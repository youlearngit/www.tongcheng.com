<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {

	public function login()
	{
		// $this->assign('username',session('username'));
		// $this->assign('pwd',session('pwd'));
			// echo 21321321;die;
		session('id',null);
		session('username',null);
		$this->display();
	}
	
	
	public function doLogin()
	{
		// var_dump($_POST);
		//创建模型
		$user = M('user');
		//读取数据库
		$where['username'] = array('eq',I('post.username'));
		$where['pwd'] = array('eq',I('post.pwd'));



		$info = $user->where($where)->find();
		//判断结果

		// var_dump($info);die;

		if(empty($info)){
			$this->error('用户名或者是密码错误', U('Admin/Login/login'),3);
		}else{
			//写入session  session('id')
			if(I('post.online')){
				session("online"."{$info['id']}",I('post.online'),3600*24*2);
				// echo session('"online"."{$info[\'username\']}"');die;
			}
			session('id',$info['id']);
			
			session('username',$info['username']);
    		$this->assign('username',session('username'));
			$this->success('登陆成功', U('Admin/Index/index'),3);
		}
	}

	public function select()
	{
		$username = I('post.username');
	// 创建模型
		$user = M('user');
		$where['username'] = array('eq',$username);
		$info = $user->where($where)->find();
		// echo online"."{$info['id']};die;
		if(session("online"."{$info['id']}")){

			

			$detail1 = 'Y ';
			$detail = $detail1.$info['pwd'];
			
			
		}
		echo $detail;
	}

}