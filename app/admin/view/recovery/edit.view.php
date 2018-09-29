<?php

	use builder\integrationTags;

	return function($__this) {
		$__this->setPageTitle('角色编辑');

		$info = $__this->logic->getInfo($__this->param);
		session(URL_MODULE , $__this->param['id']);

		$__this->displayContents = integrationTags::basicFrame([
			integrationTags::form([

				integrationTags::text([
					//随便写
					'field_name'  => '表名字' ,
					'placeholder' => '' ,
					'tip'         => '表标题' ,
					'value'       => $info['name'] ,
					//'attr'        => 'disabled' ,
					'name'        => 'name' ,
				]) ,

				integrationTags::text([
					//随便写
					'field_name'  => '表名' ,
					'placeholder' => '' ,
					'tip'         => '表在数据库里的英文标识' ,
					'value'       => $info['tab_db'] ,
					//'attr'        => 'disabled' ,
					'name'        => 'tab_db' ,
				]) ,


				integrationTags::text([
					//随便写
					'field_name'  => '字段' ,
					'placeholder' => '' ,
					'tip'         => '要预览的字段，用逗号分隔，直接拼接sql用' ,
					'value'       => $info['field'] ,
					//'attr'        => 'disabled' ,
					'name'        => 'field' ,
				]) ,


				integrationTags::textarea([
					'field_name' => '备注' ,
					'tip'        => '备注' ,
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


		return $__this->showPage();
	};