<?php


namespace app\buy\controller;


use app\common\model\Sms;
use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class Api extends Controller
{

   public function getTask(){
       $table_order_id = input('post.table_order_id','');
       $start_time = input('post.start_time','');
       $end_time = input('post.end_time','');

       $page = input('post.page',1);
       $limit = input('post.limit',20);
       $mobile = input('post.mobile','');
       $login_pwd = input('post.login_pwd','');
       $user = Db::name('seller')->where('mobile',$mobile)->where('login_pwd',md5($login_pwd))->find();
       if(!$user){
           return json(['code' => 400,  'msg' => '账密错误']);
       }
       $where['seller_id'] = $user['id'];

       if($table_order_id){
           $where['table_order_id'] = $table_order_id;
       }

       if($start_time){
           $where['create_time'] =['>=',$start_time];
       }
       if($end_time){
           $where['create_time'] =['<=',$end_time];
       }
       $count =  Db::name('user_task')->where($where)->count('id');
       $list = Db::name('user_task')
           ->where($where)->order('id','desc')
           ->field('id,shop_id,seller_task_id,task_number,user_buyno_wangwang,principal,commission,user_principal,
           seller_principal,create_time,state,table_order_id,upload_order_time,key,text_praise,img_praise,video_praise,high_praise_time')
           ->limit(($page - 1) * $limit, $limit)
           ->select()->toArray();

       $shopIds = array_column($list,'shop_id');
       $shopArr = Db::name('shop')->whereIn('id',$shopIds)->column('shop_name','id');

       $taskIds = array_column($list,'seller_task_id');
       $taskArr = Db::name('seller_task')->whereIn('id',$taskIds)
           ->column('id,task_number,is_praise,is_img_praise,is_video_praise,refund_service_price,praise_fee,
           img_praise_fee,video_praise_fee,service_price,goods_more_fee,phone_fee,pc_fee','id');
        foreach ( $taskArr as &$task){
            $task['goods'] =  Db::name('task_goods')
                ->where('task_id',$task['id'])->field('')
                ->join('tfkz_goods','tfkz_goods.id=tfkz_task_goods.goods_id','left')
                ->field('tfkz_goods.id,tfkz_goods.name,tfkz_goods.link')
                ->select()->toArray();
        }

       foreach ($list as $k=>&$v){
           $v['shop_name'] =isset($shopArr[$v['shop_id']])?$shopArr[$v['shop_id']]:$v['shop_id'];
           $v['task'] = isset($taskArr[$v['seller_task_id']])?$taskArr[$v['seller_task_id']]:$v['seller_task_id'];
           unset($v['shop_id']);
       }

       return json(['code' => 0,  'msg' => '获取数据成功','count'=>$count, 'data' => $list]);
   }


    public function api(Request $request)
    {
        $data = $request->param();
        if(!isset($data['password']))return json_encode(['code'=>0,'msg'=>'密码错误','data'=>'']);
        if($data['password'] != md5('tfapi'))return json_encode(['code'=>0,'msg'=>'密码不正确','data'=>'']);
        unset($data['password']);
        if(!$data)return json_encode(['code'=>1,'msg'=>'执行成功','data'=>[]]);
        $ids = [];
        $idss = [];
        foreach ($data as $item){
            $list = Db::name('user_task')->where(['id'=>$item])->field('id,user_id,task_number,task_type,task_step,seller_task_id,state,ending_time,create_time,ids,key_id,is_shengji')->find();
            if($list){
                if($list && $list['state']==0){
                    if($list['task_type']==1 && ($list['create_time']+7200) > time())continue;
                    if($list['task_type']==2){
                        if(($list['create_time']+7200) > time())continue;
                        $times = strtotime(date('Y-m-d',$list['create_time']))+24*3600 + 16*3600 + 2400;
                        if($times > time() && $list['task_step'] > 1)continue;
                    }
                    if($list['task_type']==3){
                        if(($list['create_time']+7200) > time())continue;
                        if($list['ending_time'] > time() && $list['task_step'] > 1)continue;
                    }
                    try{
                        Db::startTrans();
                        Db::name('user_task')->where(['id'=>$list['id']])->update(['state'=>2,'cancel_time'=>time(),'deltask_type'=>1]);
                        $last = Db::name('user_task')->where(['seller_task_id'=>$list['seller_task_id'],'create_time'=>['gt',$list['create_time']]])->find();
                        if(!$last){
                            Db::name('seller_task')->where(['id'=>$list['seller_task_id']])->update(['receipt_time'=>0]);
                        }
                        Db::name('seller_task')->where(['id'=>$list['seller_task_id']])->setInc('incomplete_num',1);
                        if(!finance($list['user_id'],2,-1,2,13,"任务{$list['task_number']}超时取消,扣除冻结1银锭"))throw new Exception('财务写入失败！');
                        $ids[] = $list['id'];
                        $praise_ids = json_decode($list['ids']);
                        if($list['ids'] && $praise_ids){
                            Db::name('seller_task_praise')->where(['id'=>['in',$praise_ids]])->update(['state'=>0]);
                        }
                        if($list['is_shengji']==2){
                            $key_ids = explode(',',$list['key_id']);
                            if($list['key_id'] && $key_ids){
                                Db::name('task_word')->where(['id'=>['in',$key_ids]])->setInc('ynum',1);
                            }
                        }
                        Db::commit();
                    }catch (Exception $e){
                        Db::rollback();
                    }
                }else{
                    $ids[] = $list['id'];
                }
            }else{
                $idss[] = $item;
            }
        }
        return json_encode(['code'=>1,'msg'=>'写入成功！','data'=>['ids'=>$ids,'delid'=>$idss]]);
    }

    /**
     * @notes 隔天任务继续完成提醒
     * @date 2019/10/28
     * @time 17:26
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function sendSms()
    {
        $where['task_type'] = 2;
        $s_time = strtotime(date('Y-m-d')) - 24*3600;
        $end_time = strtotime(date('Y-m-d'));
        $where['create_time'] = ['between',"$s_time,$end_time"];
        $where['state'] = 0;
        $list = Db::name('user_task')->where($where)->field('id,user_id,task_number,task_type,task_step,seller_task_id,state,ending_time,create_time,ids')->select();
        $list = $list ? $list->toArray() : [];
        foreach ($list as $item){
            $mobile = Db::name('users')->where(['id'=>$item['user_id']])->value('mobile');
            if(!$mobile)continue;
            $check = '/^1[3-9]{1}[0-9]{9}$/';
            if (!preg_match($check, $mobile))continue;
            $memo = "您有编号为{$item['task_number']}的隔天任务等待您继续完成！";
            Sms::send($mobile,$memo);
        }
    }


    public function timer(){
        Db::name('users')->where(['id'=>['gt',0]])->update(['qualified'=>0]);
        Db::name('users')->where(['mc_task_num'=>['gt',0]])->update(['mc_task_num'=>0]);  //每月完成单量初始化
    }

    public function setTjday(){
        Db::name('users')->where(['tj_award_day'=>['gt',0]])->update(['tj_award_day'=>0]);
        Db::name('seller')->where(['tj_award_day'=>['gt',0]])->update(['tj_award_day'=>0]);
    }

    /**
     * @Function 预售任务到时间取消
     * @Author 扬风
     * @Date: 2020/3/4
     * @Time: 9:12
     */
    public function setYs(){
        $time1 = strtotime(date('Y-m-d 23:59:59'));
        $time2 = strtotime(date('Y-m-d'));
        $where['is_ys'] = 1;
        $where['ys_time'] = ['between',[$time2,$time1]];
        $where['state'] = 0;
        $where['task_step'] = 4;
        Db::name('user_task')->where($where)->update(['state'=>5]);
    }
}