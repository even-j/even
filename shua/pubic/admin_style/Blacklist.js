layui.use(['form', 'layer', 'table', 'laytpl', 'laydate'], function () {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;
    laydate = layui.laydate;


    /**
     * 图片记得修改
     * @param {*} d
     */
    var tplImg1 = function (d) {
        return `line （行边框风格）row （列边框风格）nob （无边框风格）`;
    };
    var tplImg2 = function (d) {
        return '<img src="'+d.ipimg+'" style="height: 170px; width: 200px;" >';
    };
    var tplImg3 = function (d) {
        return '<img src="'+d.wwdaimg+'" style="height: 170px; width: 200px;" >';
    };
    var tplImg4 = function (d) {
        return '<img src="'+d.alipayimg+'" style="height: 170px; width: 200px;" >';
    };
    var tplImg5 = function (d) {
        return '<img src="'+d.idcardimg+'" style="height: 170px; width: 200px;" >';
    };
    var state = function (d) {
        if(d.state==0){
            return '<span class="red">未审核</span>';
        }else if(d.state==1){
            return '<span class="green">审核通过</span>';
        }else if(d.state==2){
            return '<span class="red">拒绝</span>';
        }
    }
    var type = function (d) {
        if(d.type==1){
            return '<span class="green">淘宝</span>';
        }else if(d.type==2){
            return '<span class="green">天猫</span>';
        }else if(d.type==3){
            return '<span class="green">飞猪</span>';
        }
    }
    var sellername = function (d) {
        return d.seller_id.seller_name;
    };
    var address = function (d) {
        return `<span>`+d.province+`-`+d.city+`-`+d.area+`-`+d.address+`</span>`
    };
    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url: '/index.php/admin/seller/BlackList',
        method:'POST',
        page: true,
        height: "full-125",
        limits: [10, 15, 20, 25],
        limit: 20,
        id: "userListTable",
        cols: [[
            { field: 'id', title: '序号', minWidth: 50, width:60, align: "center" },
            { field: 'seller_id', title: '商家昵称', minWidth: 80, width:110, align: "center",templet: sellername },
            { field: 'wangwang', title: '买手旺旺', minWidth: 95, align: "center" },
            { field: 'state', title: '拉黑类型', minWidth: 95, align: "center" },
            { field: 'end_time', title: '拉黑到期时间', minWidth: 80, width:130, },
            { field: 'create_time', title: '添加时间', minWidth: 50, width: 160, align: "center" },
            { field: 'update_time', title: '修改时间', minWidth: 95, align: "center" },
            { field: 'status', title: '状态', minWidth: 50, width: 110, align: "center"},
            { title: '操作', minWidth: 150, templet: '#userListBar', fixed: "right", align: "center" }
        ]]
    });
    //批量审核
    $(".delAll_btn").click(function () {
        var checkStatus = table.checkStatus('userListTable'),
            data = checkStatus.data,
            newsId = [];
        if (data.length > 0) {
            for (var i in data) {
                newsId.push(data[i].newsId);
            }
            console.log(newsId)
            layer.confirm('确定批量审核？', { icon: 3, title: '提示信息' }, function (index) {
                //在这里像服务器发送审核
                $.get("/delete",{
                    newsId: JSON.stringify(newsId) //将需要删除的newsId作为参数传入
                },function(data){
                    tableIns.reload();
                    layer.close(index);
                })
            })
        } else {
            layer.msg("请选择需要删除的用户");
        }
    })
    //列表操作
    table.on('tool(userList)', function (obj) {
        var layEvent = obj.event,
            data = obj.data;
        if (layEvent === 'del') { //删除
            layer.confirm('确定删除此用户？', { icon: 3, title: '提示信息' }, function (index) {
                console.log(data);
                var dataid=data.id;


                $.post("/index.php/admin/seller/delblacklist",{id:dataid},function (res) {

                    if(res.code==1){
                        layer.msg(res.msg,{icon:1},function () {
                            window.location.reload();
                        });
                    }else{
                        return  layer.msg(res.msg,{icon:2});
                    }
                })
            });
        }else if(layEvent === 'examine') {
            examine(data)
        }else if(layEvent === 'edit') {
            maihaobianji(data)
        }
    });
    //申请时间
    var date2 = laydate.render({
        elem: '#application-Time'
        , type: 'datetime'
        , range: true
        , format: 'yyyyMMdd'
    })
    //验证数据
    form.verify({
        phone: function (value, item) { //value：表单的值、item：表单的DOM对象
            //   if(!/^1[3456789]\d{9}$/.test(value)){
            //     return '手机号码有误，请重填';
            //   }
        }
        , name: function (value, item) {
        }
        //我们既支持上述函数式的方式，也支持下述数组的形式
        //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
        , pass: [
            /^[\S]{6,12}$/
            , '密码必须6到12位，且不能出现空格'
        ]
    });
    //表单提交
    form.on("submit(reload)", function (data) {
        var field = data.field;
        console.log(field)
        //弹出loading 加载
        var index = top.layer.msg('数据提交中，请稍候', { icon: 16, time: false, shade: 0.8 });
        var name = field.name;  //姓名
        var shopName=field.shopName;
        var state = field.state; //状态
        var num = field.num; //出现次数
        table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                name: name,    //姓名
                shopName:shopName, //店铺名
                num:num, //出现次数
                state: state //状态
            }
        })
        setTimeout(function () {
            top.layer.close(index);
            top.layer.msg("搜索成功！");
        }, 500);
        return false;
    })
    function examine(edit) {
        layui.layer.open({
            type: 2,
            content:"/index.php/admin/seller/BlackListExamine/id/"+edit.id,
            area: ['900px', '500px'],
            title: '审核',
            shadeClose: true,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                //审核模态框中需要数据
                //因为名字我不知道 就简单写了两个 模仿即可
                if(edit){
                    //console.log(edit,1111111111111);
                    body.find(".dataid").val(edit.id);
                }
                setTimeout(function(){
                    layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
    }
    function maihaobianji(edit) {
        layui.layer.open({
            type: 2,
            content: "maihaobianji.html",
            area: ['900px', '650px'],
            title: '编辑店铺信息',
            shadeClose: true,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                //审核模态框中需要数据
                //因为名字我不知道 就简单写了两个 模仿即可
                if(edit){
                    //console.log(edit,1111111111111);
                    body.find(".dataid").val(edit.id);
                }
                setTimeout(function(){
                    layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
    }
})
