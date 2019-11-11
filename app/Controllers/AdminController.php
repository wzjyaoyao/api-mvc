<?php
use \App\Services\AdminService;
class AdminController {
	const SESSION_KEY = 'admin_user';
	private $user = null;
	public function __construct() {
		session_start();
		// 不验证登录列表
		$noList = ['login','logout'];
		if (!in_array($_GET['action'],$noList)) {
			$user = $_SESSION[self::SESSION_KEY];
			if (empty($user)) {
				header("Location: /admin/login");
			}
			$this->user = $user;
		}
	}

	public function index() {
		include VIEWS_PATH.'/admin/index.html';
		exit;
	}

	public function login() {
        include VIEWS_PATH.'/admin/login.html';
        exit;
	}

	public function logout() {
		$_SESSION[self::SESSION_KEY]=null;
		header("Location: /admin/login");
		exit;
	}

	public function table() {
        include VIEWS_PATH . '/admin/layout.html';
        exit;
    }


}
// master分支创建标识



