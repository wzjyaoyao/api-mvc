<?php
namespace App\Services;
use Hoowu\Library\RedisConnect;
use Hoowu\Library\Config;

class BaseService {
    static $redisObj = null;
    static $mysqlObj = null;
    static $mongodbObj = null;
    public static function getRedis($id='',$name='hd') {
        if (empty($id)) {
            $num = 0;
        }else{
            $num = self::getRedisConfig($id,$name);
        }
        return self::getRedisByNum($num,$name);
    }

    public static function getRedisByNum($num,$name) {
        if (empty(self::$redisObj[$name.$num])) {
            $redisConfig = self::getRedisConfigByName($name,$num);
            $_redis =  RedisConnect::pconnect($redisConfig);
            if($_redis === false){
                return false;
            }
            self::$redisObj[$name.$num] = [$redisConfig['database'],$_redis];
        }
        self::$redisObj[$name.$num][1]->select(self::$redisObj[$name.$num][0]);
        return self::$redisObj[$name.$num][1];
    }

    private static function getRedisConfig($id,$name='hd') {
        $id= crc32(md5($id));
        if ($id <0){
            $id = sprintf("%u",$id);
        }
        $redisConfig = self::getRedisConfigByName($name);
        return (int) fmod($id,count($redisConfig));
    }

    private static function getRedisConfigByName($name,$num=null){
        $redisConfig = '';
        if ($name == 'award') {
            if ($num === null){
                $redisConfig = Config::get('redis.award');
            }else{
                $redisConfig = Config::get('redis.award.'.$num);
            }
        }
        if (empty($redisConfig)) {

            if ($num === null) {
                $redisConfig = Config::get('redis.hd');
            }else{
                $redisConfig = Config::get('redis.hd.'.$num);
            }
        }
        return $redisConfig;
    }

    public static function getMysqliDb() {
        $dbConfig = Config::get('database');
        try{
            if (empty(self::$mysqlObj)) {
                include_once(VENDOR_PATH.'/autoload.php');
                self::$mysqlObj =  new \MysqliDb($dbConfig['wanh5qiye']);
            }
            return self::$mysqlObj;
        }catch(\Exception $e){
            writeLog(Config::get('code.log_status.fail'),Config::get('code.log_msg.db'),md5($_SERVER['REQUEST_URI']),$_SERVER['REQUEST_URI'],['exception'=>$e->getMessage()]);
            return false;
        }
    }

    /**
     * @param $tableName  //表名
     * @param string $id  //分库需要传递该id
     * @return bool
     */
    public static function getMongoCollection($tableName,$id='') {
        if (!$id) {
            $num = 0;
        }else{
            $num = self::getMongoConfig($id);
        }
        $c = Config::get('mongodb.'.$num);
        if (empty(self::$mongodbObj[$num])) {
            include_once(VENDOR_PATH.'/autoload.php');
            try{
                self::$mongodbObj[$num] = new \MongoDB\Client("mongodb://".$c['username'].":".$c['password']."@".$c['host'].":".$c['port']."/".$c['database']);
            } catch (\Exception $e) {
                writeLog(Config::get('code.log_status.fail'),Config::get('code.log_msg.mongodb'),md5($_SERVER['REQUEST_URI']),$_SERVER['REQUEST_URI'],['exception'=>$e->getMessage()]);
                return false;
            }
        }
        $db = $c['database'];
        return self::$mongodbObj[$num]->$db->$tableName;
    }

    private static function getMongoConfig($id) {
        $id= crc32(md5($id));
        if ($id <0){
            $id = sprintf("%u",$id);
        }
        return (int) fmod($id,count(Config::get('mongodb')));
    }

}




