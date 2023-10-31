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
		url: '/index.php/admin/system/basicParameter',
		method:'post',
		toolbar: '#toolbarDemo',
		cellMinWidth: 95,
		page: true,
		height: "full-125",
		limits: [10, 15, 20, 25],
		limit: 10,
		id: "userListTable",
		cols: [[
			{ field: 'id', title: 'id', width: 100, align: "center" },
			{ field: 'name', title: '角色名', width: 700, align: "center" },
			{ title: '操作', minWidth: 100, width: 800, templet: '#userListBar', align: "center" }
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
			deletebp(data)
		}
	});
	$('.addBasicParameter').click(function (obj) {
		layui.layer.open({
			type: 2,
			content: "addBasicParameter.html",
			area: ['400px', '650px'],
			title: '新增角色'
		})
	});
	function edit(edit) {

		layui.layer.open({
			type: 2,
			content: "/index.php/admin/system/editbasicparameter/id/"+edit.id,
			area: ['400px', '650px'],
			title: '编辑角色',
			success : function(layero, index){// 当前层DOM当前层 索引
				//console.log(layero, index)
				console.log(edit);
				var body = layui.layer.getChildFrame('body', index);

			},
			yes: function(index, layero){
				//do something
			}
		})
	}
	/**
	 * 删除
	 * @param {} edit
	 */
	function deletebp(edit) {
		layer.confirm('真的删除行么？', function (index) {

			//edit.del();
			 $.post("/index.php/admin/system/delete_admin_role",{id:edit.id},function (res) {
			 	return  layer.msg(res.msg,{},function () {
			 		location.reload();
				});
			 })
		});
	}

})
