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



	use builder\elementsFactory;
	use builder\integrationTags;

	return function($__this) {
		$__this->setPageTitle('模块列表');
		$__this->initLogic();

		$__this->displayContents = integrationTags::basicFrame([
			integrationTags::row([
				integrationTags::rowBlock([
					integrationTags::rowButton([
						[
							[
								'is_display' => $__this->isButtonDisplay(MODULE_NAME , 'Module' , 'uploadPackage') ,
								'class'      => 'btn-success btn-open-pop' ,
								'field'      => '上传安装包' ,
								'data'       => [
									'src'   => url('admin/Module/uploadPackage') ,
									'title' => '上传安装包' ,
								] ,
							] ,
						] ,
					] , [0]) ,

					elementsFactory::staticTable()->make(function(&$doms , $_this) use ($__this) {
						$data = $__this->logic->packageList();

						/**
						 * 设置表格头
						 */
						$_this->setHead([
							[
								'field' => '信息' ,
								'attr'  => '' ,
							] ,
							[
								'field' => '状态' ,
								'attr'  => 'style="width:250px;"' ,
							] ,
							[
								'field' => '操作' ,
								'attr'  => 'style="width:150px;"' ,
							] ,
						]);

						/**
						 * 设置js请求api
						 */
						$_this->setApi([
							'deleteUrl'   => url('delete') ,
							'setFieldUrl' => url('setField') ,
							'detailUrl'   => url('detail') ,
							'editUrl'     => url('edit') ,
							'addUrl'      => url('add') ,
						]);

						foreach ($data as $k => $v)
						{
							$t = [];
							if($v['is_available'])
							{
								$t = integrationTags::tr([

									//信息
									integrationTags::td([
										integrationTags::tdSimple([
											'value' => $v['info']['id'] ,
											'name'  => 'ID : ' ,
										]) ,
										'<br />' ,
										integrationTags::tdSimple([
											'value' => $v['info']['name'] ,
											'name'  => '应用名 : ' ,
										]) ,
										'<br />' ,
										integrationTags::tdSimple([
											'value' => formatTime($v['info']['update_time']) ,
											'name'  => '更新时间 : ' ,
										]) ,
										'<br />' ,
										integrationTags::tdSimple([
											'value' => $v['info']['version'] ,
											'name'  => '版本 : ' ,
										]) ,
										'<br />' ,
										integrationTags::tdSimple([
											'value' => $v['info']['description'] ,
											'name'  => '描述 : ' ,
										]) ,
									]) ,

									//信息
									integrationTags::td([
										integrationTags::tdSimple([
											'value' => (function($v) {
												$status = '';
												switch (!!$v['is_applyed'])
												{
													case true :
														$class = 'btn-success';
														$status = '已安装';
														break;
													case false :
														$class = 'btn-danger';
														$status = '未安装';
														break;
												}

												return '<span class="btn-sm ' . $class . '">' .$status . '</span>';
											})($v)  ,
										]) ,
									]) ,

									//操作
									integrationTags::td([

										integrationTags::tdButton([
											'value'      => $v['is_applyed'] ? '卸载' :'安装',
											'class'      => ' btn-primary btn-open-pop' ,
											'data'       => [
												'src'       => url('operation') ,
												'title'     =>  $v['is_applyed'] ? '卸载' :'安装',
												'is_reload' => 1 ,
											] ,
											'params'     => [
												'id' => $v['info']['id'] ,
											] ,
											'is_display' => $__this->isButtonDisplay(MODULE_NAME , CONTROLLER_NAME , 'operation') ,
										]) ,

										'<br />' ,
										integrationTags::tdButton([
											'class'      => ' btn-danger btn-custom-request' ,
											'data'       => [
												'src'        => url('delPackage') ,
												'is_reload'  => 1 ,
												'is_confirm' => 1 ,
											] ,
											'params'     => [//'id' => $v['id'] ,
											] ,
											'value'      => '删除包文件' ,
											'is_display' => $__this->isButtonDisplay(MODULE_NAME , CONTROLLER_NAME , 'delPackage') ,
										]) ,
										'<br />' ,
										(function($v) use ($__this) {
											return $__this->isButtonDisplay(MODULE_NAME , CONTROLLER_NAME , 'downloadPackage') ? integrationTags::a('下载包文件' , [
												'href' => url('downloadPackage' , ['id' => $v['info']['id']]) ,
											]) : [];
										})($v) ,


									]) ,

								] , ['id' => $v['info']['id']]);
							}

							$doms = array_merge($doms , $t);
						}

					}) ,

				] , [
					'width'      => '12' ,
					'main_title' => '模块列表' ,
					'sub_title'  => '' ,
				]) ,
			]) ,
		]);


	};