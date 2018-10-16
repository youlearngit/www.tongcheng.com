<?php
namespace Home\Controller;
use Think\Controller;
class FangziController extends Controller {
    public function lists(){

    //     // 设置条件

        $where['isdelete']=array('eq',0);
        $fangzi=M('fangzi');
        $fangzis=$fangzi->where($where)->select();
        foreach($fangzis as $k=>$v){
             $fangzis[$k]['pic']=json_decode($v['pic']);
        }
       

        $this->assign('arr',$fangzis);
        // 跳转到房子列表页
    // }

    public function huishouzhan(){

        // 设置条件
        $where['isdelete']=array('eq',1);
        $fangzi=M('fangzi');
        $fangzis=$fangzi->where($where)->select();
        $this->assign('arr',$fangzis);
        $this->display();
    }



    public function insert(){

        if($this->checkFileExist()){

            $_POST['pic'] = $this->upload();
        } 
        $fangzi = M('fangzi');
        $_POST['area']=$_POST['prov'].'@@'.$_POST['city'].'@@'.$_POST['dist'];
        $fangzi->create();
        $res=$fangzi->add();

        if($res){
            $this->success('添加成功',U("Admin/Fangzi/index"),2);
        }else{
            $this->error('添加失败',U("Admin/Fangzi/index"),2);
            
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

    public function edit()
    {
        //获取id
        $id = I('get.id');
        //读取信息
        $info = M('fangzi')->find($id);
        $info['pic']=json_decode($info['pic']);
        
        //分配变量
        $this->assign('info', $info);
       
        //解析模板
        $this->display();
    }

    public function update()
    {   
        //检测文件是否上传
        if($this->checkFileExist()){
            //执行上传
            // $_POST['pic'] = $this->upload();
            //删除原来的图片

        }
       
        $fangzi = M('fangzi');
        //创建数据
        $fangzi->create();
        //执行更新操作
        if($fangzi->save()){
            $this->success('更新成功',U('Admin/Fangzi/index'),3);
        }else{
            $this->error('更新成功',U('Admin/Fangzi/index'),3);
        }
    }

     //删除操作
    public function huishou()
    {
        //获取id
        $id = I('get.id');
        //创建对象
        $fangzi = M('fangzi');
        //数组
        $arr = array('id'=>$id,'isdelete'=>0);
        //执行更新
        if($fangzi->save($arr)){
            $this->success('回收成功', U('Admin/Fangzi/huishouzhan'),3);
        }else{
            $this->error('回收失败', U('Admin/Fangzi/huishouzhan'),3);
        }
    }
    
    //删除操作
    public function delete()
    {
        //获取id
        $id = I('get.id');
        //创建对象
        $fangzi = M('fangzi');
        //数组
        $arr = array('id'=>$id,'isdelete'=>1);
        //执行更新
        if($fangzi->save($arr)){
            $this->success('删除成功', U('Admin/Fangzi/index'),3);
        }else{
            $this->error('删除失败', U('Admin/Fangzi/index'),3);
        }
    }

    public function deleteall(){
        //获取id 
        $id=I('get.id');
        // 创建对象
        $fangzi=M('fangzi');
        // 删除
        $res=$fangzi->delete($id);

        // 判断
        if($res){
            $this->success('删除成功', U('Admin/Fangzi/huishouzhan'),3);
        }else{
            $this->error('删除失败', U('Admin/Fangzi/huishouzhan'),3);
        }


    }
}
?>
