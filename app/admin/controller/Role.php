<?php

	namespace app\admin\controller;

	use builder\elementsFactory;
	use builder\integrationTags;

	class Role extends AdminBase
	{
		public function _initialize()
		{
			parent::_initialize();
		}

		/**
		 * @return mixed
		 * @throws \ReflectionException
		 */
		public function add()
		{
			if(IS_POST)
			{
				$this->initLogic();
				$this->jump($this->logic->add($this->param_post));
			}
			else
			{
				$this->setPageTitle('角色添加');

				$this->displayContents = integrationTags::basicFrame([

					integrationTags::form([

						integrationTags::text([
							//随便写
							'field_name'  => '角色名' ,
							'placeholder' => '' ,
							'tip'         => '必填' ,
							//'value'       => 'value' ,
							//'attr'        => 'disabled' ,
							'name'        => 'name' ,
						]) ,

						integrationTags::text([
							//随便写
							'field_name'  => '排序' ,
							'placeholder' => '' ,
							'tip'         => '必填' ,
							'value'       => '1' ,
							//'attr'        => 'disabled' ,
							'name'        => 'order' ,
						]) ,


						/*
												integrationTags::switchery([
													'isChecked'  => 'checked' ,
													//额外属性
													//'attr'       => '{if 1 == 1}checked{/if}' ,
													//随便写
													'tip'        => '是否启用' ,
													//随便写
													'field_name' => '是否启用' ,
													//表单name值
													'name'       => 'status' ,
													//表单value值,$data里的字段
													'value'      => '1' ,
													//表单value对应名字,$data里的字段
													'field'      => '' ,
												]) ,
						*/

						integrationTags::textarea([
							'field_name' => '备注' ,
							'tip'        => '角色备注' ,
							'name'       => 'remark' ,
							'value'      => '' ,
							'attr'       => '' ,
							'style'      => 'width:100%;height:150px;' ,
						]) ,

					] , [
						'id'     => 'form1' ,
						'method' => 'post' ,
						'action' => url() ,
					]) ,

				] , [
					'animate_type' => 'fadeInRight' ,
				]);


				return $this->showPage();
			}
		}


		/**
		 * @return mixed
		 * @throws \ReflectionException
		 */
		public function edit()
		{
			$this->initLogic();
			if(IS_POST)
			{
				$id = session(URL_MODULE);
				$this->jump($this->logic->edit($this->param , $id));
			}
			else
			{
				$this->setPageTitle('角色编辑');

				$info = $this->logic->getInfo($this->param);
				session(URL_MODULE , $this->param['id']);

				$this->displayContents = integrationTags::basicFrame([
					integrationTags::form([

						integrationTags::text([
							//随便写
							'field_name'  => '角色名' ,
							'placeholder' => '' ,
							'tip'         => '必填' ,
							'value'       => $info['name'] ,
							//'attr'        => 'disabled' ,
							'name'        => 'name' ,
						]) ,

						integrationTags::text([
							//随便写
							'field_name'  => '排序' ,
							'placeholder' => '' ,
							'tip'         => '必填' ,
							'value'       => $info['order'] ,
							//'attr'        => 'disabled' ,
							'name'        => 'order' ,
						]) ,
						/*
												integrationTags::switchery([
													'isChecked'  => $info['status'] == 1 ? 'checked' : '' ,
													//额外属性
													//'attr'       => '{if 1 == 1}checked{/if}' ,
													//随便写
													'tip'        => '是否启用' ,
													//随便写
													'field_name' => '是否启用' ,
													//表单name值
													'name'       => 'status' ,
													//表单value值,$data里的字段
													'value'      => '1' ,
													//表单value对应名字,$data里的字段
													'field'      => '' ,
												]) ,
						*/

						integrationTags::textarea([
							'field_name' => '备注' ,
							'tip'        => '角色备注' ,
							'name'       => 'remark' ,
							'value'      => $info['remark'] ,
							'attr'       => '' ,
							'style'      => 'width:100%;height:150px;' ,
						]) ,

					] , [
						'id'     => 'form1' ,
						'method' => 'post' ,
						'action' => url() ,
					]) ,
				] , [
					'animate_type' => 'fadeInRight' ,
				]);


				return $this->showPage();
			}
		}


		public function dataList()
		{
			$this->setPageTitle('角色列表');

			$this->initLogic();
			$this->displayContents = integrationTags::basicFrame([
				integrationTags::row([
					integrationTags::rowBlock([
						integrationTags::rowButton([[
							[
								'class' => 'btn-success  search-dom-btn-1',
								'field' => '筛选',
							],
							[
								'class' => 'btn-info  se-all',
								'field' => '全选',
							],
							[
								'class' => 'btn-info  se-rev',
								'field' => '反选',
							],
							[
								'class' => 'btn-danger  btn-add',
								'field' => '添加数据',
								'is_display' => $this->isButtonDisplay(MODULE_NAME , CONTROLLER_NAME , 'add'),
							],
							[
								'class' => 'btn-danger  multi-op multi-op-del',
								'field' => '批量删除',
								'is_display' => $this->isButtonDisplay(MODULE_NAME , CONTROLLER_NAME , 'delete'),
							],
							[
								'class' => 'btn-primary  multi-op multi-op-toggle-status-enable',
								'field' => '批量启用',
							],
							[
								'class' => 'btn-primary  multi-op multi-op-toggle-status-disable',
								'field' => '批量禁用',
							],
						]]),

						elementsFactory::staticTable()->make(function(&$doms , $_this) {

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
									'field' => '角色名' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '排序' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '添加时间' ,
									'attr'  => '' ,
								] ,
								[
									'field' => '备注' ,
									'attr'  => 'style="width:150px;"' ,
								] ,
								[
									'field' => '状态' ,
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
								'deleteUrl'           => url('delete') ,
								'setFieldUrl'         => url('setField') ,
								'detailUrl'           => url('detail') ,
								'editUrl'             => url('edit') ,
								'addUrl'              => url('add') ,
								'assignPrivilegesUrl' => url('assignPrivileges') ,
							]);

							/**
							 * 设置表格搜索框
							 *searchFormCol
							 */
							$searchForm = elementsFactory::searchForm()->make(function(&$doms , $_this) {

								//角色名
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormText([
										'field'       => '角色名' ,
										'value'       => input('name' , '') ,
										'name'        => 'name' ,
										'placeholder' => '' ,
									]) ,
								] , ['col' => '6']);
								$doms = array_merge($doms , $t);

								//添加时间
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormDate([
										'field' => '添加时间' ,

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

								//排序字段
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormSelect([
										[
											'value' => 'id' ,
											'field' => '默认' ,
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
								array_unshift($k , ['value' => -1 , 'field' => '全部' ,]);
								$t = integrationTags::searchFormCol([
									integrationTags::searchFormRadio($k, 'status' , '状态' , input('status' , '-1')) ,
								] , ['col' => '6']);
								$doms = array_merge($doms , $t);

							});

							$_this->setSearchForm($searchForm);

							foreach ($data['data'] as $k => $v)
							{
								/**
								 * 构造tr
								 */
								$t = integrationTags::tr([

									//checkbox
									integrationTags::td([
										integrationTags::tdCheckbox() ,
										integrationTags::tdSimple([
											'value' => $v['id'] ,
										]) ,
									]) ,

									//角色名
									integrationTags::td([
										integrationTags::tdSimple([
											'value'    => $v['name'] ,
											'name'     => '' ,
											'field'    => 'name' ,
											'reg'      => '/^\S+$/' ,
											'msg'      => '角色名必填' ,
											'editable' => (function() use ($v) {
												return ($v['id'] != GLOBAL_ADMIN_ROLE_ID);
											})() ,
										]) ,
									]) ,

									//排序
									integrationTags::td([
										integrationTags::tdSimple([
											'name'     => '' ,
											'value'    => $v['order'] ,
											'field'    => 'order' ,
											'reg'      => '/^\d+$/' ,
											'msg'      => '必须为数字，确保前后无空格' ,
											'editable' => (function() use ($v) {
												return ($v['id'] != GLOBAL_ADMIN_ROLE_ID);
											})() ,
										]) ,
									]) ,


									//添加时间
									integrationTags::td([
										integrationTags::tdSimple([
											//'name'     => '添加时间' ,
											//'editable' => '0' ,
											'value'    => formatTime($v['time']) ,
										]) ,
									]) ,


									//备注
									integrationTags::td([
										integrationTags::tdTextarea([
											'style'    => 'width:100%' ,
											//'name'     => 'remark' ,
											'field'    => 'remark' ,
											//'reg'      => '/^\d{1,4}$/' ,
											//'msg'      => '请填写合法手机号码' ,
											'value'    => $v['remark'] ,
											'editable' => (function() use ($v) {
												return ($v['id'] != GLOBAL_ADMIN_ROLE_ID);
											})() ,
										]) ,
									]) ,


									//状态
									integrationTags::td([
										integrationTags::tdSwitcher([
											'params'  => [
												'checked'         => $v['status'] ? 'checked' : '' ,
												'name'            => 'status' ,
												'change_callback' => 'switcherUpdateField' ,
												//switcherUpdateFieldConfirm
												'is_display'      => (function() use ($v) {
													return ($v['id'] != GLOBAL_ADMIN_ROLE_ID);
												})() ,
											] ,
											'name'    => '' ,
											'is_auto' => '1' ,

										]) ,
									]) ,

									//操作
									integrationTags::td([
										integrationTags::tdButton([
											'attr'       => ' btn-success btn-edit' ,
											'value'      => '编辑' ,
											'is_display' => (function() use ($v) {
												return ($v['id'] != GLOBAL_ADMIN_ROLE_ID);
											})() ,
										]) ,
										integrationTags::tdButton([
											'attr'       => ' btn-info btn-assign-privileges' ,
											'value'      => '分配权限' ,
											'is_display' => (function() use ($v) {
												return ($v['id'] != GLOBAL_ADMIN_ROLE_ID);
											})() ,
										]) ,
										integrationTags::tdButton([
											'attr'       => ' btn-danger btn-delete' ,
											'value'      => '删除' ,
											'is_display' => (function() use ($v) {
												return ($v['id'] != GLOBAL_ADMIN_ROLE_ID);
											})() ,
										]) ,
									]) ,

								] , ['id' => $v['id']]);

								$doms = array_merge($doms , $t);
							}

						}) ,
					] , [
						'width'      => '12' ,
						'main_title' => '角色列表' ,
						'sub_title'  => '' ,
					]) ,
				]) ,
			]);


			return $this->showPage();
		}

		public function assignPrivileges()
		{
			$this->initLogic();
			if(IS_POST)
			{
				$this->param['id'] = session(URL_MODULE);
				$this->jump($this->logic->assignPrivileges($this->param));
			}
			else
			{
				$this->setPageTitle('分配权限');
				session(URL_MODULE , $this->param['id']);

				/**
				 ***************************************************************************************************************
				 *                                                        菜单
				 ***************************************************************************************************************
				 */

				$resourceMenuIndex = RESOURCE_INDEX_MENU;
				//获取所有有效菜单
				$menus = $this->logic__common_Privilegeresource->getAssignableResource($resourceMenuIndex);
				$menus = makeTree($menus);

				foreach ($menus as $k => $v)
				{
					(!$v['is_common']) && $availableMenus[] = [
						'value' => $v['id'] ,
						'field' => indentationOptionsByLevel($v['name'] . " -- " . formatMenu($v['module'] , $v['controller'] , $v['action']), $v['level']) ,
						//'field' => $v['name'] . " -- " . formatMenu($v['module'] , $v['controller'] , $v['action']) ,
					];
				}
				

				//获取当前角色有的菜单
				$currMenu = $this->logic->getRolesResource($this->param, $resourceMenuIndex);

				$menusForms = integrationTags::rowBlock([
					integrationTags::form([

						//blockCheckbox
						//inlineCheckbox
						integrationTags::blockCheckbox($availableMenus , 'privileges[]' , '分配菜单' , '每个角色可分配多个菜单' , $currMenu) ,
						integrationTags::hidden([
							'name'  => 'type' ,
							'value' => $resourceMenuIndex ,
						]) ,

					] , [
						'id'     => 'form1' ,
						'method' => 'post' ,
						'action' => url() ,
					]) ,
				] , [
					'width'      => '12' ,
					'main_title' => '分配菜单和访问权限' ,
					'sub_title'  => '' ,
				]);

				/**
				 ***************************************************************************************************************
				 *                                                        页面元素
				 ***************************************************************************************************************
				 */


				/**
				 ***************************************************************************************************************
				 *                                                        构造页面
				 ***************************************************************************************************************
				 */
				$this->displayContents = integrationTags::basicFrame([
					integrationTags::row([
						$menusForms ,
					]) ,

				] , [
					'animate_type' => 'fadeInRight' ,
				]);

				return $this->showPage();
			}
		}


		/**
		 * @throws \Exception
		 */
		public function delete()
		{
			$this->initLogic();

			return $this->jump($this->logic->delete($this->param , [
				[
					//看有没有用户有这个角色，有的话就不能删除
					function(&$param) {
						$res = db('user_role')->where([
							'role_id'   => [
								'in' ,
								$param['ids'],
							] ,
						])->find();

						return !$res;
					} ,
					[] ,
					'有用户被赋予此角色，不允许删除'
				] ,
/*
				[
					////////////////////////////////
					/// 放置回收站
					////////////////////////////////

					//删除角色对应的授权
					function(&$param) {
						//看有没有角色有这个权限，有的话就不能删除
						$res = db('role_privilege')->where([
							'role_id'   => [
								'in' ,
								$param['ids'],
							] ,
						])->delete() !== false;

						return $res;
					} ,
					[] ,
					''
				] ,

*/
			]));
		}

	}
