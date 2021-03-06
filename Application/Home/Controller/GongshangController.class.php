<?php
namespace Home\Controller;
use Think\Controller;
class GongshangController extends Controller {
    public function zc_lists(){
         //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;

        // 设置条件
         $gongshang=M('gongshang');
        //按条件进行查询

        $where = isset($_GET['where']) ? $_GET['where'].'and' : '';
        if(isset($_GET['price1']) && isset($_GET['price2'])){
             $where .= 'price >= '.$_GET['price1'].' and '.'price <= '.$_GET['price2'].' and ';
         }else if(isset($_GET['fenlei'])){
            $where = 'fenlei = '.$_GET['fenlei'].' and ';
         }else if(isset($_GET['sm'])){
            $where = 'sm = '.$_GET['sm'].' and ';
        }

          $pagecount = ceil($gongshang->where($where.'isdelete=0 and zhonglei="工商注册"')->count()/3);
         if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }

        $gongshangs=$gongshang->where($where.'isdelete=0 and zhonglei="工商注册"')->page($pagenow,3)->select();
        foreach($gongshangs as $k=>$v){
             $gongshangs[$k]['pic']=json_decode($v['pic']);
        }
        $this->assign('arr',$gongshangs);
        $this->assign('pagecount',$pagecount);
        $this->assign('pagenow',$pagenow);
        // 跳转到房子列表页

