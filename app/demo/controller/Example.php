<?php

	namespace app\demo\controller;

	use builder\elementsFactory;
	use builder\integrationTags;
	use builder\tagConstructor;

	/**
	 * ******************************************************************************************
	 * ******************************************************************************************
	 *                                此类为页面构造器的使用示例
	 *
	 * ******************************************************************************************
	 * ******************************************************************************************
	 * Class Example
	 * @package app\demo\controller
	 */
	class Example extends DemoBase
	{
		public function api()
		{
			$this->success();
		}

		public function exception()
		{
			exception('未授权的访问' , 403);
		}

		/**
		 * 典型的列表示例
		 * 自己写逻辑请参照admin模块下的写法
		 * @return mixed
		 * @throws \ReflectionException
		 */
		public function tab()
		{
			$this->setPageTitle('用户列表');

			$this->logic = $this->logic__admin_user;

			//$this->initLogic();

			/**
			 * 把要输出的内容以字符串的形式赋值给 displayContents即可
			 */
			$this->displayContents = integrationTags::basicFrame([

				integrationTags::row([
					integrationTags::rowBlock([

						//生成按钮
						//每个按钮3个属性，
						integrationTags::rowButton([
							[
								[
									'class' => 'btn-success  search-dom-btn-1' ,
									'field' => '筛选' ,
								] ,
								[
									'class' => 'btn-info  se-all' ,
									'field' => '全选' ,
								] ,
								[
									'class' => 'btn-info  se-rev' ,
									'field' => '反选' ,
								] ,
								[
									'class'      => 'btn-danger  btn-add' ,
									'field'      => '添加数据' ,
									'is_display' => 1 ,
								] ,
								[
									'class'      => 'btn-danger  multi-op multi-op-del' ,
									'field'      => '批量删除' ,
									'is_display' => 0 ,
								] ,
								[
									'class' => 'btn-primary  multi-op multi-op-toggle-status-enable' ,
									'field' => '批量启用' ,
								] ,
								[
									'class' => 'btn-primary  multi-op multi-op-toggle-status-disable' ,
									'field' => '批量禁用' ,
								] ,
							] ,
						]) ,

						//生成静态表格
						elementsFactory::staticTable()->make(function(&$doms , $_this) {

							//取出数据，这里测试数据我们使用用户表里的数据

							//$data = $this->logic->dataList($this->param);
							$data = $this->logic->dataListWithPagination($this->param);

							/**
							 * 设置表格头
							 */
							$_this->setHead([
								[
									'field' => 'ID' ,
									'attr'  => 'style="width:80px;"' ,
								] ,
								[
									'field' => '头像' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '账户' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '联系方式' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '时间' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '登陆次数' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '状态 (允许登陆)' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '操作' ,
									'attr'  => '' ,
								] ,
							]);

							/**
							 * 设置表分页按钮
							 */
							$_this->setPagination($data['pagination']);

							/**
							 * 设置js请求api
							 */
							$_this->setApi([
								'deleteUrl'      => url('delete') ,
								'setFieldUrl'    => url('setField') ,
								'detailUrl'      => url('detail') ,
								'editUrl'        => url('edit') ,
								'addUrl'         => url('add') ,
								'editPwdUrl'     => url('editPwd') ,
								'assignRolesUrl' => url('assignRoles') ,
							]);

							/**
							 * 设置表格搜索框
							 *searchFormCol
							 */
							$searchForm = elementsFactory::searchForm()->make(function(&$doms , $_this) {
								$_this->setIsDisplay(1);

								//用户账号
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormText([
										'field'       => '用户账号' ,
										'value'       => input('user' , '') ,
										'name'        => 'user' ,
										'placeholder' => '' ,
									]) ,
								] , ['col' => '6']);
								$doms = array_merge($doms , $t);

								//用户名
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormText([
										'field'       => '用户名' ,
										'value'       => input('nickname' , '') ,
										'name'        => 'nickname' ,
										'placeholder' => '' ,
									]) ,
								] , ['col' => '6']);
								$doms = array_merge($doms , $t);

								//注册时间
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormDate([
										'field' => '注册时间' ,

										'value1'       => input('reg_time_begin' , '') ,
										'name1'        => 'reg_time_begin' ,
										'placeholder1' => '' ,

										'value2'       => input('reg_time_end' , '') ,
										'name2'        => 'reg_time_end' ,
										'placeholder2' => '' ,
									]) ,
								] , ['col' => '6']);
								$doms = array_merge($doms , $t);

								//每页显示条数
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormText([
										'field'       => '每页显示条数' ,
										'value'       => (isset($this->param['pagerow']) && is_numeric($this->param['pagerow'])) ? $this->param['pagerow'] : DB_LIST_ROWS ,
										'name'        => 'pagerow' ,
										'placeholder' => '' ,
									]) ,
								] , ['col' => '6']);
								$doms = array_merge($doms , $t);


								$roles_ = $this->logic__admin_role->getFormatedData();
								$k = $roles_;
								array_unshift($k , [
									'value' => -1 ,
									'field' => '全部' ,
								]);

								//角色
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormSelect($k , 'role_id' , '用户角色' , input('role_id' , -1)) ,
								] , ['col' => '6']);
								$doms = array_merge($doms , $t);


								//排序字段
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormSelect([
										[
											'value' => 'id' ,
											'field' => '默认' ,
										] ,
										[
											'value' => 'last_login_time' ,
											'field' => '最后登录时间' ,
										] ,
									] , 'order_filed' , '排序字段' , input('order_filed' , 'id')) ,
								] , ['col' => '6']);
								$doms = array_merge($doms , $t);


								//排序方向
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormRadio([
										[
											'value' => 'asc' ,
											'field' => '正序' ,
										] ,
										[
											'value' => 'desc' ,
											'field' => '反序' ,
										] ,
									] , 'order' , '排序方向' , input('order' , 'asc')) ,

								] , ['col' => '6']);
								$doms = array_merge($doms , $t);


								//状态
								$k = static::$statusMap;
								array_pop($k);
								array_unshift($k , [
									'value' => -1 ,
									'field' => '全部' ,
								]);
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormRadio($k , 'status' , '状态' , input('status' , '-1')) ,

								] , ['col' => '6']);
								$doms = array_merge($doms , $t);

							});
							$_this->setSearchForm($searchForm);

							//遍历数据生成表格
							foreach ($data['data'] as $k => $v)
							{
								/**
								 * 构造tr
								 */
								$t = integrationTags::tr([

									//checkbox
									integrationTags::td([
										integrationTags::tdSimple([
											'value'      => $v['id'] ,
											'is_display' => (function() use ($v) {
												//是管理员id不显示id
												if(isGlobalManagerId($v['id'])) return false;

												return 1;
											})() ,
										]) ,
										integrationTags::tdCheckbox((function() use ($v) {
											//管理员id 和 自己的
											if(isGlobalManagerId($v['id'])) return false;
											if($v['id'] == getAdminSessionInfo('user' , 'id')) return false;

											return true;
										})()) ,
									]) ,

									//头像
									//data-href="/admin/User/editProfilePic" data-text="修改头像"
									integrationTags::td([
										integrationTags::tdSimple([
											'value' => elementsFactory::singleLabel(integrationTags::singleLabel('img' , [
												'src'             => generateProfilePicPath($v['profile_pic'] , 1) ,
												'style'           => 'height: 65px;' ,
												'class'           => 'preview-img index_pop' ,
												'data-origin-src' => generateProfilePicPath($v['profile_pic'] , 0) ,
												'data-condition'  => formatMenu(CONTROLLER_NAME , 'profile_pic' , $v['id']) ,
												'data-text'       => '修改图片' ,
											])) ,
										]) ,
									]) ,

									//用户名
									integrationTags::td([
										integrationTags::tdSimple([
											'name'     => '姓名 : ' ,
											'value'    => $v['nickname'] ,
											'field'    => 'nickname' ,
											//'reg'      => '/^\S+$/' ,
											//'msg'      => '请填写合法手机号码' ,
											'editable' => (function() use ($v) {
												//是管理员的话所有人名字都可以改
												if(isGlobalManager()) return true;

												//除管理员的只能自己，其他人都可以改
												return !isGlobalManagerId($v['id']);
											})() ,
										]) ,
										'<br/>' ,
										integrationTags::tdSimple([
											'name'       => '用户名 : ' ,
											'value'      => $v['user'] ,
											'is_display' => (function() use ($v) {
												//是管理员的话所有人名字都可以改
												if(isGlobalManager()) return true;

												//除管理员的只能自己，其他人都可以改
												return !isGlobalManagerId($v['id']);
											})() ,
										]) ,
										'<br/>' ,

										integrationTags::tdSimple([
											'name'     => '角色 : ' ,
											'value'    => $v['role'] ,
											'editable' => 0 ,
										]) ,
									]) ,

									//联系方式
									integrationTags::td([
										integrationTags::tdSimple([
											'name'     => 'email : ' ,
											'value'    => $v['email'] ,
											'field'    => 'email' ,
											'reg'      => '/^[A-Za-z0-9\u4e00-\u9fa5]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/' ,
											'msg'      => '请填写合法email' ,
											'editable' => (function() use ($v) {
												//是管理员的话所有人名字都可以改
												if(isGlobalManager()) return true;

												//除管理员的只能自己，其他人都可以改
												return !isGlobalManagerId($v['id']);
											})() ,
										]) ,
										'<br>' ,
										integrationTags::tdSimple([
											'name'     => '电话 : ' ,
											'value'    => $v['phone'] ,
											'field'    => 'phone' ,
											'reg'      => '/^1\d{10}$/' ,
											'msg'      => '请填写合法手机号码' ,
											'editable' => (function() use ($v) {
												//是管理员的话所有人名字都可以改
												if(isGlobalManager()) return true;

												//除管理员的只能自己，其他人都可以改
												return !isGlobalManagerId($v['id']);
											})() ,

										]) ,
										'<br/>' ,
										integrationTags::tdSelect([
											'is_display' => 1 ,
											'name'       => 'gender' ,
											'field_name' => '性别 :' ,
											'selected'   => $v['gender'] ,
											'options'    => $this->logic::$sexMap ,
											'disabled'   => (function() use ($v) {
												//是管理员的话所有人名字都可以改
												if(isGlobalManager()) return '';

												//除管理员的只能自己，其他人都可以改
												return !isGlobalManagerId($v['id']) ? '' : 'disabled';
											})() ,
										]) ,

									]) ,

									//时间
									integrationTags::td([
										integrationTags::tdSimple([
											'name'     => '注册时间' ,
											'editable' => '0' ,
											'value'    => formatTime($v['time']) ,
										]) ,
										'<br>' ,
										integrationTags::tdSimple([
											'name'     => '登陆时间' ,
											'editable' => '0' ,
											'value'    => formatTime($v['last_login_time']) ,
										]) ,
										'<br>' ,
										integrationTags::tdSimple([
											'name'     => '注册IP' ,
											'editable' => '0' ,
											'value'    => $v['reg_ip'] ,
										]) ,
										'<br>' ,
										integrationTags::tdSimple([
											'name'     => '登陆IP' ,
											'editable' => '0' ,
											'value'    => $v['last_login_ip'] ,
										]) ,
									]) ,


									//登陆次数
									integrationTags::td([
										integrationTags::tdSimple([
											//'name'     => '登陆次数' ,
											'editable' => '0' ,
											'value'    => $v['login_count'] ,
										]) ,
									]) ,

									//用户状态
									integrationTags::td([
										integrationTags::tdSwitcher([
											'params'  => [
												'checked'         => $v['status'] ? 'checked' : '' ,
												'disabled'        => '' ,
												'name'            => 'status' ,
												'change_callback' => 'switcherUpdateField' ,
												//switcherUpdateFieldConfirm
												//switcherUpdateField
												'is_display'      => (function() use ($v) {
													//管理员id 和 自己的
													if(isGlobalManagerId($v['id'])) return false;
													if($v['id'] == getAdminSessionInfo('user' , 'id')) return false;

													return true;
												})() ,
											] ,
											'name'    => '无需确认' ,
											'is_auto' => '1' ,

										]) ,
										'<br>' ,
										integrationTags::tdSwitcher([
											'params'  => [
												'checked'          => $v['status'] ? 'checked' : '' ,
												'name'             => 'status' ,
												'change_callback'  => 'switcherUpdateFieldConfirm' ,
												'success_callback' => 'refresh_page' ,
												'disabled'         => '' ,
												'is_display'       => (function() use ($v) {
													//管理员id 和 自己的
													if(isGlobalManagerId($v['id'])) return false;
													if($v['id'] == getAdminSessionInfo('user' , 'id')) return false;

													return true;
												})() ,
											] ,
											'name'    => '需要确认' ,
											'is_auto' => '0' ,
										]) ,
									]) ,

									//操作
									integrationTags::td([
										/*
										integrationTags::tdButton([
											'attr'  => ' btn-success btn-edit' ,
											'value' => '编辑' ,
										]) ,
										*/

										integrationTags::tdButton([
											'attr'       => ' btn-info btn-modify-pwd' ,
											'value'      => '修改密码' ,
											'is_display' => (function() use ($v) {
												//是管理员的话所有人名字都可以改
												if(isGlobalManager()) return true;

												//除管理员的只能自己，其他人都可以改
												return !isGlobalManagerId($v['id']);
											})() ,
										]) ,
										integrationTags::tdButton([
											'attr'       => ' btn-info btn-assign-role' ,
											'value'      => '用户授权' ,
											'is_display' => (function() use ($v) {
												//管理员id 和 自己的
												if(isGlobalManagerId($v['id'])) return false;

												return true;
											})() ,
										]) ,

										'<br>' ,

										integrationTags::tdButton([
											'attr'       => ' btn-danger btn-delete' ,
											'value'      => '删除' ,
											'is_display' => (function() use ($v) {
												//管理员id 和 自己的
												if(isGlobalManagerId($v['id'])) return false;
												if($v['id'] == getAdminSessionInfo('user' , 'id')) return false;

												return true;
											})() ,
										]) ,


									]) ,

								] , ['id' => $v['id']]);

								$doms = array_merge($doms , $t);
							}

						}) ,
					] , [
						'main_title' => '用户列表' ,
						'sub_title'  => '' ,
					]) ,
				]) ,
			]);


			/**
			 * 输出内容
			 * 使用此方法为调用我们自己开发的模板构造引擎生成页面
			 * 调用fetch方法为tp自带的模板引擎，此项目统一都使用我们自己的模板构造引擎，没有使用tp自带的模板引擎
			 */
			return $this->showPage();
		}


		/**
		 * 典型的表单使用示例
		 * 自己写逻辑请参照admin模块下的写法
		* @return mixed
		 * @throws \ReflectionException
		 */
		public function form()
		{
			$this->makePage()->setNodeValue(['BODY_ATTR' => tagConstructor::buildKV(['class' => ' gray-bg' ,]) ,]);

			//设置标题
			$this->setPageTitle('form测试');

			$this->displayContents = integrationTags::basicFrame([
				integrationTags::row([
					integrationTags::rowBlock([


						integrationTags::form([

							integrationTags::staticText([
								'field_name' => 'staticText' ,
								'value'      => 'value' ,
							]) ,

							integrationTags::text([
								//随便写
								'field_name'  => 'text' ,
								'placeholder' => 'placeholderplaceholder' ,
								'tip'         => 'text' ,
								'value'       => 'value' ,
								//'attr'        => 'disabled' ,
								'name'        => 'text' ,
							]) ,


							integrationTags::password([
								//随便写
								'field_name'  => 'text' ,
								'placeholder' => 'placeholderplaceholder' ,
								'tip'         => 'text' ,
								'value'       => 'value' ,
								//'attr'        => 'disabled' ,
								'name'        => 'text' ,
							] , 1) ,

							integrationTags::inlineCheckbox([
								[
									'value' => '1' ,
									'field' => '年1111' ,
								] ,
								[
									'value' => '2' ,
									'field' => '月2222' ,
								] ,
								[
									'value' => '3' ,
									'field' => '日3333' ,
								] ,
							] , 'namebbbb22233' , 'inlineCheckbox' , '提示信息4411' , [
								1 ,
								3 ,
							]) ,


							integrationTags::inlineRadio([
								[
									'value' => '1' ,
									'field' => '年1111' ,
								] ,
								[
									'value' => '2' ,
									'field' => '月2222' ,
								] ,
								[
									'value' => '3' ,
									'field' => '日3333' ,
								] ,
							] , 'dd2222' , 'inlineRadio' , '提示信息4411' , 2) ,


							integrationTags::blockCheckbox([
								[
									'value' => '1' ,
									'field' => '年1111' ,
								] ,
								[
									'value' => '2' ,
									'field' => '月2222' ,
								] ,
								[
									'value' => '3' ,
									'field' => '日3333' ,
								] ,
							] , 'namebbbb2221' , 'blockCheckbox' , '提示信息4411' , [
								1 ,
								3 ,
							]) ,


							integrationTags::blockRadio([
								[
									'value' => '1' ,
									'field' => '年1111' ,
								] ,
								[
									'value' => '2' ,
									'field' => '月2222' ,
								] ,
								[
									'value' => '3' ,
									'field' => '日3333' ,
								] ,
							] , 'namebbbb2222' , 'blockRadio' , '提示信息4411' , 2) ,

							integrationTags::singleSelect([
								[
									'value' => '1' ,
									'field' => '年1111' ,
								] ,
								[
									'value' => '2' ,
									'field' => '月2222' ,
								] ,
								[
									'value' => '3' ,
									'field' => '日3333' ,
								] ,
							] , 'namebbbb2222' , 'singleSelect111' , '提示信息4411' , 2) ,


							integrationTags::switchery([
								//额外属性
								//'attr'       => '' ,
								//随便写
								'isChecked'  => 'checked' ,
								//随便写
								'tip'        => '提示信息11' ,
								//随便写
								'field_name' => '用户名' ,
								//表单name值
								'name'       => 'switchery' ,
								//表单value值,$data里的字段
								'value'      => '1222' ,
								//表单value对应名字,$data里的字段
								'field'      => 'name' ,
							]) ,

							integrationTags::singleDate([
								'field_name'  => '日期' ,
								'name'        => 'singleDate' ,
								'value'       => '' ,
								'is_time'     => '1' ,
								'placeholder' => '点击选时间' ,
							]) ,

							integrationTags::betweenDate([
								'field_name' => '日期期间' ,
								//'min'        => 'laydate.now()' ,
								'is_time'    => 'true' ,
								//'format'     => 'YYYY-MM-DD hh:mm:ss' ,

								'start_name' => 'start_name' ,
								'end_name'   => 'end_name' ,

								'start_value' => '' ,
								'end_value'   => '' ,

								//'format'      => 'YYYY-MM-DD ' ,
							]) ,

							integrationTags::textarea([
								'field_name' => 'textarea' ,
								'name'       => 'textarea' ,
								'value'      => '11' ,
								'attr'       => '' ,
								'style'      => 'width:100%;height:200px;' ,
							]) ,

							integrationTags::uediter([
								'field_name' => '内容' ,
								'name'       => 'uediter' ,
								'value'      => 'sdfsdfsdfsdf' ,
							]) ,


						] , [
							'id'     => 'form122222' ,
							'method' => 'post' ,
							'action' => '/home/index/index' ,
						]) ,


					]) ,
				]) ,
			]);

			return $this->showPage();
		}


		/**
		 * 典型导出execl
		 * @return string
		 * @throws \PhpOffice\PhpSpreadsheet\Exception
		 * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
		 */
		public function exportExcel()
		{
			$path = 'C:\Users\Administrator\Desktop\\';
			$list = $this->logic__admin_Resourcemenu->dataList();

			$titles = [
				'id' ,
				'name' ,
				'pid' ,
				'module' ,
				'controller' ,
				'action' ,
				'ico' ,
				'order' ,
				'is_menu' ,
				'is_common' ,
				'remark' ,
				'status' ,
				'time' ,
			];

			array_unshift($list , $titles);

			$fileName = $path . '测试.xlsx';

			/**
			 * 如果设置了这个回答，则只有添加在data上的数据会被导出
			 *
			 * @param $v
			 * @param $data
			 */
			$func = function($v , &$data) {
				//$v['is_menu'] && ($data[] =  $v);
				($data[] = $v);
			};
			exportExcel($list , $fileName , $func , false);

			return 'done';
		}

		/**
		 * 典型读取execl
		 * @throws \PhpOffice\PhpSpreadsheet\Exception
		 * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
		 */
		public function importExcel()
		{
			$path = 'C:\Users\Administrator\Desktop\\';
			$fileName = $path . '测试.xlsx';

			$data = importExcel($fileName);
			print_r($data);
			exit;;
		}


		/**
		 * 生二维码
		 */
		public function generateQrcode()
		{
			$path = 'C:\Users\Administrator\Desktop\\';
			$fileName = $path . '3.png';

			//generateQrcode('http://www.hao123.com' , false , 3 , 10);
			generateQrcode('http://www.hao123.com' , $fileName , 3 , 10);
		}


		/**
		 * 发邮件
		 * 发之前在菜单的配置里，把邮箱组里的数据填好
		 */
		public function sendEmail()
		{
			//参考
			//https://blog.csdn.net/Edu_enth/article/details/53114818
			//https://swiftmailer.symfony.com/docs/messages.html
			//https://www.helloweba.net/php/457.html

			$title = 'just title';
			$body = '163邮件是支持普通连接和SSL连接两种方式的，这里我们推荐使用 ssl 连接方式。';
			$to = [
				'845875470@qq.com' => 'by hello' ,
				'5496150@qq.com'   => 'by 5496150' ,
			];
			$res = sendEmail($title , $body , $to , $err);
			print_r($res);
			print_r($err);
			exit;;
		}


		/**
		 * 下载器
		 */
		public function download()
		{
			$file = 'C:\Users\Administrator\Desktop\t.php';
			$saveName = 'dd.php';

			//$downloader = new downloader($file, $saveName);
			//$downloader->send();

			downloadFile($file , $saveName );
		}


		/**
		 * 上传文件测试用的api
		 *
		 * @return \think\response\Json
		 * @throws \LogicException
		 * @throws \RuntimeException
		 * @throws \think\image\Exception
		 */
		public function upload()
		{
			if(isset($_FILES['image']))
			{
				$res = uploadImg('image' , function($result) {
					$result['url'] = URL_PICTURE . DS . $result['savename'];

					//文件上传成功的回调，可以在这里添加写数据库的逻辑

					return $result;
				} , [
					200 ,
					200 ,
					1 ,
				]);
			}
			elseif(isset($_FILES['file']))
			{
				$res = uploadFile('file' , function($result) {
					//文件上传成功的回调，可以在这里添加写数据库的逻辑
					return $result;
				});
			}

			return json($res);
		}
		
		

		public function uploadImg1()
		{

			//设置标题
			$this->setPageTitle('上传测试');
			$this->makePage()->setNodeValue(['BODY_ATTR' => tagConstructor::buildKV(['class' => ' gray-bg' ,]) ,]);

			$this->displayContents = integrationTags::basicFrame([
				integrationTags::row([
					integrationTags::rowBlock([
						/*
													integrationTags::rowButton([
														[
															[
																'class' => 'btn-info ' ,
																'field' => '重新上传' ,
																'attr' => 'onclick="location.reload()"' ,
															] ,
														],
													]),
						*/


						integrationTags::upload(SINGLE_IMG , [
							[
								'title' => '上传须知' ,
								'items' => [
									'支持jpg，png，gif格式' ,
									'图片大小不超过2M' ,
								] ,
							] ,
						] , [

							'uploadSuccess' => <<<AAA
function (file, response) {
	if (response.code == 1)
	{
	
		$(".uploader-preview").find('img').attr({
			'src':response.data.thumb_url,
		});
		
		$(".profile_pic_preview").attr({
			'src':response.data.url,
		});
		
		$(".status-box-text").text('更新成功');
		
		setTimeout(function(){
		//	layer.close()
		}, 400);
	}
	else
	{
		//服务器处理出错
	}
}
AAA
							,
						] , [
							'server' => "'".url()."'" ,
							'accept' =>json_encode( [
								'extensions' => 'jpg,jpeg,png,gif',
								'mimeTypes' => 'image/*',
							]) ,
						]) ,

					], [
						'width'      => '6' ,
						'main_title' => '' ,
						'sub_title'  => '' ,
					]) ,

					integrationTags::rowBlock((function()  {
						return [
							elementsFactory::doubleLabel('div' , function(&$doms) {

								$doms[] = elementsFactory::singleLabel(function(&$doms) {

									$param = session(SESSION_TAG_ADMIN.'updateImage_condition');
									$info = $this->logic->getInfo(['id' => $param['id']]);
									$imageUrl = generateProfilePicPath($info[$param['field']], 0);

									$doms = integrationTags::singleLabel('img' , [
										'src'   => $imageUrl ,
										'class' => 'profile_pic_preview' ,
									]);

								});

							} , [
								'class' => 'test-div' ,
								'id'    => 'div1' ,
							]),
						];


					})(), [
						'width'      => '6' ,
						'main_title' => '' ,
						'sub_title'  => '' ,
					]) ,
				]) ,
			],[
				'animate_type' => 'fadeInRight' ,
				'attr'         => '' ,
			]);


		}


