<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {

	public function _initialize()
	{
		if(!session('id')){
			$this->error('您没有登陆请先登陆',U('Admin/Login/login'),3);
		}


		$AUTH = new \Think\Auth();
		//类库位置应该位于ThinkPHP\Library\Think\
		//MODULE_NAME  模块儿名 Admin
		//CONTROLLER_NAME  控制器名  User
		//ACTION_NAME   方法名  add
		// Admin/User/add
		if(!$AUTH->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME, session('id'))){
		    echo "<script type='text/javascript'>alert('没有对应权限,去浏览其他吧');parent.location.href='".U('Admin/Login/login')."'</script>";
		    // href('没有对应权限,去浏览其他吧',U('Admin/Login/login'));
		    // $this->redirect('Admin/Login/login', array('cate_id' => 2), 2, '暂无权限,页面跳转中...');
		}
	}


}