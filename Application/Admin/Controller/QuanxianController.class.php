<?php
namespace Admin\Controller;
use Think\Controller;
class QuanxianController extends CommonController {
	public function index(){
		$group_num = M('think_auth_group_access');
		$group_num = $group_num->select();

		$group = M('think_auth_group');
		$group = $group->select();

		$rule = M('think_auth_rule');
		$rule = $rule->select();
		
		$where = '';//声明字符串年变量
        $keyword = I('get.keyword');
        if(!empty($keyword)){
            $where['title'] = array('like','%'.$keyword.'%');
        }
        $user = M('user');


		$user=$user->where($where)->select();

		 foreach ($group_num as $key => $value) {
		 	foreach ($group as $k => $v) {
		 			if($group_num[$key]['group_id'] == $group[$k]['id']){
		 				$group_num[$key]['group'] = $group[$k]['title'];
		 				$group_num[$key]['quanxian'] = $group[$k]['rules'];
		 			}
		 		}
        	}

        	
    	foreach($group_num as $key=>$value){
    		$group_num[$key]['quanxian'] = explode(',',$group_num[$key]['quanxian']);
    		
			foreach($rule as $k => $v){
				foreach ($group_num[$key]['quanxian'] as $ke => $val) {
					if(in_array($rule[$k]['id'],$group_num[$key]['quanxian'])){
    					$group_num[$key]['quanxian'][$ke] = $rule[$ke]['title'];
    				}
				}	
			}

			$group_num[$key]['quanxian'] = implode(',',$group_num[$key]['quanxian']);
		
    	}
        // var_dump($rule);
		// var_dump($group_num);die;
		$this->assign('group_num',$group_num);//uid  group_id   group   quanxian
		$this->display();
	}



	public function add(){
		// 用户
		$user = M('user');
		$user = $user->select();
		// 规则
		
		// 管理组名
		$level = M('think_auth_group');
		$level = $level->select();
		// var_dump($level);die;

		$this->assign('level',$level);
		$this->assign('user',$user);
		

		$this->display();
	}



	public function insert(){

		$uid = I('post.uid');
		$group_id = I('post.group_id');

		// var_dump($_POST);die;
		$group_num = M('think_auth_group_access');
        //创建数据
        $group_num->create();
        if($group_num->add()){
        	// var_dump($marry->_sql());die;
            $this->success('添加成功',U('Admin/Quanxian/index'),3);
        }else{
            $this->error('添加失败',U('Admin/Quanxian/index'),3);
        }

	}



	public function ruleAdd(){
		$this->display();
	}

	public function ruleInsert(){
		// var_dump($_POST);
		$name = I('post.name');
		$title = I('post.title');

		$rule = M('think_auth_rule');
		//创建数据
        $rule->create();
        if($rule->add()){
        	// var_dump($marry->_sql());die;
            $this->success('添加成功',U('Admin/Quanxian/index'),3);
        }else{
            $this->error('添加失败',U('Admin/Quanxian/index'),3);
        }
	}


	public function adminAdd(){
		$rule = M('think_auth_rule');
		$rule = $rule->select();


		$this->assign('rule',$rule);
		$this->display();
	}

	public function adminInsert(){
		// var_dump($_POST);die;
		$title = I('post.title');
		$ruleList = I('post.quanxian');


		$rules = implode(',',$ruleList);

		// var_dump($rules);die;

		$rule = M('think_auth_group');
		//创建数据
        $rule->create();
        if($rule->add()){
        	// var_dump($marry->_sql());die;
            $this->success('添加成功',U('Admin/Quanxian/index'),3);
        }else{
            $this->error('添加失败',U('Admin/Quanxian/index'),3);
        }

	}




	
    //删除操作
    public function delete(){
        //获取id
        $uid = I('get.uid');

        // var_dump($uid);die;
        
        // $where = strip_tags($where);
        // var_dump($where);die;

        //创建对象
        $group_num = M('think_auth_group_access');
        //数组
        //执行更新
        $res = $group_num->where(' uid = '.$uid )->delete();
		
		if($res){
        	$this->ajaxReturn(1);
        }else{
        	$this->ajaxReturn(0);
        }

    }


	
}

?>