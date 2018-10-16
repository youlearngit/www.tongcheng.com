<?php
namespace Admin\Controller;
use Think\Controller;
class LengController extends Controller {
	    public function user(){
		    	// 设置条件
		    	 $where['isdelete']=array('eq',0);
		    	 $leng_user=M('leng_user');
		    	 $leng_users=$leng_user->where($where)->select();
	    	 foreach($leng_users as $k=>$v){
             	$leng_users[$k]['pic']=json_decode($v['pic']);
        		}
        	$this->assign('arr',$leng_users);
        	$this->display();

	    }

	    // 用户的添加页面
	    public function user_add(){
	    	$this->display();
	    }

	    // 用户的插入
	    public function insert(){

	    	if($this->checkFileExist()){

            	$_POST['pic'] = $this->upload();
        		} 
        	$leng_user = M('leng_user');

        	$leng_user->create();
        	$res=$leng_user->add();

        	if($res){
            	$this->success('添加成功',U("Admin/Leng/user"),2);
       	 	}else{
            	$this->error('添加失败',U("Admin/Leng/user"),2);
            
        	}
	   }

	   // 用户的编辑
	   public function user_edit(){
	   		//获取id
	        $id = I('get.id');
	        //读取信息
	        $info = M('leng_user')->find($id);
	        $info['pic']=json_decode($info['pic']);
	        
	        //分配变量
	        $this->assign('info', $info);
	       
	        //解析模板
	        $this->display();
	   }

	    public function user_update(){
	    	//检测文件是否上传
        	if($this->checkFileExist()){
            	//执行上传
            	$_POST['pic'] = $this->upload();
            	//删除原来的图片
        	}
        	//创建模型
	        $leng_user = M('leng_user');
	        //创建数据
	        $leng_user->create();
	        //执行更新操作
	        if($leng_user->save()){
	            $this->success('更新成功',U('Admin/Leng/user'),3);
	        }else{
	            $this->error('更新失败',U('Admin/Leng/user'),3);
	        }
	    }

	    // 冷笑话用户的删除
	    public function user_delete(){
	    	 //获取id
		        $id = I('get.id');
		        // var_dump($_GET);
		        // die;
		        //创建对象
		        $leng_user = M('leng_user');
		        //数组
		        $arr = array('id'=>$id,'isdelete'=>1);
		        //执行更新

		        if($leng_user->save($arr)){
		            $this->success('删除成功', U('Admin/Leng/user'),3);
		        }else{
		            $this->error('删除失败', U('Admin/Leng/user'),3);
		        }
	    }

	    // 笑话的首页,笑话的列表
	    public function xiaohua(){
	    	// 设置条件
		    	 $where['isdelete']=array('eq',0);
		    	 $xiaohua=M('xiaohua');
		    	 $xiaohuas=$xiaohua->where($where)->select();
	    	 	foreach($xiaohuas as $k=>$v){
             		$xiaohuas[$k]['pic1']=json_decode($v['pic1']);
        		}
	        	$this->assign('arr',$xiaohuas);

	        	$this->display();

	    }

	    // 笑话的添加
	     public function xiaohua_add(){
	     		$this->display();
	     }

	    // 笑话的插入
	     public function xiaohua_insert(){

	     		if($this->checkFileExist1()){

            		$_POST['pic1'] = $this->upload();
          //   		var_dump($_POST['pic']);
	        	// die;
        		} 
        		$xiaohua = M('xiaohua');

        		$xiaohua->create();
        		$res=$xiaohua->add();

        	if($res){
            	$this->success('添加成功',U("Admin/Leng/xiaohua"),2);
       	 	}else{
            	$this->error('添加失败',U("Admin/Leng/xiaohua"),2);
            
        	}
	     		// $this->display();
	     }

	     public function xiaohua_edit(){
			     //获取id
		        $xid = I('get.xid');
		        //读取信息
		        $info = M('xiaohua')->find($xid);
		        $info['pic1']=json_decode($info['pic1']);
		        
		        //分配变量
		        $this->assign('info', $info);
		       
		        //解析模板
		        $this->display();
	     }

	     // 笑话的修改
	     public function xiaohua_update(){
	     	// var_dump($_POST);
	     	// die;
	     	//检测文件是否上传
        	if($this->checkFileExist1()){
            	//执行上传
            	$_POST['pic1'] = $this->upload();
            	// var_dump($_POST['pic1']);
            	// die;
            	//删除原来的图片
        	}
	        	//创建模型
		        $xiaohua = M('xiaohua');
		        //创建数据
		        $xiaohua->create();
		        //执行更新操作
		        if($xiaohua->save()){
		            $this->success('更新成功',U('Admin/Leng/xiaohua'),3);
		        }else{
		        	// echo $xiaohua->_sql();
		        	// die;
		            $this->error('更新失败',U('Admin/Leng/xiaohua'),3);
		        }
	     }


	     // 笑话的修改
	     public function xiaohua_delete(){


	     	//获取id
		        $id = I('get.xid');
		        // var_dump($_GET);
		        // die;
		        //创建对象
		        $xiaohua = M('xiaohua');
		        //数组
		        $arr = array('xid'=>$id,'isdelete'=>1);
		        //执行更新

		        if($xiaohua->save($arr)){
		            $this->success('删除成功', U('Admin/Leng/xiaohua'),3);
		        }else{
		            $this->error('删除失败', U('Admin/Leng/xiaohua'),3);
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


	     //检测是否有文件上传
	    private function checkFileExist1()
	    {
	        //检测第一张图片是否上传 如果ok的话 返回真
	        if($_FILES['pic1']['error'][0] == 0){
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

	}