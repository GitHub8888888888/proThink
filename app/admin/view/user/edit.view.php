<?php

	use builder\integrationTags;

	return function($__this) {

		$__this->setPageTitle('用户编辑');
		$info = $__this->logic->getInfo($__this->param);

		session(URL_MODULE , $__this->param['id']);

		$__this->displayContents = integrationTags::basicFrame([
			integrationTags::form([

				integrationTags::text([
					'field_name'  => '用户名' ,
					'placeholder' => '请填写用户名' ,
					'tip'         => '' ,
					'value'       => $info['user'] ,
					'attr'        => 'disabled' ,
					'name'        => 'user' ,
				]) ,

				integrationTags::staticText([
					//'placeholder' => '' ,
					//'tip'         => '' ,
					//'attr'        => 'disabled' ,
					//'name'        => 'user' ,

					'field_name' => '用户名' ,
					'value'      => $info['user'] ,
				]) ,


				integrationTags::text([
					'field_name'  => '姓名' ,
					'placeholder' => '请填写用户名' ,
					'tip'         => '' ,
					'value'       => $info['nickname'] ,
					//'attr'        => 'disabled' ,
					'name'        => 'nickname' ,
				]) ,

				integrationTags::text([
					//随便写
					'field_name'  => '邮箱' ,
					'placeholder' => '' ,
					'tip'         => '请填写邮箱' ,
					'value'       => $info['email'] ,
					//'attr'        => 'disabled' ,
					'name'        => 'email' ,
				]) ,


				integrationTags::text([
					//随便写
					'field_name'  => '手机' ,
					'placeholder' => '' ,
					'tip'         => '请填写手机号码' ,
					'value'       => $info['phone'] ,
					'attr'        => '' ,
					'name'        => 'phone' ,
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