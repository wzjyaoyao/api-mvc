<?php
namespace App\Controllers;
use \App\Services\AdminService;
class ApiController {
	const SESSION_KEY = 'admin_user';
    public function __construct() {
        session_start();
    }

	public function login() {
        $username = $_POST['username'];
        $password = $_POST['password']; //isv_qazxswedc
        $innerAccount = [
            'isv_hoowu'=>[
                'password'=>'isv_hoowu',
                'id'=>1,
                'nickname'=>'火舞科技',
                'avatar'=>'http://static.51h5.com/images/home/apple-touch-icon-152x152.png'
            ]
        ];
        $code = 0;
        if (empty($username)
            || empty($password)
            || !isset($innerAccount[$username]) || $password!=$innerAccount[$username]['password']) {
            $msg = "账户密码错误，请重试";
            $code = 1001;
        }
        else {
            $_SESSION[self::SESSION_KEY]=$innerAccount[$username];
            $msg = "登录成功";
        }
        exit(json_encode([
            'code'=>$code,
            'msg'=>$msg
        ],JSON_UNESCAPED_UNICODE));
    }

	public function table() {
        $data = [];
        for ($i=1;$i<=30;$i++){
            $data[] = ['coin'=>1000,'bonus'=>0,'id'=>$i];
        }
        exit(json_encode([
            'code'=>0,
            'msg'=>'',
            'count'=>count($data),
            'data'=>$data
        ]));
    }

    public function save() {
        $ret = true;
        $msg = "保存成功";
        if($ret === false){
            $msg = "保存失败";
        }
        exit(json_encode([
            'code'=>0,
            'msg'=>$msg
        ],JSON_UNESCAPED_UNICODE));
    }
    public function test() {
        exit(json_encode(['code'=>0,'msg'=>'成功'],JSON_UNESCAPED_UNICODE));
    }
}



