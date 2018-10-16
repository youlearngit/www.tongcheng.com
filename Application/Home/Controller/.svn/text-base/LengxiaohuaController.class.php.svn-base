<?php
namespace Home\Controller;
use Think\Controller;
class LengxiaohuaController extends Controller {
    public function lengxiaohua(){
       $leng_user=M('leng_user');
        $xiaohua=M('xiaohua');
    	// //接收当前显示第几页的信息
        $this->common();

    		// 查询当前提交的邮箱和密码是否同时存在于一条数据中
    		if(!empty($_POST)){
    			$leng_users=$leng_user->where("youxiang='{$_POST['youxiang']}' and pass='{$_POST['pass']}'")->find();
          // var_dump($leng_users);die;
        
        // 如果条件查询成功
          if($leng_users){
            //往页面中分配信息、
            // foreach ($leng_users as $k=>$v){

                $leng_users['pic']=json_decode($leng_users['pic']);
                // var_dump($leng_users);die;
            // }
            // var_dump($leng_users);
            // die;
            
      			$_SESSION['username']=$leng_users['username'];
      			$_SESSION['user_id']=$leng_users['id'];
            $_SESSION['youxiang']=$leng_users['youxiang'];
            $_SESSION['pic']=$leng_users['pic'][0];

      

        		$this->assign('userxinxi',$leng_users);

    	    	$this->display('Lengxiaohua/lengxiaohua');
        }else{
          
      
          $this->assign('eee','1');
          $this->display('Lengxiaohua/lengshouye');
          }
      }else{
        if(isset($_SESSION['username']) && isset($_SESSION['user_id'])){
            $this->display('Lengxiaohua/lengxiaohua');
        }else{
          $this->display('Lengxiaohua/lengshouye');
        }
        
      }
    }

public function common(){
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;

      // 当首页中登录成功的时候，跳转到lengxiaohua页面
        // 实例化数据库
        $xiaohua=M('xiaohua');
        $pagecount = ceil($xiaohua->count()/5);
               if($pagenow<1){
                  $pagenow=1;
              }
              if($pagenow>$pagecount){
                  $pagenow=$pagecount;
              }

            // // 查询当前所有的笑话，并显示
              $xiaohuas=$xiaohua->join('left join leng_user on xiaohua.u_id=leng_user.id')->page($pagenow,5)->select();


            foreach ($xiaohuas as $k=>$v){

                $xiaohuas[$k]['pic']=json_decode($v['pic']);
                $xiaohuas[$k]['pic1']=json_decode($v['pic1']);
                $xiaohuas[$k]['atime']=date('Y-m-d H:i:s',$xiaohuas[$k]['atime']);
                // var_dump($xiaohuas[$k]['atime']);
                // die;
            }

            $this->assign('arr',$xiaohuas);
            $this->assign('pagecount',$pagecount);
            $this->assign('pagenow',$pagenow);
}
  	public function lengzhuce(){
  		// 当页面注册的时候，跳转到该页面
  			// 实例化数据库
  			$leng_user=M('leng_user');
  			if(empty($_FILES['pic'])){
  				$_POST['pic']='["\/Uploads\/2015-11-23\/5652666023346.png"]';
          // ["\/Uploads\/2015-11-23\/5652666023346.png"]
  			}
  			$_POST['atime']=time();
	        $leng_user->create();
	        $res=$leng_user->add();
	       // 如果插入成功
	        if($res){
            $_SESSION['username']=$_POST['username'];
            $_SESSION['user_id']=$res;
            $_SESSION['youxiang']=$_POST['youxiang'];
	        	// 调用登录的方法
	        	// $this->lengxiaohua();
            $xiaohua=M('xiaohua');
            $this->common();
	        	$this->display('Lengxiaohua/lengxiaohua');
	        }else{
	        	// alert('失败了');
	        }
  	}



