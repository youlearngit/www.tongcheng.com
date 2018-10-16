<?php
namespace Admin\Controller;
use Think\Controller;
class CarController extends Controller{

	//列表页
	public function index(){
		//声明条件变量
		$where = '';

    	//获取每页显示条数
    	$num = I('get.num');
    	if(!empty($num)){
    		$num = 5;
    	}

    	//获取搜索关键字
    	$keyword = I('get.keyword');
		if(!empty($keyword)){
			$where['title'] = array('like','%'.$keyword.'%');
		}

		//设置条件
		$where['car.isdelete'] = array('eq',0);
		//创建对象
		$car = M('car');
		//获取总条数
		$count = $car->where($where)->count();
		//创建分页对象
		$page = new \Think\Page($count, $num);
		//获取页码字符串
		$pages = $page->show();
		//获取limit参数
		$limit = $page->firstRow.','.$page->listRows;
		//读取数据
		$cars = $car->limit($limit)->where($where)->select();

		foreach ($cars as $key => $value) {
                $cars[$key]['pic'] = json_decode($cars[$key]['pic']);

        }
        // var_dump($cars);die;
       	
		// 分配变量
		$this->assign('cars',$cars);
		$this->assign('pages', $pages);
		$this->assign('num',$num);
		$this->assign('keyword',$keyword);
		$this->assign('count',$count);
		//解析模板
		$this->display();

    }

    //编辑页面
    public function edit(){

    	//获取id
        $id = I('get.id');
        //读取信息
        $car = M('car')->find($id);
        $car['pic']=json_decode($car['pic']);
        
        //分配变量
        $this->assign('car', $car);
       
        //解析模板
        $this->display();
    }

    //更新操作
    public function update()
    {   

    	// var_dump($_POST);die;

    	//获取主键id
		$id = I('post.id');

        //检测文件是否上传
        if($this->checkFileExist()){
            //执行上传
            $_POST['pic'] = $this->upload();
            //删除原来的图片

        }
        //创建模型
        $car = M('car');
        //创建数据
        $car->create();
        //执行更新操作
        if($car->save()){
            $this->success('更新成功',U('Admin/car/index'),3);
        }else{
            $this->error('更新失败',U('Admin/car/index'),3);
        }
    }

    //删除操作
    public function delete(){
		//获取id
		$id = I('get.id');
		//创建对象
		$car = M('car');
		//数组
		$arr = array('id'=>$id,'isdelete'=>1);
		//执行更新
		if($car->save($arr)){
			$this->success('删除成功', U('Admin/Car/index'),3);
		}else{
			$this->error('删除失败', U('Admin/Car/index'),3);
			// echo $car->_sql();die;
		}
	}

	//还原操作
    public function huanyuan(){
		//获取id
		$id = I('get.id');
		//创建对象
		$car = M('car');
		//数组
		$arr = array('id'=>$id,'isdelete'=>0);
		//执行更新
		if($car->save($arr)){
			$this->success('还原成功', U('Admin/Car/record'),3);
		}else{
			$this->error('还原失败', U('Admin/Car/record'),3);
			// echo $car->_sql();die;
		}
	}


	//已下架产品
	public function record(){
		//声明条件变量
		$where = '';

    	//获取每页显示条数
    	$num = I('get.num');
    	if(!empty($num)){
    		$num = 5;
    	}

    	//获取搜索关键字
    	$keyword = I('get.keyword');
		if(!empty($keyword)){
			$where['title'] = array('like','%'.$keyword.'%');
		}

		//设置条件
		$where['car.isdelete'] = array('eq',1);
		//创建对象
		$car = M('car');
		//获取总条数
		$count = $car->where($where)->count();
		//创建分页对象
		$page = new \Think\Page($count, $num);
		//获取页码字符串
		$pages = $page->show();
		//获取limit参数
		$limit = $page->firstRow.','.$page->listRows;
		//读取数据
		$cars = $car->limit($limit)->where($where)->select();

		foreach ($cars as $key => $value) {
                $cars[$key]['pic'] = json_decode($cars[$key]['pic']);

        }
        // var_dump($cars);die;
       	
		// 分配变量
		$this->assign('cars',$cars);
		$this->assign('pages', $pages);
		$this->assign('num',$num);
		$this->assign('keyword',$keyword);
		$this->assign('count',$count);
		//解析模板
		$this->display();

    }



	public function add(){
		$this->display();
	}

	//插入操作
	public function insert()
	{
		//检测文件是否上传
		if($this->checkFileExist()){
			//执行上传
			$_POST['pic'] = $this->upload();
		}
		
		$_POST['show_time'] = time();
		//创建模型
		$car = M('car');
		//创建数据
		$car->create();
		if($car->add()){
			$this->success('添加成功',U('Admin/car/index'),3);
		}else{
			$this->error('添加失败',U('Admin/car/index'),3);
		}
	}

	//检测是否有文件上传
	private function checkFileExist()
	{
		//检测第一张图片是否上传 如果ok的话 返回真
		if($_FILES['pic']['error'][0] == 0){
			return true;
		}else{
			return false;
		}
	}

	//封装方法 上传文件
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
			//获得图片的上传路径
			// $_POST['pic'] = ltrim($upload->rootPath.$info['pic']['savepath'].$info['pic']['savename'],'.');
			$arr = array();//['1.jpg','2.jpg','3.jpg'];
			// 1.jpg@@@2.jpg@@@3.jpg  implode
			// serialize
			// json_encode
			foreach ($info as $key => $value) {
				$arr[] = ltrim($value['savepath'].$value['savename'],'.');
			}
			
			return json_encode($arr);
		}
	}




}

?>