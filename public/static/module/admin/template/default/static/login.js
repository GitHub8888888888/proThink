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

(function () {
	$("#bannerBox").slide({
		mainCell : ".slideBanner",
		effect   : "fold",
		interTime: 3000,
		delayTime: 800,
		autoPlay : true,
		autoPage : true,
		endFun   : function (i, c, s) {
			$(window).resize(function () {
				var width = $(window).width();
				var height = $(window).height();
				s.find(".slideBanner,.slideBanner li").css({"width": width, "height": height});
			});
		}
	});

	// this.src='{:captcha_src()}

	let loginForm = $("#loginForm");

	loginForm.submit(function () {
		var _this = $(this);
		//_this.find('button:submit').attr("disabled",true);
		var loadIndex = layer.load()

		$(this).ajaxSubmit({
			//把服务器返回的内容放入id为output的元素中
			// target: '#output',

			//提交前的回调函数
			beforeSubmit: function (formData, jqForm, options) {
				//只要不返回false，表单都会提交,在这里可以对表单元素进行验证
				return true;
			},

			//提交后的回调函数
			success: function (responseText, statusText) {
				layer.close(loadIndex)

				_this.find('button:submit').attr("disabled", false);
				layer.msg(responseText.msg)

				if (statusText == 'success')
				{
					if (responseText.code == 1)
					{
						setTimeout(function () {
							location.href = responseText.url;
						}, 500);
					}
					else
					{
						refreshSrc();
					}
				}

			},

			// 默认是form的action， 如果申明，则会覆盖
			//url: url,

			// 默认是form的method（get or post），如果申明，则会覆盖
			//type: type,

			// html(默认), xml, script, json...接受服务端返回的类型
			dataType: 'json',

			// 成功提交后，清除所有表单元素的值
			//clearForm: true,

			// 成功提交后，重置所有表单元素的值
			//resetForm: true,

			//限制请求的时间，当请求大于3秒后，跳出请求
			timeout: 3000
		});
		return false;
	})
	/*


	ajaxPost(loginApi, {ids: ids}, function (data) {
		//成功返回回调
		layer.msg(data.msg);
		if (data.code)
		{
			getParentTr($(btn)).remove();
		}
		(typeof callback_ === "function") && callback_(data);
	}, function (data) {
		//错误返回回调

	}, function (btn) {
		//请求之前回调

	}, btn);
	*/

})();

function refreshSrc()
{
	let _this = $('#imgVerify');
	$(_this).attr('src', $(_this).attr('src') + '?_=' + Math.random())
}
