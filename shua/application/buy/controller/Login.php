<?php
namespace app\buy\controller;
use app\common\controller\Img;
use think\Cache;
use think\captcha\Captcha;
use think\Exception;
use think\Request;
use think\Db;
use app\common\model\Sms; //引入手机验证码
use think\Controller;//引入系统控制器
use app\buy\model\Login as Log; //引入model类类名重复 用 log 代替

class Login extends Controller//继承系统控制器
{

    //自动插旗
    public function autoFlag(){
        $list = Db::name('user_task')
            ->where('flag',1)//5
            ->limit(10)->order('id desc')
            ->select()->toArray();

        foreach ($list as $info){
            $shopInfo = Db::name('shop')->where('id', $info['shop_id'])->find();

            if(!$shopInfo || !$shopInfo['flag_sign']){
                continue;
            }

            // 订单API
            $url = 'https://api.yunhaike.com/api/trade/MemoUpdate';

// 基本参数
            $code = $shopInfo['flag_sign'];                                 // 验证码
            $sellerWang =$shopInfo['wangwang'];                           //旺旺名
            $timestamp = date('Y-m-d H:m:s');

// 对验证码做md5摘要
            $md5 = md5($code);
            $sign = urlencode($md5);

// 以POST方式调用API
            $data = array(
                'tid'    => $info['table_order_id'],     //订单号
                'memo'    => $shopInfo['flag_memo'],
                'flag'    => '1',
                'sellerWang'    => $sellerWang,
                'sign'          => $sign,
                'timestamp'     => $timestamp
            );

            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $data22 = ['task_id'=>$info['id'],'request'=>http_build_query($data),'time'=>date('Y-m-d H:i:s')];
            $res=Db::name('flag')->insertGetId($data22);

            $context  = stream_context_create($options);
            $result = file_get_contents($url, false, $context);

            $result1=json_decode($result);
            if($result1->IsSuccess){
                Db::name('user_task')->where(['id'=>$info['id']])->update(['flag'=>0]);
            }

            $result=json_encode($result,JSON_UNESCAPED_UNICODE);
            Db::name('flag')->where(['id'=>$res])->update(['return'=>$result]);
            //echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
    }
    //自动发货返款
    public function returnPay(){
        $list = Db::name('user_task')
            ->where('state',3)//5
            ->where('delivery_state',1)
            ->where('update_time','<',strtotime ( "-1 day" ))
            ->select()->toArray();

        foreach ($list as $info){
            $data['price'] = $info['principal'];
            $data['id'] = $info['id'];
            //$margin = Db::name('seller_task')->where(['id'=>$info['seller_task_id']])->value('margin');
            //$margin = $margin ? $margin : 0;
            $seller_principal = $info['user_principal']?$info['user_principal']: $data['price'];

            $price = $seller_principal - $info['principal'] ;//- $margin;
            $seller = Db::name('seller')
                ->where('id',$info['seller_id'])
                ->find();
            if($seller['balance'] < $price){
                continue;
            }

            $userA=Db::name('users')
                ->where('id',$info['user_id'])
                ->find();
            $add_balance=$userA['balance']+$seller_principal;//返款佣金 买手本身的佣金+商家确认返还的佣金
            $refund_message=[
                'balance'=>$add_balance,
            ];

            Db::startTrans();
            if($price != 0){
                $update['balance'] = $seller['balance'] - $price;
                Db::name('seller')->where(['id'=>$seller['id']])->update($update);
                if($price < 0){
                    $prices = -$price;
                    $str = '退回';
                }else{
                    $prices = $price;
                    $str = '扣除';
                }
                if(!finance($seller['id'],1, -$price,1,9,"任务{$info['task_number']}自动完成,返款补差额{$str}本金{$prices}"))throw new Exception('财务写入失败！');
            }
            $task['seller_principal'] =$seller_principal;
            $task['platform_refund_time'] = time();
            $task['state'] = 6;
            Db::name('user_task')->where(['id'=>$info['id']])->update($task);
            $resA =Db::name('users')->where('id', $info['user_id'])->update($refund_message);
            if($resA) {
                finance($info['user_id'], 2, +$seller_principal, 1, 7,"任务{$info['task_number']}自动完成,退还本金{$seller_principal}元");
            }
            Db::commit();
        }
    }
    
    

    public function hour_task(){
        $list = Db::name('seller_task')
            ->where('is_hour_publish', 1)
            ->where('publish_time', '<', time())
            ->where('publish_time', '>', strtotime(date('Y-m-d')))
            ->select();
        $list = $list ? $list->toArray() : [];
        $h =date('H');

        foreach ($list as $task) {
            $hour_msg = json_decode($task['hour_msg']);
            $hour_msg =array_slice($hour_msg,0,$h+1);

            $nums = array_sum($hour_msg);

            if($task['num']<$nums){
                $add_nums = $nums-$task['num'];
                $incomplete_num = $task['incomplete_num']+$add_nums;
                Db::name('seller_task')->where('id', $task['id'])->update(['num'=>$nums,'incomplete_num'=>$incomplete_num]);
            }
        }

        echo 'OK';

    }


    //买家接任务后，如果1个小时没有去完成任务自动取消。
    public function channel_task(){
        $list = Db::name('user_task')
            ->where('state', 0)
            ->where('create_time','<', strtotime ( "-1 hour" ))
            ->select();
        $list = $list ? $list->toArray() : [];
        $now = time();
        $begin_day = strtotime(date('Y-m-d', time()));
        $begin_day_nine = $begin_day + 9 * 3600;
        $begin_day_elevn = $begin_day + 23 * 3600;

        foreach ($list as $user_task) {

            $user = Db::name('users')->where('id', $user_task['user_id'])->find();
            $return_reward = $user['reward'] + 1;
            if ($now < $begin_day_nine || $now > $begin_day_elevn) {
                $return = [
                    'reward' => $return_reward,
                ];
            } //当前时间如果是晚上11点到第二天9点 取消任务返还1银锭
            $delcounttime['cancel_time'] = ['between', [$begin_day_nine, $begin_day_elevn]];
            $return_task_count = Db::name('user_task')
                ->where('state', 2)
                ->where('user_id', $user_task['user_id'])
                ->where($delcounttime)
                ->count();
            if ($return_task_count <= 2) {
                $return = [
                    'reward' => $return_reward,
                ];
            } //买手白天9点到晚上11点接单可以自行放弃2个任务，系统不扣脉点。
            $between_time_day['complete_time'] = ['between', [$begin_day, $now]];
            $sell_task = Db::name('seller_task')
                ->where('id', $user_task['seller_task_id'])
                ->find();
            $del = [
                'state' => 2,
                'cancel_reason' => '系统自主取消任务',
                'cancel_time' => time(),
                'deltask_type' => 2
            ];
            $lately_user_task = Db::name('user_task')->where('seller_task_id', $user_task['seller_task_id'])
                ->max('id');
            if ($lately_user_task == $user_task['id']) {
                $return_task = [
                    'incomplete_num' => $sell_task['incomplete_num'] + 1,
                    'receipt_time' => 0,
                ];
            } else {
                $return_task = [
                    'incomplete_num' => $sell_task['incomplete_num'] + 1,
                ];
            }

            Db::startTrans();

                $have_del_task = Db::name('user_task')->where('id', $user_task['id'])->update($del);
                Db::name('seller_task')->where('id', $sell_task['id'])->update($return_task);

                /**
                if ($have_del_task) {
                    if ($now < $begin_day_nine || $now > $begin_day_elevn) {
                        $nine_return = Db::name('users')->where('id', $user_task['user_id'])->update($return);
                        finance($user_task['user_id'], 2, +1, 2, 13, "客服不上班期间（23点-9点）系统放弃任务{$user_task['task_number']},解除冻结1银锭");
                    } else {
                        if ($return_task_count < 200000) {
                            $return_task_count_jia = $return_task_count + 1;
                            $nine_return = Db::name('users')->where('id', $user_task['user_id'])->update($return);
                            finance($user_task['user_id'], 2, +1, 2, 13, "任务自行放弃不扣银锭，第{$return_task_count_jia}单：{$user_task['task_number']}, 放弃后解除冻结1银锭 系统会自动返还");
                        } else {
                            finance($user_task['user_id'], 2, -1, 2, 13, "系统自行放弃任务{$user_task['task_number']},扣除冻结的1银锭");
                        }
                    }
                }*/


                $praise_ids = json_decode($user_task['ids']);
                if ($user_task['ids'] && $praise_ids) {
                    Db::name('seller_task_praise')->where(['id' => ['in', $praise_ids]])->update(['state' => 0]);
                }
                if ($user_task['is_shengji'] == 2) {
                    $key_ids = explode(',', $user_task['key_id']);
                    if ($user_task['key_id'] && $key_ids) {
                        Db::name('task_word')->where(['id' => ['in', $key_ids]])->setInc('ynum', 1);
                    }
                }

                Db::commit();


        }



   echo 'OK';

    }

    public function index(Request $request)
    {
        if(isMobile())return $this->redirect(url('mobile/login/index'));
        if($request->isAjax()){
            //实例化引入过来的类
            $data=input('post.');
            $captcha = new \think\captcha\Captcha();
           // if(!$captcha->check($data['captcha_code'])){   //验证码
           if (1==2) {
                return $this->error('验证码错误');
            }else{
            $login=new Log;
            $db=$login->login(input('name'),input('password'));
            if($db==1){
                $now=time();
                $users= Db::name('users')->where('username','=',$data['name'])->find();
                
                
                $admin_limit=Db::name('system')->where('id',1)->find();
                $strs = str_replace('，', ',', $admin_limit['limit_mobile']);
                $array = explode(',', $strs);

                if(in_array($users['mobile'],$array)){
                    return $this->error('此手机号码已被禁止登录，请联系客服');
                }
                $list_limit = Db::name('hei')->select()->toArray();
                $mobileArr = $wwArr = $sfzArr = $qqArr =[];
                foreach ($list_limit as $limit){
                    if($limit['type']==1)$mobileArr[]=$limit['name'];
                    if($limit['type']==2)$wwArr[]=$limit['name'];
                    if($limit['type']==3)$qqArr[]=$limit['name'];
                    if($limit['type']==4)$sfzArr[]=$limit['name'];
                }

                if(in_array($users['mobile'],$mobileArr)){
                    return $this->error('黑名单禁止登录，请联系客服');
                }

                if($users['qq'] && in_array($users['qq'],$mobileArr)){
                    return $this->error('黑名单禁止登录，请联系客服');
                }
                $idcard =Db::name('user_bank')->where('user_id',$users['id'])->where('state',1)->value('idcard');
                if($idcard && in_array($idcard,$sfzArr)){
                    return $this->error('黑名单禁止登录，请联系客服');
                }

                $wwlist = Db::name('user_buyno')->where('uid',$users['id'])->where('state',1)->column('wwid');
                foreach ($wwlist as $ww){
                    if($ww && in_array($ww,$wwArr)){
                        return $this->error('黑名单禁止登录，请联系客服');
                    }
                }

                if($users['vip_time']<$now){
                    //$edituservip=Db::name('users')->where('username','=',$data['name'])->update(['vip'=>0]);
                }
                $operation_time=time();
                \think\Session::set('operation_time',$operation_time);
                $insert_ip = request()->ip();
                $update=[
                    'logins_ip'=>$insert_ip
                ];
                Db::name('users')->where('id',$users['id'])->update($update);
                return $this->success('登录成功正在跳转','My/index');
            }elseif($db==2){
                return $this->error('账号或密码错误');
                return $this->success('登录成功正在跳转','My/index');
            }else{
                return $this->error('用户不存在');
            }
            }
       }
        return $this->fetch();
    }

    /**
     * @notes 判断是否是登录状态
     * @date 2019/12/3
     * @time 15:05
     */
    public function getSession(){
        if(session('id')){
            return $this->error();
        };
        return $this->success('',url('login/index'));
    }

    public function logout()
    {
        session(null);
        return $this->success('退出成功，即将返回登录页面！',url('login/index'));
    }

    public function register(Request $request){
        $data = $request->param();
        $type = isset($data['type']) ? $data['type'] : '';
        $invite_code = isset($data['invite']) ? $data['invite'] : '';
        if(isMobile())return $this->redirect(url('mobile/login/register',['type'=>$type,'invite'=>$invite_code]));
        $this->assign('type',$type);
        $this->assign('invite',$invite_code);
        return view();
    }

    /*注册验证手机号码*/
    public function check_mobile(){
        $data=input();
        $user=Db::name('users')->where('mobile',$data['mobile'])->count();
        if($user>0){
            return $this->error('此手机号码已被注册');
        }
    }
    /*注册验证*/
    public function check_register(){
        return $this->error('注册已关闭,请联系客服');
        $code=session('code');
        $data=input();
        $data['username']=trim($data['username']);
        $data['mobile']=trim($data['mobile']);
        $hava_seller_name=Db::name('seller')->where('seller_name',$data['username'])->count();
        if($hava_seller_name >= 1){
            return $this->error('此用户名已被注册');
        }
        $result = $this->validate($data,'Register');
        if(true !== $result){
            return $this->error($result);
        }
        if($data['login_pwd'] !== $data['login_pwd2']){
            return $this->error('您两次输入的密码不一致,请检查后重新输入');
        }
        $code_time=session( 'code_time');
        $code_time=$code_time+15*60;    //短信验证码时间为15分钟
        $time=time();
       /*if($data['dxyzm'] != $code){
           return $this->error('您输入的验证码不正确');
       }
        $session_mobile=session('mobile');
        if($session_mobile != $data['mobile']){
            return $this->error('请输入获取验证码的手机号');
        }
        if($code_time<$time){
            return $this->error('验证码已失效');
        }*/
        $admin_limit=Db::name('system')->where('id',1)->find();
        $add_vip_time=$admin_limit['user_vip_time']*24*3600+$time;
        $strs = str_replace('，', ',', $admin_limit['limit_mobile']);
        $array = explode(',', $strs);
        $db = '';
        if($data['type']==1){
            $db = 'users';
            $field = 'username';
        }
        if($data['type']==2){
            $db = 'seller';
            $field = 'seller_name';
        }
       // if(!$db)return $this->error('推荐链接有误！');
       if ($data['invite']!=''){
          $tjuser = Db::name($db)->where(['invite_code'=>$data['invite'],'state'=>1])->value($field);
          if(!$tjuser)return $this->error('推荐链接有误！');}
       else   $tjuser =  '';


        foreach($array as $v){
            if($v == $data['mobile']){
                return $this->error('此手机号码已被禁止注册，请联系客服');
            }
        }
        $user=[
            'username'      =>     $data['username'],
            'mobile'        =>      $data['mobile'],
            'login_pwd'     =>      md5($data['login_pwd']),
            'qq'            =>      $data['qq'],

            'wechat'            =>      $data['wechat'],
            'province'            =>      $data['province'],
            //'province1'            =>      $data['province1'],
            'city'            =>      $data['city'],
            //'city1'            =>      $data['city1'],


            'create_time'   =>      time(),
            'reward'        =>      $admin_limit['user_num'],
            'vip'           =>      1,
            'invite_code'   =>      md5(time().rand(0,99999)),
            'vip_time'      =>      $add_vip_time,
            'state'         =>      1,
        ];
        $user['tjuser'] = $tjuser;
        $user['tjuser_state'] = $data['type'];

        $user_insert = db::name('users')->insertGetId($user);
        if($user_insert){
            $user_insert=Db::name('users')->where('id',$user_insert)->find();
            $bill=[
                'uid'               =>      $user_insert['id'],
                'utype'             =>      2,
                'user_name'         =>      $user_insert['username'],
                'price'             =>      0,
                'create_time'       =>      time(),
                'expire_time'       =>      $user_insert['vip_time'],
                'remarks'           =>     "注册成功，免费赠送一年会员",
            ];
           $vip_record=Db::name('vip_record')->insertGetId($bill);
           if($vip_record){
               finance($user_insert['id'], 2, 4, 2, 14, "首次注册赠送4银锭");
           }
         }
        return $this->success('注册成功正在跳转','Login/index');
    }

    public function forgot(){
        if(isMobile())return $this->redirect(url('mobile/login/forgot'));
        return view();
    }
    public function forget_edit(){
        $data=input();
        $code=session('code');
        $data=input();

        if($data['newpassword'] !== $data['newpassword2']){
            return $this->error('您两次输入的密码不一致,请检查后重新输入');
        }
        $code_time=session( 'code_time');
        $code_time=$code_time+15*60;    //短信验证码时间为15分钟
        $time=time();
        if($data['dxyzm'] != $code){
            return $this->error('您输入的验证码不正确');
        }
        $session_mobile=session('mobile');
        if($session_mobile != $data['mobile']){
            return $this->error('请输入获取验证码的手机号');
        }
        if($code_time<$time){
            return $this->error('验证码已失效');
        }
        $newpassword=[
            'login_pwd'=>md5($data['newpassword'])
        ];
        db('users')->where('mobile',$data['mobile'])->update($newpassword);
        return $this->success('修改成功正在跳转','login/index');
    }

    public function yanzhengma(){
        $captcha = new Captcha();
        // 设置验证码字符为纯数字
        $captcha->codeSet = '0123456789';
        return $captcha->entry();
    }

    //自动生成任务
    public function auto_create_task(){
        $list = Db::name('task_import')
            ->where('state',0)
            ->chunk(20,function ($list){
                $system = Db::name('system')->find();
                foreach ($list as $info){
                    $lock_key = 'task_import_import:'.$info['id'];
                    if(Cache::get($lock_key)){
                        continue;
                    }
                    Cache::set($lock_key,1,60);
                    $url = $info['C'];
                    $goodsInfo = Db::name('goods')->where('shop_id', $info['shop_id'])->where('link',$url)->find();
                    if($goodsInfo){
                        $goods_id = $goodsInfo['id'];
                    }else{
                        //https://item.taobao.com/item.htm?spm=a21dvs.23580594.0.0.1d293d0dRvzgmU&ft=t&id=686484992981
                        //https://detail.tmall.com/item.htm?id=754341403704&scene=taobao_shop&spm=a1z10.1-b-s.w5003-24984680753.23.546947c0rtXn7h
                        $itemid = $goods_id= 0;
                        $taobao_info = explode('id=',$url);
                        if(isset($taobao_info['1']) && $taobao_info['1']){
                            $info2 = explode('&',$url);
                            $itemid = $info2['0'];
                        }
                        $t_info = \app\common\model\Api::getTaoBao($itemid);
                        if(!$t_info || empty($t_info['img'])){
                            Db::name('task_import')->where(['id'=>$info['id']])->update(['state'=>2]);
                            continue;
                        }

                        $shop_name = isset($t_info['title'])?$t_info['title']:$t_info['shopName'];
                        $good_img = $t_info['img'];
                        $add['pc_img'] = json_encode([$good_img]);
                        $add['name'] = $shop_name;
                        $add['shop_id'] = $info['shop_id'];
                        $add['seller_id'] = $info['uid'];
                        $add['link'] = $url;
                        $add['taobao_id'] = $itemid;
                        $add['show_price'] =$t_info['price'];
                        $add['create_time'] = time();
                        $goods_id = Db::name('goods')->insertGetId($add);

                    }
                    if($goods_id){
                        $shop = Db::name('shop')->where(['id'=>$info['shop_id'],'state'=>1])->find();
                        if(!$shop){
                            Db::name('task_import')->where(['id'=>$info['id']])->update(['state'=>3]);
                            continue;
                        }
                        $good_info = Db::name('goods')->where(['id'=>$goods_id])->find();
                        $pc_img_arr = json_decode($good_info['pc_img']);
                        $good_info['pc_img'] = $pc_img_arr['0'];

                        if($info['A'] =='淘口令'){
                            $info['task_type'] = 2;
                        }else{
                            $info['task_type'] = 1;
                        }

                        $add['shop_id']   = $info['shop_id'];
                        $add['task_type'] = $info['task_type'];
                        $add['seller_id'] = $info['uid'];
                        if($add['task_type']==2)$add['tao_word'] =$info['B'];// $info['tao_word'];
                        if($add['task_type']==3)$add['qr_code'] ='';// $info['qr_code'];
                        if($add['task_type']==5)$add['channel_img'] = '';
                        $add['terminal'] = 2;
                        $add['task_number'] = time().rand(100000,999999);
                        $add['shop_name'] = $shop['shop_name'];
                        $add['code'] = $shop['code'];
                        $add['is_shengji'] = 2;
                        $add['step'] = 1;
                        $add['address'] = $shop['province'].'-'.$shop['city'].'-'.$shop['area'].'-'.$shop['address'].'-'.$shop['mobile'];
                        $add['create_time'] = time();
                        $add['goods_number'] = 1;

                        if(isset($add['tao_word']) && $add['tao_word']){
                            $add['tao_word'] = str_replace("\n",'', $add['tao_word']);
                            $add['tao_word'] = str_replace("\r", '', $add['tao_word']);
                        }

                        $goods_price = $info['D'] * $info['E'];
                        $goods_z_price = $info['D'];

                        $add['goods_more_fee'] = 0;
                        $add['goods_price'] = $goods_price;
                        $add['goods_z_price'] = $goods_z_price;

                        //step2
                        $divide_price = 0;
                        $add['is_free_shiping'] = 0;
                        $add['postage'] = 0;
                        $add['weight'] = 0;
                        $add['memo'] = $info['F'];
                        $add['num'] = $info['I'];
                        $add['incomplete_num'] = $info['I'];
                        $add['step'] = 2;
                        $add['goods_money'] = $goods_price * $info['I'];
                        $add['goods_more_fee'] = 0; //多商品费用

                        $add['service_price'] = 0; //套餐服务费
                        $list = Db::name('commission')->where(['max_goods_price'=>['egt',$goods_price]])->order('max_goods_price asc')->find();
                        if($list){
                            $add['service_price'] = $list['seller_reward'];
                        }

                        /*返款服务费用计算*/
                        $add['refund_service_price'] = round($system['refund_service_price'] * $goods_price,2);
                        $add['refund_service_price'] = $add['refund_service_price'] > 2 ? 2 : $add['refund_service_price'];
                        $add['phone_fee'] = $system['phone_fee'];
                        $add['is_praise'] = $add['praise_fee']=$add['is_video_praise'] = $add['video_praise_fee']  =$add['is_img_praise'] =$add['img_praise_fee']= 0;
                        if($info['M']){
                            $add['is_praise'] =1;
                            $add['praise_fee'] =$system['praise'] ;
                            $divide_price +=  $system['praise'] * $info['I'];
                        }
                        $add['add_reward'] = 0;//加赏任务佣金
                        $add['is_cycle_time'] = 0;
                        $add['cycle_time'] = 0;
                        $add['cycle'] = 0;
                        $add['is_timing_pay'] = 0;
                        $add['timing_pay'] = 0;
                        $add['is_ys'] = 0;
                        $add['timing_time'] ='';
                        $add['next_day'] = 0;
                        $add['next_day_fee'] = 0;
                        $add['is_repay'] = 0;
                        $add['repay'] = 0;
                        $divide_price += $add['phone_fee'] * $info['I'];
                        $add['user_divided'] = round($divide_price * $system['divided'],2);

                        /*银锭统计*/
                        $price = $divide_price;
                        $add['is_timing_publish'] = 0;
                        $add['timing_publish_pay'] = 0;
                        $add['publish_time'] = time();
                        /*定时发布统计*/
                        if($info['K']){
                            $add['is_timing_publish'] = 1;
                            $price += $system['timing_publish'];
                            $add['timing_publish_pay'] = $system['timing_publish'];
                            $add['publish_time'] =strtotime( $info['K']);
                        }

                        /*接单间隔时间(分钟)*/
                        $add['union_interval_time'] = 0;
                        $add['union_interval'] = 0;
                        $price += $add['refund_service_price'] * $info['I'];//返款服务费
                        $price += $add['union_interval'];
                        $price += $add['service_price'] * $info['I'];//套餐服务费
                        $add['postage_money'] =0; //运费总计
                        $add['margin'] = 0; //商家保证金
                        $add['deposit'] = $add['postage_money'] + $add['goods_money'] ; //押金总计
                        $add['silver_ingot'] = $price; //银锭总计

                        $add['is_hour_publish'] = 0;
                        $add['hour_msg'] = '';
                        if(isset($info['L']) && $info['L']){
                            $add['is_hour_publish'] = 1;
                            $hour_msg_arr = explode('#',$info['L']);
                            $data=[];
                            foreach ($hour_msg_arr as $hour){
                                $str1 =explode('_',$hour);
                                if(isset($str1['1'])){
                                    $data['time_'.$str1['0']]=$str1['1'];
                                }
                            }

                            $hour_msg[0] = isset($data['time_0'])?$data['time_0']:0;
                            $hour_msg[1] = isset($data['time_1'])?$data['time_1']:0;
                            $hour_msg[2] = isset($data['time_2'])?$data['time_2']:0;
                            $hour_msg[3] = isset($data['time_3'])?$data['time_3']:0;
                            $hour_msg[4] = isset($data['time_4'])?$data['time_4']:0;
                            $hour_msg[5] = isset($data['time_5'])?$data['time_5']:0;
                            $hour_msg[6] = isset($data['time_6'])?$data['time_6']:0;
                            $hour_msg[7] = isset($data['time_7'])?$data['time_7']:0;
                            $hour_msg[8] = isset($data['time_8'])?$data['time_8']:0;
                            $hour_msg[9] = isset($data['time_9'])?$data['time_9']:0;
                            $hour_msg[10] = isset($data['time_10'])?$data['time_10']:0;
                            $hour_msg[11] = isset($data['time_11'])?$data['time_11']:0;
                            $hour_msg[12] = isset($data['time_12'])?$data['time_12']:0;
                            $hour_msg[13] = isset($data['time_13'])?$data['time_13']:0;
                            $hour_msg[14] = isset($data['time_14'])?$data['time_14']:0;
                            $hour_msg[15] = isset($data['time_15'])?$data['time_15']:0;
                            $hour_msg[16] = isset($data['time_16'])?$data['time_16']:0;
                            $hour_msg[17] = isset($data['time_17'])?$data['time_17']:0;
                            $hour_msg[18] = isset($data['time_18'])?$data['time_18']:0;
                            $hour_msg[19] = isset($data['time_19'])?$data['time_19']:0;
                            $hour_msg[20] = isset($data['time_20'])?$data['time_20']:0;
                            $hour_msg[21] = isset($data['time_21'])?$data['time_21']:0;
                            $hour_msg[22] = isset($data['time_22'])?$data['time_22']:0;
                            $hour_msg[23] = isset($data['time_23'])?$data['time_23']:0;

                            $total = array_sum($hour_msg);

                            if($total !=$info['I']){
                                Db::name('task_import')->where(['id'=>$info['id']])->update(['state'=>4]);
                                continue;
                            }
                            $add['hour_msg'] = json_encode($hour_msg);
                            $add['num'] = 0;
                            $add['incomplete_num'] = 0;

                        }
                        $key_word_num_arr = explode('#',$info['H']);

                        $is_praise_arr = explode('#',$info['M']);
                        if($info['I'] != count($is_praise_arr)){
                            Db::name('task_import')->where(['id'=>$info['id']])->update(['state'=>5]);
                            continue;
                        }
                        $seller = Db::name('seller')->where('id',$info['uid'])->find();

                        if(($seller['balance'] + $seller['reward']) < ($add['deposit']+$add['silver_ingot'])){
                            Db::name('task_import')->where(['id'=>$info['id']])->update(['state'=>6]);
                            continue;
                        }
                        if($add['deposit'] > $seller['balance']){
                            Db::name('task_import')->where(['id'=>$info['id']])->update(['state'=>7]);
                            continue;
                        }

                        Db::startTrans();
                        $task_id = Db::name('seller_task')->insertGetId($add);
                        $rand_num = $task_id . rand(1000,9999);
                        Db::name("seller_task")->where(['id'=>$task_id])->update(['rand_num'=>$rand_num]);

                        //$num = 0;
                        //foreach ($data['goods'] as $goods){
                        //  $num++;
                        //if($goods['price'] <= 0)throw new Exception('商品价格要大于0');
                        // if($goods['num'] <= 0)throw new Exception('商品下单数量要大于0');
                        $task_goods_add['task_id'] = $task_id;
                        $task_goods_add['goods_id'] = $goods_id;
                        $task_goods_add['price'] = $info['D'];
                        $task_goods_add['num'] = $info['E'];
                        $task_goods_add['name'] = $good_info['name'];
                        $task_goods_add['pc_img'] = $good_info['pc_img'];

                        $task_goods_add['goods_spec'] = $info['F'];
                        $task_goods_add['create_time'] = time();
                        Db::name('task_goods')->insert($task_goods_add);

                        //if(!isset($goods['key_word']))$goods['key_word'] = [];
                        $goods['key_word'] = [];
                        if($info['G']){
                            $goods['key_word'] =explode('#',$info['G']);
                        }
                        //if($data['task_type']!=2 && $data['task_type']!=3 && !$goods['key_word'])throw new Exception('添加商品关键词！');



                        foreach ($goods['key_word'] as $k=> $word){
                            //if(!$word['key_word'])throw new Exception('关键词不能为空');
                            //if(!isset($word['discount']))$word['discount'] = [];
                            $word_add_num =  isset($key_word_num_arr[$k])?$key_word_num_arr[$k]:0;
                            $word_add['goods_id'] = $goods_id;
                            $word_add['task_id'] = $task_id;
                            $word_add['key_word'] = $word;//$word['key_word'];
                            $word_add['discount'] = '';// implode(',',$word['discount']);
                            $word_add['filter'] = '';//implode(',',$word['filter']);
                            $word_add['sort'] = '';// $word['sort'];

                            $word_add['max_price'] ='0.00';// $word['max_price'];
                            $word_add['min_price'] ='0.00';// $word['min_price'];
                            $word_add['province'] = '';//$word['province'];
                            $word_add['create_time'] = time();
                            $word_add['num'] =$word_add_num;
                            $word_add['ynum'] = $word_add_num;
                            Db::name('task_word')->insert($word_add);
                        }
                        //  }
                        foreach ($is_praise_arr as $k=>$val){
                            $create['content'] = $val ? trim($val) : '好评为空';
                            $create['goods_id'] = $goods_id;
                            $create['seller_task_id'] = $task_id;
                            $create['type'] = 1;
                            $create['create_time'] = time();
                            Db::name('seller_task_praise')->insert($create);
                        }
                        $price1 = $add['deposit'];
                        $price2 = 0;
                        if($add['silver_ingot'] > $seller['reward']){
                            $prices = $seller['reward'];
                            $price2 += $add['silver_ingot'] - $seller['reward'];
                            $update['reward'] = 0;
                        }else{
                            $prices = $add['silver_ingot'];
                            $update['reward'] = $seller['reward'] - $add['silver_ingot'];
                        }

                        $update['balance'] = $seller['balance'] - $price1;
                        Db::name('seller')->where(['id'=>$seller['id']])->update($update);
                        $task_update['status'] = 2;
                        $task_update['step'] = 2;
                        $task_update['pay_state'] = 1;
                        $task_update['pay_time'] = time();
                        $task_update['yajin'] = $price1+$price2;
                        $task_update['yinding'] = $prices;
                        Db::name('seller_task')->where(['id'=>$task_id,'seller_id'=>$seller['id']])->update($task_update);
                        if($prices > 0){
                            if(!finance($seller['id'],1,-$prices,2,5,"使用银锭发布《{$shop['shop_name']}》店铺任务{$add['task_number']}扣除银锭{$prices}银锭"))throw new Exception('银锭财务写入失败');
                        }
                        if(!finance($seller['id'],1,-$price1,1,5,"使用本金发布《{$shop['shop_name']}》店铺任务{$add['task_number']}扣除本金{$price1}元"))throw new Exception('押金财务写入失败！');
                        if($price2 > 0){
                            Db::name('seller')->where(['id'=>$seller['id']])->setDec('balance',$price2);
                            if(!finance($seller['id'],1,-$price2,1,15,"使用本金代付银锭发布《{$shop['shop_name']}》店铺任务{$add['task_number']}扣除本金{$price2}元"))throw new Exception('押金代付财务写入失败！');
                        }
                        Db::name('task_import')->where(['id'=>$info['id']])->update(['state'=>1]);
                        Db::commit();
                    }
                    //Cache::rm($lock_key);
                }
            },['id']);
    }
}

