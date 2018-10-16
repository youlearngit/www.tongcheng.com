<?php
namespace Home\Controller;
use Think\Controller;
class yuleController extends Controller {
    public $vm='Yule/sport';
    public $where='';
    function fenye($table,$pagesize,$pagenow){
        $ww = M($table);
        
         // var_dump($this->where);
         $gclass = isset($_GET['gclass']) ? $_GET['gclass'] : '运动健身';
        switch($gclass){
          case '运动健身':
            // $whe = "and sclass='运动健身'";
            $this->vm="Yule/sport";
            break;
          case '夜店酒吧':
            // $whe = "and sclass='夜店酒吧'";
            $this->vm="Yule/jiu";
            break;
          case '足疗':
            // $whe = "and sclass='足疗/按摩'";
            $this->vm="Yule/zu";
            break;
          case 'KTV':
            // $whe = "and sclass='KTV'";
            $this->vm="Yule/ktv";
            break;
          case '户外运动':
            // $whe = "and sclass='户外运动'";
            $this->vm="Yule/hu";
            break;
          case '洗浴':
             // $whe = "and sclass='洗浴/温泉'";
            $this->vm="Yule/xi";
            break;
        }

         
       //执行查询并分页
        $goods=$ww->where($this->where.'isdelete=0')->page($pagenow,$pagesize)->select();
        // echo $ww->_sql();
        // var_dump($goods);
        // die();
        return $goods;
    }

   
    public function index(){
      $p = ['运动健身','夜店酒吧','足疗/按摩','KTV','户外运动','洗浴/温泉'];
      $c = [];
      $c[0] = ['游泳馆','健身中心','篮球场','篮球场','足球场','网球场','羽毛球馆','乒乓球馆','溜冰场','高尔夫球场','保龄球馆'];
      $c[1] = ['酒吧','夜总会','迪厅'];
      $c[2] = ['足浴保健','足部按摩','足底拔罐','修脚','按摩理疗'];
      $c[3] = [];
      $c[4] = ['攀岩','骑马',' 卡丁车','滑翔伞','蹦极','潜水','漂流','野外拓展','真人cs','滑雪'];
      $c[5] = ['洗浴中心','度假村'];

      
      $gclass = isset($_GET['gclass']) ? $_GET['gclass'] : '夜店酒吧';
      $sclass = $c[array_search($gclass,$p)];
      // var_dump($sclass);
      // die();
       //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;
       
        //获取总的页数
        $ww = M('yule');
        //按条件进行查询
        $this->where = isset($_GET['where']) ? $_GET['where'].'and' : '';
        if(isset($_GET['area'])){//按地区
            $area = array_pop(implode('###',$_GET['area']));
            $this->where .= 'area = '.$area.' and ';
        }
        if(isset($_GET['gclass'])){//按服务类型
            $this->where .= 'gclass = "'.$_GET['gclass'].'" and ';
         }
        $pagecount = ceil($ww->where($this->where.'isdelete=0')->count()/9);
        // var_dump($this->where);
        // echo $ww->_sql();
        // var_dump($pagecount);
        // die();
        if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }
        // var_dump($pagecount);
        // var_dump($pagenow);
        //调用搜索加分页的方法
        $goods = $this->fenye('yule',9,$pagenow);
      foreach($goods as $k=>$v){
        $goods[$k]['pic']=json_decode($v['pic']);
      }

      //将城市信息转换成数组
      foreach($goods as $k=>$v){
        $goods[$k]['area'] = explode('###',$v['area']);
      }

      //获取用户选择城市的信息
        $city = '北京市';
        $areas=$this->cityselect($city);
        $this->assign('pagenow',$pagenow);
        $this->assign('pagecount',$pagecount);
        $this->assign('where',$this->where);
        $this->assign('areas',$areas);
        $this->assign('sclass',$sclass);
        $this->assign('goods',$goods);

