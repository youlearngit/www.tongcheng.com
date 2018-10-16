<?php 

	namespace Home\Controller;
	use Think\Controller;
	class GamesController extends Controller{

		public function login(){
			$this->display();
		}

		public function dologin(){
			//创建模型
			$user = M('gamesuser');
			//读取数据库
			$where['username'] = array('eq',I('post.username'));

			$where['password'] = array('eq',I('post.password'));
			//
			$info = $user->where($where)->find();
			//判断结果
			if(empty($info)){
				$this->error('用户名或者是密码错误', U('Home/Games/login'),3);
			}else{
				session('id',$info['id']);
				session('username',$info['username']);
				$this->success('登陆成功', U('Home/Games/index'),3);
			}
		}

		public function zhuce(){

			$this->display();
		}


		public function namecheck(){

			$where['username'] = array('eq',I('post.username'));

			$user = M('gamesuser');

			$res = $user->where($where)->select();

			if($res){//用户名存在
				echo 1;
			}else{
				echo 0;
			}
		}

		public function userinsert(){

			//实例化对象
			$user = M('gamesuser');

			//插入到游戏用户表
			$user->create();

			$res = $user->add();
			$id = $res;
			if($res){
				session('id',$id);
				session('username',$_POST['username']);
				$this->success('添加成功',U('Home/Games/index'),3);
			}else{

				$this->error('添加失败',U('Home/Games/zhuce'),3);
			}
		}


		public function index(){

			//获取id
			$id = session('id');

			//实例化对象
			$user = M('gamesuser');

			$info = $user->find($id);

			//分配变量
			$this->assign('info',$info);

			$this->display();

		}


		public function postlist(){
			$user = session('username');

			$post = M('post');

			$posts = $post->limit(10)->select();
			foreach($posts as $key=>$val){

				$posts[$key]['ftime'] = date('m-d',$posts[$key]['ftime']);
			}

			$this->assign('posts',$posts);
			$this->assign('username',$user);

			$this->display();
		}

		public function huitie(){

			//主贴显示
			//获取值
			$pid = $_GET['id'];
		
			$post = M('post');

			$postxq = $post->field('post.*,gamesuser.username')->join('left join gamesuser on gamesuser.id=post.uid')->where('post.id='.$pid)->find();
			// var_dump($postxq);die;
			$user = session('username');
			$postxq['ftime'] = date('Y-m-d H:i:s',$postxq['ftime']);

			//回帖显示
			$reply = M('reply');
	        $p = isset($_GET['p']) ? $_GET['p'] : 1;
	        $replyxq = $reply->page($p,3)->field('reply.*,gamesuser.username')->join('left join gamesuser on gamesuser.id=reply.uid')->where('reply.pid='.$pid)->select();
				foreach($replyxq as $key=>$val){

					$replyxq[$key]['htime'] = date('Y-m-d H:i:s',$replyxq[$key]['htime']);

					// $replyxq['id'][] = $replyxq[$key]['id'];
				}
	        $ss=($p-1)*3+1;

	        foreach($replyxq as $k=>$v){
	            $replyxq[$k]['jishu']= $ss;
	            $ss++;
	        }
	         // 获取总数
	        $count = $reply->count();
	        $page = new \Think\Page($count,3);
	        $pages = $page->show(); 
	        
	        
			
				// $replyxq['id'] = implode(',',$replyxq['id']);

				// var_dump($replyxq['id']);die;

				// $where['fid'] = array('in',$replyxq['id']);


			// //子帖显示
			// $zitie = M('zitie');
			// $zitiexq = $zitie->field('zitie.*,gamesuser.username')->where($where)->join('left join gamesuser on gamesuser.id=zitie.uid')->select();
			$this ->assign('pages',$pages);
			$this->assign('reply',$replyxq);
			$this->assign('post',$postxq);
			$this->assign('username',$user);

			$this->display();
		}

		public function fatie(){
			$user = session('username');

			$this->assign('username',$user);
			if(session('id')){

				$this->display();
			}else{
				$this->error('请先登录',U('Home/Games/login'),3);
			}

			
		}

		public function postinsert(){
			$id = session('id');

			if(!($id)){

				$this->error('请先登录',U('Home/Games/login'),3);
			}

			$_POST['uid'] = session('id');

			$_POST['ftime'] = time();

			//实例化对象
			$post = M('post');

			//插入到游戏用户表
			$post->create();

			$res = $post->add();
			if($res){
				$this->success('发表成功',U('Home/Games/liebiao'),3);
			}else{

				$this->error('发表失败',U('Home/Games/fatie'),3);
			}
		}

		public function replyinsert(){
			$id = session('id');

			if(!($id)){

				$this->error('请先登录',U('Home/Games/login'),3);
			}
			//接主贴id
			$_POST['pid'] = $_GET['id'];

			//实例化对象
			$reply = M('reply');

			$_POST['htime'] = time();

			$_POST['uid'] = session('id');

			$reply->create();

			//执行插入
			$res = $reply->add();

			if($res){
				$this->success('回复成功',U('Home/Games/huitie/id/'. $_GET['id']),3);
				
			}else{
				$this->error('请先登录',U('Home/Games/login'),3);
			
			}
		}

		public function zitieinsert(){

			$zitie = M('zitie');

			$_POST['htime'] = time();

			$_POST['uid'] = session('id');
			
			$_POST['fid'] = $_GET['fid'];

			$zitie->create();

			$res = $zitie->add();

			if($res){
				$this->success('回复成功',U('Home/Games/huitie/id/'. $_GET['pid']),3);
			}else{
				$this->success('回复失败',U('Home/Games/huitie'),3);
			}
		}



		//帖子列表页
		public function liebiao(){
			//声明每页显示的条数
			$num = 6;

			//声明where条件
			$where = '';
			$keyword = $_POST['keyword'];
			if(!empty($keyword)){

				$where['title'] = array('like','%'.$keyword.'%');

			}


			$post = M('post');

			//获取总条数
			$count = $post->where($where)->count();
			//创建分页对象
			$page = new \Think\Page($count, $num);
			//获取页码字符串
			$pages = $page->show();
			//获取limit参数
			$limit = $page->firstRow.','.$page->listRows;

			$user = session('username');
			
			$posts = $post->limit($limit)->where($where)->field('post.*,gamesuser.username')->join('left join gamesuser on gamesuser.id=post.uid')->select();

			foreach($posts as $key=>$val){

				$posts[$key]['ftime'] = date('m-d',$posts[$key]['ftime']);
			}

			$this->assign('posts',$posts);
			$this->assign('username',$user);
			$this->assign('pages',$pages);

			$this->display();
		}

	}