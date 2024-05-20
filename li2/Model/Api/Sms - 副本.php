<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Api;
use Common\Query;
/**
 * Description of Sms
 *
 * @author Administrator
 */
class Sms {

    public static function send($mobile, $content) {
        /*云片网*/
        /*require_once(SITEROOT. 'Plugin/yunpian/YunpianAutoload.php');
        $site_sms = \Model\Admin\Params::get ( 'site_sms' );
        $smsOperator = new \SmsOperator();
        $data['mobile'] = $mobile;
        //$data['text'] = '【华亿配资】'.$content;
        $data['text'] = $site_sms['mqianming'].$content;
        $result = $smsOperator->single_send($data);
        return $result->success;*/
        /*短信宝*/
        /*$statusStr = array(
            "0" => "短信发送成功",
            "-1" => "参数不全",
            "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
            "30" => "密码错误",
            "40" => "账号不存在",
            "41" => "余额不足",
            "42" => "帐户已过期",
            "43" => "IP地址限制",
            "50" => "内容含有敏感词"
        );
        $smsapi = "http://api.smsbao.com/";
        $user = "lqpz789"; //短信平台帐号
        $pass = md5("ccg123321"); //短信平台密码
        //$content="【分筹购】您的验证码为{code}，请不要把验证码泄露给其他人。";//要发送的短信内容
        $phone = $mobile;//要发送短信的手机号码
        $content = '【华亿策略】'.$content;
        $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
        $result =file_get_contents($sendurl) ;
        if($result == 0){
            return true;
        }
        return false;*/
        /**/
        /*$account = "8D00197";
        $pwd = strtoupper(md5("8D0019754"));*/
		$account = "HX00021";
        $pwd = strtoupper(md5("HX0002121"));
        $content = urlencode('【华亿平台】'.$content);
        $sendurl = "https://dx.ipyy.net/smsJson.aspx?action=send&userid=&account=$account&password=$pwd&mobile=$mobile&content=$content&sendTime=&extno=";
        $result =file_get_contents($sendurl) ;
        $result = json_decode($result, true);
        if($result['returnstatus'] =='Success'){
            return true;
        }
        return false;
    }
    /**
     * 如果失败尝试发送3次
     * @param type $mobile
     * @param type $content
     * @return boolean
     */
    public static function smsSend($mobile,$content) {
        $i=0;
        while (true) {
            $i++;
            $r = self::send($mobile, $content);
            if ($r) {
                return true;
            }
            if($i>3){
                return false;
            }
        }
        return false;
    }
    
    /**
     * 发送注册验证码
     * @param type $mobile 手机号码
     * @return 验证码
     */
    public static function validSend($mobile) {
        $code = rand(1000, 9999);
        $content = \Model\Sys\SmsTemplet::regist($code);
        $r = self::smsSend($mobile, $content);
        if ($r) {
            Query::insert('sys_sms', array('mobile' => $mobile, 'codes' => $code, 'inline' => time()), true);
            return true;
        }
        return false;
    }
    
    /**
     * 发送注册验证码  推广用
     * @param type $mobile 手机号码
     * @return 验证码
     */
    public static function validSend_tg($mobile) {
        $code = rand(1000, 9999);
        $content = \Model\Sys\SmsTemplet::getValidTemp();
        $content=str_replace('@',$code , $content);
        $r = self::smsSend($mobile, $content);
        if ($r) {
            Query::insert('sys_sms', array('mobile' => $mobile, 'codes' => $code, 'inline' => time()), true);
            return true;
        }
        return false;
    }
}