        $this->display('');
  
    }

    public function kj_lists(){

         //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;

        // 设置条件
         $gongshang=M('gongshang');
        //按条件进行查询

        $where = isset($_GET['where']) ? $_GET['where'].'and' : '';
        if(isset($_GET['price1']) && isset($_GET['price2'])){
             $where .= 'price >= '.$_GET['price1'].' and '.'price <= '.$_GET['price2'].' and ';
         }else if(isset($_GET['fenlei'])){
            $where = 'fenlei = '.$_GET['fenlei'].' and ';
         }else if(isset($_GET['fenlei'])){
            $where = 'sm = '.$_GET['sm'].' and ';
        }


          $pagecount = ceil($gongshang->where($where.'isdelete=0 and zhonglei="财务会计"')->count()/3);
         if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }

        $gongshangs=$gongshang->where($where.'isdelete=0 and zhonglei="财务会计"')->page($pagenow,3)->select();
        foreach($gongshangs as $k=>$v){
             $gongshangs[$k]['pic']=json_decode($v['pic']);
        }
        $this->assign('arr',$gongshangs);
         $this->assign('pagecount',$pagecount);
        $this->assign('pagenow',$pagenow);
        // 跳转到房子列表页

        $this->display('');
  
    }

     public function zl_lists(){

         //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;

        // 设置条件
         $gongshang=M('gongshang');
        //按条件进行查询

        $where = isset($_GET['where']) ? $_GET['where'].'and' : '';
        if(isset($_GET['price1']) && isset($_GET['price2'])){
             $where .= 'price >= '.$_GET['price1'].' and '.'price <= '.$_GET['price2'].' and ';
         }else if(isset($_GET['fenlei'])){
            $where = 'fenlei = '.$_GET['fenlei'].' and ';
         }
         else if(isset($_GET['hownew'])){
            $where = 'hownew = '.$_GET['hownew'].' and ';
         }else if(isset($_GET['fenlei'])){
            $where = 'sm = '.$_GET['sm'].' and ';
        }


          $pagecount = ceil($gongshang->where($where.'isdelete=0 and zhonglei="商标专利"')->count()/3);
         if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }

        $gongshangs=$gongshang->where($where.'isdelete=0 and zhonglei="商标专利"')->page($pagenow,3)->select();
        foreach($gongshangs as $k=>$v){
             $gongshangs[$k]['pic']=json_decode($v['pic']);
        }
        $this->assign('arr',$gongshangs);
         $this->assign('pagecount',$pagecount);
        $this->assign('pagenow',$pagenow);
        // 跳转到房子列表页

        $this->display('');
  
    }

    public function qm_lists(){

         //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;

        // 设置条件
         $gongshang=M('gongshang');
        //按条件进行查询

        $where = isset($_GET['where']) ? $_GET['where'].'and' : '';
        if(isset($_GET['price1']) && isset($_GET['price2'])){
             $where .= 'price >= '.$_GET['price1'].' and '.'price <= '.$_GET['price2'].' and ';
         }else if(isset($_GET['fenlei'])){
            $where = 'fenlei = '.$_GET['fenlei'].' and ';
         }
         else if(isset($_GET['hownew'])){
            $where = 'hownew = '.$_GET['hownew'].' and ';
         }else if(isset($_GET['fenlei'])){
            $where = 'sm = '.$_GET['sm'].' and ';
        }


          $pagecount = ceil($gongshang->where($where.'isdelete=0 and zhonglei="起名"')->count()/3);
         if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }

        $gongshangs=$gongshang->where($where.'isdelete=0 and zhonglei="起名"')->page($pagenow,3)->select();
        foreach($gongshangs as $k=>$v){
             $gongshangs[$k]['pic']=json_decode($v['pic']);
        }
        $this->assign('arr',$gongshangs);
         $this->assign('pagecount',$pagecount);
        $this->assign('pagenow',$pagenow);
        // 跳转到房子列表页

        $this->display('');
  
    }

    public function huishouzhan(){

        // 设置条件
        $where['isdelete']=array('eq',1);
        $gongshang=M('gongshang');
        $gongshangs=$gongshang->where($where)->select();
        $this->assign('arr',$gongshangs);
        $this->display();
    }



    public function insert(){
        // echo '<pre>';
        // var_dump($_FILES);
        // die();
        // echo '</pre>';
        //检测文件是否上传
        // var_dump($_POST);
        // die();

        if($this->checkFileExist()){

            $_POST['pic'] = $this->upload();
        } 
        $gongshang = M('gongshang');
        $_POST['area']=$_POST['prov'].'@@'.$_POST['city'].'@@'.$_POST['dist'];
        $gongshang->create();
        $res=$gongshang->add();

        if($res){
            $this->success('添加成功',U("Admin/Gongshang/index"),2);
        }else{
            $this->error('添加失败',U("Admin/Gongshang/index"),2);
            
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
        $info = M('gongshang')->find($id);
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
        // //处理颜色字段
        // if(!empty($_POST['color'])){
        //     $_POST['color'] = serialize($_POST['color']);
        // }

        // //处理尺寸
        // if(!empty($_POST['size'])){
        //     $_POST['size'] = implode('@@@', $_POST['size']);
        // }
        //创建模型
        $gongshang = M('gongshang');
        //创建数据
        $gongshang->create();
        //执行更新操作
        if($gongshang->save()){
            $this->success('更新成功',U('Admin/Gongshang/index'),3);
        }else{
            $this->error('更新成功',U('Admin/Gongshang/index'),3);
        }
    }

     //删除操作
    public function huishou()
    {
        //获取id
        $id = I('get.id');
        //创建对象
        $gongshang  = M('gongshang ');
        //数组
        $arr = array('id'=>$id,'isdelete'=>0);
        //执行更新
        if($gongshang ->save($arr)){
            $this->success('回收成功', U('Admin/Gongshang/huishouzhan'),3);
        }else{
            $this->error('回收失败', U('Admin/Gongshang/huishouzhan'),3);
        }
    }
    
    //删除操作
    public function delete()
    {
        //获取id
        $id = I('get.id');
        //创建对象
        $gongshang = M('gongshang');
        //数组
        $arr = array('id'=>$id,'isdelete'=>1);
        //执行更新
        if($gongshang->save($arr)){
            $this->success('删除成功', U('Admin/Gongshang/index'),3);
        }else{
            $this->error('删除失败', U('Admin/Gongshang/index'),3);
        }
    }

    public function deleteall(){
        //获取id 
        $id=I('get.id');
        // 创建对象
        $gongshang=M('gongshang');
        // 删除
        $res=$gongshang->delete($id);

        // 判断
        if($res){
            $this->success('删除成功', U('Admin/Gongshang/huishouzhan'),3);
        }else{
            $this->error('删除失败', U('Admin/Gongshang/huishouzhan'),3);
        }


    }

    public function gettips(){
        //创建对象
        $tips = M('tips');

        //获取总数
        $count = $tips->count();

        //创建分页对象
        $page = new \Think\Page($count, 5);

        //获取页码字符串
        $pages = $page->show();

        //获取limit参数
        $limit = $page->firstRow.','.$page->listRows;

        //读取数据
        $res = $tips->limit($limit)->select();

        //返回数据
        echo json_encode($res);
    }


      //详情页控制部分
    public function xiangqing(){
      //获取id
      $id = $_GET['id'];
      //创建数据库库对象
      $gongshang = M('gongshang');
      // 查询数据
      $detail = $gongshang->find($id);
      // 图片处理
      $detail['pic'] = json_decode($detail['pic']);
      // 地区处理
      $detail['area'] = array_pop(explode('@@',$detail['area']));
      // 分配变量
      $this->assign('detail',$detail);
      $this->display();
    }
}
?>
