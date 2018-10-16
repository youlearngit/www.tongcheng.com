<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {

	//用户添加
    public function add(){
        $this->display();
    }

    //插入操作
    public function insert(){

    	//开启事务
    	// M()->startTrans();

    	$user = M('user');//创建对象
    	$_POST['status'] = 1;//
    	$_POST['isdelete'] = 0;//是否删除
    	$_POST['password'] = md5($_POST['password']);//密码加密

    	//过滤字段
    	$user->create();

    	//插入主表
    	$uid = $user->add();

    	//头像上传
    	if($_FILES['pic']['error'] == 0){
			$upload = new \Think\Upload();// 实例化上传类    
			$upload->maxSize = 3145728 ;// 设置附件上传大小    
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');//设置附件上传类型    
			$upload->rootPath = './Public';
			$upload->savePath = '/Uploads/';//设置附件上传目录   
			//上传文件     
			$info = $upload->upload();
			if(!$info) {
				//上传失败 提示错误信息        
				$this->error($upload->getError());    
			}else{
				//上传成功 获得图片的上传路径
				$_POST['pic'] = '/project2'.ltrim($upload->rootPath.$info['pic']['savepath'].$info['pic']['savename'],'.');
			}
		}

		//实例化详情表对象
		$detail = M('user_detail');

		$_POST['uid'] = $uid;//用户id
		$_POST['rtime'] = time();//注册时间

		//过滤字段
		$detail->create();

		//插入详情表
		$res = $detail->add();

		if($uid && $res){
			//插入成功 提交事务
			M()->commit();
			$this->success('添加成功',U('Admin/User/index'),3);
		}else{
			//插入失败 回滚
			M()->rollback();
			$this->error('添加失败',U('Admin/User/index'),3);
		}
    }

    //用户列表
    public function index(){

    	//声明条件变量
		$where = '';

    	//获取每页显示条数
    	$num = I('get.num');
    	if(!empty($num)){
    		$num = 5;
    	}

    	//获取搜索关键字
    	$keyword = I('get.keyword');
		if(!empty($keyword)){
			$where['username'] = array('like','%'.$keyword.'%');
		}

		//设置条件
		$where['isdelete'] = array('eq',0);
		//创建对象
		$user = M('user');
		//获取总条数
		$count = $user->where($where)->count();
		//创建分页对象
		$page = new \Think\Page($count, $num);
		//获取页码字符串
		$pages = $page->show();
		//获取limit参数
		$limit = $page->firstRow.','.$page->listRows;
		//读取数据
		$users = $user->limit($limit)->where($where)->join('left join user_detail on user_detail.uid = user.id')->select();
		//分配变量
		$this->assign('users',$users);
		$this->assign('pages', $pages);
		$this->assign('num',$num);
		$this->assign('keyword',$keyword);
		$this->assign('count',$count);
		//解析模板
		$this->display();

    }

    //修改操作
    public function edit(){
    	//获取用户id
		$id = I('get.id');
		//实例化对象
		$user = M('user');
		//显示用户信息
		$info = $user->join('left join user_detail on user_detail.uid = user.id')->where('id='.$id)->find();
		//分配变量
		$this->assign('info',$info);
		//解析模板
		$this->display();
    }

    //更新操作
	public function update(){
		//获取主键id
		$id = I('post.id');
		//更新主表
		$user = M('user');
		//过滤字段
		$user->create();
		//更新主表
		$res = $user->save();

		//头像处理
		$detail = M('user_detail');
		//执行文件上传操作
		if($_FILES['pic']['error'] === 0){
			$upload = new \Think\Upload();// 实例化上传类    
			$upload->maxSize = 3145728 ;// 设置附件上传大小    
			$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$upload->rootPath = './Public';
			$upload->savePath = '/Uploads/'; // 设置附件上传目录    
			//上传文件     
			$info = $upload->upload();
			if(!$info) {
				//上传错误提示错误信息        
				$this->error($upload->getError());    
			}else{
			    //上传成功 获得图片的上传路径
				$_POST['pic'] = '/project2'.ltrim($upload->rootPath.$info['pic']['savepath'].$info['pic']['savename'],'.');
				//获取图片的路径
				$info = $detail->where('uid='.$id)->find();
				$path = $info['pic'];//   /Public/Uploads/2015-11-03/563825c27209d.jpg
				//删除旧头像
				// var_dump($path);die;
				@unlink($path);
			}
		}

		$detail->create();

		//更新操作
		$res2 = $detail->where('uid='.$id)->save();

		if($res || $res2){
			//检测是否为ajax请求
			if(IS_AJAX){
				$this->ajaxReturn(1);
			}else{
				$this->success('更新成功', U('Admin/User/index'), 3);
			}
		}else{
			//检测是否为ajax请求
			if(IS_AJAX){
				$this->ajaxReturn(0);
			}else{
				$this->error('更新失败',U('Admin/User/index'),3);
			}
		}
	}

	//删除操作
	public function delete(){
		//获取id
		$id = I('get.id');
		//创建对象
		$user = M('user');
		//数组
		$arr = array('id'=>$id,'isdelete'=>1);
		//执行更新
		if($user->save($arr)){
			$this->success('删除成功', U('Admin/User/index'),3);
		}else{
			$this->error('删除失败', U('Admin/User/index'),3);
		}
	}

	//删除的会员
	public function record(){
		//声明条件变量
		$where = '';

    	//获取每页显示条数
    	$num = I('get.num');
    	if(!empty($num)){
    		$num = 5;
    	}

    	//获取搜索关键字
    	$keyword = I('get.keyword');
		if(!empty($keyword)){
			$where['username'] = array('like','%'.$keyword.'%');
		}

		//设置条件
		$where['isdelete'] = array('eq',0);
		//创建对象
		$user = M('user');
		//获取总条数
		$count = $user->where($where)->count();
		//创建分页对象
		$page = new \Think\Page($count, $num);
		//获取页码字符串
		$pages = $page->show();
		//获取limit参数
		$limit = $page->firstRow.','.$page->listRows;
		//读取数据
		$users = $user->limit($limit)->where($where)->join('left join user_detail on user_detail.uid = user.id')->select();
		//分配变量
		$this->assign('users',$users);
		$this->assign('pages', $pages);
		$this->assign('num',$num);
		$this->assign('keyword',$keyword);
		$this->assign('count',$count);
		//解析模板
		$this->display();
	}

	//还原操作
	public function huanyuan(){
		//获取id
		$id = I('get.id');
		//创建对象
		$user = M('user');
		//数组
		$arr = array('id'=>$id,'isdelete'=>0);
		//执行更新
		if($user->save($arr)){
			$this->success('还原成功', U('Admin/User/record'),3);
		}else{
			$this->error('还原失败', U('Admin/User/record'),3);
		}
	}

	//彻底删除
	public function  dedelete(){
		//获取id
		$id = I('get.id');
		//创建对象
		$user = M('user');
		//数组
		$res = $user->delete($id);
		//执行删除
		if($res){
			$this->success('彻底删除成功', U('Admin/User/record'),3);
		}else{
			$this->error('彻底删除失败', U('Admin/User/record'),3);
		}
	}

}