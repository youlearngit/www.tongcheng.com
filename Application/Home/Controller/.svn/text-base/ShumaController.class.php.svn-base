<?php
namespace Home\Controller;
use Think\Controller;
class ShumaController extends Controller {
    public $pagecount=1;
    public $vm;
    public $condition;

    //多条件搜索加分页的方法
    function fenye($table,$pagesize,&$pagenow){
        $ww = M($table);

         
        //判断查询的数码的类型
        $gclass = isset($_GET['gclass']) ? $_GET['gclass'] : 'phone';
        switch($gclass){
          case 'pad':
            // $whe = " and type='pad'";
            $this->vm="Shuma/pad";
            break;
          case 'ts':
            // $whe = " and type='ts'";
            $this->vm="Shuma/ts";
            break;
          case 'pc':
            // $whe = " and type='pc'";
            $this->vm="Shuma/pc";
            break;
          case 'phone':
            // $whe = " and type='phone'";
            $this->vm="Shuma/list";
            break;
          case 'camera':
            // $whe = " and type='camera'";
            $this->vm="Shuma/camera";
            break;
        }
         //按条件进行查询
        $this->condition = !empty($_GET['condition']) ? (array)json_decode(str_replace('\'','"',$_GET['condition'])) : array();
        // var_dump($this->condition);die;
        // $where = !empty($_GET['where']) ? $_GET['where'].'and' : '';
        if(isset($_GET['area'])){//按地区
            $area = $_GET['area'];
            $pp=isset($_SESSION['area']) ? $_SESSION['area'] : '北京市@@@市辖区';
            $this->condition['area'] = ' and area = "'.$pp.'@@@'.$area.'"'; 

        }
        if(isset($_GET['price1']) && isset($_GET['price2'])){//按价格


             $this->condition['price1'] = ' and price > '.$_GET['price1'];
             $this->condition['price2'] = ' and price < '.$_GET['price2'];


        }
        if(isset($_GET['gclass'])){//按大类
            // $where .= 'brand = "'.$_GET['sclass'].'" and ';

            $this->condition['gclass'] = ' and type = "'.$_GET['gclass'].'"';

         }
         if(isset($_GET['sclass'])){//按品牌
            // $where .= 'brand = "'.$_GET['sclass'].'" and ';

            $this->condition['sclass'] = ' and brand = "'.$_GET['sclass'].'"';

         }
         if(isset($_GET['width'])){//按屏幕尺寸
            // $where = 'width = "'.$_GET['width'].'" and ';

            $this->condition['width'] = ' and width = "'.$_GET['width'].'"';

         }
         // var_dump($_GET);
         // var_dump($this->condition);
         // die;
         $ccoo = implode(' ',$this->condition);
         // var_dump($ccoo);die();
         //获取总的页数
         $this->pagecount = ceil($ww->where(' isdelete=0'.$ccoo.$whe)->count()/$pagesize);
         if($pagenow<1){
            $pagenow=1;
        }
        if($pagenow>$this->pagecount){
            $pagenow=$this->pagecount;
        }

        
       //执行查询并分页
        $goods=$ww->where('isdelete=0 '.$ccoo.$whe)->page($pagenow,$pagesize)->select();
        // echo $ww->_sql();
        // die();
      // echo $ww->_sql();
      // die();
        return $goods;
    }

    //列表页的方法
    public function index(){
       //接收当前显示第几页的信息
        $pagenow = isset($_GET['pagenow']) ? $_GET['pagenow'] : 1;
        //调用搜索加分页的方法
        $goods = $this->fenye('shuma',9,$pagenow);
        
        foreach($goods as $k=>$v){
          $goods[$k]['pic']=json_decode($v['pic']);
        }

        //将城市信息转换成数组
        foreach($goods as $k=>$v){
          $goods[$k]['area'] = explode('@@@',$v['area']);
        }

        //获取用户选择城市的信息
          session_start();
          $city=$_SESSION['city'];
          if(empty($city)){
            $this->error('请选择城市',U('Home/Index/area'),2);
          }
         
          $city = array_pop(explode('@@@',$city));

          //获取指定城市的地区
          $areas=$this->cityselect($city);
          $this->assign('pagenow',$pagenow);
          $this->assign('pagecount',$this->pagecount);
          // $this->assign('where',$where);

          $str_condition = json_encode($this->condition);
          // var_dump($str_condition);
          $str_condition = str_replace('"','\'',$str_condition);
          // var_dump($str_condition);die;
          $this->assign('condition',$str_condition);
          $this->assign('areas',$areas);
          $this->assign('city',$city);
          $this->assign('goods',$goods);

      	$this->display($this->vm);
    }



    public function checkFile(){
        if($_FILES['pic']['error'][0]==0){
            return true;
        }else{
            return false;
        }
    }


    //二手市场的首页的方法
    public function ershou(){
      $shuma = M('shuma');
      $goods = $shuma->limit('15')->select();
      foreach($goods as $k=>$v){
        $goods[$k]['pic']=json_decode($v['pic'])[0];
        $goods[$k]['name']=substr(0,10,$v['name']);
      }
      $this->assign('goods',$goods);

      $this->display();
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
      //将商品的id存入cookie中
      setcookie('gid',$id);
      //创建数据库库对象
      $shuma = M('shuma');
      // 查询数据
      $detail = $shuma->find($id);

      // 图片处理
      $detail['pic'] = json_decode($detail['pic']);
      // 地区处理
      $detail['area'] = array_pop(implode('###',$detail['area']));


      //查询评价
      $ping = M('pinglun');
      $pings = $ping->where('gid='.$id)->select();
      // 分配变量
      $this->assign('ping',$pings);
      $this->assign('detail',$detail);
      $this->display('Shuma/xiangqing');
    }

    public function liuyan(){
      if(!empty($_POST['content'])){
        $content=$_POST['content'];
        $liuyan = M('liuyan');
        //从session中获取当前登录用户的id

        $uid = $_SESSION['id'];
        $uid = 28;
        //从cookie中获取此详情页的商品的id
        $gid = $_COOKIE['gid'];
        //获取商家用户的id
        $sid = M('shuma')->where('id='.$gid)->field('uid')->find();
        $sid = $sid['uid'];
        //存储用户id
        $_POST['uid'] = $uid;
        //商家的id
        $_POST['sid'] = $sid;
        //商品的id
        $_POST['gid'] = $gid;
        $liuyan->create();
        $res=$liuyan->add();
      }

      if($res){
        echo true;
      }else{
        echo false;
      }
    }
}
?>