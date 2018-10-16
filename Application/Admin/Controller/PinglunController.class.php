<?php
namespace Admin\Controller;
use Think\Controller;
class PinglunController extends Controller {
    public function index(){
        $ww = M('pinglun');
        $goods=$ww->field('pinglun.id,name,user,content,atime')->join('left join shuma on pinglun.gid=shuma.id')->where('pinglun.isdelete=0 and shuma.isdelete=0')->select();


        // 转换时间格式
        foreach($goods as $k=>$v){
            $goods[$k]['atime']=date('Y-m-d H-i-s',$v['atime']);
        }

      // 分配变量

      $this->assign('goods',$goods);
      $this->display('Pinglun/index');
    }

    public function edit(){
        //接受id
        $id = $_GET['id'];
        $edit = M('pinglun');
        //查询要编辑的商品
        $res=$edit->field('pinglun.id,name,user,content,atime')->join('left join shuma on pinglun.gid=shuma.id')->where('pinglun.id='.$id)->select();

        // 转换时间格式
        // foreach($goods as $k=>$v){
            $res[0]['atime']=date('Y-m-d H-i-s',$res[0]['atime']);
        // }
            // var_dump($res);die();
        $this->assign('res',$res[0]);
        $this->display();
    }

    public function update(){
        $up = M('pinglun');

        $up->create();
        $res=$up->save();

        if($res){
            $this->success('修改成功',U("Admin/pinglun/index"),2);
        }else{
            $this->error('修改失败',U("Admin/pinglun/index"),2);

        }
    }

    //删除数据
    public function delete(){
        $de=M('pinglun');
        $id=$_GET['id'];
        $res=$de->save(['isdelete'=>1,'id'=>$id]);
        if($res){
            $this->success('删除成功',U("Admin/pinglun/index"),2);
        }else{
            $this->error('删除失败',U("Admin/pinglun/index"),2);

        }
    }

    //显示回收站
    public function recover(){
        $ww = M('pinglun');
        $goods=$ww->field('pinglun.id,name,user,content,atime')->join('left join shuma on pinglun.gid=shuma.id')->where('pinglun.isdelete=1')->select();


        // 转换时间格式
        foreach($goods as $k=>$v){
            $goods[$k]['atime']=date('Y-m-d H-i-s',$v['atime']);
        }
        $this->assign('goods',$goods);
        $this->display();
    }

    //彻底删除
    public function clear(){
        $cc=M('pinglun');
        $id=$_GET['id'];
        $res=$cc->delete($id);
        if($res){
            $this->success('删除成功',U("Admin/pinglun/index"),2);
        }else{
            $this->error('删除失败',U("Admin/pinglun/index"),2);

        }

    }

    //回收数据

    public function hui(){
        $de=M('pinglun');
        $id=$_GET['id'];
        $arr = array('isdelete'=>0,'id'=>$id);
        
        $res=$de->save($arr);

        if($res){
            $this->success('还原成功',U("Admin/pinglun/index"),2);
        }else{
            $this->error('还原失败',U("Admin/pinglun/index"),2);

        }
    }


  }
?>