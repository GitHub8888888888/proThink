<?php

	namespace app\admin\controller;

	class Loginlog extends PermissionAuth
	{
		public function _initialize()
		{
			parent::_initialize();
		}


		public function dataList()
		{
			return $this->makeView($this);
		}

	}
