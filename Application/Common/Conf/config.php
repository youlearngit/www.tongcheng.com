<?php
return array(
	//'配置项'=>'配置值'
	//数据库配置信息
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'erhuo1', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => '', // 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集
	'DB_DEBUG'  =>  TRUE, // 数据库调试模式 开启后可以记录SQL日志 3.2.3新增

	'SHOW_PAGE_TRACE' =>true,//开启调试窗口
	'URL_CASE_INSENSITIVE' => true,//自动转换URL路径的大小写
	'DEFAULT_FILTER' =>  '', //修改默认的标签解析模式

	//网站配置
	'title'=>'58同城',
);