<?php

	namespace app\common\logic;

	use app\common\common\set;
	use builder\elementsFactory;
	use builder\integrationTags;

	//use app\common\model\ModelBase;

	class LogicBase
	{
		use set;

		//对应表的验证器实例
		public $validate_ = null;

		//对应表的模型实例
		public $model_ = null;

		//返回结果默认值
		public $retureResult = [
			'sign'    => RESULT_SUCCESS ,
			'message' => '' ,
			'url'     => '' ,
		];

		public function initBaseClass()
		{
			//当前类名
			//$this->model_ = $this->logic__common_User;
			$this->model_ = $this->{'model__common_' . getClassBase(static::class)};
			$this->validate_ = $this->{'validate__common_' . getClassBase(static::class)};
		}


		/**
		 *                        curl基础操作
		 */

		/**
		 * 控制器添加数据
		 *
		 * @param array $data 控制器传来的参数
		 * @param null  $beforeClosureList
		 * @param null  $afterClosureList
		 *
		 * @return array
		 */
		public function add($data , $beforeClosureList = null , $afterClosureList = null)
		{
			$validateResult = $this->validate_->scene('add')->check($data);

			if($validateResult)
			{
				//TODO 执行前置钩子，根据结果处理
				$globalVariable = $data;
				$globalVariable['_id'] = null;
				$closureList = [];

				//添加前置回调
				(is_array($beforeClosureList)) && $closureList = $beforeClosureList;

				//处理方法
				$closureList[] = [
					function(&$globalVariable) {
						$res = $this->model_->insertData($globalVariable);
						($res) && $globalVariable['_id'] = $this->model_->getData('id');

						return $res;
					} ,
					[] ,
					'添加失败，请稍后再试...' ,
				];

				//添加后置回调
				(is_array($afterClosureList)) && $closureList = array_merge($closureList , $afterClosureList);

				$res = execClosureList($closureList , $err , $globalVariable);

				if($res !== false && (((int)$globalVariable['_id']) > 0))
				{
					$this->retureResult['message'] = '添加成功';
					$this->retureResult['sign'] = RESULT_SUCCESS;
				}
				else
				{
					$msg = $err ? $err : $this->model_->getError();
					$this->retureResult['message'] = $msg;
					$this->retureResult['sign'] = RESULT_ERROR;
				}
			}
			else
			{
				$this->retureResult['message'] = $this->validate_->getError();
				$this->retureResult['sign'] = RESULT_ERROR;
			}

			return $this->retureResult;
		}


		/**
		 * 控制器编辑数据
		 *
		 * @param array      $param 控制器传来的参数
		 * @param int|string $id    要更新的id
		 * @param null       $beforeClosureList
		 * @param null       $afterClosureList
		 *
		 * @return array
		 */
		public function edit($param , $id , $beforeClosureList = null , $afterClosureList = null)
		{
			$validateResult = $this->validate_->scene('edit')->check($param);

			if($validateResult)
			{
				//TODO 执行前置钩子，根据结果处理
				$globalVariable = $param;
				$closureList = [];

				//添加前置回调
				if(is_array($beforeClosureList))
				{
					$closureList = $beforeClosureList;
				}

				//处理方法
				$closureList[] = [
					function(&$globalVariable) use ($id) {
						$where = [
							'id' => [
								'in' ,
								$id ,
							] ,
						];

						return $this->model_->updateData($globalVariable , $where);
					} ,
					[] ,
					'修改失败，请稍后再试...' ,
				];

				//添加后置回调
				if(is_array($afterClosureList))
				{
					$closureList = array_merge($closureList , $afterClosureList);
				}

				$res = execClosureList($closureList , $err , $globalVariable);

				if(($res) !== false)
				{
					$this->retureResult['message'] = '修改成功';
					$this->retureResult['sign'] = RESULT_SUCCESS;
				}
				else
				{
					$msg = $err ? $err : $this->model_->getError();
					$this->retureResult['message'] = $msg;
					$this->retureResult['sign'] = RESULT_ERROR;
				}
			}
			else
			{
				$this->retureResult['message'] = $this->validate_->getError();
				$this->retureResult['sign'] = RESULT_ERROR;
			}

			return $this->retureResult;

		}

		/**
		 * 软删除用户
		 *
		 * @param            $param
		 * @param null       $beforeClosureList
		 * @param null       $afterClosureList
		 *
		 * @return array
		 */
		public function delete($param , $beforeClosureList = null , $afterClosureList = null)
		{
			//TODO 执行前置钩子，根据结果决定是否删除
			//TODO 把删除语句加入闭包队列中最后一个都通过才删除
			//TODO 或者在执行删除语句之前执行一个前置方法，通过才删除
			$globalVariable = $param;
			$closureList = [];

			//添加前置回调
			if(is_array($beforeClosureList))
			{
				$closureList = $beforeClosureList;
			}

			//处理方法
			$closureList[] = [
				function(&$globalVariable) {
					$where = [
						'id' => [
							'in' ,
							explode(',' , $globalVariable['ids']) ,
						] ,
					];

					return $this->model_->recycle($where);
				} ,
				[] ,
				'删除失败，请稍后再试...' ,
			];

			//添加后置回调
			if(is_array($afterClosureList))
			{
				$closureList = array_merge($closureList , $afterClosureList);
			}

			$res = execClosureList($closureList , $err , $globalVariable);

			if(($res) !== false)
			{
				$this->retureResult['message'] = '删除成功';
				$this->retureResult['sign'] = RESULT_SUCCESS;
			}
			else
			{
				$msg = $err ? $err : $this->model_->getError();
				$this->retureResult['message'] = $msg;
				$this->retureResult['sign'] = RESULT_ERROR;
			}

			return $this->retureResult;
		}


		/**
		 * @param      $param
		 * @param null $beforeClosureList
		 * @param null $afterClosureList
		 *
		 * @return array
		 */
		public function updateField($param , $beforeClosureList = null , $afterClosureList = null)
		{
			//ids:4
			//val:0
			//field:is_pending

			//TODO 执行前置钩子，根据结果处理
			$globalVariable = $param;
			$closureList = [];

			//添加前置回调
			if(is_array($beforeClosureList))
			{
				$closureList = $beforeClosureList;
			}

			//处理方法
			$closureList[] = [
				function(&$globalVariable) {
					$data = [
						$globalVariable['field'] => $globalVariable['val'] ,
					];

					$where = [
						'id' => [
							'in' ,
							explode(',' , $globalVariable['ids']) ,
						] ,
					];

					return $this->model_->updateField($data , $where);
				} ,
				[] ,
				'更新失败，请稍后再试...' ,
			];

			//添加后置回调
			if(is_array($afterClosureList))
			{
				$closureList = array_merge($closureList , $afterClosureList);
			}

			$res = execClosureList($closureList , $err , $globalVariable);

			if(($res) !== false)
			{
				$this->retureResult['message'] = '更新成功';
				$this->retureResult['sign'] = RESULT_SUCCESS;
			}
			else
			{
				$msg = $err ? $err : $this->model_->getError();
				$this->retureResult['message'] = $msg;
				$this->retureResult['sign'] = RESULT_ERROR;
			}

			return $this->retureResult;
		}


		/**
		 *                        查询数据通用信息
		 */


		/**
		 * 按id获取单条数据
		 * 状态不为2的数据
		 *
		 * @param $param
		 *
		 * @return mixed
		 */
		public function getInfo($param)
		{
			$data = $this->model_->getRowById($param['id']);

			return $data;
		}


		/**
		 * 不带分页的查询
		 *
		 * @param array $param         控制器传的参数
		 * @param null  $callback      每个数据的回调
		 * @param bool  $isActivedOnly 是否只取status为1的值
		 *
		 * @return mixed
		 */
		public function dataList($param = [] , $callback = null , $isActivedOnly = false)
		{
			$condition = $this->makeCondition($param);
			$isActivedOnly && $this->model_->getActivedOnly();

			$data = $this->model_->selectData($condition);
			(is_callable($callback)) && $data->each($callback);

			return $data->toArray();
		}


		/**
		 * 带分页的查询
		 *
		 * @param array $param         控制器传的参数
		 * @param null  $callback      每个数据的回调
		 * @param bool  $isActivedOnly 是否只取status为1的值
		 *
		 * @return mixed
		 */
		public function dataListWithPagination($param , $callback = null , $isActivedOnly = false)
		{
			$condition = $this->makeCondition($param);
			$isActivedOnly && $this->model_->getActivedOnly();

			$pageSize = (isset($param['pagerow']) && is_numeric($param['pagerow'])) ? $param['pagerow'] : DB_LIST_ROWS;

			$data = $this->model_->selectDataWithPagination($condition , $pageSize , [
				'var_page' => 'page' ,
				'query'    => $param ,
			]);

			(is_callable($callback)) && $data->each($callback);

			$result = $data->toArray();
			$result['pagination'] = $data->render();

			return $result;
		}


		/**
		 * 不分页获取当前表所有status为1的数据
		 *
		 * @param array $param    控制器传的参数
		 * @param null  $callback 每个数据的回调
		 *
		 * @return mixed
		 */
		public function getActivedData($param = [] , $callback = null)
		{
			$data = $this->dataList($param , $callback , 1);

			return $data;
		}

		/**
		 * 分页获取当前表所有status为1的数据
		 *
		 * @param array $param    控制器传的参数
		 * @param null  $callback 每个数据的回调
		 *
		 * @return mixed
		 */
		public function getActivedDataWithPagination($param = [] , $callback = null)
		{
			$data = $this->dataListWithPagination($param , $callback , 1);

			return $data;
		}


		/**
		 * 已经被删除的数据
		 * 分页获取当前表所有status为2的数据
		 *
		 * @param array $param    控制器传的参数
		 * @param null  $callback 每个数据的回调
		 *
		 * @return mixed
		 */
		public function getDeletedDataWithPagination($param = [] , $callback = null)
		{

			$condition = $this->makeCondition($param);
			$pageSize = (isset($param['pagerow']) && is_numeric($param['pagerow'])) ? $param['pagerow'] : DB_LIST_ROWS;

			$data = $this->model_->selectDeletedDataWithPagination($condition , $pageSize , [
				'var_page' => 'page' ,
				'query'    => $param ,
			]);

			(is_callable($callback)) && $data->each($callback);

			$result = $data->toArray();
			$result['pagination'] = $data->render();

			return $result;
		}


		/**
		 * 读取回收站里的数据
		 *
		 * @param $params
		 *
		 * @return mixed
		 */
		public function getDeletedTab($params)
		{

			return elementsFactory::staticTable()->make(function(&$doms , $_this) use ($params) {
				$info = $this->getInfo($params);
				$logic = $this->{'logic__common_' . $info['tab_db']};
				$data = $logic->getDeletedDataWithPagination($params);

				/**
				 * 设置表格头
				 */
				$_this->setHead([
					[
						'field' => 'ID' ,
						'attr'  => 'style="width:80px;"' ,
					] ,
					[
						'field' => '信息' ,
						'attr'  => '' ,
					] ,
					[
						'field' => '删除时间' ,
						'attr'  => 'style="width:240px;"' ,
					] ,
					[
						'field' => '操作' ,
						'attr'  => 'style="width:200px;"' ,
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
					'deleteUrl'   => url('delete') ,
					'setFieldUrl' => url('setField') ,
					'detailUrl'   => url('detail') ,
					'editUrl'     => url('edit') ,
					'addUrl'      => url('add') ,
					'viewInfoUrl' => url('viewInfo') ,
				]);


				/*
				 * 设置表格搜索框
				 */
				$searchForm = elementsFactory::searchForm()->make(function(&$doms , $_this)  use ($params) {
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
							'field'        => '添加时间' ,
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
							'value'       => (isset($params['pagerow']) && is_numeric($params['pagerow'])) ?$params['pagerow'] : DB_LIST_ROWS ,
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
						integrationTags::td((function() use ($v , $info) {
							$res = [];
							$res = array_map(function($v1) use ($v , $info) {
								$re = integrationTags::tdSimple([
									'value'    => $v[$v1] ,
									'name'     => $v1 . ' : ' ,
									//'field'    => 'name' ,
									//'reg'      => '/^\S+$/' ,
									//'msg'      => '表名字必填' ,
									'editable' => 0 ,
								]);
								$re[] = '<br />';

								return $re;
							} , explode(',' , $info['field']));

							return $res;
						})()) ,

						integrationTags::td([
							integrationTags::tdSimple([
								'name'  => '添加时间' ,
								//'editable' => '0' ,
								'value' => formatTime($v['time']) ,
							]) ,
							'<br />' ,
							integrationTags::tdSimple([
								'name'  => '删除时间' ,
								//'editable' => '0' ,
								'value' => formatTime($v['del_time']) ,
							]) ,
						]) ,


						//操作
						integrationTags::td([

							integrationTags::tdButton([
								'attr'       => ' btn-info btn-view-detail' ,
								'value'      => '详细数据' ,
								'is_display' => 1 ,
							]) ,

							integrationTags::tdButton([
								'attr'       => ' btn-success btn-recover' ,
								'value'      => '恢复记录' ,
								'is_display' => 1 ,
							]) ,

							integrationTags::tdButton([
								'attr'       => ' btn-danger btn-complete-delete' ,
								'value'      => '彻底删除' ,
								'is_display' => 1 ,
							]) ,


						]) ,

					] , ['id' => $v['id']]);

					$doms = array_merge($doms , $t);
				}

			});
		}

		/**
		 *                        用户登陆通用信息
		 */

		/**
		 * 登陆成功后更新用户信息
		 * @return mixed
		 */
		public function updateUserInfo()
		{
			$info = getAdminSessionInfo(SESSOIN_TAG_USER);
			$where = [
				'user' => [
					'=' ,
					$info['user'] ,
				] ,
			];

			$res = $this->model__user->updateData([
				'last_login_ip'   => IP ,
				'last_login_time' => TIME_NOW ,
				'login_count'     => $info['login_count'] + 1 ,
			] , $where);

			return $res;
		}


		/**
		 * 用户菜单信息写到session
		 * @return mixed
		 */
		public function initPrivilege()
		{
			if(isGlobalManager())
			{
				//如果id是admin的，直接查所有权限
				$privilege = $this->logic__common_Privilegeresource->getResourceByIndex(RESOURCE_INDEX_MENU , [
					'order_filed' => 'order' ,
					'order'       => 'desc' ,
				]);
			}
			else
			{
				$privilege = $this->model__common_Privilegeresource->getMenusByUserId(getAdminSessionInfo(SESSOIN_TAG_USER , 'id'))->toArray();
			}

			$privilege = makeTree($privilege);
			$this->updateSession(SESSOIN_TAG_PRIVILEGES , $privilege);
		}

		/**
		 * 用户角色信息写到session，分别是rolesId，rolesName和roles
		 * @return mixed
		 */
		public function initRole()
		{
			$roles = $this->logic__common_User->getUserRolesInfo(['id' => getAdminSessionInfo(SESSOIN_TAG_USER , 'id')]);

			$this->updateSession(SESSOIN_TAG_ROLE , $roles);

			$this->updateSession(SESSOIN_TAG_ROLE_NAME , array_map(function($v) {
				return $v['name'];
			} , $roles));

			$this->updateSession(SESSOIN_TAG_ROLE_IDS , array_map(function($v) {
				return $v['id'];
			} , $roles));
		}

		/**
		 * 根据用户名更新用户信息session
		 *
		 * @param $username
		 *
		 * @return mixed
		 */
		public function updateSessionByUsername($username)
		{
			$this->updateSession(SESSOIN_TAG_USER , $this->model__common_user->getUserInfoByUsername($username)->toArray());
		}

		/**
		 * 根据tag写入数据到session
		 *
		 * @param string $tag  用户信息，权限信息等等。。。
		 * @param mixed  $info 对应的值
		 *
		 * @return mixed
		 */
		public function updateSession($tag , $info)
		{
			session(((SESSION_TAG_ADMIN . $tag)) , $info);
		}


		/**
		 * 根据tag读出session
		 *
		 * @param string $tag 用户信息，权限信息等等。。。
		 *
		 * @return mixed
		 */
		public function getSessionInfo($tag)
		{
			return session(((SESSION_TAG_ADMIN . $tag)));
		}


	}