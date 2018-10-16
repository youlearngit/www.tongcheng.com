<?php 
	
	namespace Admin\Controller;
	use Think\Controller;
	class ZiyingController extends Controller{

		public function add(){

			$cate = M('ziying');

			//读取分类信息
			$cates = $cate->select();

			$this->assign('cates',$cates);
			
			$this->display();
		
		}

		public function insert(){

			$cate = M('ziying');

			//判断当前分类是不是顶级分类
			if($_POST['pid'] == 0){
				$_POST['path'] = 0;
			}else{
				$parent = $cate->find(I('post.pid'));
				//根据父级分类拼接path路径
				$_POST['path'] = $parent['path'].','.$parent['id'];
			}

			//执行添加
			$cate->create();
			if($cate->add()){
				$this->success('添加成功', U('Admin/ziying/index'), 3);
			}else{
				$this->error('添加失败', U('Admin/ziying/index'), 3);
			}

		}

		public function index(){

			//声明条件变量
			$where = '';

			$cate = M('ziying');

			$where['ziying.isdelete'] = array('eq',0);


			//读取分类信息
			$cates = $cate->where($where)->select();

			$this->assign('cates',$cates);

			//解析模板
			$this->display();
		
		}

		public function edit(){

			$id = $_GET['id'];

			$cate = M('Ziying');

			$cates = $cate->select();

			$info = $cate->find($id);

			//分配变量
			$this->assign('cate',$cates);
			$this->assign('info',$info);

			$this->display();
		
		}

		public function update(){
			//接收id
			$id = I('post.id');
			
			$cate = M('ziying');

			//获取path路径
			if($_POST['pid'] == 0){
				$_POST['path']=0;
			}else{
				$parent = $cate->find(I('post.pid'));
				$_POST['path'] = $parent['path'].','.$parent['id'];
			}

			//执行更新
			$cate->create();
			if($cate->save()){
				$this->success('添加成功', U('Admin/ziying/index'), 3);
			}else{
				$this->error('添加失败', U('Admin/ziying/index'), 3);

			}
		
		}

		public function delete(){

			//获取主键id
			$id = I('get.id');

			$cate = M('ziying');
			//数组
			$arr = array('id'=>$id,'isdelete'=>1);

			//查询
			$cates = $cate->find($id);
			$info = $cate->where('pid ='.$id .' and isdelete = 0')->select();

			if($info){
				$this->error('删除失败,请先删除此类下的子分类', U('Admin/ziying/index'), 3);
			}else{
				if($cate->save($arr)){
					$this->success('删除成功', U('Admin/ziying/index'), 3);
				}else{
					$this->error('删除失败', U('Admin/ziying/index'), 3);
				}
			}

		}

		//回收站
		public function record(){

			//声明条件变量
			$where = '';

			$cate = M('ziying');

			$where['ziying.isdelete'] = array('eq',1);


			//读取分类信息
			$cates = $cate->where($where)->select();

			$this->assign('cates',$cates);

			//解析模板
			$this->display();
		
		}

		//还原
		public function huanyuan(){

			//获取主键id
			$id = I('get.id');

			$cate = M('ziying');
			//数组
			$arr = array('id'=>$id,'isdelete'=>0);

			//查询
			$cates = $cate->find($id);
			$info = $cate->where('id ='.$cates['pid'].' and isdelete = 0')->select();

			if(!$info){
				$this->error('还原失败,此类的父类已经不存在,请重新创建', U('Admin/ziying/add'), 3);
			}else{
				if($cate->save($arr)){
					$this->success('还原成功', U('Admin/Ziying/record'), 3);
				}else{
					$this->error('还原失败', U('Admin/Ziying/record'), 3);
				}
			}

		}


		//彻底删除
		public function cddelete(){
			//获取主键id
			$id = I('get.id');

			$cate = M('ziying');
			
			if($cate->delete($id)){
				$this->success('彻底删除成功', U('Admin/ziying/record'), 3);
			}else{
				$this->error('彻底删除失败', U('Admin/ziying/record'), 3);
			}
			
		}


	}







 ?>