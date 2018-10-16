<?php
namespace Admin\Controller;
use Think\Controller;
class JiajuController extends Controller {
    public function index(){
        $where = '';//声明字符串年变量
        $keyword = I('get.keyword');
        if(!empty($keyword)){
            $where['title'] = array('like','%'.$keyword.'%');
        }
        $jiaju = M('jiaju');
        //设置条件
        $where['isdelete'] = array('eq',0);

        $jiaju=$jiaju->where($where)->select();
        // var_dump($jiaju);die;
        //提取图片信息  json_encode
        foreach ($jiaju as $key => $value) {
                $jiaju[$key]['pic'] = json_decode($jiaju[$key]['pic']);

                // var_dump($jiaju[$key]['pic']);
        }

        foreach ($jiaju as $key => $value) {
                $jiaju[$key]['show_time'] = date('Y-m-d H:i:s',$jiaju[$key]['show_time']);

                // var_dump($jiaju[$key]['pic']);
        }

        
        // var_dump($jiaju);die;
        // var_dump($pic[0][0]);die;

        // $this->assign('pic',$pic);
        $this->assign('jiaju',$jiaju);

    	$this->display();
    }


    // 商品添加
    public function add(){

        $this->display();
    }
    

   public function insert()
    {

        //检测文件是否上传
        if($this->checkFileExist()){
            //执行上传
            $_POST['pic'] = $this->upload();
        }
      

        
        $_POST['show_time'] = time();
        //创建模型
        $jiaju = M('jiaju');
        //创建数据
        $jiaju->create();
        if($jiaju->add()){
            $this->success('添加成功',U('Admin/jiaju/index'),3);
        }else{
            $this->error('添加失败',U('Admin/jiaju/index'),3);
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
        $user = M('jiaju');
        //数组
        $arr = array('id'=>$id,'isdelete'=>1);
        //执行更新
        if($user->save($arr)){
            echo $user->save($arr);
            $this->success('删除成功', U('Admin/Jiaju/index'),3);
        }else{
            $this->error('删除失败', U('Admin/Jiaju/index'),3);
        }
    }


     public function edit()
    {
        //获取id
        $id = I('get.id');
        //读取信息
        $info = M('jiaju')->find($id);
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
        $jiaju = M('jiaju');
        //创建数据
        $jiaju->create();
        //执行更新操作
        if($jiaju->save()){
            $this->success('更新成功',U('Admin/jiaju/index'),3);
        }else{
            $this->error('更新成功',U('Admin/jiaju/index'),3);
        }
    }


      public function huishouzhan(){
        $jiaju = M('jiaju');
        //设置条件
        $where['isdelete'] = array('eq',1);

        $jiaju=$jiaju->where($where)->select();
        // var_dump($jiaju);die;
        //提取图片信息  json_encode
        foreach ($jiaju as $key => $value) {
                $jiaju[$key]['pic'] = json_decode($jiaju[$key]['pic']);

                // var_dump($jiaju[$key]['pic']);
        }

        
        // var_dump($jiaju);die;
        // var_dump($pic[0][0]);die;

        // $this->assign('pic',$pic);
        $this->assign('jiaju',$jiaju);

        $this->display();
    }




    //回收操作
    public function huishou(){
        //获取id
        $id = I('get.id');
        //创建对象
        $user = M('jiaju');
        //数组
        $arr = array('id'=>$id,'isdelete'=>0);
        //执行更新
        if($user->save($arr)){
            echo $user->save($arr);
            $this->success('删除成功', U('Admin/Jiaju/huishouzhan'),3);
        }else{
            $this->error('删除失败', U('Admin/Jiaju/huishouzhan'),3);
        }
    }



    // 回收站删除
    

}
?>