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
	var username = function (d) {
		return '<p class="p2">'+d.admin_id.user_name+'</p>';
	};
	//用户列表
	var tableIns = table.render({
		elem: '#userList',
		url: '/index.php/admin/system/userRecord',
		method:'post',
		cellMinWidth: 95,
		page: true,
		height: "full-125",
		limits: [10, 15, 20, 25],
		limit: 20,
		id: "userListTable",
		cols: [[
            { field: 'id', title: '序号', width: 80, align: "center" },
            { field: 'create_time', title: '日期', width: 200, align: "center" },
			{ field: 'admin_id', title: '用户名', width: 150, align: "center" , templet:username},
			{ field: 'model', title: '模块', align: "center" },
			{ field: 'content', title: '描述', width: 400, align: "center" },

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
		edit()
	});
	function edit(edit) {
		layui.layer.open({
			type: 2,
			content: "addUser.html",
			area: ['800px', '450px'],
			title: '新增后台用户',
			success : function(layero, index){
				var body = layui.layer.getChildFrame('body', index);

                if(edit){
					var optionStr = '<option value="0" >后台管理用户</option><option value="1">客服</option>';
					body.find(".vip").append(optionStr);
					body.find(".state").val(edit.newsStatus);
					body.find(".vip").val(edit.newsStatus);
				}else{
					var optionStr = '<option value="0" >后台管理用户</option><option value="1">客服</option>';
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
	function deletebp(edit) {
		layer.confirm('真的删除行么？', function (index) {
			console.log(edit.newsId);
			layer.close(index);
		});
	}

	//申请时间1
	var date2 = laydate.render({
		elem: '#application-Time'
		, type: 'datetime'
		, range: true
		, format: 'yyyyMMdd'
	})
	//表单提交
	form.on("submit(reload)", function (data) {
		var field = data.field;
		//弹出loading 加载
		var index = top.layer.msg('数据提交中，请稍候', { icon: 16, time: false, shade: 0.8 });
		var time = field.time;  //接单时间
		var username = field.username; //用户名
		var modular = field.modular; //模块
		table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
			page: {
				curr: 1 //重新从第 1 页开始
			},
			where: {
				username: username    //用户名
				, time: time  //接单时间
				, modular: modular  //模块
			}
		})
		setTimeout(function () {
			top.layer.close(index);
			top.layer.msg("搜索成功！");
		}, 500);
		return false;
	});

})
