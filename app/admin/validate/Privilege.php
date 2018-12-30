<?php

/*
+---------------------------------------------------------------------+
| iThinkphp     | [ WE CAN DO IT JUST THINK ]                         |
+---------------------------------------------------------------------+
| Official site | http://www.ithinkphp.org/                           |
+---------------------------------------------------------------------+
| Author        | hello wf585858@yeah.net                             |
+---------------------------------------------------------------------+
| Repository    | https://gitee.com/wf5858585858/iThinkphp            |
+---------------------------------------------------------------------+
| Licensed      | http://www.apache.org/licenses/LICENSE-2.0 )        |
+---------------------------------------------------------------------+
*/



	namespace app\admin\validate;

	class Privilege extends Base
	{
		// 验证规则
		protected $rule = [
			'pid'        => 'number' ,
			'name'       => 'require' ,
			'category'   => 'require' ,
			//'name'       => 'unique:resource_menu|require' ,
			'module'     => 'alpha|require' ,
			'controller' => 'alpha|require' ,
			'action'     => 'alpha|require' ,
			'order'      => 'number' ,
		];

		// 验证提示
		protected $message = [

			'name.number'      => '上级选择错误' ,
			'name.unique'      => '同样的记录已存在' ,
			'name.require'     => '权限名字必填' ,
			'category.require' => '应用ID必填' ,

			'module.require' => '权限名字必填' ,
			'module.alpha'   => '允许为英文字母' ,

			'controller.require' => '控制器名字必填' ,
			'controller.alpha'   => '允许为英文字母' ,

			'action.require' => '方法名字必填' ,
			'action.alpha'   => '允许为英文字母' ,

			'order.number' => '排序必须为数字' ,
		];

		// 应用场景
		protected $scene = [
			'add'  => [
				'category' ,
				'name' ,
				'module' ,
				'controller' ,
				'action' ,
				'order' ,
			] ,
			'edit' => [
				//'name' ,
				'module' ,
				'controller' ,
				'action' ,
				'order' ,
			] ,


		];

	}

























