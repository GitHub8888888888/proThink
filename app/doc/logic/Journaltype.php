<?php

	namespace app\doc\logic;


	class Journaltype extends DocBase
	{
		public function __construct()
		{
			$this->initBaseClass();
		}

		/**
		 * 获取用户拥有的类型
		 * 专门给编辑用的
		 * @param $uid
		 */
		public function getUserHasType($uid)
		{
			$types = $this->model_->getJournalTypeIdByUserId($uid);

			$journalTypes = $this->getActivedData();
			$res = [];
			array_unshift($res , [
				'value' => 0 ,
				'field' => '请选择' ,
			]);
			foreach ($journalTypes as $k => $v)
			{
				if(in_array($v['id'] , $types))
				{
					$res[] = [
						'value' => $v['id'] ,
						'field' => $v['name'] ,
					];
				}
			}

			return $res;
		}

		public function getFormatedData($isPushDefault = 0)
		{
			$journalTypes = $this->getActivedData();

			$journalTypes = array_map(function($v) {
				return [
					'value' => $v['id'] ,
					'field' => $v['name'] ,
				];
			} , $journalTypes);

			$isPushDefault && array_unshift($journalTypes , [
				'value' => 0 ,
				'field' => '请选择' ,
			]);

			return $journalTypes;
		}

		/**
		 * @param $param
		 *
		 * @return array
		 */
		protected function makeCondition($param)
		{
			$where = [];
			$order = [];

			$order_filed = 'id';
			$order_ = 'asc';

			foreach ($param as $k => $v)
			{
				switch ($k)
				{
					case 'name' :
						$v != '' && $where[$this->model_::makeSelfAliasField($k)] = [
							'like' ,
							"%" . $v . "%" ,
						];
						break;

					case 'action' :
						$v != '' && $where[$this->model_::makeSelfAliasField($k)] = [
							'=' ,
							$v ,
						];
						break;

					case 'order_filed' :
						$v != '' && $order_filed = $v;
						break;

					case 'order' :
						$v != '' && $order_ = $v;
						break;

					case 'status' :
						if($v != -1)
						{
							$where[$this->model_::makeSelfAliasField($k)] = [
								'=' ,
								$v ,
							];
						}
						break;

					default :
						#...
						break;
				}
			}


			$order[$order_filed] = $order_;


			return $condition = [
				'where' => $where ,
				'order' => $order ,
			];
		}

	}