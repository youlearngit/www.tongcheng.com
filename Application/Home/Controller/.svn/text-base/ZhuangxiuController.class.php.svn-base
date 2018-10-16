<?php 

	namespace Home\Controller;
	use Think\Controller;
	class ZhuangxiuController extends Controller{

		public function index(){

			$name = session('username');

			//声明每页显示的条数
			$num = 12;

			$zhuangxiu = M('zhuangxiu');

	        $_GET['gtype'] = isset($_GET['gtype']) ? $_GET['gtype'] : '工装服务';
	        $gtype = $_GET['gtype'];
    
	        //设置条件
	        if(isset($_GET['gtype'])){
		         $where .= 'gtype = "'.$_GET['gtype'].'" and ';
		    }


	        switch ($_GET['gtype']) {
	            case '家庭装修':
	                $stype = ['装修队/散工','装修公司','设计公司/设计师','施工监理'];
	                break;
	            case '工装服务':
	                $stype = ['办公室装修','写字楼装修','餐饮娱乐装修','店铺装修','商场/超市装修','学校装修','幼儿园装修','医院装修','售楼中心装修','厂房装修','展厅装修','酒店装修'];
	                break;
	            case '建材':
	                $stype = ['橱柜','瓷砖','地板','房门','卫浴洁具','移门壁柜','涂料壁纸','厨卫电器','公共环卫设施','灯具照明','门窗','龙头水槽','吊顶浴霸','暖气地暖','晾衣架/杆','楼梯','智能家居系统','基础建筑材料','水泥砂石','五金工具','电子电工','环保/除味/保养'];
	                break;
	            case '家具':
	                $stype = ['床','床垫','榻榻米','空间家具','沙发','桌类','椅凳','柜类','架类','几类','案/台类','根雕类','镜子类','屏风/花窗','箱类','户外庭院','辅料配件','商业/办公家具'];
	                break;
	            case '家纺家饰':
	                $stype = ['床上用品','布艺软饰','帘类','毯类','垫类','家居摆挂饰','相框/画片','贴饰壁饰','工艺饰品'];
	                break;
	        }

	        $stp = isset($_GET['stype']) ? $_GET['stype'] : '';
	        $gtp = isset($_GET['gtype']) ? $_GET['gtype'] : '';
	        $addr = isset($_GET['addr']) ? $_GET['addr'] : '';

	        if(isset($_GET['stype'])){
		         $where .= 'stype = "'.$_GET['stype'].'" and ';
		    }else if(isset($_GET['addr'])){
		    	 $where .= 'addr = "'.$_GET['addr'].'" and ';
		    }

		    //获取总数
			$count = $zhuangxiu->where($where.'isdelete=0')->count();
			//创建分页对象
			$page = new \Think\Page($count, $num);// 实例化分页类
			//获取页码字符串
			$pages = $page->show();
			//获取limit参数
			$limit = $page->firstRow.','.$page->listRows;
			//读取数据
	        $zhuangxius=$zhuangxiu->limit($limit)->where($where.'isdelete=0')->select();

	        foreach ($zhuangxius as $key => $value) {
	                $zhuangxius[$key]['pic'] = json_decode($zhuangxius[$key]['pic']);
	        }

	        $this->assign('username',$name);
	        $this->assign('stype',$stype);
	        $this->assign('stp',$stp);
	        $this->assign('zhuangxiu',$zhuangxius);
			$this->assign('pages', $pages);
	        $this->assign('gtype',$gtp);
	  
			$this->display();
		}


		//瀑布流请求
		public function gettips(){
			//创建对象
			$tips = M('zhuangxiutips');

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

			$username = session('username');

			//读取信息
	        $zhuangxiu =  M('zhuangxiu')->field('zhuangxiu.*,user.username')->join('left join user on user.id = zhuangxiu.uid')->where('zhuangxiu.id='.$id)->find();

	        //处理图片
	        $zhuangxiu['pic']=json_decode($zhuangxiu['pic']);
	        $zhuangxiu['time'] = date('Y-m-d',$zhuangxiu['time']);

	        /******根据所查询的大类 查询猜你喜欢的数据******/
	        $like = M('zhuangxiu')->limit(5)->where('gtype="'.$zhuangxiu['gtype'].'"')->select();
	        foreach ($like as $k => $v){

	        	$like[$k]['pic']=json_decode($like[$k]['pic']);

	        }

	        /******根据所查询的小类 查询只能推广的数据******/
	        $tui = M('zhuangxiu')->limit(5)->where('stype="'.$zhuangxiu['stype'].'"')->select();
	        foreach ($tui as $k => $v){

	        	$tui[$k]['pic']=json_decode($tui[$k]['pic']);

	        }

	         /******同类推荐**人气****/
	        $ren = M('zhuangxiu')->limit(1,5)->where('stype="'.$zhuangxiu['stype'].'"')->select();
	        foreach ($ren as $k => $v){

	        	$ren[$k]['pic']=json_decode($ren[$k]['pic']);

	        }

	         /******同类推荐**同类****/
	        $tong = M('zhuangxiu')->limit(1,5)->where('gtype="'.$zhuangxiu['gtype'].'"')->select();
	        foreach ($tong as $k => $v){

	        	$tong[$k]['pic']=json_decode($tong[$k]['pic']);

	        }

	         /******同类推荐**同类****/
	        $qita = M('zhuangxiu')->limit(1,5)->where('gtype="建材"')->select();
	        foreach ($qita as $k => $v){

	        	$qita[$k]['pic']=json_decode($qita[$k]['pic']);

	        }

	       
	        //分配变量
	        $this->assign('username',$username);
	        $this->assign('zhuangxiu', $zhuangxiu);
	        $this->assign('like', $like);
	        $this->assign('tui', $tui);
	        $this->assign('ren', $ren);
	        $this->assign('tong', $tong);
	        $this->assign('qita', $qita);
	       
	        //解析模板
	        $this->display();
		}


		public function zhuye(){

			$zhuangxiu = M('zhuangxiu');
    
	        //设置条件
	        if(isset($_GET['gtype'])){
		         $where .= 'gtype = "'.$_GET['gtype'].'" and ';
		    }


	        switch ($_GET['gtype']) {
	            case '家庭装修':
	                $stype = ['装修队/散工','装修公司','设计公司/设计师','施工监理'];
	                break;
	            case '工装服务':
	                $stype = ['办公室装修','写字楼装修','餐饮娱乐装修','店铺装修','商场/超市装修','学校装修','幼儿园装修','医院装修','售楼中心装修','厂房装修','展厅装修','酒店装修'];
	                break;
	            case '建材':
	                $stype = ['橱柜','瓷砖','地板','房门','卫浴洁具','移门壁柜','涂料壁纸','厨卫电器','公共环卫设施','灯具照明','门窗','龙头水槽','吊顶浴霸','暖气地暖','晾衣架/杆','楼梯','智能家居系统','基础建筑材料','水泥砂石','五金工具','电子电工','环保/除味/保养'];
	                break;
	            case '家具':
	                $stype = ['床','床垫','榻榻米','空间家具','沙发','桌类','椅凳','柜类','架类','几类','案/台类','根雕类','镜子类','屏风/花窗','箱类','户外庭院','辅料配件','商业/办公家具'];
	                break;
	            case '家纺家饰':
	                $stype = ['床上用品','布艺软饰','帘类','毯类','垫类','家居摆挂饰','相框/画片','贴饰壁饰','工艺饰品'];
	                break;
	        }

	        $stp = isset($_GET['stype']) ? $_GET['stype'] : '';
	        $gtp = isset($_GET['gtype']) ? $_GET['gtype'] : '';

	        if(isset($_GET['stype'])){
		         $where .= 'stype = "'.$_GET['stype'].'" and ';
		    }

	        $zhuangxius=$zhuangxiu->where($where.'isdelete=0')->select();

	        foreach ($zhuangxius as $key => $value) {
	                $zhuangxius[$key]['pic'] = json_decode($zhuangxius[$key]['pic']);
	        }


	        $this->assign('stype',$stype);
	        $this->assign('stp',$stp);
	        $this->assign('zhuangxiu',$zhuangxius);
	        $this->assign('gtype',$gtp);
	  
			$this->display();
		
		}

		//家庭装修
		public function onef(){


			$zhuangxiu = M('zhuangxiu');

			//设置条件
			$where .= 'gtype = "家庭装修" and ';

			$stp = isset($_GET['stype']) ? $_GET['stype'] : '';
	        $gtp = isset($_GET['gtype']) ? $_GET['gtype'] : '';

	        if(isset($_GET['stype'])){
		         $where .= 'stype = "'.$_GET['stype'].'" and ';
		    }

	        $zhuangxius=$zhuangxiu->where($where.'isdelete=0')->limit(8)->select();

	        foreach ($zhuangxius as $key => $value) {
	                $zhuangxius[$key]['pic'] = json_decode($zhuangxius[$key]['pic']);
	        }

			//返回数据
			echo json_encode($zhuangxius);

		}

		//工装服务
		public function twof(){


			$zhuangxiu = M('zhuangxiu');

			//设置条件
			$where .= 'gtype = "工装服务" and ';

			$stp = isset($_GET['stype']) ? $_GET['stype'] : '';
	        $gtp = isset($_GET['gtype']) ? $_GET['gtype'] : '';

	        if(isset($_GET['stype'])){
		         $where .= 'stype = "'.$_GET['stype'].'" and ';
		    }

	        $zhuangxius=$zhuangxiu->where($where.'isdelete=0')->limit(8)->select();

	        foreach ($zhuangxius as $key => $value) {
	                $zhuangxius[$key]['pic'] = json_decode($zhuangxius[$key]['pic']);
	        }

			//返回数据
			echo json_encode($zhuangxius);

		}


		//建材
		public function threef(){


			$zhuangxiu = M('zhuangxiu');

			//设置条件
			$where .= 'gtype = "建材" and ';

			$stp = isset($_GET['stype']) ? $_GET['stype'] : '';
	        $gtp = isset($_GET['gtype']) ? $_GET['gtype'] : '';

	        if(isset($_GET['stype'])){
		         $where .= 'stype = "'.$_GET['stype'].'" and ';
		    }

	        $zhuangxius=$zhuangxiu->where($where.'isdelete=0')->limit(8)->select();

	        foreach ($zhuangxius as $key => $value) {
	                $zhuangxius[$key]['pic'] = json_decode($zhuangxius[$key]['pic']);
	        }

			//返回数据
			echo json_encode($zhuangxius);

		}

		//家庭装修
		public function fourf(){


			$zhuangxiu = M('zhuangxiu');

			//设置条件
			$where .= 'gtype = "家具" and ';

			$stp = isset($_GET['stype']) ? $_GET['stype'] : '';
	        $gtp = isset($_GET['gtype']) ? $_GET['gtype'] : '';

	        if(isset($_GET['stype'])){
		         $where .= 'stype = "'.$_GET['stype'].'" and ';
		    }

	        $zhuangxius=$zhuangxiu->where($where.'isdelete=0')->limit(8)->select();

	        foreach ($zhuangxius as $key => $value) {
	                $zhuangxius[$key]['pic'] = json_decode($zhuangxius[$key]['pic']);
	        }

			//返回数据
			echo json_encode($zhuangxius);

		}


		//家纺家饰
		public function fivef(){


			$zhuangxiu = M('zhuangxiu');

			//设置条件
			$where .= 'gtype = "家纺家饰" and ';

			$stp = isset($_GET['stype']) ? $_GET['stype'] : '';
	        $gtp = isset($_GET['gtype']) ? $_GET['gtype'] : '';

	        if(isset($_GET['stype'])){
		         $where .= 'stype = "'.$_GET['stype'].'" and ';
		    }

	        $zhuangxius=$zhuangxiu->where($where.'isdelete=0')->limit(8)->select();

	        foreach ($zhuangxius as $key => $value) {
	                $zhuangxius[$key]['pic'] = json_decode($zhuangxius[$key]['pic']);
	        }

			//返回数据
			echo json_encode($zhuangxius);

		}

	}







 ?>