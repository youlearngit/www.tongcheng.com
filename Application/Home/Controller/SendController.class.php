<?php
namespace Home\Controller;
use Think\Controller;
class SendController extends Controller {
	public function index(){
		$this->display();
	}

	public function send2(){
		$prov = M('provinces');
		$provs = $prov->select();  
		$this->assign('provs',$provs);
		$this->display();
	}

	public function province(){
		$provinceid = $_GET['provinceid'];
		$cities = M('cities');
		$city = $cities -> where('provinceid='.$provinceid)->select();
		$arr = array();
		foreach($city as $v){
			$arr[$v['cityid']]=$v['city'];
		}
		echo json_encode($arr);

	}
	public function city(){
		$cityid = $_GET['cityid'];
		$area = M('areas');
		$areas = $area -> where('cityid='.$cityid)->select();
		$arr = array();
		foreach($areas as $v){
			$arr[$v['areaid']]=$v['area'];
		}
		echo json_encode($arr);

	}

	public function insert(){
		$shuma = D('shuma');
		//品牌判断
		switch($_POST['type']){
			case '平板':
				$_POST['type']='pad';
				break;
			case '手机':
				$_POST['type']='phone';
				break;
			case '台式机':
				$_POST['type']='ts';
				break;
			case '笔记本':
				$_POST['type']='pc';
				break;	
		}
		if(!empty($_SESSION['id'])){
			$_POST['uid']=$_SESSION['id'];
		}else{
			$this->assign('url','Home/Send/send2');
			$this->display('User/login');
		}
		
        //处理所在城市
        $_POST['area']=$_POST['prov'].'@@@'.$_POST['city'].'@@@'.$_POST['dist'];
        //处理多长图片的上传
        if(!empty($_SESSION['pic'])){
        	//从session中获取图片
        	// var_dump($_SESSION['pic']);
        	$_POST['pic'] = json_encode($_SESSION['pic']);
        	// var_dump($_POST['pic']);
        	// die();
        	// 清空session
        	unset($_SESSION['pic']);
        }

		if(!$shuma->create()){
			exit($shuma->getError());
		}else{
			$res=$shuma->add();
			if($res){
				$this->success('发布成功',U('Home/Send/sendok'),0);
			}else{
				$this->error('发布失败',U('Home/Send/send2'),2);
			}
		}
		
		
	}

	public function upload(){
		$targetDir = "./Public/Uploads";
		$cleanupTargetDir = true; // Remove old files

		// Create target dir
		if (!file_exists($targetDir)) {
			@mkdir($targetDir);
		}

		// Get a file name
		$fileName = $_FILES["file"]["name"];
		$filePath = $targetDir . '/' . $fileName;


		if(move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)){
			echo json_encode(array('status'=>'ok','data'=>array('path'=>$filePath)));
		// $arr=array();
		// $arr[]='/Uploads/'.$fileName;
		$_SESSION['pic'][] = '/Uploads/'.$fileName;
		}else{
			die('error');
		}

	}
	
}
?>