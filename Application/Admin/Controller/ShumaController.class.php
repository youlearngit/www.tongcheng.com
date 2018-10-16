<?php
namespace Admin\Controller;
use Think\Controller;
class ShumaController extends Controller {
    public function shumaleiadd(){
        $this->display();
    }

    public function insert(){
    	// var_dump($_POST);
    	//拼接path路径
    	$type = M('type');
    	//如果是顶级分类
    	if(I('post.pid')==0){
    		$_POST['path']=0;
    	}else{
    		//不是顶级分类
    		$parent = $type->find(I('post.pid'));
    		$_POST['path'] = (string)$parent['path'].','.(string)$parent['id'];
    	}
    	$type->create();
    	$res = $type->add();

    	if($res){
    		$this->success('添加成功',U('Admin/Shuma/add'),2);
    	}else{
    		$this->error('添加失败',U('Admin'),2);

    	}
    	

    }

    public function add(){
    	$type = M('type');
    	//读取分类信息
    	$types = $type->select();
    	foreach($types as $k=>$v){
    		$arr = count(explode(',',$v['path']));
    		$types[$k]['name']=str_repeat('|--',$arr).$v['name'];
    	}
    	//分配操作
    	$this->assign('types',$types);
    	//解析模板
    	$this->display();
    }

}