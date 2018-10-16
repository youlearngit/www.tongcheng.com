<?php 

	namespace Home\Controller;
	use Think\Controller;
	class ZiyingController extends Controller{

		public function index()
		{
			//获取当前所有的分类
			$cates = $this->getAllCates(0);
			$this->assign('cates', $cates);
			$this->display();
		}

		public function getAllCates($pid){
			//创建模型
			$cate = M('ziying');
			$res = $cate->where("pid={$pid}")->select();
			//声明数组
			$arr = [];
			//遍历顶级分类
			foreach ($res as $key => $value) {
				//通过当前分类的id去获取子分类
				$value['subCate'] = $this->getAllCates($value['id']);
				//压入空数组
				$arr[] = $value;// array_push  array_unshift
			}
			return $arr;

		}

		public function jiazheng(){

			$this->display();
		}

		public function liren(){

			$this->display();
		}


		public function suyun(){

			$this->display();
		}

		public function yuesao(){

			$this->display();
		}

		public function baomu(){

			$this->display();
		}

		public function xiangqing(){

			$id = (I('get.id'));

			$ziying = M('ziying');

			$info = $ziying->find($id);

			$this->assign('info',$info);

			$this->display();
		}

		public function saixuan(){

			$baomu = M('baomu');

			$baomus = $baomu->select();

			$this->assign('baomu',$baomus);

			$this->display();
		}

		// public function caboli(){

		// 	$this->display();
		// }


		// public function sdqingjie(){

		// 	$this->display();
		// }

		// public function jiandian(){

		// 	$this->display();
		// }

		// public function jiaju(){

		// 	$this->display();
		// }


		// public function meijia(){

		// 	$this->display();
		// }

		// public function meijie(){

		// 	$this->display();
		// }


		// public function huazhuang(){

		// 	$this->display();
		// }

		// public function banjia(){

		// 	$this->display();
		// }

	}