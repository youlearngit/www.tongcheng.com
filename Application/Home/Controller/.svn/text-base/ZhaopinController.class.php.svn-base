<?php
namespace Home\Controller;
use Think\Controller;
class ZhaopinController extends Controller {
		
		//残疾人招聘信息 首页 
    	public function cj(){
    		$this->display();
    	}

    	// 业务员的招聘信息
    	public function ywy(){
    		$this->display();
    	}

    	// 往数据库中插入应聘信息
    	public function insert(){
    		// var_dump($_POST);
    		// die;
    		// 创建
    		$zhaopin=M('zhaopin');
            $_POST['atime']=time();
            $_POST['u_id']=$_SESSION['id'];

    		$zhaopin->create();

    		$res1=$zhaopin->where('u_id='.$_SESSION['id'])->add();

    		
		$this->display("ywy");
    	}


    	// 业务员的招聘信息
    	public function jianli(){
    		$user=M('user');

    		// 此处的id=28应该换成当前登录用户的id号
    		// $users=$user->where("id=28")->find();
    		$user_detail=M('user_detail');
	        $user_details=$user_detail->join('left join user on user_detail.uid=user.id')->where("uid=".$_SESSION['id'])->find();

    		// 分配变量
    		$this->assign('arr',$user_details);
    		$this->display();
    	}

    	public function a(){
    		$this->display();
    	}
	}