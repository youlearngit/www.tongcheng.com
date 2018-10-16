<?php 
	
	namespace Home\Controller;
	use Think\Controller;
	class CartController extends Controller{

		//加入购物车
		public function add()
		{	
			$username = session('username');

			if(!$username){
				$this->error('请先登录',U('Home/User/login'),3);
			}

			//将数据压入session数组
			if(!$this->checkExist()){
				$_SESSION['cart'][] = $_POST;
			}
			//提示信息
			$this->success('成功加入收藏', U('Home/Cart/index'),3);
			
		}
 

		//显示收藏夹页面
		public function index()
		{
			$username = session('username');

			$data = $_SESSION['cart'];
				
			foreach ($data as $key => $value) {
				//读取商品的信息
				$data[$key]['info'] = M('zhuangxiu')->find($value['id']);
				//计算总价
				$countprice += $data[$key]['info']['price'];
				//获取主图
				$pic = explode(',', $data[$key]['info']['pic']);
				foreach ($pic as $k => $v) {
					//清除两侧的无用字符
					$v = trim($v,'["');
					//删除反斜杠
					$pic[$k] = str_replace('\\', '', trim($v,'["'));
				}
				//
				$data[$key]['pic'] = $pic;
			}
			$id = $_SESSION['cart'][(count($_SESSION['cart'])-1)];

			$zhuangxiu = M('zhuangxiu')->find($id);

			$count = count($_SESSION['cart']);

			$tui = M('zhuangxiu')->where('stype="'.$zhuangxiu['stype'].'"')->limit(3,5)->select();
			foreach ($tui as $k => $v){

	        	$tui[$k]['pic']=json_decode($tui[$k]['pic']);

	        }

			
			//分配变量
			$this->countprice = $countprice;
			$this->username = $username;
			$this->tui = $tui;
			$this->data = $data;
			$this->count = $count;
			$this->display();
		}

		private function checkExist()
		{
			//检测收藏夹中是否存在该商品
			$id = I('post.id');
			foreach ($_SESSION['cart'] as $key => $value) {
				if($value['id'] == $id){
					return true;
				}
			}
			return false;
		}


		public function delete(){
			//获取id
			$id = I('get.id');

			//遍历数组
			$data = $_SESSION['cart'];

			foreach($data as $key => $val){

				if($val['id'] == $id){

					unset($_SESSION['cart'][$key]);
				}

			}

			//提示信息
			$this->success('从收藏里移出成功', U('Home/Cart/index'),3);


		}

	}










 ?>