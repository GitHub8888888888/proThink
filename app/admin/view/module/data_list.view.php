<?php

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
								'is_display' => 1 ,
								'class'      => 'btn-success btn-open-pop' ,
								'field'      => '安装包管理' ,
								'data'       => [
									'src'   => url('admin/Module/packageList') ,
									'title' => '安装包管理' ,
								] ,
							] ,
							[
								'is_display' => 1 ,
								'class'      => 'btn-success btn-open-pop' ,
								'field'      => '上传安装包' ,
								'data'       => [
									'src'   => url('admin/Module/uploadPackage') ,
									'title' => '上传安装包' ,
								] ,
							] ,
						] ,
					] , [
						0 ,
						2 ,
					]) ,
					'<p class="red"> <strong>开发者功能</strong> 仅在开发阶段供开发者使用，如果是使用别人开发好的包不要随意点击，此操作会影响应用文件，可能会导致包损坏</p>' ,
					'<p class="red"> <span class=" btn-xs btn-primary">生成菜单文件</span> 功能是在开发完成后，将 ithink_privilege 表里对应的应用的数据导出到应用文件下的 ' . MODULE_FILE_MENU . ' ，只有在应用所有功能开发完才使用</p>' ,
					'<p class="red"> <span class=" btn-xs btn-primary">生成配置文件</span> 功能是在开发完成后，将 ithink_config 表里对应的应用的数据导出到应用文件下的 ' . MODULE_FILE_CONFIG . ' ，只有在应用所有功能开发完才使用</p>' ,
					'<p class="red"> <span class=" btn-xs btn-primary">生成安装sql文件</span> 功能是在开发完成后，将 ' . MODULE_FILE_INFO . ' 里 database_tables 对应表数据导出到应用文件下的 ' . MODULE_FILE_SQL . ' ，只有在应用所有功能开发完才使用</p>' ,

					elementsFactory::staticTable()->make(function(&$doms , $_this) use ($__this) {
						$data = $__this->logic->dataList($__this->param);

						/**
						 * 设置表格头
						 */
						$_this->setHead([

							[
								'field' => '封面' ,
								'attr'  => 'style="width:100px;"' ,
							] ,
							[
								'field' => '信息' ,
								'attr'  => '' ,
							] ,
							[
								'field' => '描述' ,
								'attr'  => 'style="width:160px;"' ,
							] ,
							[
								'field' => '状态' ,
								'attr'  => 'style="width:120px;"' ,
							] ,
							[
								'field' => '操作' ,
								'attr'  => 'style="width:120px;"' ,
							] ,
							[
								'field' => '开发者功能' ,
								'attr'  => 'style="width:120px;"' ,
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
							/**
							 * 构造tr
							 */
							if($v['is_complete'])
							{
								$t = integrationTags::tr([


									//封面
									//data-href="/admin/User/editProfilePic" data-text="修改头像"
									integrationTags::td([
										integrationTags::tdSimple([
											'value' => elementsFactory::singleLabel(integrationTags::singleLabel('img' , [
												'is_display'      => 1 ,
												'src'             => $v['cover'] ,
												'data-origin-src' => $v['cover'] ,
												'text'            => '' ,
												'style'           => 'height: 65px;' ,
												'class'           => 'preview-img ' ,
											])) ,
										]) ,
									]) ,

									//信息
									integrationTags::td([
										integrationTags::tdSimple([
											'value'    => $v['info']['id'] ,
											'name'     => 'id : ' ,
											//'field'    => 'name' ,
											//'reg'      => '/^\S+$/' ,
											//'msg'      => '表名字必填' ,
											'editable' => 0 ,
										]) ,
										'<br />' ,
										integrationTags::tdSimple([
											'value'    => $v['info']['name'] ,
											'name'     => '应用名 : ' ,
											//'field'    => 'name' ,
											//'reg'      => '/^\S+$/' ,
											//'msg'      => '表名字必填' ,
											'editable' => 0 ,
										]) ,
										'<br />' ,
										integrationTags::tdSimple([
											'value'    => $v['info']['title'] ,
											'name'     => '标题 : ' ,
											//'field'    => 'name' ,
											//'reg'      => '/^\S+$/' ,
											//'msg'      => '表名字必填' ,
											'editable' => 0 ,
										]) ,
										'<br />' ,
										//添加时间
										integrationTags::tdSimple([
											'name'  => '更新时间 : ' ,
											//'editable' => '0' ,
											'value' => formatTime($v['info']['update_time']) ,
										]) ,


									]) ,

									//描述
									integrationTags::td([
										integrationTags::tdTextarea([
											'style'    => 'width:100%;height:120px' ,
											//'name'     => 'remark' ,
											'field'    => 'description' ,
											//'reg'      => '/^\d{1,4}$/' ,
											//'msg'      => '请填写合法手机号码' ,
											'value'    => $v['info']['description'] ,
											'editable' => 0 ,
										]) ,
									]) ,

									//描述
									integrationTags::td([

										integrationTags::tdSimple([
											'value'    => (function($v) {
												switch ($v['is_install'])
												{
													case '0' :
														$class = 'btn-success';
														break;
													case '1' :
														$class = 'btn-info';
														break;
													case '2' :
														$class = 'btn-danger';
														break;
												}

												return '<span class="btn-xs ' . $class . '">' . $this->logic->model_::$appStatusMap[$v['is_install']]['field'] . '</span>';
											})($v) ,
											//'name'     => '状态 : ' ,
											//'field'    => 'name' ,
											//'reg'      => '/^\S+$/' ,
											//'msg'      => '表名字必填' ,
											'editable' => 0 ,
										]) ,

									]) ,

									//操作
									integrationTags::td([
										integrationTags::tdButton([
											'value'      => '安装/卸载' ,
											'class'      => ' btn-primary btn-open-pop' ,
											'data'       => [
												'src'       => url('operation') ,
												'title'     => '安装/卸载' ,
												'is_reload' => 1 ,
											] ,
											'params'     => [
												'id' => $v['info']['id'] ,
											] ,
											'is_display' => 1 ,
										]) ,
										'<br />' ,
										integrationTags::tdButton([
											'value'      => '备份安装包' ,
											'class'      => ' btn-success btn-custom-request' ,
											'data'       => [
												'src'   => url('backup') ,
												'title' => '备份' ,
											] ,
											'params'     => [
												'id' => $v['info']['id'] ,
											] ,
											'is_display' => 1 ,
										]) ,

										'<br />' ,

										integrationTags::tdButton([
											'class'      => ' btn-warning btn-custom-request' ,
											'data'       => [
												'src'       => url('setDefault') ,
												'is_alert'  => 1 ,
												'is_reload' => 1 ,
											] ,
											'params'     => [
												'id' => $v['info']['id'] ,
											] ,
											'value'      => '设为默认应用' ,
											'is_display' => $v['is_install'] ,
										]) ,

										integrationTags::tdButton([
											'class'      => ' btn-danger btn-delete' ,
											'value'      => '删除应用' ,
											'is_display' => ($v['is_install'] != 1) ,
										]) ,
									]) ,


									//信息
									integrationTags::td([
										integrationTags::tdButton([
											'class'      => ' btn-info btn-custom-request' ,
											'data'       => [
												'src'        => url('devTool') ,
												'is_reload'  => 1 ,
												'is_alert'   => 1 ,
												'is_confirm' => 1 ,
												'msg'        => '此功能为应用开发阶段使用，会影响应用文件结构，可能会导致应用损坏，除非你是开发者，明确知道当前操作的后果，否则请不要随意点击此按钮' ,
											] ,
											'params'     => [
												'option' => 'menu' ,
												'id'     => $v['info']['id'] ,
											] ,
											'value'      => '生成菜单文件' ,
											'is_display' => ($v['is_install']) ,
										]) ,
										'<br />' ,

										integrationTags::tdButton([
											'class'      => ' btn-info btn-custom-request' ,
											'data'       => [
												'src'        => url('devTool') ,
												'is_alert'   => 1 ,
												'is_reload'  => 1 ,
												'is_confirm' => 1 ,
												'msg'        => '此功能为应用开发阶段使用，会影响应用文件结构，可能会导致应用损坏，除非你是开发者，明确知道当前操作的后果，否则请不要随意点击此按钮' ,
											] ,
											'params'     => [
												'option' => 'conf' ,
												'id'     => $v['info']['id'] ,
											] ,
											'value'      => '生成配置文件' ,
											'is_display' => ($v['is_install']) ,
										]) ,

										'<br />' ,
										integrationTags::tdButton([
											'class'      => ' btn-info btn-custom-request' ,
											'data'       => [
												'src'        => url('devTool') ,
												'is_reload'  => 1 ,
												'is_confirm' => 1 ,
												'is_alert'   => 1 ,
												'msg'        => '确定生成安装sql文件？此操作仅在应用开发完成后使用' ,
											] ,
											'params'     => [
												'option' => 'sql' ,
												'id'     => $v['info']['id'] ,
											] ,
											'value'      => '生成安装sql文件' ,
											'is_display' => ($v['is_install']) ,
										]) ,

									]) ,
								] , ['id' => $v['info']['id']]);
							}
							else
							{
								$t = integrationTags::tr([
									//封面
									//data-href="/admin/User/editProfilePic" data-text="修改头像"
									integrationTags::td([
										integrationTags::tdSimple([
											'value' => elementsFactory::singleLabel(integrationTags::singleLabel('img' , [
												'is_display'      => 1 ,
												'src'             => $v['cover'] ,
												'data-origin-src' => $v['cover'] ,
												'text'            => '' ,
												'style'           => 'height: 65px;' ,
												'class'           => 'preview-img ' ,
											])) ,
										]) ,
									]) ,

									//信息
									integrationTags::td([
										integrationTags::tdSimple([
											'value'    => isset($v['info']['id']) ? $v['info']['id'] : '未定义' ,
											'name'     => 'id : ' ,
											//'field'    => 'name' ,
											//'reg'      => '/^\S+$/' ,
											//'msg'      => '表名字必填' ,
											'editable' => 0 ,
										]) ,
										'<br />' ,
										integrationTags::tdSimple([
											'value'    => isset($v['info']['name']) ? $v['info']['name'] : '未定义' ,
											'name'     => '应用名 : ' ,
											//'field'    => 'name' ,
											//'reg'      => '/^\S+$/' ,
											//'msg'      => '表名字必填' ,
											'editable' => 0 ,
										]) ,
										'<br />' ,
										integrationTags::tdSimple([
											'value'    => isset($v['info']['title']) ? $v['info']['title'] : '未定义' ,
											'name'     => '标题 : ' ,
											//'field'    => 'name' ,
											//'reg'      => '/^\S+$/' ,
											//'msg'      => '表名字必填' ,
											'editable' => 0 ,
										]) ,

									]) ,

									//描述
									integrationTags::td([

									]) ,

									//状态
									integrationTags::td([
										integrationTags::tdSimple([
											'value'    => (function($v) {
												return '<span class="btn-xs btn-warning">' . $this->logic->model_::$appStatusMap[$v['is_install']]['field'] . '</span>';
											})($v) ,
											'editable' => 0 ,
										]) ,

									]) ,

									//操作
									integrationTags::td([
										integrationTags::tdButton([
											'class'      => ' btn-danger btn-delete' ,
											'value'      => '删除应用' ,
											'is_display' => ($v['is_install'] != 1) ,
										]) ,
									]) ,


									//信息
									integrationTags::td([
										integrationTags::tdButton([
											'class'      => ' btn-info btn-custom-request' ,
											'data'       => [
												'src'        => url('devTool') ,
												'is_alert'   => 1 ,
												'is_reload'  => 1 ,
												'is_confirm' => 1 ,
												'msg'        => '此功能为应用开发阶段使用，会影响应用文件结构，可能会导致应用损坏，除非你是开发者，明确知道当前操作的后果，否则请不要随意点击此按钮' ,
											] ,
											'params'     => [
												'option' => 'menu' ,
												'id'     => $v['info']['id'] ,
											] ,
											'value'      => '生成菜单文件' ,
											'is_display' => 1 ,
										]) ,

										'<br />' ,
										integrationTags::tdButton([
											'class'      => ' btn-info btn-custom-request' ,
											'data'       => [
												'src'        => url('devTool') ,
												'is_reload'  => 1 ,
												'is_confirm' => 1 ,
												'is_alert'   => 1 ,
												'msg'        => '此功能为应用开发阶段使用，会影响应用文件结构，可能会导致应用损坏，除非你是开发者，明确知道当前操作的后果，否则请不要随意点击此按钮' ,
											] ,
											'params'     => [
												'option' => 'conf' ,
												'id'     => $v['info']['id'] ,
											] ,
											'value'      => '生成配置文件' ,
											'is_display' => 1 ,
										]) ,

										'<br />' ,
										integrationTags::tdButton([
											'class'      => ' btn-info btn-custom-request' ,
											'data'       => [
												'src'        => url('devTool') ,
												'is_reload'  => 1 ,
												'is_confirm' => 1 ,
												'is_alert'   => 1 ,
												'msg'        => '确定生成安装sql文件？此操作仅在应用开发完成后使用' ,
											] ,
											'params'     => [
												'option' => 'sql' ,
												'id'     => $v['info']['id'] ,
											] ,
											'value'      => '生成安装sql文件' ,
											'is_display' => 1 ,
										]) ,


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