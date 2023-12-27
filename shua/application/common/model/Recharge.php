<?php


namespace app\common\model;
use think\Model;

class Recharge extends Model
{
    public  function getCreateTimeAttr($value){
        return date('Y-m-d H:i:s',$value);
    }
    public  function getUserTypeAttr($value){
        $type_array=array(
            '1'=>"商家",
            '2'=>"买手",
        );
        return $type_array[$value];
    }

    public  function getPayTypeAttr($value){
        $type_array=array(
            '1'=>"支付宝",'0'=>'',
            '2'=>"本金",'3'=>'银行卡'
        );
        return $type_array[$value];
    }
    public  function getRechargeTypeAttr($value){
        $type_array=array(
            '1'=>"本金",
            '2'=>"银锭",
        );
        return $type_array[$value];
    }

    public  function getTypeAttr($value){
        $type_array=array(
            '1'=>"充值",
            '2'=>"购买会员",
        );
        return $type_array[$value];
    }

    public  function getStateAttr($value){
        $type_array=array(
            '0'=>"未到账",
            '1'=>"充值成功",'2'=>'失败'
        );
        return $type_array[$value];
    }
}
