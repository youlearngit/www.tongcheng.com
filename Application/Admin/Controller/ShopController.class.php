<?php
namespace Admin\Controller;
use Think\Controller;
class ShopController extends Controller {
    public function index(){
        $ww = M('shop');
        $goods=$ww->where('isdelete=0')->select();
      //将城市信息转换成数组
      // foreach($goods as $k=>$v){
      //   $goods[$k]['area'] = explode('###',$v['area']);
      // }
        $this->assign('goods',$goods);

    	$this->display();
    }

    public function insert(){
        if($this->checkFile()){
             //处理上传的图片的函数
            $_POST['pic']= $this->upload();  
        }

        $goods = M('shop');
        //处理所在城市
        $_POST['area']=$_POST['prov'].'###'.$_POST['city'].'###'.$_POST['dist'];
        $goods->create();
        $res = $goods->add();
        //插入第二章表
        $_POST['list_id']=$res;
        $_POST['ltime']=time();
        $detail = M('shop_detail');
        $detail->create();
        $detail->add();
        echo $goods->_sql();
        if($res){
            $this->success('添加成功',U("Admin/Shop/index"),2);
        }else{
            $this->error('添加失败',U("Admin/Shop/index"),2);

        }

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
        $edit = M('shop');
        //查询要编辑的商品
        $res=$edit->join('left join shop_detail on shop.id = shop_detail.list_id')->where('shop.id='.$id)->select();
        //将图片的路径再次转换为数组
        // $res['pic'] = json_decode($res['pic']);
        //将城市信息转化为数组
        $res['area'] = explode('###',$res['area']);

        $this->assign('res',$res[0]);
        $this->display('Shop/edit');
    }

    public function update(){
        $up = M('shop');
        //整理城市信息
        var_dump($_POST);
        $p=isset($_POST['prov']) ? $_POST['prov'] : '';
        $c=isset($_POST['city']) ? $_POST['city'] : '';
        $d=isset($_POST['dsit']) ? $_POST['dist'] : '';
        $_POST['area'] = $p.'###'.$c.'###'.$d;
        
        //修改详情表
        $detail=M('shop_detail');
        $detail->create();
        $res1=$detail->save();

        //修改主表
        $_POST['id']=$_POST['list_id'];
        var_dump($_POST);
        $up->create();
        $res=$up->save($_POST);
        if($res || $res1){
            // echo"<script type='text/javascript'> alert('修改成功');location.href=".U('Admin/Goods/index').";</script>";
            $this->success('修改成功',U("Admin/Shop/index"),2);
        }else{
            // echo "<script>alert('修改失败');</script>";
            $this->error('修改失败',U("Admin/Shop/index"),2);

        }
    }

    //删除数据
    public function delete(){
        $de=M('shop');
        $id=$_GET['id'];
        $res=$de->save(['isdelete'=>1,'id'=>$id]);
        if($res){
            $this->success('删除成功',U("Admin/Shop/index"),2);
        }else{
            $this->error('删除失败',U("Admin/Shop/index"),2);

        }
    }

    //显示回收站
    public function recover(){
        $ww = M('shop');
        $goods=$ww->where('isdelete=1')->select();

      //将城市信息转换成数组
      foreach($goods as $k=>$v){
        $goods[$k]['area'] = explode('###',$v['area']);
      }
        $this->assign('goods',$goods);
        $this->display();
    }

    //彻底删除
    public function clear(){
        $cc=M('shop');
        $id=$_GET['id'];
        $res=$cc->delete($id);
        $dd = M('shop_detail');
        $res1 = $dd->where('list_id='.$id)->delete();
        if($res && $res1){
            $this->success('删除成功',U("Admin/Shop/index"),2);
        }else{
            $this->error('删除失败',U("Admin/Shop/index"),2);

        }

    }

    //回收数据

    public function hui(){
        $de=M('shop');
        $id=$_GET['id'];
        $res=$de->where('id='.$id)->save(['isdelete'=>0]);
        if($res){
            $this->success('还原成功',U("Admin/Shop/index"),2);
        }else{
            $this->error('还原失败',U("Admin/Shop/index"),2);

        }
    }

    public function changeimg(){
        echo $_GET['img'];

        }





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