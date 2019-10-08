<?php
return [
    'path'=>[
		// 后台
		'/admin/index'=>'AdminController@index', // 首页
		'/admin/edit'=>'AdminController@edit', // 编辑界面
		'/admin/login'=>'AdminController@login', // 登录
		'/admin/api/login'=>'ApiController@login', // 登录接口
		'/admin/logout'=>'AdminController@logout', // 退出
		'/admin/table'=>'AdminController@table', // 退出
		'/admin/api/table/save'=>'ApiController@table', // 退出
    ],
    // 路由规则
    'rule' => [
//        '/case/(\d+).html'=>'/case/show?id=$1',
    ]
];


