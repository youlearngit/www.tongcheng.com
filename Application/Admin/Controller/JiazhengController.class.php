<?php
namespace Admin\Controller;
use Think\Controller;
class JiazhengController extends Controller {
    public function index(){
        $ww = M('jiazheng');
        $goods=$ww->where('isdelete=0')->select();
        //将图片路径转化成数组，并获取第一个
      foreach($goods as $k=>$v){
        $goods[$k]['pic']=json_decode($v['pic']);
      }

      //将城市信息转换成数组
      foreach($goods as $k=>$v){
        $goods[$k]['area'] = explode('@@@',$v['area']);
      }
        $this->assign('goods',$goods);

    	$this->display();
    }

    public function insert(){
        if($this->checkFile()){
             //处理上传的图片的函数
            $_POST['pic']= $this->upload();  
        }

        $goods = M('jiazheng');
        //处理所在城市
        $_POST['area']=$_POST['prov'].'@@@'.$_POST['city'].'@@@'.$_POST['dist'];
        $goods->create();
        $res = $goods->add();
        echo $goods->_sql();
        if($res){
            $this->success('添加成功',U("Admin/Jiazheng/index"),2);
        }else{
            $this->error('添加成功',U("Admin/Jiazheng/index"),2);

        }

    }

public function add(){
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



    public function checkFile(){
        if($_FILES['pic']['error'][0]==0){
            return true;
        }else{
            return false;
        }
    }
    public function edit(){
        //接受id
        $id = $_GET['id'];
        $edit = M('jiazheng');
        //查询要编辑的商品
        $res=$edit->find($id);
        //将图片的路径再次转换为数组
        $res['pic'] = json_decode($res['pic']);

        //将城市信息转化为数组
        $res['area'] = explode('@@@',$res['area']);
        $prov = M('provinces');
        $provs = $prov->select();
        
        $this->assign('provs',$provs);
        $this->assign('res',$res);
        $this->display('Jiazheng/edit');
    }

    public function update(){
        $up = M('jiazheng');
        //整理城市信息
        $p=isset($_POST['prov']) ? $_POST['prov'] : '';
        $c=isset($_POST['city']) ? $_POST['city'] : '';
        $d=isset($_POST['dsit']) ? $_POST['dist'] : '';

        $_POST['area'] = $p.'@@@'.$c.'@@@'.$d;
        $up->create();
        $res=$up->save($_POST);
        if($res){
            // echo"<script type='text/javascript'> alert('修改成功');location.href=".U('Admin/Goods/index').";</script>";
            $this->success('修改成功',U("Admin/Jiazheng/index"),2);
        }else{
            // echo "<script>alert('修改成功');</script>";
            $this->error('修改成功',U("Admin/Jiazheng/index"),2);

        }
    }

    //删除数据
    public function delete(){
        $de=M('jiazheng');
        $id=$_GET['id'];
        $res=$de->save(['isdelete'=>1,'id'=>$id]);
        if($res){
            $this->success('删除成功',U("Admin/Jiazheng/index"),2);
        }else{
            $this->error('删除成功',U("Admin/Jiazheng/index"),2);

        }
    }

    //显示回收站
    public function recover(){
        $ww = M('jiazheng');
        $goods=$ww->where('isdelete=1')->select();
        //将图片路径转化成数组，并获取第一个
      foreach($goods as $k=>$v){
        $goods[$k]['pic']=json_decode($v['pic']);
      }

      //将城市信息转换成数组
      foreach($goods as $k=>$v){
        $goods[$k]['area'] = explode('@@@',$v['area']);
      }
        $this->assign('goods',$goods);
        $this->display();
    }

    //彻底删除
    public function clear(){
        $cc=M('jiazheng');
        $id=$_GET['id'];
        $res=$cc->delete($id);
        if($res){
            $this->success('删除成功',U("Admin/Jiazheng/index"),2);
        }else{
            $this->error('删除成功',U("Admin/Jiazheng/index"),2);

        }

    }

    //回收数据

    public function hui(){
        $de=M('jiazheng');
        $id=$_GET['id'];
        $res=$de->where('id='.$id)->save(['isdelete'=>0]);
        if($res){
            $this->success('还原成功',U("Admin/Jiazheng/index"),2);
        }else{
            $this->error('还原成功',U("Admin/Jiazheng/index"),2);

        }
    }


    //文件上传函数
   // private function upload()
   //  {
   //      $upload = new \Think\Upload();// 实例化上传类    
   //      $upload->maxSize   =     3145728 ;// 设置附件上传大小    
   //      $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');
   //      $upload->rootPath  =     './Public';
   //      $upload->savePath  =      '/Uploads/';    
   //      $info   =   $upload->upload();
   //      if(!$info) {      
   //          $this->error($upload->getError());    
   //      }else{      
   //          $arr = array();
   //          foreach ($info as $key => $value) {
   //              $arr[] = ltrim($upload->rootPath.$value['savepath'].$value['savename'],'.');
   //          }
   //          return json_encode($arr);
   //      }
   //  }
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
?>