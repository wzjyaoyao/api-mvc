<?php
namespace Hoowu\Library;
class RedisConnect{
    public static $redis = NUll;
    public static function pconnect($redisConfig){
        if (empty($redisConfig)) {
            //Log::info('Redis配置不存在');
            return false;
        }
        $redisConfigKey = md5($redisConfig['host'].":".$redisConfig['port']);
        if (empty(self::$redis[$redisConfigKey])) {

            try{
                $_redis = new \Redis();
                $_redis->pconnect($redisConfig['host'],$redisConfig['port'],5);
            }
            catch (\Exception $e){
                exit("redis_connect_fail");
            }
            if (empty($_redis->ping())) {
                exit("redis_ping_fail");
            }
            //$_redis->select($redisConfig['database']);
            self::$redis[$redisConfigKey] = $_redis;
        }

        return self::$redis[$redisConfigKey];
    }
}