<?php 
	
	namespace Home\Controller;
	use Think\Controller;
	class JiajuController extends Controller{

		public function index(){

			$jiaju = M('jiaju');
			// 页面a链接传值
	        $price1 = $_GET['price1'];
	        $price2 = $_GET['price2'];
	        $price = isset($_GET['price1'])? 'price > '.$price1.' and price < '.$price2 : '';
	        
	        // echo $price;die;
	       
	        $link = M('link');
            $num = I('get.num');
            if(empty($num)) {
                $num =11;
            }
            $count = $jiaju->where($price)->count();
            //创建分页对象
            $page = new \Think\Page($count, $num);// 实例化分页类
            //获取页码字符串
            $pages = $page->show();
            //获取limit参数
            $limit = $page->firstRow.','.$page->listRows;
            //读取数据
            $jiaju=$jiaju->limit($limit)->where($price)->select();
            foreach ($jiaju as $key => $value) {
                $jiaju[$key]['pic'] = json_decode($jiaju[$key]['pic']);
                $jiaju[$key]['show_time'] = date('Y-m-d',$jiaju[$key]['show_time']);
                // var_dump($jiaju[$key]['pic']);
            }

	        $link = $link->limit(11)->select();
	        // var_dump($link);die;

	        foreach ($link as $key => $value) {
	                $link[$key]['pic'] = json_decode($link[$key]['pic']);

	                // var_dump($jiaju[$key]['pic']);
	        }

	    


            $this->assign('pages', $pages);
            $this->assign('num',$num);
	        $this->assign('link',$link);
	        $this->assign('jiaju',$jiaju);
			$this->display();
		}






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







      public function detail()
        {
        //获取id
        $id = I('get.id');
        
        //读取信息
        $info = M('jiaju')->find($id);
        $uid = $info['uid'];
        $use = M('user')->find($uid);
        $info['pic']=json_decode($info['pic']);
        $info['show_time'] = date('Y-m-d H',$info['show_time']);
        //分配变量

        // var_dump($use);die;
        // var_dump($info['pic']);die;
        $more = M('jiaju')->limit(6)->select();
        foreach ($more as $key => $value) {
            $more[$key]['pic'] = json_decode($more[$key]['pic']);
        }

        $this->assign('more',$more);
        $this->assign('user',$use);
        $this->assign('info', $info);
       
        //解析模板
        $this->display();
    }
}














 ?>