<?php
return [
    'hd'=>env('REDIS_CONFIG',[
        0=>array(
            'host'=>'127.0.0.1',
            'port'=>'6379',
            'database'=>'0'
        )
    ])
];