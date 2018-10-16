<?php
namespace Admin\Controller;
use Think\Controller;
class MarryController extends CommonController {
	  public function index(){
        $where = '';//声明字符串年变量
        $keyword = I('get.keyword');
        if(!empty($keyword)){
            $where['title'] = array('like','%'.$keyword.'%');
        }
        $marry = M('marry');
        //设置条件
        $where['isdelete'] = array('eq',0);

        $marry=$marry->where($where)->select();
        // var_dump($marry);die;
        //提取图片信息  json_encode
        foreach ($marry as $key => $value) {
                $marry[$key]['pic'] = json_decode($marry[$key]['pic']);

                // var_dump($marry[$key]['pic']);
        }

        foreach ($marry as $key => $value) {
                $marry[$key]['show_time'] = date('Y-m-d H:i:s',$marry[$key]['show_time']);

                // var_dump($marry[$key]['pic']);
        }

        
        // var_dump($marry);die;
        // var_dump($pic[0][0]);die;

        // $this->assign('pic',$pic);
        $this->assign('marry',$marry);

    	$this->display();
    }


 

     // 商品添加
    public function add(){

        $this->display();
    }
    

   public function insert()
    {
    	// var_dump($_POST);
    	// var_dump($_FILES);die;
        //检测文件是否上传
        if($this->checkFileExist()){
            //执行上传
            $_POST['pic'] = $this->upload();
        }
      

        
        $_POST['show_time'] = time();
        //创建模型
        $marry = M('marry');
        //创建数据
        $marry->create();
        if($marry->add()){
        	// var_dump($marry->_sql());die;
            $this->success('添加成功',U('Admin/marry/index'),3);
        }else{
            $this->error('添加失败',U('Admin/marry/index'),3);
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


     //删除操作
    public function delete(){
        //获取id
        $id = I('get.id');
        //创建对象
        $user = M('marry');
        //数组
        $arr = array('id'=>$id,'isdelete'=>1);
        //执行更新
        if($user->save($arr)){
            echo $user->save($arr);
            $this->success('删除成功', U('Admin/Marry/index'),3);
        }else{
            $this->error('删除失败', U('Admin/Marry/index'),3);
        }
    }

      public function edit()
        {
        //获取id
        $id = I('get.id');
        //读取信息
        $info = M('marry')->find($id);
        $info['pic']=json_decode($info['pic']);
        
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
        $marry = M('marry');
        //创建数据
        $marry->create();
        //执行更新操作
        if($marry->save()){
            $this->success('更新成功',U('Admin/marry/index'),3);
        }else{
            $this->error('更新失败',U('Admin/marry/index'),3);
        }
    }


      public function huishouzhan(){
        $marry = M('marry');
        //设置条件
        $where['isdelete'] = array('eq',1);

        $marry=$marry->where($where)->select();
        // var_dump($marry);die;
        //提取图片信息  json_encode
        foreach ($marry as $key => $value) {
                $marry[$key]['pic'] = json_decode($marry[$key]['pic']);

                // var_dump($marry[$key]['pic']);
        }

        
        // var_dump($marry);die;
        // var_dump($pic[0][0]);die;

        // $this->assign('pic',$pic);
        $this->assign('marry',$marry);

        $this->display();
    }


        //回收操作
    public function huishou(){
        //获取id
        $id = I('get.id');
        //创建对象
        $user = M('marry');
        //数组
        $arr = array('id'=>$id,'isdelete'=>0);
        //执行更新
        if($user->save($arr)){
            echo $user->save($arr);
            $this->success('删除成功', U('Admin/Marry/huishouzhan'),3);
        }else{
            $this->error('删除失败', U('Admin/Marry/huishouzhan'),3);
        }
    }

    //回收站删除操作
    public function redelete(){
        //获取id
        $id = I('get.id');
        //创建对象
        $link = M('link');
        //数组
        //执行更新
        return $link->delete($id);
        

    }

}