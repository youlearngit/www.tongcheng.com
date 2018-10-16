<?php
namespace Home\Controller;
use Think\Controller;
class JiazhengController extends Controller {

    // function fenye($table,$pagesize,$nowpage){
    //     $ww = M($table);
    //     //按条件进行查询
    //     $where = isset($_GET['where']) ? $_GET['where'].'and' : '';
    //     if(isset($_GET['area'])){//按地区
    //         $area = array_pop(implode('@@@',$_GET['area']));
    //         $where .= 'area = '.$area.' and ';
    //     }else if(isset($_GET['brand'])){//按服务类型
    //         $where .= 'brand = '.$_GET['brand'].' and ';
    //     }

    //      //获取总的页数
    //      $pagecount = ceil($ww->count()/$pagesize);
    //    //执行查询并分页
    //     $goods=$ww->where($where.'isdelete=0')->page($nowpage,$pagesize)->select();
    //     return $goods;
    // }

   
    public function index(){
       $p = ['月嫂/保姆','保洁','钟点工','疏通','回收','维修'];
    $c = array();
    $c[0] = ['月嫂','育儿师','管家','陪护','保姆','钟点工'];
    $c[1] = ['物业保洁','开荒保洁','家庭保洁','玻璃清洗','地板打蜡','石材翻新/养护','油烟机清洗','地毯清洗','空调清洗','沙发清洗','灯具清洗','高空清'];
    $c[2] = ['月嫂/保姆','保洁','钟点工','疏通','维修','回收'];
    $c[3] = ['下水道疏通','马桶疏通','化粪池清理','工业管道安装／改造','打捞','市政管道清淤','隔油池维修/清理'];
    $c[4] = ['电器回收','电脑回收','手机回收',' 金银回收','礼品回收','奢侈品回收','家具回收','金属回收','废纸回收','塑料回收','药品回收'];
    $c[5] = ['冰箱维修','热水器维修','电视维修','空调维修/拆装','洗衣机维修','厨房家电维修','影音家电维修','小家电维修'];
      //参数字符串
      $condition = isset($condition) ? json_decode($condition) : array();
      //大类
      $gclass="保洁";
      if(isset($_GET['gclass'])){
        $gclass=$_GET['gclass'];
        $condition['gclass']= ' and gclass="'.$gclass.'"';
      }

      
      //小类列表
      $sclass = $c[array_search($gclass,$p)];
      //小类
       if(isset($_GET['sclass'])){
            $condition['sclass'] = ' and sclass = "'.$_GET['sclass'].'"';
         }
       
       
        if(isset($_GET['area'])){//按地区
            $area = $_GET['area'];
            $pp=isset($_SESSION['area']) ? $_SESSION['area'] : '北京市@@@市辖区';
            $condition['area'] = ' and area = "'.$pp.'@@@'.$area.'"';
        }

        if(isset($_GET['sclass'])){//按品牌

            $condition['sclass'] = ' and sclass = "'.$_GET['sclass'].'"';
         }

         //将condition数组转换为SQL语句
         $ccoo = implode(' ',$condition);
         $ww = M('jiazheng');
         //获取总的页数
         $pagecount = ceil($ww->count()/8);
         //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;
        if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$pagecount){
            $pagenow=$pagecount;
        }

       //执行查询并分页
       $goods=$ww->where('isdelete=0 '.$ccoo)->page($pagenow,8)->select();


      foreach($goods as $k=>$v){
        $goods[$k]['pic']=json_decode($v['pic']);
      }
      $city=$_SESSION['city'];
          if(empty($city)){
            $this->error('请选择城市',U('Home/Index/area'),2);
          }
         
          $city = array_pop(explode('@@@',$city));

          //获取指定城市的地区
          $areas=$this->cityselect($city);

      //获取用户选择城市的信息
        $areas=$this->cityselect($city);
        $this->assign('pagenow',$pagenow);
        $this->assign('pagecount',$pagecount);
        $this->assign('where',$where);
        $this->assign('areas',$areas);
        $this->assign('sclass',$sclass);
        $this->assign('gclass',$gclass);
        $this->assign('goods',$goods);

    	$this->display('jiazheng/list');
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
        $edit = M('jiazheng');
        //查询要编辑的商品
        $res=$edit->find($id);
        //将图片的路径再次转换为数组
        $res['pic'] = json_decode($res['pic']);

        //将城市信息转化为数组
        $res['area'] = explode('@@@',$res['area']);

        $this->assign('res',$res);

        $pinpai = M('type');
        $pinpai->find($res['tid']);
        $this->display('Goods/edit');
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
            $this->success('修改成功',U("Admin/Goods/index"),2);
        }else{
            // echo "<script>alert('修改失败');</script>";
            $this->error('修改失败',U("Admin/Goods/index"),2);

        }
    }

    //删除数据
    public function delete(){
        $de=M('jiazheng');
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
            $this->success('删除成功',U("Admin/Goods/index"),2);
        }else{
            $this->error('删除失败',U("Admin/Goods/index"),2);

        }

    }

    //回收数据

    public function hui(){
        $de=M('jiazheng');
        $id=$_GET['id'];
        $res=$de->where('id='.$id)->save(['isdelete'=>0]);
        if($res){
            $this->success('还原成功',U("Admin/Goods/index"),2);
        }else{
            $this->error('还原失败',U("Admin/Goods/index"),2);

        }
    }


  
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
      $jiazheng = M('jiazheng');
      // 查询数据
      $detail = $jiazheng->find($id);
      // 图片处理
      $detail['pic'] = json_decode($detail['pic']);
      // 地区处理
      $detail['area'] = array_pop(implode('@@@',$detail['area']));
      // 分配变量
      $this->assign('detail',$detail);
      $this->display('Jiazheng/xiangqing');
    }


}
?>