<?php
namespace Admin\Controller;
use Think\Controller;
class LiuyanController extends Controller {
    public function index(){
        $ww = M('liuyan');
        $goods = $ww->where('isdelete=0')->select();
        foreach($goods as $k=>$v){
            //将查询结果中的id替换为值
            $goods[$k]['uid']=$this->usernames($v['uid']);
            $goods[$k]['sid']=$this->usernames($v['sid']);
            $goods[$k]['gid']=$this->goodsnames($v['gid']);
            $goods[$k]['atime']=date('Y-m-d H-i-s',$v['atime']);
        }

      // 分配变量
      $this->assign('goods',$goods);
      $this->display('liuyan/index');
    }

    //获取用户的方法
    private function usernames($id){
        $users = M('user');
        $res=$users->field('username')->find($id);
        return $res['username'];
    }

    //获取商品的方法
    private function goodsnames($id){
        $goods = M('shuma');
        $res=$goods->field('name')->find($id);
        return $res['name'];
    }






    public function edit(){
        //接受id
        $id = $_GET['id'];
        $edit = M('liuyan');
        //查询要编辑的商品
       $goods = $edit->find($id);
        // foreach($goods as $k=>$v){
            //将查询结果中的id替换为值
            $goods['uid']=$this->usernames($goods['uid']);
            $goods['sid']=$this->usernames($goods['sid']);
            $goods['gid']=$this->goodsnames($goods['gid']);
            $goods['atime']=date('Y-m-d H-i-s',$goods['atime']);
        // }
        $this->assign('res',$goods);
        $this->display();
    }

    public function update(){
        $up = M('liuyan');

        $up->create();
        $res=$up->save();

        if($res){
            $this->success('修改成功',U("Admin/Liuyan/index"),2);
        }else{
            $this->error('修改失败',U("Admin/Liuyan/index"),2);

        }
    }

    //删除数据
    public function delete(){
        $de=M('liuyan');
        $id=$_GET['id'];
        $res=$de->save(['isdelete'=>1,'id'=>$id]);
        if($res){
            $this->success('删除成功',U("Admin/Liuyan/index"),2);
        }else{
            $this->error('删除失败',U("Admin/Liuyan/index"),2);

        }
    }

    //显示回收站
    public function recover(){
        $ww = M('liuyan');
        $goods = $ww->where('isdelete=1')->select();
        foreach($goods as $k=>$v){
            //将查询结果中的id替换为值
            $goods[$k]['uid']=$this->usernames($v['uid']);
            $goods[$k]['sid']=$this->usernames($v['sid']);
            $goods[$k]['gid']=$this->goodsnames($v['gid']);
            $goods[$k]['atime']=date('Y-m-d H-i-s',$v['atime']);
        }

        $this->assign('goods',$goods);
        $this->display();
    }

    //彻底删除
    public function clear(){
        $cc=M('liuyan');
        $id=$_GET['id'];
        $res=$cc->delete($id);
        if($res){
            $this->success('删除成功',U("Admin/Liuyan/index"),2);
        }else{
            $this->error('删除失败',U("Admin/Liuyan/index"),2);

        }

    }

    //回收数据

    public function hui(){
        $de=M('liuyan');
        $id=$_GET['id'];
        $arr = array('isdelete'=>0,'id'=>$id);
        
        $res=$de->save($arr);

        if($res){
            $this->success('还原成功',U("Admin/Liuyan/index"),2);
        }else{
            $this->error('还原失败',U("Admin/Liuyan/index"),2);

        }
    }


  }
?>