<?php
namespace Admin\Controller;
use Think\Controller;
class BusinessController extends Controller {
	public function index(){
		$where = '';//声明字符串年变量
        $keyword = I('get.keyword');
        if(!empty($keyword)){
            $where['title'] = array('like','%'.$keyword.'%');
        }
        $business = M('business');
        //设置条件
        $where['isdelete'] = array('eq',0);

        $business=$business->where($where)->select();
        // var_dump($business);die;
        //提取图片信息  json_encode
        foreach ($business as $key => $value) {
                $business[$key]['pic'] = json_decode($business[$key]['pic']);

                // var_dump($business[$key]['pic']);
        }

        foreach ($business as $key => $value) {
                $business[$key]['time'] = date('Y-m-d',$business[$key]['time']);

                // var_dump($business[$key]['pic']);
        }

        
        // var_dump($business);die;
        // var_dump($pic[0][0]);die;

        // $this->assign('pic',$pic);
        $this->assign('business',$business);

    	$this->display();

	}


	public function add(){
		// 实例化城市
		$city = M('agency_city');
		$citys = $city->select();
		$this->assign('citys',$citys);

		$this->display();
	}


	public function insert()
    {

        //检测文件是否上传
        if($this->checkFileExist()){
            //执行上传
            $_POST['pic'] = $this->upload();
        }
      

        $_POST['status'] = 0;//
        $_POST['isdelete'] = 0;//是否删除
        $_POST['time'] = time();
        //创建模型
        $business = M('business');
        //创建数据
        $business->create();
        if($business->add()){
            $this->success('添加成功',U('Admin/business/index'),3);
        }else{
            $this->error('添加失败',U('Admin/business/index'),3);
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


    public function pass(){
        //获取id
        $id = I('get.id');

        // var_dump($id);die;
        
        //创建对象
        $business = M('business');
        //数组
        //执行更新
         $arr = array('id'=>$id,'status'=>1);
        $res = $business->save($arr);
        
        if($res){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }

    }

    public function noPass(){
        //获取id
        $id = I('get.id');

        // var_dump($id);die;
        
        //创建对象
        $business = M('business');
        //数组
        //执行更新
         $arr = array('id'=>$id,'status'=>0);
        $res = $business->save($arr);
        
        if($res){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }

    }

    public function delete(){
        $id = I('get.id');
        //创建对象
        $business = M('business');
        $res = $business->delete($id);
         if($res){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }
    }


    public function edit()
        {
        //获取id
        $id = I('get.id');
        //读取信息
        $info = M('business')->find($id);
        $info['pic']=json_decode($info['pic']);

        // 实例化城市
        $city = M('agency_city');
        $citys = $city->select();
        $this->assign('citys',$citys);
        
        //分配变量
        $this->assign('info', $info);
       
        //解析模板
        $this->display();
    }


    public function update()
    {   
        // var_dump($_POST);die;
        //检测文件是否上传
        if($this->checkFileExist()){
             $_POST['pic'] = $this->upload();

        }
        
        //创建模型
        $business = M('business');
        //创建数据
        $business->create();
        //执行更新操作
        if($business->save()){
            $this->success('更新成功',U('Admin/business/index'),3);
        }else{
            $this->error('更新失败',U('Admin/business/index'),3);
        }
    }

    


}