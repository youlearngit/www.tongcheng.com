<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends Controller {
	public function index(){
		$shop = M('shop');
		if(!empty($_GET['price']) && $_GET['price']==1){
			$order = 'order by price asc';
		}
		if(!empty($_GET['price']) && $_GET['price']==2){
			$order = 'order by price desc';
		}
		if(!empty($_GET['xiaoliang']) && $_GET['xiaoliang']==1){
			$order = 'order by xiaoliang asc';
		}
		if(!empty($_GET['xiaoliang']) && $_GET['xiaoliang']==1){
			$order = 'order by xiaoliang desc';
		}


		$goods = $shop->order($order)->select();
		$this->assign('goods',$goods);
		$this->display();
	}

	public function detail(){
		$id = $_GET['id'];
		$shop = M('shop');
		$shops = $shop->join('left join shop_detail on shop.id = shop_detail.list_id')->where('shop.id='.$id)->select();
		$shops[0]['ltime']=date('Y-m-d H-i-s',$shops[0]['ltime']);
		$this->assign('shops',$shops);
		$this->display();
	}

	public function xiadan(){

		$id = $_GET['id'];
		$amount = $_GET['amount'];
		$shang = M('shop');
		$goods = $shang->find();
		$goods['num']=$amount;
		$this->assign('goods',$goods);
		$this->display();
	}

}
?>