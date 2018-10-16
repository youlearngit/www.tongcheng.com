<?php
namespace Home\Controller;
use Think\Controller;
class BusinessController extends Controller {
	public function index(){
		// 实例化城市
		$city = M('agency_city');
		$citys = $city->select();
		$this->assign('citys',$citys);


		//创建模型
        $business = M('business');
        //读取数据库

        $infoA = $business->where(' status=1')->limit(0,6)->select();
        // var_dump($infoA);die;
        $infoB = $business->where(' status=1')->limit(6,6)->select();
        foreach ($infoA as $key => $value) {
                
                $infoA[$key]['pic'] = json_decode($infoA[$key]['pic']);

        }

        foreach ($infoB as $key => $value) {
                
                $infoB[$key]['pic'] = json_decode($infoB[$key]['pic']);

        }

        // var_dump($infoA);die;

        $this->assign('infoA',$infoA);
        $this->assign('infoB',$infoB);

		$this->display();
	}



	public function apply(){
		// 实例化城市
		$city = M('agency_city');
		$citys = $city->select();
		$this->assign('citys',$citys);

		$this->display();
	}


	public function doApply(){
		// var_dump($_POST);
		  $business = M('business');//创建对象
        $_POST['status'] = 0;//
        $_POST['isdelete'] = 0;//是否删除
        $_POST['time'] = time();//注册时间
        //过滤字段
        $business->create();
        $id = $business->add();
        

 

        if($id){
        	$this->redirect('Home/Business/apply',array('cate_id' => 2), 1, '申请已提交,请等待有关人员联系...');
        }else{
        	$this->redirect('Home/Business/apply',array('cate_id' => 2), 2, '填写内容有误,即将返回...');
        }
	}


	public function citySelect(){
		// var_dump($_POST);
		//创建模型
        $business = M('business');
        //读取数据库
        $where['agency_city'] = array('eq',I('post.agency_city'));
        $info = $business->where($where)->limit(4)->select();
        $info = json_encode($info);
        //判断结果
        if(empty($info)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn($info);
        }
	}


	public function bselect(){
		//创建模型
        $business = M('business');
        $company = I('post.agentBusinessName');
        //读取数据库
        // $where['company'] = array('eq',I('post.agentBusinessName'));

        $where = ' company like "%'.$company.'%"';

        $info = $business->where($where.' and status=1')->limit(5)->select();
        $info = json_encode($info);

        
        //判断结果
        if(empty($info)){
            $this->ajaxReturn(0);
        }else{
            $this->ajaxReturn($info);
        }
	}



	public function detail(){
        // 实例化城市
        $city = M('agency_city');
        $citys = $city->select();
        $this->assign('citys',$citys);

        $id = I('get.id');
        // var_dump($id);die;
          //创建对象
        $business = M('business');
        $res = $business->select($id);

        
        foreach ($res as $key => $value) {
            $res[$key]['pic'] = json_decode($res[$key]['pic']);    
            $res[$key]['time'] = date('Y-m-d H:i:s',$res[$key]['time']);

        }
        // var_dump($res);die;
        $this->assign('res',$res);
		$this->display();
	}


    public function policy(){
        // 实例化城市
        $city = M('agency_city');
        $citys = $city->select();
        $this->assign('citys',$citys);
        $this->display();
    }

     public function powered(){
        // 实例化城市
        $city = M('agency_city');
        $citys = $city->select();
        $this->assign('citys',$citys);
        $this->display();
    }

    public function link(){
        // 实例化城市
        $city = M('agency_city');
        $citys = $city->select();
        $this->assign('citys',$citys);


        //创建模型
        $link = M('link');
        //读取数据库

        $link = $link->where(' status=1')->limit(0,14)->select();
        // var_dump($link);die;
        foreach ($link as $key => $value) {
                
                $link[$key]['pic'] = json_decode($link[$key]['pic']);

        }


        // var_dump($link);die;

        $this->assign('link',$link);

        $this->display();
    }

    public function doLink(){
        // var_dump($_POST);
        //检测文件是否上传
        if($this->checkFileExist()){
            //执行上传
            $_POST['pic'] = $this->upload();
        }
        // var_dump($_POST);
        $link = M('link');//创建对象
        $_POST['status'] = 0;//
        $_POST['isdelete'] = 0;//是否删除
        $_POST['time'] = time();//注册时间
        //过滤字段
        $link->create();
        $id = $link->add();
        

 

        if($id){
            $this->redirect('Home/Business/link',array('cate_id' => 2), 1, '申请已提交,请等待有关人员联系...');
        }else{
            $this->redirect('Home/Business/link',array('cate_id' => 2), 2, '填写内容有误,即将返回...');
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
                //获得图片的上传路径
                
                $arr = array();
                
                foreach ($info as $key => $value) {
                    $arr[] = ltrim($value['savepath'].$value['savename'],'.');
                }
                
                return json_encode($arr);
            }
        }



    public function huangye(){
          // 实例化城市
        $city = M('agency_city');
        $citys = $city->select();
        $this->assign('citys',$citys);
        //创建模型
        $business = M('business');
        $agency = I('get.agency');
        //读取数据库
        $where = " agency = '".$agency."'";
        $info = $business->where($where.' and status=1')->limit(8)->select();
        // var_dump($info);die;
        foreach ($info as $key => $value) {
                
                $info[$key]['pic'] = json_decode($info[$key]['pic']);

        }
        // var_dump($info);die;
        $this->assign('info',$info);
        $this->display();
    }



    public function wanted(){
          // 实例化城市
        $city = M('agency_city');
        $citys = $city->select();
        $this->assign('citys',$citys);

        //创建模型
        $business = M('business');
        $agency = I('get.agency');
        //读取数据库
        $where = " agency = '".$agency."'";
        $info = $business->where($where.' and status=1')->limit(8)->select();
        // var_dump($info);die;
        foreach ($info as $key => $value) {
                
                $info[$key]['pic'] = json_decode($info[$key]['pic']);

        }
        // var_dump($info);die;
        $this->assign('info',$info);
        $this->display();
    }

    public function homes(){
          // 实例化城市
        $city = M('agency_city');
        $citys = $city->select();
        $this->assign('citys',$citys);

        //创建模型
        $business = M('business');
        $agency = I('get.agency');
        //读取数据库
        $where = " agency = '".$agency."'";
        $info = $business->where($where.' and status=1')->limit(8)->select();
        // var_dump($info);die;
        foreach ($info as $key => $value) {
                
                $info[$key]['pic'] = json_decode($info[$key]['pic']);

        }
        // var_dump($info);die;
        $this->assign('info',$info);
        $this->display();
    }
}