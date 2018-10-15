<?php

	namespace app\common\common;

	trait set
	{
		//性别映射 性别;0:保密,1:男,2:女
		public static $sexMap = [
			[
				'value' => 0 ,
				'field' => '保密' ,
			] ,
			[
				'value' => 1 ,
				'field' => '男' ,
			] ,
			[
				'value' => 2 ,
				'field' => '女' ,
			] ,
		];

		//年份表
		public static $yearMap = [
			[
				'value' => 0 ,
				'field' => '请选择' ,
			] ,
			[
				'value' => '2018' ,
				'field' => '2018' ,
			] ,
			[
				'value' => '2019' ,
				'field' => '2019' ,
			] ,
			[
				'value' => '2020' ,
				'field' => '2020' ,
			] ,
			[
				'value' => '2021' ,
				'field' => '2021' ,
			] ,
		];

		//月份表
		public static $monthMap = [
			[
				'value' => 0 ,
				'field' => '请选择' ,
			] ,
			[
				'value' => '1' ,
				'field' => '1' ,
			] ,
			[
				'value' => '2' ,
				'field' => '2' ,
			] ,
			[
				'value' => '3' ,
				'field' => '3' ,
			] ,
			[
				'value' => '4' ,
				'field' => '4' ,
			] ,
			[
				'value' => '5' ,
				'field' => '5' ,
			] ,
			[
				'value' => '6' ,
				'field' => '6' ,
			] ,
			[
				'value' => '7' ,
				'field' => '7' ,
			] ,
			[
				'value' => '8' ,
				'field' => '8' ,
			] ,
			[
				'value' => '9' ,
				'field' => '9' ,
			] ,
			[
				'value' => '10' ,
				'field' => '10' ,
			] ,
			[
				'value' => '11' ,
				'field' => '11' ,
			] ,
			[
				'value' => '12' ,
				'field' => '12' ,
			] ,
		];

		//status状态映射  0:禁用, 1:正常, 2:已删除
		public static $statusMap = [
			[
				'value' => 0 ,
				'field' => '禁用' ,
			] ,
			[
				'value' => 1 ,
				'field' => '正常' ,
			] ,
			[
				'value' => 2 ,
				'field' => '已删除' ,
			] ,
		];

		/**
		 * $this->model__common_User
		 *
		 * @param string $name
		 *
		 * @return \think\Model
		 * @throws \Exception
		 */
		public function __get($name)
		{
			//  -- 属性命名不规范,示例: model__Admin_User, logic__User, logic__common_UserType ...
			$result = explode('__' , $name);

			if(!isset($result[0]) || !isset($result[1]))
			{
				$msg = '不正确的命名 : ' . $name;
				exception($msg);
			}

			$layerName = $result[0];
			$modelName = strtr($result[1] , ['_' => '/']);

			return model($modelName , $layerName);
		}

		public static function makeClassName($classNameWithNamespace , $layer)
		{
			$res = preg_split('#[\\\\/]#im' , $classNameWithNamespace , -1 , PREG_SPLIT_NO_EMPTY);
			$res[2] = $layer;
			$res[3] = ucwords($res[3]);
			$c = implode('\\' , $res);
			$t = class_exists($c) ? $layer . '__' . $res[1] . '_' . $res[3] : $layer . '__common_' . $res[3];

			return $t;
		}
	}