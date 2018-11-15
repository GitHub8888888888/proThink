<?php

	namespace app\admin\controller;

	use file\FileTool;

	class Login extends FrontendBase
	{

		public function _initialize()
		{
			parent::_initialize();
		}

		/**
		 * 登陆页面
		 * @return mixed
		 * @throws \think\exception\HttpResponseException
		 */
		public function login()
		{
			$this->initLogic();
			if(isAdminLogin())
			{
				$this->redirect(SYS_LOGIN_INDEX);
			}
			else
			{
				return $this->fetch('login');
			}
		}

		/**
		 * 登陆api
		 * @return mixed
		 * @throws \Exception
		 */
		public function doLogin()
		{
			$this->initLogic();

			return $this->jump($this->logic->doLogin($this->param));
		}

		/**
		 * 退出登录
		 * @return mixed
		 * @throws \Exception
		 */
		public function logout()
		{
			$this->initLogic();

			return $this->jump($this->logic->logout($this->param));
		}

		/**
		 * 刷新session
		 * @return mixed
		 * @throws \Exception
		 */
		public function refresh()
		{
			$this->initLogic();

			return $this->jump($this->logic->refresh($this->param));
		}


		/**
		 * 环境检测
		 */
		public function evnCheck()
		{
			$isEvnOk = true;
			$data = [];

			$data[] = [
				'item'    => '操作系统' ,
				'require' => '(windows/类unix)' ,
				'value'   => PHP_OS ,
				'result'  => 1 ,
			];

			$data[] = [
				'item'    => 'PHP版本' ,
				'require' => '7.0及以上' ,
				'value'   => phpversion() ,
				'result'  => (int)version_compare(phpversion() , '7.0.0' , '>=') ,
			];

			$t = (function_exists('exec') && !ini_get('safe_mode') && @exec('echo EXEC') == 'EXEC');
			$data[] = [
				'item'    => 'exec 函数' ,
				'require' => '可执行' ,
				'value'   => $t ? '可执行' : '必须开启exec函数 <a target="_blank" href="https://zhidao.baidu.com/question/217070038.html">开启方法</a>' ,
				'result'  => $t ? 1 : ($isEvnOk = 0) ,
			];


			$t = function_exists('gd_info');
			$data[] = [
				'item'    => 'GD 库' ,
				'require' => '开启' ,
				'value'   => $t ? (function() {
					$t = gd_info();

					return empty($t['GD Version']) ? '未开启' : $t['GD Version'];
				})() : '未开启' ,
				'result'  => $t ? 1 : ($isEvnOk = 0) ,
			];

			$t = function_exists('session_start');
			$data[] = [
				'item'    => 'session' ,
				'require' => '开启' ,
				'value'   => $t ? '已开启' : '未开启' ,
				'result'  => $t ? 1 : ($isEvnOk = 0) ,
			];

			$t = class_exists('pdo');
			$data[] = [
				'item'    => 'PDO' ,
				'require' => '开启' ,
				'value'   => $t ? '已开启' : '未开启' ,
				'result'  => $t ? 1 : ($isEvnOk = 0) ,
			];

			$t = extension_loaded('pdo_mysql');
			$data[] = [
				'item'    => 'PDO_MySQL' ,
				'require' => '开启' ,
				'value'   => $t ? '已开启' : '未开启' ,
				'result'  => $t ? 1 : ($isEvnOk = 0) ,
			];

			$t = extension_loaded('curl');
			$data[] = [
				'item'    => 'CURL' ,
				'require' => '开启' ,
				'value'   => $t ? '已开启' : '未开启' ,
				'result'  => $t ? 1 : ($isEvnOk = 0) ,
			];

			$t = extension_loaded('mbstring');
			$data[] = [
				'item'    => 'MBstring' ,
				'require' => '开启' ,
				'value'   => $t ? '已开启' : '未开启' ,
				'result'  => $t ? 1 : ($isEvnOk = 0) ,
			];

			$t = extension_loaded('fileinfo');
			$data[] = [
				'item'    => 'fileinfo' ,
				'require' => '开启' ,
				'value'   => $t ? '已开启' : '未开启' ,
				'result'  => $t ? 1 : ($isEvnOk = 0) ,
			];

			$t = ini_get('file_uploads');
			$data[] = [
				'item'    => '文件上传限制' ,
				'require' => '8M以上' ,
				'value'   => ini_get('upload_max_filesize') ,
				'result'  => (function($t) {
					$res = false;
					($t == strtolower('on') || $t == 1) && ($res = true);

					return $res;
				})($t) ? 1 : ($isEvnOk = 0) ,
			];

			$t = (function() {
				return FileTool::recursiveChmod(APP_PATH, '0777');
			})();
			$info = FileTool::fileInfo(ROOT_PATH);
			$data[] = [
				'item'    => '根目录写权限' ,
				'require' => ROOT_PATH ,
				'value'   => $t['sign'] ? $info['mode'] : '请登陆SSH执行：chmod -R 777 ' . replaceToSysSeparator(ROOT_PATH) .'<br />某些上传代码至服务器的方式会因为代码所属用户及组与apache所属用户及组不一致导致apache没有写的权限，如使用git下载程序',
				'result'  => $t ? $info['mode'] : ($isEvnOk = 0) ,
			];

			$tmp = <<<AA
<tr>
	<td>__ITEM__</td>
	<td>__REQUIRE__</td>
	<td>__VALUE__</td>
	<td>
		<button class="btn btn-xs btn-__AAA__ " type="button">
			<i class="fa fa-__BBB__"></i>
		</button>
	</td>
</tr>
AA;

			$tmp = array_map(function($v) use ($tmp) {
				return strtr($tmp , [
					'__ITEM__'    => $v['item'] ,
					'__REQUIRE__' => $v['require'] ,
					'__VALUE__'   => $v['value'] ,
					'__AAA__'     => $v['result'] ? 'success' : 'danger' ,
					'__BBB__'     => $v['result'] ? 'check' : 'times' ,
				]);
			} , $data);

			if($isEvnOk)
			{
				$this->success(implode(' ' , $tmp) , null , $data);
			}
			else
			{
				$this->error($tmp , null , $data);
			}
		}

	}