<?php
namespace App\Services;

class AdminService extends BaseService{

    public static function testRedis(){
        $redis = self::getRedis();
        $redis->delete('test');
        return true;
    }

    public static function testMysql() {
        $db = self::getMysqliDb();
        $user =  $db
            ->where('username','111')
            ->getOne('user',"password,nickname,avatar,id");
        if (empty($user)) {
            return false;
        }

        $db->where('id',$user['id'])
            ->update('user',['update_time'=>time(),'login_time'=>time(),'ip'=>get_server_ip()]);
        return $user;
    }



}