<?php
return [
    0=>array(
        'host'=>env('MONGO_HOST','127.0.0.1'),
        'port'=>env('MONGO_PORT','27019'),
        'username'=>env('MONGO_USERNAME','dev'),
        'password'=>env('MONGO_PASSWORD','dev'),
        'database'=>env('MONGO_DATABASE','devdb')
    )
];