    	$this->display($this->vm);
    }

    public function insert(){
        if($this->checkFile()){
             //处理上传的图片的函数
            $_POST['pic']= $this->upload();  
        }

        $goods = M('yule');
        //处理所在城市
        $_POST['area']=$_POST['prov'].'###'.$_POST['city'].'###'.$_POST['dist'];
        $goods->create();
        $res = $goods->add();
        if($res){
            $this->success('添加成功',U("Admin/Goods/index"),2);
        }else{
            $this->error('添加失败',U("Admin/Goods/index"),2);

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
        $edit = M('yule');
        //查询要编辑的商品
        $res=$edit->find($id);
        //将图片的路径再次转换为数组
        $res['pic'] = json_decode($res['pic']);

        //将城市信息转化为数组
        $res['area'] = explode('###',$res['area']);

        $this->assign('res',$res);

        $pinpai = M('type');
        $pinpai->find($res['tid']);
        $this->display('Goods/edit');
    }

    public function update(){
        $up = M('yule');
        //整理城市信息
        $p=isset($_POST['prov']) ? $_POST['prov'] : '';
        $c=isset($_POST['city']) ? $_POST['city'] : '';
        $d=isset($_POST['dsit']) ? $_POST['dist'] : '';

        $_POST['area'] = $p.'###'.$c.'###'.$d;
        $up->create();
        $res=$up->save($_POST);
        if($res){
            // echo"<script type='text/javascript'> alert('修改成功');location.href=".U('Admin/Goods/index').";</script>";
            $this->success('修改成功',U("Admin/Goods/index"),2);
        }else{
            // echo "<script>alert('修改失败');</script>";
            $this->error('修改失败',U("Admin/Goods/index"),2);

        }
    }

    //删除数据
    public function delete(){
        $de=M('yule');
        $id=$_GET['id'];
        $res=$de->save(['isdelete'=>1,'id'=>$id]);
        if($res){
            $this->success('删除成功',U("Admin/Goods/index"),2);
        }else{
            $this->error('删除失败',U("Admin/Goods/index"),2);

        }
    }

    //显示回收站
    public function recover(){
        $ww = M('yule');
        $goods=$ww->where('isdelete=1')->select();
        //将图片路径转化成数组，并获取第一个
      foreach($goods as $k=>$v){
        $goods[$k]['pic']=json_decode($v['pic']);
      }

      //将城市信息转换成数组
      foreach($goods as $k=>$v){
        $goods[$k]['area'] = explode('###',$v['area']);
      }
        $this->assign('goods',$goods);
        $this->display();
    }

    //彻底删除
    public function clear(){
        $cc=M('yule');
        $id=$_GET['id'];
        $res=$cc->delete($id);
        if($res){
            $this->success('删除成功',U("Admin/Goods/index"),2);
        }else{
            $this->error('删除失败',U("Admin/Goods/index"),2);

        }

    }

    //回收数据

    public function hui(){
        $de=M('yule');
        $id=$_GET['id'];
        $res=$de->where('id='.$id)->save(['isdelete'=>0]);
        if($res){
            $this->success('还原成功',U("Admin/Goods/index"),2);
        }else{
            $this->error('还原失败',U("Admin/Goods/index"),2);

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


    //城市选择类
    private function cityselect($city){
        $arr = array('北京市','天津市','重庆市','上海市');
        if(in_array($city,$arr)){

            $p = M('provinces');
             $pid= $p->where('province="'.$city.'"')->find();//获得直辖市的id
             $c = M('cities');
             $city = $c->where('provinceid='.$pid['provinceid'])->select();//获得直辖市，县的id
             $a = M('areas');
             $areas = $a->where('cityid in ('.$city[0]['cityid'].','.$city[1]['cityid'].')')->select();//获得所有的区和县
             // var_dump($areas);
             // die();
        }else{
             $c = M('cities');
            $city = $c->where('city="'.$city.'"')->find();
            $cityid = $city['cityid'];
            $a = M('areas');
            $areas = $a->where('cityid='.$cityid)->select();
           
        }
         return $areas;
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
      $yule = M('yule');
      // 查询数据
      $detail = $yule->find($id);
      // 图片处理
      $detail['pic'] = json_decode($detail['pic']);
      // 地区处理
      $detail['area'] = array_pop(implode('###',$detail['area']));
      // 分配变量
      $this->assign('detail',$detail);
      $this->display('yule/xiangqing');
    }


}
?>