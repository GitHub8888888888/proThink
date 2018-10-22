<?php

	namespace builder\elements\form;

	use builder\lib\makeBase;

	class inlineCheckbox extends makeBase
	{
		public $path = __DIR__;


		/**
		 * 添加到head里的js路径
		 * @var array
		 */
		public $jsLib = [];


		public $css = [];

		public $jsScript = [];

		/**
		 * 自定义的js，引用此模板必须的js，多次引用只加载一次
		 * 必须用script标签加起来
		 * @var string
		 */
		public $customJs = /** @lang text */
			<<<'js'
			<script>  
			
			</script>  
js;

		/**
		 * 自定义的css，引用此模板必须的css，多次引用只加载一次
		 * 必须用style标签加起来
		 * @var string
		 */
		public $customCss = /** @lang text */
			<<<'Css'
			<style>  
			
			</style>  
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

		//* ----------------------------------------自定义方法区

		/**
		 * @param        $options
		 * @param        $name
		 * @param        $fieldName
		 * @param string $tips
		 * @param array  $selected
		 */
		function setOption($options , $name , $fieldName , $tips = '' , $selected = [])
		{
			$tmp = <<<str
			
			<label class="checkbox-inline i-checks">
				<input name="__NAME__" type="checkbox" value="__VALUE__"  __CHECKED__ >
				__FIELD__
			</label>
str;

			$str = '';

			foreach ($options as $k => $v)
			{
				$replacement['__CHECKED__'] = '';

				$replacement['__FIELD__'] = $v['field'];
				$replacement['__VALUE__'] = $v['value'];
				$replacement['__NAME__'] = $name;

				in_array($v['value'] , $selected) && ($replacement['__CHECKED__'] = 'checked');

				$str .= strtr($tmp , $replacement);
			}

			$this->replaceTag(static::makeNodeName('options') , $str);
			$this->replaceTag(static::makeNodeName('field_name') , $fieldName);
			$this->replaceTag(static::makeNodeName('tip') , $tips);
		}



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
				'left'  => '2' ,
				'right' => '8' ,

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
				<label class="col-sm-<!-- ~~~left~~~ --> control-label">
					<!-- ~~~field_name~~~ -->
				</label>
				<div class="col-sm-<!-- ~~~right~~~ -->">
					<!-- ~~~options~~~ -->
					<span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <!-- ~~~tip~~~ --> <span class="error-tip"></span></span>
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