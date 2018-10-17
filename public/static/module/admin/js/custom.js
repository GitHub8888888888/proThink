/**
 *
 *
 *
 *
 *                  回收站
 *
 *
 *
 */

$('.btn-recover').on({'click': function () {registerSetItem(this, 'recover')}});
//
$('.btn-complete-delete').on({'click': function () {registerSetItem(this, 'delete')}});


//彻底删除
$('.multi-item-delete').on({
	'click': function () {
		let _this = $(this);
		_this.data('callback', 'itemSet')
		_this.data('callback_', function () {refresh_page(300)})
		_this.data('action', 'delete')
		regeditMulti(this)
	}
});

//恢复数据
$('.multi-item-recover').on({
	'click': function () {
		let _this = $(this);
		_this.data('callback', 'itemSet')
		_this.data('callback_', function () {refresh_page(300)})
		_this.data('action', 'recover')
		console.dir( _this.data('action'))

		regeditMulti(this)
	}
});


function registerSetItem($obj, opreation)
{
	let _this = $($obj);
	let data_id = getParentTr(_this).data('id');
	itemSet(data_id, $obj, null, opreation)
}

function itemSet(ids, btn, callback_)
{

	let _this = $(this);
	console.dir( _this.data('action'))
	let url = setItemUrl;

	layer.confirm('确定？此操作不可恢复', {
		resize    : 1,
		moveOut   : 1,
		title     : '请确定当前操作',
		shade     : 0.1,
		closeBtn  : 0, //不显示关闭按钮
		anim      : 0,
		// anim      : randomNum(0, 6),
		isOutAnim : 0,
		shadeClose: true, //开启遮罩关闭
		btn       : ['确定', '取消']
	}, function (index, layero) {
		layer.close(index)

		ajaxPost(url, {ids: ids, type: _this.data('action')}, function (data) {
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

	}, function (index) {
		layer.close(index)
	});

}


