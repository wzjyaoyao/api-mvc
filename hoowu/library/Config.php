<?php
namespace Hoowu\Library;
class Config {
    static $conf=[];
    static public function get($name) {
        list($file,$name,$key) = explode('.',$name);
        if (!isset(self::$conf[$file])) {
            $filePath = CONFIG_PATH . '/'.$file.'.php';
            if (!is_file($filePath)) {
                $filePath = STORAGE_PATH.'/config'.'/'.$file.'.php';
                if(!is_file($filePath)) {
                    return '';
                }
            }

            $config = include $filePath;
            if (empty($config)) {
                return '';
            }
            self::$conf[$file] = $config;
        }
        if ($key!==NULL) {
            return isset(self::$conf[$file][$name][$key])?self::$conf[$file][$name][$key]:'';
        }
        else if ($name!==NULL){
            return isset(self::$conf[$file][$name])?self::$conf[$file][$name]:'';
        }
        else {
            return isset(self::$conf[$file])?self::$conf[$file]:'';
        }
    }
}
