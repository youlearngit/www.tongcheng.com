<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        //查看是否有新的留言
      if(!empty($_SESSION['id'])){
             $liuyan = M('liuyan');
             $sid = $_SESSION['id'];
            //获取所有留言
            $liuyans = $liuyan->where('status=1 and sid='.$sid)->select();
            $ff = count($liuyans);
      }
         


    	$area = isset($_GET['area']) ? $_GET['area'] : '北京市';
        if($area=='北京市'){
            $area='北京市@@@市辖区';
        }
        if($area=='上海市'){
            $area='上海市@@@市辖区';
        }
        if($area=='天津市'){
            $area='天津市@@@市辖区';
        }
        if($area=='重庆市'){
            $area='重庆市@@@市辖区';
        }
    	session_start();
    	$_SESSION['city'] = $area;

         if($area=='北京市@@@市辖区'){
           $area = explode('@@@',$area)[0];
        }
        if($area=='上海市@@@市辖区'){
            $area = explode('@@@',$area)[0];
        }
        if($area=='天津市@@@市辖区'){
            $area = explode('@@@',$area)[0];
        }
        if($area=='重庆市@@@市辖区'){
           $area = explode('@@@',$area)[0];
        }

    	$area = array_pop(explode('@@@',$area));
        $this->assign('username',session('username'));
    	$this->assign('area',$area);
        $this->assign('ff',$ff);
        $this->display();
    }
    public function area(){
    	$prov = M('provinces');
    	$provinces = $prov->select();
    	// var_dump($provinces);

    	$city = M('cities');
    	$cities = $city->select();

    	$arr = array();
    	foreach($provinces as $v){
    		if($v['province']=='北京市'){
    			continue;
    		}
    		if($v['province']=='重庆市'){
    			continue;
    		}
    		if($v['province']=='上海市'){
    			continue;
    		}
    		if($v['province']=='天津市'){
    			continue;
    		}

    		
    		$arr[$v['province']][] = $city->field('city,cityid')->where('provinceid='.$v['provinceid'])->select();

    	}
	    	$this->assign('arr',$arr);
	    	$this->display();
    }

    public function xx(){
        $uid = $_SESSION['id'];
        // var_dump($uid);
        //查询留言表信息
        $liuyan = M('liuyan');
        //设置留言已经查看
        $a=array('status'=>0);
        $liuyan ->where('status=1')->save($a);

        //获取所有留言
        $liuyans = $liuyan->where('sid='.$uid)->select();
        $arr = array();
        $i=0;

        
        foreach($liuyans as $k=>$v){
           //重新组织数组
             $arr[$i]=array_merge($this->ggg($v['gid']),$this->uuu($v['uid']));

             // $arr[$i]['content']=$v['content'];
             $arr[$i]=array_merge($arr[$i],$v);
            $i++;
        }
        // var_dump($liuyans);
        // var_dump($arr);
        // die();
        $this->assign('arr',$arr);

        $this->display();
    }
    //取商品信息方法
    public function ggg($id){
        $god = M('shuma');
        $res=$god->field('name')->find($id);
        return $res;
    }
    // 取用户信息方法
    public function uuu($id){
        $user = M('user');
        $res=$user->field('username,tel')->find($id);
        return $res;
    }



    public function search(){
      $key = $_POST['key'];
      
      $pad = ['iPad','三星','小米','爱国者','联想/ThinkPad','E人E本','纽曼','华为','宏基','华硕','戴尔','微软','其他品牌'];
        $ts = ['联想/ThinkPad','华为','宏基','华硕','戴尔'];

        $phone = ['苹果','三星','小米','诺基亚','华为','HTC','联想','酷派','更多品牌'];
            
        $pc = ['宏基','华硕','戴尔','联想','惠普','索尼','苹果','三星','富士通','东芝','方正','神舟','其他品牌'];

        $camera = ['单反相机','相机包','微单相机','镜头'];
      

    }

    public function res(){
        $liuyan = M('liuyan');
        $liuyan->create($_GET);
        $res = $liuyan->add($_GET);
        if($res){
            echo 1;
        }else{
            echo 0;
        }
       
    }

}