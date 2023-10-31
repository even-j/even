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
        url: '/index.php/admin/system/delivery',
        method:'post',
        toolbar: '#toolbarDemo',
        cellMinWidth: 95,
        page: true,
        height: "full-125",
        limits: [10, 15, 20, 25],
        limit: 20,
        id: "userListTable",
        cols: [[
            { field: 'id', title: '序号', width: 300, align: "center" },
            { field: 'name', title: '名称', width: 310, align: "center" },
            { field: 'remarks', title: '描述', width: 300, align: "center" },
            { field: 'create_time', title: '时间', width: 300, align: "center" },
            { title: '操作', minWidth: 100, width: 400, templet: '#userListBar', align: "center" }
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
            deletebp(data,obj)
        }
    });
    $('.addBasicParameter').click(function (obj) {
        edit()
    });
    function edit(edit={id:0}) {
        layui.layer.open({
            type: 2,
            content:"/index.php/admin/system/addDelivery/id/"+edit.id,
            area: ['800px', '400px'],
            title: '新增佣金比例',
            success: function (layero, index) {
                var body = layui.layer.getChildFrame('body', index);
                console.log(edit)
                // if (edit) {
                // 	body.find(".principal1").val(edit.newsId);
                // 	body.find(".principal2").val(edit.newsStatus);
                // 	body.find(".principal3").val(edit.newsStatus);
                // 	body.find(".principal4").val(edit.newsStatus);

                //}
                setTimeout(function () {
                    layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                }, 500)
            }
        })
    }
    /**
     * 删除
     * @param {} edit
     */
    function deletebp(edit,obj) {
        layer.confirm('真的删除行么？', function (index) {
            obj.del();
            layer.close(index);
            $.post("/index.php/admin/system/delete_delivery",{id:edit.id},function (res) {
                return  layer.msg(res.msg,{},function () {

                });
            })
        });
    }

})
