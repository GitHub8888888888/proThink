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



	namespace ithinkphp\controller;

	/**
	 * 自定义模块前台操作都要继承的基类
	 * Class CustomFrontendBase
	 * @package ithinkphp\controller
	 */
	class CustomFrontendBase  extends FrontendBaseController
	{
		use CustomBase;

	}