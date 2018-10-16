<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	$this->assign('username',session('username'));
        $this->display();
    }
}