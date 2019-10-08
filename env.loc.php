<?php
return [
    'ENV_TYPE'=>'loc', //本地环境：loc； dev环境：dev； test环境：test; 生产环境：pro；
    'APP_DEBUG'=>true,
    'RUNTIME_PATH'=>'/var/www/data/runtime/admin-market-tmall-isv.51h5.com/',
    'LOG_PATH'=>'/var/www/data/log/web/admin-market-tmall-isv.51h5.com/',

     //mysql数据库配置
    'DB_HOST'=>'172.100.10.243',
    'DB_PORT'=>'3307',
    'DB_DATABASE'=>'wan_h5_qiye',
    'DB_USERNAME'=>'qiye51h5',
    'DB_PASSWORD'=>'4sStlD-o0imc',

     //redis配置
    'REDIS_HOST'=>'172.100.10.243',
    'REDIS_PORT'=>'16379',
    'REDIS_DATABASE'=>'6',

    //mongo配置
    'MONGO_HOST'=>'172.100.10.243',
    'MONGO_PORT'=>'27019',
    'MONGO_USERNAME'=>'dev',
    'MONGO_PASSWORD'=>'dev',
    'MONGO_DATABASE'=>'devdb',
];

