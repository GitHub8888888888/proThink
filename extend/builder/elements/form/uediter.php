<?php

/*
+---------------------------------------------------------------------+
| iThink        | [ WE CAN DO IT JUST THINK ]                         |
+---------------------------------------------------------------------+
| Official site | http://www.ithinkphp.org/                           |
+---------------------------------------------------------------------+
| Author        | hello wf585858@yeah.net                             |
+---------------------------------------------------------------------+
| Repository    | https://gitee.com/wf5858585858/iThink               |
+---------------------------------------------------------------------+
| Licensed      | http://www.apache.org/licenses/LICENSE-2.0 )        |
+---------------------------------------------------------------------+
*/



	namespace builder\elements\form;

	use builder\lib\makeBase;

	class uediter extends makeBase
	{
		public $path = __DIR__;

		/**
		 * 添加到head里的js路径
		 * @var array
		 */
		public $jsLib = [
			'__PLUGINS__uediter/ueditor.config.js' ,
			'__PLUGINS__uediter/ueditor.all.min.js' ,

		];

		public $css = [
			'__HPLUS__css/plugins/switchery/switchery.css' ,
		];

		public $jsScript = [
			"__PLUGINS__plugins/uediter/lang/zh-cn/zh-cn.js",
		];


		/**
		 * 自定义的js，引用此模板必须的js，多次引用只加载一次
		 * 必须用script标签加起来
		 * @var string
		 */
		public $customJs = /** @lang text */
			<<<'js'
			
			
			
<!--  ueditor -->
<!--   
		<script type="text/javascript" charset="utf-8" src="__PLUGINS__uediter/ueditor.config.js"></script>
		<script type="text/javascript" charset="utf-8" src="__PLUGINS__uediter/ueditor.all.min.js"></script>
-->

		<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
		<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
		<!--
		<script type="text/javascript" charset="utf-8" src="__PLUGINS__plugins/uediter/lang/zh-cn/zh-cn.js"></script>
		-->
		
		
		<script>
			$(document).ready(function () {var ue = UE.getEditor('editor');});
		</script>
<!--  /ueditor-->



js;

		/**
		 * 自定义的css，引用此模板必须的css，多次引用只加载一次
		 * 必须用style标签加起来
		 * @var string
		 */
		public $customCss = /** @lang text */
			<<<'Css'


Css;


		/**
		 * 自定义的js，会附加在jsScript里面，每个元素可以自定义
		 * 必须用script标签加起来
		 * $_this->addJs($js);
		 * @var string
		 */
		public $userJs = '';


		/**
		 * 自定义的js，会附加在head里面，每个元素可以自定义
		 * 必须用style标签加起来
		 * $_this->addCss($css);
		 * @var string
		 */
		public $userCss = '';

		/**
		 * ----------------------------------------自定义方法区
		 */



		/**
		 *--------------------------------------------------------------------------
		 */

		/**
		 * 构造方法里的的回调
		 */
		protected function _init()
		{
			/**
			 * ----------------------------------------设置表单里属性的默认值
			 */
			$this->setNodeValue([

				'field_name' => '' ,
				'name'       => '' ,
				'value'      => '' ,
				'left'       => '2' ,
				'right'      => '8' ,
			]);
			/**
			 *--------------------------------------------------------------------------
			 */
			parent::_init();

		}

		public function __construct()
		{
			/**
			 * ----------------------------------------自定义内容
			 */
			$contents = <<<'CONTENTS'

			<div class="form-group">
				<label class="col-sm-<!-- ~~~left~~~ --> control-label"><!-- ~~~field_name~~~ --></label>
				<div class="col-sm-<!-- ~~~right~~~ -->">
					<textarea id="editor" type="text/plain" style="width:100%;height:350px;" name="<!-- ~~~name~~~ -->"><!-- ~~~value~~~ --></textarea>
				</div>
			</div>

CONTENTS;
			/**
			 *--------------------------------------------------------------------------
			 */
			parent::__construct($contents);
			$this->_init();
		}
	}