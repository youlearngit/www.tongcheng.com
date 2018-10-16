<?php
namespace Home\Controller;
use Think\Controller;
class CarController extends Controller{
	public $condition;
	//列表页显示
	public function index(){
		
		//声明每页显示的条数
		$num = 15;

		//创建数据库操作对象
		$car = M('car');
		//按条件进行查询
        $this->condition = !empty($_GET['condition']) ? (array)json_decode(str_replace('\'','"',$_GET['condition'])) : array();

		if(isset($_GET['type'])){

            $type = $_GET['type'];

            $this->condition['type'] = ' and type = "'.$type.'"'; 

        }else if(isset($_GET['price1']) && isset($_GET['price2'])){//按价格

            $this->condition['price1'] = ' and price > '.$_GET['price1'];
            
            $this->condition['price2'] = ' and price < '.$_GET['price2'];

        }else if(isset($_GET['brand'])){//按品牌

            $this->condition['brand'] = ' and brand = "'.$_GET['brand'].'"';

        }else if(isset($_GET['chexi'])){

            $this->condition['chexi'] = ' and chexi = "'.$_GET['chexi'].'"';

        }else if(isset($_GET['age1']) && isset($_GET['age2'])){//按价格

            $this->condition['age1'] = ' and age > '.$_GET['age1'];
            
            $this->condition['age2'] = ' and age < '.$_GET['age2'];

        }

        $ccoo = implode(' ',$this->condition);

		//获取总数
		$count = $car->where('isdelete=0 '.$ccoo)->count();
		//创建分页对象
		$page = new \Think\Page($count, $num);// 实例化分页类
		//获取页码字符串
		$pages = $page->show();
		//获取limit参数
		$limit = $page->firstRow.','.$page->listRows;
		//读取数据
		$cars = $car->limit($limit)->where('isdelete=0 '.$ccoo)->select();

		foreach($cars as $k=>$v){
             $cars[$k]['pic']=json_decode($v['pic']);
        }

        $str_condition = json_encode($this->condition);
        // var_dump($str_condition);die;
        $condition = str_replace('"','\'',$str_condition);

		//分配变量
		$this->assign('cars',$cars);
		$this->assign('pages', $pages);
		$this->assign('num',$num);
		$this->assign('condition',$condition);
		// $this->assign('keyword',$keyword);

        //解析模板
        $this->display();


	}


	//瀑布流请求
	public function gettips(){
		//创建对象
		$tips = M('cartips');

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

	//详情页
	public function detail(){

		//接收id
		$id = $_GET['id'];

		//读取信息
        $car = M('car')->find($id);

        //获取读取出的汽车类型 查询右侧广告栏的数据
        $cars = M('car')->limit(7)->where('type="'.$car['type'].'"')->select();

        //同类推荐
        $chexi = M('car')->limit(4)->where('chexi="'.$car['chexi'].'"')->select();
        $brand = M('car')->limit(4)->where('brand="'.$car['brand'].'"')->select();

        //处理图片
        $car['pic']=json_decode($car['pic']);

        foreach($cars as $k=>$v){
             $cars[$k]['pic']=json_decode($v['pic']);
        }

        foreach($chexi as $k=>$v){
             $chexi[$k]['pic']=json_decode($v['pic']);
        }

        foreach($brand as $k=>$v){
             $brand[$k]['pic']=json_decode($v['pic']);
        }
        
        //分配变量
        $this->assign('car', $car);
        $this->assign('cars', $cars);
        $this->assign('chexi', $chexi);
        $this->assign('brand', $brand);

        //解析模板
        $this->display();
	}

}