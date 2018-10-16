<?php
namespace Home\Controller;
use Think\Controller;
class FangziController extends Controller {
    public function er_lists(){
        //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;

        // 设置条件 
        $fangzi=M('fangzi');
        //按条件进行查询
        $where = isset($_GET['where']) ? $_GET['where'].'and' : '';
        if(isset($_GET['zujin1']) && isset($_GET['zujin2'])){
             $where .= 'zujin >= '.$_GET['zujin1'].' and '.'zujin <= '.$_GET['zujin2'].' and ';
         }else if(isset($_GET['size1']) && isset($_GET['size2'])){
             $where .= 'size >= '.$_GET['size1'].' and '.'size <= '.$_GET['size2'].' and ';
         }else if(isset($_GET['shi'])){
            $where = 'shi = '.$_GET['shi'].' and ';
         }

        // $fangzis=$fangzi->where($where.'isdelete=0 and fangshi="二手房"')->select();

           //获取总的页数
         $pagecount = ceil($fangzi->where($where.'isdelete=0 and fangshi="二手房"')->count()/3);
         if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }

       //执行查询并分页
        $fangzis=$fangzi->where($where.'isdelete=0 and fangshi="二手房"')->page($pagenow,3)->select();
        foreach($fangzis as $k=>$v){
            $fangzis[$k]['pic']=json_decode($v['pic']);
        }
        $this->assign('arr',$fangzis);
        $this->assign('pagecount',$pagecount);
        $this->assign('pagenow',$pagenow);
        // 跳转到房子列表页
        $this->display();
    }

     public function zu_lists(){

         //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;


        // 设置条件 
        $fangzi=M('fangzi');
        //按条件进行查询
        $where = isset($_GET['where']) ? $_GET['where'].'and' : '';
        if(isset($_GET['zujin1']) && isset($_GET['zujin2'])){
             $where .= 'zujin >= '.$_GET['zujin1'].' and '.'zujin <= '.$_GET['zujin2'].' and ';
         }else if(isset($_GET['size1']) && isset($_GET['size2'])){
             $where .= 'size >= '.$_GET['size1'].' and '.'size <= '.$_GET['size2'].' and ';
         }

           //获取总的页数
         $pagecount = ceil($fangzi->where($where.'isdelete=0 and fangshi in ("整套出租","单间出租","床位出租")')->count()/3);
         if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }

        $fangzis=$fangzi->where($where.'isdelete=0 and fangshi in ("整套出租","单间出租","床位出租")')->page($pagenow,3)->select();
        foreach($fangzis as $k=>$v){
             $fangzis[$k]['pic']=json_decode($v['pic']);
        }
        $this->assign('arr',$fangzis);
        $this->assign('pagecount',$pagecount);
        $this->assign('pagenow',$pagenow);
        // 跳转到房子列表页
        $this->display();
    }

    public function zz_lists(){

          //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;

        // 设置条件 
        $fangzi=M('fangzi');
        //按条件进行查询
        $where = isset($_GET['where']) ? $_GET['where'].'and' : '';
        if(isset($_GET['zujin1']) && isset($_GET['zujin2'])){
             $where .= 'zujin >= '.$_GET['zujin1'].' and '.'zujin <= '.$_GET['zujin2'].' and ';
         }else if(isset($_GET['size1']) && isset($_GET['size2'])){
             $where .= 'size >= '.$_GET['size1'].' and '.'size <= '.$_GET['size2'].' and ';
         }

             //获取总的页数
         $pagecount = ceil($fangzi->where($where.'isdelete=0 and fangshi="整套出租"')->count()/3);
         if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }
        $fangzis=$fangzi->where($where.'isdelete=0 and fangshi="整套出租"')->page($pagenow,3)->select();
        foreach($fangzis as $k=>$v){
             $fangzis[$k]['pic']=json_decode($v['pic']);
        }
        $this->assign('arr',$fangzis);
        $this->assign('pagecount',$pagecount);
        $this->assign('pagenow',$pagenow);
        // 跳转到房子列表页
        $this->display();
    }

    public function dz_lists(){

          //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;


        // 设置条件 
        $fangzi=M('fangzi');
        //按条件进行查询
        $where = isset($_GET['where']) ? $_GET['where'].'and' : '';
        if(isset($_GET['zujin1']) && isset($_GET['zujin2'])){
             $where .= 'zujin >= '.$_GET['zujin1'].' and '.'zujin <= '.$_GET['zujin2'].' and ';
         }else if(isset($_GET['size1']) && isset($_GET['size2'])){
             $where .= 'size >= '.$_GET['size1'].' and '.'size <= '.$_GET['size2'].' and ';
         }

              //获取总的页数
         $pagecount = ceil($fangzi->where($where.'isdelete=0 and fangshi="单间出租"')->count()/3);
         if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }

        $fangzis=$fangzi->where($where.'isdelete=0 and fangshi="单间出租"')->page($pagenow,3)->select();
        foreach($fangzis as $k=>$v){
             $fangzis[$k]['pic']=json_decode($v['pic']);
        }
        $this->assign('arr',$fangzis);
         $this->assign('pagecount',$pagecount);
        $this->assign('pagenow',$pagenow);
        // 跳转到房子列表页
        $this->display();
    }

    public function cz_lists(){

          //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;

        // 设置条件 
        $fangzi=M('fangzi');
        //按条件进行查询
        $where = isset($_GET['where']) ? $_GET['where'].'and' : '';
        if(isset($_GET['zujin1']) && isset($_GET['zujin2'])){
             $where .= 'zujin >= '.$_GET['zujin1'].' and '.'zujin <= '.$_GET['zujin2'].' and ';
         }else if(isset($_GET['size1']) && isset($_GET['size2'])){
             $where .= 'size >= '.$_GET['size1'].' and '.'size <= '.$_GET['size2'].' and ';
         }


              //获取总的页数
         $pagecount = ceil($fangzi->where($where.'isdelete=0 and fangshi="床位出租"')->count()/3);
         if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }

        $fangzis=$fangzi->where($where.'isdelete=0 and fangshi="床位出租"')->page($pagenow,3)->select();
        foreach($fangzis as $k=>$v){
             $fangzis[$k]['pic']=json_decode($v['pic']);
        }
        $this->assign('arr',$fangzis);
         $this->assign('pagecount',$pagecount);
        $this->assign('pagenow',$pagenow);
        // 跳转到房子列表页
        $this->display();
    }

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
      $fangzi = M('fangzi');
      // 查询数据
      $detail = $fangzi->find($id);
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