  	// 顶
    public function ding(){
        $xiaohua = M('xiaohua');
        if($_GET['dings']){

            $xid = $_GET['xid'];
            $res=$xiaohua->where('xid='.$xid)->setInc('ding',1);
            if($res){
                echo 1;
            }
        }
    }


    // 踩
    public function cai(){
        $xiaohua = M('xiaohua');
        if($_GET['cais']){

            $xid = $_GET['xid'];
            $res=$xiaohua->where('xid='.$xid)->setInc('cai',1);
            if($res){
                echo 1;
            }
        }

    }


    public function lengshouye(){
        $_SESSION['username']=$_POST['username'];

        // //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;

        // 设置条件
        $xiaohua=M('xiaohua');
        // 获取总的页数
 

        $pagecount = ceil($xiaohua->count()/5);
         if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }

        // $leng_user=M('leng_user');
        $xiaohua=M('xiaohua');
        $xiaohuas=$xiaohua->join('left join leng_user on xiaohua.u_id=leng_user.id')->page($pagenow,5)->select();
        // var_dump($xiaohuas);
        // die;
        foreach ($xiaohuas as $k=>$v){

        
            $xiaohuas[$k]['pic']=json_decode($v['pic']);
            $xiaohuas[$k]['pic1']=json_decode($v['pic1']);
            $xiaohuas[$k]['atime']=date('Y-m-d H:i:s',$xiaohuas[$k]['atime']);
        }
        
        $this->assign('arr',$xiaohuas);

        $this->assign('pagecount',$pagecount);
        $this->assign('pagenow',$pagenow);
        $this->display();
    }
    

    // 提交信息
     public function insert(){
      // var_dump($_FILES);
      // die;
      if(!empty($_FILES)){
        if($this->checkFileExist1()){

            $_POST['pic1'] = $this->upload();
        } }
        $xiaohua = M('xiaohua');
        $_POST['atime']=time();
        $_POST['u_id']=$_SESSION['user_id'];
        $xiaohua->create();
        $res=$xiaohua->add();

        if($res){
                $this->success('发表成功',U("Home/Lengxiaohua/lengxiaohua"),2);
            }else{
                $this->error('发表失败',U("Home/Lengxiaohua/lengxiaohua"),2);
            
            }
     }


    // 修改用户密码
     public function xiugaimima(){
     	// 实例化数据库

     	$leng_user=M('leng_user');
     	// 查看当前用户输入的旧密码是否正确
     	$res=$leng_user->where("username='{$_SESSION['username']}' and pass='{$_POST['pass']}'")->find();

     	
     	if(!empty($res)){
     		$_POST['pass']=$_POST['newpass'];
     		$_POST['id']=$_SESSION['user_id'];
     		
     		// 执行更新操作
     		//创建数据
	        $leng_user->create();
	        //执行更新操作
	        if($leng_user->save()){
	        	// var_dump($leng_user->save());die;
	        	$this->success('更新成功',U('Home/Lengxiaohua/lengxiaohua'),3);
	        }else{
	        	// var_dump($leng_user->save());die;
	        	$this->error('更新失败',U('Home/Lengxiaohua/lengxiaohua'),3);
	        	}
     		}
		}


		public function xiugaitouxiang(){

      //检测文件是否上传
          if($this->checkFileExist()){
              //执行上传
              $_POST['pic'] = $this->upload();
              $_POST['id']=$_SESSION['user_id'];
              $_SESSION['pic']=json_decode($_POST['pic'])[0];
              //删除原来的图片
          }

          
          // $_SESSION['pic']=$_POST['pic'][0];

            //创建模型
            $leng_user = M('leng_user');
            
            //创建数据
            $leng_user->create();
            //执行更新操作
            if($leng_user->save()){
                $this->success('修改成功',U('Home/Lengxiaohua/lengxiaohua'),3);
            }else{
                $this->error('修改失败',U('Home/Lengxiaohua/lengxiaohua'),3);
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