/*
 *
	 * ******************************************************************************************
	 * ******************************************************************************************
	 *                                下面部分仅供参考不建议使用
	 *
	 * ******************************************************************************************
	 * ******************************************************************************************
 *
 *
 * */


		/**
		 * 表格原生写法，仅供参考，不建议使用
		 * @return mixed
		 * @throws \ReflectionException
		 */
		public function tab1()
		{
			$this->setPageTitle('table测试');
			$this->displayContents = elementsFactory::build('basicFrame')->make(function(&$doms , $_this) {
				$_this->setNodeValue([
					'animate_type' => 'fadeInRight' ,
				]);

				$doms[] = elementsFactory::row()->make(function(&$doms , $_this) {
					$_this->setNodeValue([//'data-id' => '1' ,
					]);

					$doms[] = elementsFactory::rowBlock()->make(function(&$doms , $_this) {
						//$_this->isEnableClosed(1);
						$_this->setNodeValue([
							'width'      => '12' ,
							'main_title' => '大标题' ,
							'sub_title'  => '小标题' ,
						]);
						/*
						 *
						 *
						 *
						 *
						 *		start of table
						 *
						 *
						 *
						 *
						 * */

						$data = [
							[
								'id'      => '1' ,
								'project' => 'hello"' ,
							] ,
						];

						$doms[] = elementsFactory::staticTable()->make(function(&$doms , $_this) {

							/**
							 * 设置表格头
							 */
							$_this->setHead([
								[
									'field' => '' ,
									'attr'  => 'style="width:20px;"' ,
								] ,
								[
									'field' => '项目' ,
									'attr'  => 'class="red"' ,
								] ,
								[
									'field' => '进度' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '任务' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '日期' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '操作' ,
									'attr'  => '' ,
								] ,
							]);


							/**
							 * 设置表分页按钮
							 */
							$_this->setPagination('<ul class="pagination"> <li class="disabled"> <span>«</span> </li> <li class="active"> <span>122</span> </li> <li> <a href="#">2</a> </li> <li> <a href="#">»</a> </li> </ul>');

							/**
							 * 设置js请求api
							 */
							$_this->setApi([
								'deleteUrl'   => url('delete') ,
								'setFieldUrl' => url('setField') ,
								'detailUrl'   => url('detail') ,
								'editUrl'     => url('edit') ,
							]);


							/**
							 * 设置表格搜索框
							 *searchFormCol
							 */
							$searchForm = elementsFactory::searchForm()->make(function(&$doms , $_this) {

								$doms[] = elementsFactory::searchFormCol()->make(function(&$doms , $_this) {
									$_this->setNodeValue(['col' => '12']);

									$doms[] = elementsFactory::searchFormSelect()->make(function(&$doms , $_this) {

										$_this->setOption([
											[
												'value' => '1' ,
												'field' => '年' ,
											] ,
											[
												'value' => '2' ,
												'field' => '月' ,
											] ,
											[
												'value' => '3' ,
												'field' => '日' ,
											] ,
										] , 'nameaaa11' , '上传时间' , 2);
									});
								});

								$doms[] = elementsFactory::searchFormCol()->make(function(&$doms , $_this) {
									$_this->setNodeValue(['col' => '6']);

									$doms[] = elementsFactory::searchFormRadio()->make(function(&$doms , $_this) {

										$_this->setOption([
											[
												'value' => '1' ,
												'field' => '年' ,
											] ,
											[
												'value' => '2' ,
												'field' => '月' ,
											] ,
											[
												'value' => '3' ,
												'field' => '日' ,
											] ,
										] , 'nameaaa' , 'searchFormRadio' , 3);
									});
								});

								$doms[] = elementsFactory::searchFormCol()->make(function(&$doms , $_this) {
									$_this->setNodeValue(['col' => '6']);

									$doms[] = elementsFactory::searchFormCheckbox()->make(function(&$doms , $_this) {

										$_this->setOption([
											[
												'value' => '1' ,
												'field' => '年' ,
											] ,
											[
												'value' => '2' ,
												'field' => '月' ,
											] ,
											[
												'value' => '3' ,
												'field' => '日' ,
											] ,
										] , 'namebbbb' , 'searchFormCheckbox' , [
											1 ,
											2 ,
										]);

									});
								});

								$doms[] = elementsFactory::searchFormCol()->make(function(&$doms , $_this) {
									$_this->setNodeValue(['col' => '6']);

									$doms[] = elementsFactory::searchFormText()->make(function(&$doms , $_this) {
										$_this->setNodeValue([
											'field'       => '名字' ,
											'value'       => 'gaag' ,
											'name'        => 'name11' ,
											'placeholder' => '随便写' ,
										]);

									});
								});

								$doms[] = elementsFactory::searchFormCol()->make(function(&$doms , $_this) {
									$_this->setNodeValue(['col' => '6']);

									$doms[] = elementsFactory::searchFormText()->make(function(&$doms , $_this) {
										$_this->setNodeValue([
											'field'       => '名字' ,
											'value'       => 'gaag' ,
											'name'        => 'name11' ,
											'placeholder' => '随便写' ,
										]);

									});
								});

								$doms[] = elementsFactory::searchFormCol()->make(function(&$doms , $_this) {
									$_this->setNodeValue(['col' => '12']);

									$doms[] = elementsFactory::searchFormRange()->make(function(&$doms , $_this) {
										$_this->setNodeValue([
											'field' => '名字' ,

											'value1'       => '名字' ,
											'name1'        => 'name1' ,
											'placeholder1' => 'placeholder1' ,

											'value2'       => 'value2' ,
											'name2'        => 'name2' ,
											'placeholder2' => 'placeholder2' ,
										]);
									});
								});


								$doms[] = elementsFactory::searchFormCol()->make(function(&$doms , $_this) {
									$_this->setNodeValue(['col' => '12']);

									$doms[] = elementsFactory::searchFormDate()->make(function(&$doms , $_this) {
										$_this->setNodeValue([
											'field' => '名字' ,

											'value1'       => '' ,
											'name1'        => 'name111' ,
											'placeholder1' => 'placeholder1' ,

											'value2'       => '' ,
											'name2'        => 'name222' ,
											'placeholder2' => 'placeholder2' ,

										]);
									});
								});

							});

							$_this->setSearchForm($searchForm);


							/**
							 * 设置行
							 */
							$doms[] = elementsFactory::tr()->make(function(&$doms , $_this) {
								$_this->setNodeValue([
									//'id'   => '{$vo1["id"]}' ,
									'id' => '1' ,
									//'attr' => 'data-pid="33"' ,
								]);

								//表格选择复选框
								$doms = array_merge($doms , integrationTags::td([
									integrationTags::tdCheckbox() ,
								]));

								//生成文本
								$doms = array_merge($doms , integrationTags::td([
									integrationTags::tdSimple([
										'name'     => 'name222:' ,
										'editable' => '1' ,
										'value'    => '234' ,
										'field'    => 'name' ,
										'reg'      => '/^\d{1,4}$/' ,
										'msg'      => '请填写合法手机号码' ,
									]) ,
								]));

								//生成文本3
								$doms = array_merge($doms , integrationTags::td([
									integrationTags::tdSelect([
										'name'     => 'time111:' ,
										'selected' => 1 ,
										'options'  => [

											[
												'value' => '1' ,
												'field' => '年' ,
											] ,
											[
												'checked' => '1' ,
												'value'   => '2' ,
												'field'   => '月' ,
											] ,
											[
												'value' => '3' ,
												'field' => '日' ,
											] ,
										] ,
									]) ,
								]));


								//生成select
								$doms = array_merge($doms , integrationTags::td([
									integrationTags::tdSimple([
										'name'     => 'time22:' ,
										'editable' => '0' ,
										'value'    => date('Y-m-d H:i:s' , time()) ,
									]) ,
								]));


								//生成按钮
								$doms = array_merge($doms , integrationTags::td([
									integrationTags::tdButton([
										'attr'  => ' btn-success btn-edit' ,
										'value' => '编辑' ,
									]) ,
									integrationTags::tdButton([
										'attr'  => ' btn-info btn-detail' ,
										'value' => '详细' ,
									]) ,
									integrationTags::tdButton([
										'attr'  => ' btn-danger btn-delete' ,
										'value' => '删除' ,
									]) ,
								]));


								//生成按钮
								$doms = array_merge($doms , integrationTags::td([
									integrationTags::tdSwitcher([
										'params'  => [
											'checked'         => '' ,
											'name'            => 'status' ,
											'change_callback' => 'switcherUpdateField' ,
											//switcherUpdateFieldConfirm
										] ,
										//'name'    => '编辑' ,
										'is_auto' => '1' ,
									]) ,
									'<br>' ,
									integrationTags::tdSwitcher([
										'params'  => [
											'checked'         => 'checked' ,
											'name'            => 'aa' ,
											'change_callback' => 'switcherUpdateFieldConfirm' ,
											//switcherUpdateFieldConfirm
										] ,
										'name'    => '编辑' ,
										'is_auto' => '0' ,
									]) ,
								]));


							});
						});

						/*
						 *
						 *
						 *
						 *
						 *		end of table
						 *
						 *
						 *
						 *
						 * */
					});

				});

			});


			return $this->showPage();
		}

		/**
		 * 表达构造器简单原生写法，仅供参考，不建议使用
		 * @return mixed
		 * @throws \ReflectionException
		 */
		public function form1()
		{

			$this->makePage()->setNodeValue([
				'BODY_ATTR' => tagConstructor::buildKV([
					'class' => ' gray-bg' ,
				]) ,
			]);

			//设置标题
			$this->setPageTitle('form测试');

			$this->displayContents = elementsFactory::build('basicFrame')->make(function(&$doms , $_this) {
				$_this->setNodeValue([
					'animate_type' => 'fadeInRight' ,
				]);

				$doms[] = elementsFactory::row()->make(function(&$doms , $_this) {
					$_this->setNodeValue([//'data-id' => '1' ,
					]);

					$doms[] = elementsFactory::rowBlock()->make(function(&$doms , $_this) {
						//$_this->isEnableClosed(1);
						$_this->setNodeValue([
							'width'      => '12' ,
							'main_title' => 'main_title' ,
							'sub_title'  => 'sub_title' ,
						]);
						/*
						 *
						 *
						 *
						 *
						 *		start of from1
						 *
						 *
						 *
						 *
						 * */

						$doms[] = elementsFactory::form()->make(function(&$doms , $_this) {
							$_this->setNodeValue([
								'id'     => 'form122222' ,
								'method' => 'post' ,
								'action' => '/home/index/index' ,
							]);


							//静态
							$doms = array_merge($doms , integrationTags::staticText([
								'field_name' => 'staticText' ,
								'value'      => 'value' ,
							]));

							//text
							$doms = array_merge($doms , integrationTags::text([
								//随便写
								'field_name'  => 'text' ,
								'placeholder' => 'placeholderplaceholder' ,
								'tip'         => 'text' ,
								'value'       => 'value' ,
								//'attr'        => 'disabled' ,
								'name'        => 'text' ,
							]));

							//password
							$doms = array_merge($doms , integrationTags::password([
								//随便写
								'field_name'  => 'text' ,
								'placeholder' => 'placeholderplaceholder' ,
								'tip'         => 'text' ,
								'value'       => 'value' ,
								//'attr'        => 'disabled' ,
								'name'        => 'text' ,
							] , 1));

							//inlineCheckbox
							$doms = array_merge($doms , integrationTags::inlineCheckbox([
								[
									'value' => '1' ,
									'field' => '年1111' ,
								] ,
								[
									'value' => '2' ,
									'field' => '月2222' ,
								] ,
								[
									'value' => '3' ,
									'field' => '日3333' ,
								] ,
							] , 'namebbbb22233' , 'inlineCheckbox' , '提示信息4411' , [
								1 ,
								3 ,
							]));


							//inlineRadio
							$doms = array_merge($doms , integrationTags::inlineRadio([
								[
									'value' => '1' ,
									'field' => '年1111' ,
								] ,
								[
									'value' => '2' ,
									'field' => '月2222' ,
								] ,
								[
									'value' => '3' ,
									'field' => '日3333' ,
								] ,
							] , 'dd2222' , 'inlineRadio' , '提示信息4411' , 2));


							//blockCheckbox
							$doms = array_merge($doms , integrationTags::blockCheckbox([
								[
									'value' => '1' ,
									'field' => '年1111' ,
								] ,
								[
									'value' => '2' ,
									'field' => '月2222' ,
								] ,
								[
									'value' => '3' ,
									'field' => '日3333' ,
								] ,
							] , 'namebbbb2221' , 'blockCheckbox' , '提示信息4411' , [
								1 ,
								3 ,
							]));


							//blockRadio
							$doms = array_merge($doms , integrationTags::blockRadio([
								[
									'value' => '1' ,
									'field' => '年1111' ,
								] ,
								[
									'value' => '2' ,
									'field' => '月2222' ,
								] ,
								[
									'value' => '3' ,
									'field' => '日3333' ,
								] ,
							] , 'namebbbb2222' , 'blockRadio' , '提示信息4411' , 2));


							//singleSelect
							$doms = array_merge($doms , integrationTags::singleSelect([
								[
									'value' => '1' ,
									'field' => '年1111' ,
								] ,
								[
									'value' => '2' ,
									'field' => '月2222' ,
								] ,
								[
									'value' => '3' ,
									'field' => '日3333' ,
								] ,
							] , 'namebbbb2222' , 'singleSelect111' , '提示信息4411' , 2));


							//switchery
							$doms = array_merge($doms , integrationTags::switchery([
								//额外属性
								//'attr'       => '' ,
								//随便写
								'isChecked'  => 'checked' ,
								//随便写
								'tip'        => '提示信息11' ,
								//随便写
								'field_name' => '用户名' ,
								//表单name值
								'name'       => 'switchery' ,
								//表单value值,$data里的字段
								'value'      => '1222' ,
								//表单value对应名字,$data里的字段
								'field'      => 'name' ,
							]));

							//singleDate
							$doms = array_merge($doms , integrationTags::singleDate([
								'field_name'  => '日期' ,
								'name'        => 'singleDate' ,
								'value'       => '' ,
								'is_time'     => '1' ,
								'placeholder' => '点击选时间' ,
							]));


							//betweenDate
							$doms = array_merge($doms , integrationTags::betweenDate([
								'field_name' => '日期期间' ,
								//'min'        => 'laydate.now()' ,
								'is_time'    => 'true' ,
								//'format'     => 'YYYY-MM-DD hh:mm:ss' ,

								'start_name' => 'start_name' ,
								'end_name'   => 'end_name' ,

								'start_value' => '' ,
								'end_value'   => '' ,

								//'format'      => 'YYYY-MM-DD ' ,
							]));


							//textarea
							$doms = array_merge($doms , integrationTags::textarea([
								'field_name' => 'textarea' ,
								'name'       => 'textarea' ,
								'value'      => '11' ,
								'attr'       => '' ,
								'style'      => 'width:100%;height:200px;' ,
							]));

							//uediter
							$doms = array_merge($doms , integrationTags::uediter([
								'field_name' => '内容' ,
								'name'       => 'uediter' ,
								'value'      => 'sdfsdfsdfsdf' ,
							]));


						});

						/*
						 *
						 *
						 *
						 *
						 *		end of from1
						 *
						 *
						 *
						 *
						 * */
					});

				});

			});

			return $this->showPage();
		}


	}