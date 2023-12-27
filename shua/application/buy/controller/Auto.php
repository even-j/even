<?php
namespace app\buy\controller;
use think\captcha\Captcha;
use think\Request;
use think\Db;
use app\common\model\Sms; //引入手机验证码
use think\Controller;//引入系统控制器
use app\buy\model\Login as Log; //引入model类类名重复 用 log 代替

class Auto extends Controller//继承系统控制器
{
    //自动插旗
    public function autoFlag(){
        $list = Db::name('user_task')
            ->where('flag',1)//5
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
                'flag'    => '2',
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
            $margin = Db::name('seller_task')->where(['id'=>$info['seller_task_id']])->value('margin');
            $margin = $margin ? $margin : 0;
            $price = $data['price'] - $info['principal'] - $margin;
            $seller = Db::name('seller')
                ->where('id',$info['seller_id'])
                ->find();
            if($seller['balance'] < $price){
                continue;
            }

            $userA=Db::name('users')
                ->where('id',$info['user_id'])
                ->find();
            $add_balance=$userA['balance']+$data['price'];//返款佣金 买手本身的佣金+商家确认返还的佣金
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
                if(!finance($seller['id'],1, -$price,1,9,"任务{$info['task_number']}返款补差额{$str}本金{$prices}"))throw new Exception('财务写入失败！');
            }
            $task['seller_principal'] = $data['price'];
            $task['platform_refund_time'] = time();
            $task['state'] = 6;
            Db::name('user_task')->where(['id'=>$info['id']])->update($task);
            Db::name('users')->where('id', $info['user_id'])->update($refund_message);

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

}

