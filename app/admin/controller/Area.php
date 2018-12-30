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



	namespace app\admin\controller;

	class Area extends FrontendBase
	{
		public function _initialize()
		{
			parent::_initialize();
			$this->initLogic();
		}

		//pid=1
		public function getAreaByPid()
		{
			$data = $this->logic->getAreaByPid($this->param);

			return json($data);
		}
	}
