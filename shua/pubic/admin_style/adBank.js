layui.use(['form', 'layer', 'table', 'laytpl', 'laydate', 'upload'], function () {
	var form = layui.form,
		layer = parent.layer === undefined ? layui.layer : top.layer,
		$ = layui.jquery,
		laytpl = layui.laytpl,
		table = layui.table,
		upload = layui.upload;
	laydate = layui.laydate;
	var wgbz2 = function (d) {
		var wg = d.collection;
		if (wg === undefined) {
			wg = '---'
		}
		return '<span clas="wgbz">' + wg + '</span>';
	};
	//用户列表
	var tableIns = table.render({
		elem: '#userList',
		url: '/index.php/admin/system/adBank',
		toolbar: '#toolbarDemo',
		method:'post',
		cellMinWidth: 95,
		page: true,
		height: "full-125",
		limits: [10, 15, 20, 25],
		limit: 10,
		id: "userListTable",
		cols: [[
            { field: 'id', title: '序号', width: 100, align: "center" },
            { field: 'name', title: '银行名字', width: 200, align: "center" },

			{ title: '操作', minWidth: 100, width: 200, templet: '#userListBar', align: "center" }
		]]
	});
	//列表操作
	table.on('tool(userList)', function (obj) {
		var that = this;
		var layEvent = obj.event,
			data = obj.data;
		if (layEvent === 'edit') { //编辑
			edit(data)
		} else if (layEvent === 'deletebp') { //删除
			deletebp(data, obj)
		}
	});
	$('.addBasicParameter').click(function (obj) {
		edit()
	});
	function edit(edit={id:0}) {
		layui.layer.open({
			type: 2,
			content: "/index.php/admin/system/addBank/id/"+edit.id,
			area: ['800px', '450px'],
			title: '新增',
			success : function(layero, index){
				var body = layui.layer.getChildFrame('body', index);
				console.log(edit)
                if(edit){
					var optionStr = '<option  value="0" selected>后台管理用户</option><option  value="1">客服</option>';
					body.find(".vip").append(optionStr);
					body.find(".state").val(edit.newsStatus);
					body.find(".vip").val(edit.newsStatus);
				}else{
					var optionStr = '<option value="0" selected>后台管理用户</option><option value="1">客服</option>';
					body.find(".vip").append(optionStr);
				}
                setTimeout(function(){
                    layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
		})
	}

	/**
	 * 删除
	 * @param {} edit
	 */
	function deletebp(edit, obj) {
		layer.confirm('真的删除行么？', function (index) {
			obj.del();
			layer.close(index);
			$.post("/index.php/admin/system/delete_bank",{id:edit.id},function (res) {
				return  layer.msg(res.msg,{},function () {

				});
			})

		});
	}

})
