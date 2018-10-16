<?php
namespace Home\Controller;
use Think\Controller;
class UcenterController extends Controller {
	// 首页
    	public function index(){
    	// $_SESSION['u_id']=28;
    	$this->display();
	   }

	   // 最新信息
		 public function infoa(){
		 	// 进行查询当前用户最新发布的信息
		 	// 初始化数据表
		 	// $chongwu1=M('chongwu1');
		 	$zhaopin=M('zhaopin');

		 	$zhaopins=$zhaopin->where("u_id={$_SESSION['id']} and isdelete=0")->limit(3)->select();
		 	// 进行查询
		 	// $chongwus=$chongwu1->where("u_id={$_SESSION['u_id']} and isdelete=0")->order('atime desc')->limit(3)->select();
		 	// 分配变量
		 	foreach($zhaopins as $k=>$v){
	   //           $chongwus[$k]['pic']=json_decode($v['pic']);
	             $zhaopins[$k]['atime']=date('Y-m-d H:i:s',$zhaopins[$k]['atime']);
	             $zhaopins[$k]['area']=array_shift(explode('@@',$zhaopins[$k]['area']));

	        	}

		 	 	$this->assign('arr',$zhaopins);
	    		$this->display();
	   }

	   // 审核中的信息
	   public function sh(){
    	$this->display();
	   }

	   	// 显示中的信息
	   	public function xs(){
    	$this->display();
	   	}


	   	// 修改I密码
	   	public function a(){
	   		// 实例化表
	   		$user=M('user');
	   		// 进行查询
		 	$users=$user->where("id={$_SESSION['id']} and isdelete=0")->select();
		 	// var_dump($users);
		 	// die();
		 	// 分配变量
		 	$this->assign('arr',$users[0]);

    		$this->display('Ucenter/a');
	   	}

	   	// 在修改页面显示头像
	   	public function userdata(){

	        // 设置条件
	        // $where['isdelete']=array('eq',1);
	        $user_detail=M('user_detail');
	        $user_details=$user_detail->join('left join user on user_detail.uid=user.id')->where("uid={$_SESSION['id']}")->find();
	        
	        $user_details['pic']=json_decode($user_details['pic']);
	     
	        $this->assign('arr',$user_details);
	        // var_dump($user_details);
	        // die;
	        $this->display();
	    	
    	}

    	

	   		


	   	// 修改密码，提交表单
	   	public function wancheng(){
	   		// 实例化表
	   		$user=M('user');

	   		$users=$user->where("username='{$_POST['username']}' and pwd='{$_POST['pwd']}'")->select();
	   		if(!$users){
	   			$this->error('密码错误',U('Ucenter/a'),2);
	   		}
	   		// 创建数据
	   		$data = array('pwd'=>$_POST['pwd1'],'id'=>$_SESSION['id']);
			 // $user->create();
        	//执行更新操作
	   		$res=$user->save($data);
        if($res){
            $this->success('修改成功',U('Ucenter/a'),3);
        }else{
        	// echo $user->_sql();
        	// die();
            $this->error('修改失败',U('Ucenter/a'),3);

        }
    		// $this->display('Ucenter/a');
	   	}



	   // 删除发布信息
	    public function shanc(){
	     	// 进行查询当前用户最新发布的信息
			 	// 初始化数据表
			 	$chongwu1=M('zhaopin');

			 	// 进行查询
			 	$chongwus=$chongwu1->where("u_id='{$_SESSION['id']}' and isdelete=1")->select();
			 	// 分配变量
			 	foreach($chongwus as $k=>$v){
		             // $chongwus[$k]['pic']=json_decode($v['pic']);
		             $chongwus[$k]['atime']=date('Y-m-d H:i:s',$chongwus[$k]['atime']);
		             $chongwus[$k]['area']=array_shift(explode('@@',$chongwus[$k]['area']));

		             if($chongwus[$k]['zhonglei']=='宠物狗'){
		             	$chongwus[$k]['zl']='gou_lists';
		             }
		             if($chongwus[$k]['zhonglei']=='宠物猫'){
		             	$chongwus[$k]['zl']='mao_lists';
		             }
		        	}

			 	$this->assign('arr',$chongwus);
		    	$this->display();
	   	}

	   	// 我的求职（1）
	 	public function qz1(){
    			$this->display();
	   }

	   // 我的发表
	  	public function fb(){
    	$this->display();
	   }

	   // 我的收藏
	 	public function sc(){
    	$this->display();
	   }



	  //删除操作
    public function delete()
    {
        //获取id
        $id = I('get.id');
        //创建对象
        $chongwu1 = M('zhaopin');
        //数组
        $arr = array('id'=>$id,'isdelete'=>1);
        //执行更新
        if($chongwu1->save($arr)){
           	$this->error('删除成功', U('Home/Ucenter/infoa'),1);
        }else{
            $this->success('删除成功', U('Home/Ucenter/infoa'),1);
        }
    }


      //回收
    public function huishou()
    {
        //获取id
        $id = I('get.id');
        //创建对象
        $chongwu1  = M('zhaopin');
        //数组
        $arr = array('id'=>$id,'isdelete'=>0);
        //执行更新
        if($chongwu1 ->save($arr)){
            $this->error('回收失败', U('Home/Ucenter/shanc'),3);
        }else{
            $this->success('回收成功', U('Home/Ucenter/shanc'),3);
        }
    }

    	 //检测是否有文件上传
    private function checkFileExist()
    {
        //检测第一张图片是否上传 如果ok的话 返回真
        if($_FILES['pic']['error'][0] == 0){
            return true;
        }else{
            return false;
        }
    }


    //封装方法 上传文件
    private function upload()
    {   
        $upload = new \Think\Upload();// 实例化上传类    
        $upload->maxSize   =     3145728 ;// 设置附件上传大小    
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->rootPath  =     './Public';
        $upload->savePath  =      '/Uploads/'; // 设置附件上传目录    // 上传文件     
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息        
            $this->error($upload->getError());    
        }else{// 上传成功        
            $arr = array();
            foreach ($info as $key => $value) {
                $arr[] = ltrim($value['savepath'].$value['savename'],'.');
            }
            
            return json_encode($arr);
        }
    }




    public function touxiangxiugai(){
    		// 创建
    		$user=M('user');

    		$user->create();

    		$res1=$user->where('id='.$_SESSION['id'])->save();
    		// var_dump($user->_sql());
    		// die();
    		//检测文件是否上传
	        if($this->checkFileExist()){
	            //执行上传
	            $_POST['pic'] = $this->upload();
	            //删除原来的图片

	        }
	        
	        //创建模型
	        $user_detail = M('user_detail');
	        //创建数据
	        $user_detail->create();
	        $res2 = $user_detail->where('uid='.$_SESSION['id'])->save();

	        //执行更新操作
	        if($res1 || $res2){
	    
	            $this->success('更新成功',U('Home/Ucenter/userdata'),3);
	        }else{
	        	
	            $this->error('更新失败',U('Home/Ucenter/userdata'),3);
	        }

    	}

	}