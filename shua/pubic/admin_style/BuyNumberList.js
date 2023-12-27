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
        return '<img class="jump"  src="'+d.ipimg+'" style="height: 170px; width: 200px;" >';
     };
    var tplImg3 = function (d) {
        return '<img class="jump1"  src="'+d.wwdaimg+'" style="height: 170px; width: 200px;" >';
    };

    var tplImg4 = function (d) {
        return '<img class="jump"   src="'+d.alipayimg+'" style="height: 170px; width: 200px;" >';
    };
    var tplImg5 = function (d) {
        return '<img class="jump"  src="'+d.idcardimg+'" style="height: 170px; width: 200px;" >';
    };
    var username = function (d) {
        return '<p class="p2">'+d.uid.username+'</p>';
    };

    var tjuser = function (d) {
        return '<p class="p2">'+d.uid.tjuser+'</p>';
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
    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url: '/index.php/admin/buyer/BuyNumberList',
        method:'POST',
        page: true,
        height: "full-125",
        limits: [10, 15, 20, 25],
        limit: 20,
        id: "userListTable",
        cols: [[
            { field: 'id', title: '序号', minWidth: 50, width:60, align: "center" },
            { field: 'addressphone', title: '收货人手机号码', minWidth: 80, width:110, align: "center" },
            { field: 'wwid', title: '旺旺号', minWidth: 80, width:95, align: "center" },
            { field: 'username', title: '用户名', minWidth: 80, width:95, align: "center" , templet: username  },
            { field: 'alipayname', title: '支付宝姓名', minWidth: 80, width:95, align: "center" },
            // { field: 'addressname', title: '收货人姓名', minWidth: 80, width:100, align: "center" },
             { field: 'detail_address', title: '收货地址', minWidth: 80, width:100, align: "center" },
            { field: 'creat_time', title: '提交时间', minWidth: 50, width: 80, align: "center" },
            { field: 'tjuser', title: '来源用户ID', minWidth: 100, align: "center" , templet: tjuser},

            { field: 'wwdaimg', title: 'IP所在地截图', minWidth: 95, align: "center", templet: tplImg2 },
            { field: 'wwdaimg', title: '旺旺档案截图', minWidth: 95, align: "center", templet: tplImg3 },
            { field: 'alipayimg', title: '支付宝实名截图', minWidth: 95, align: "center", templet: tplImg4 },
            { field: 'idcardimg', title: '身份证正面截图', minWidth: 95, height: 315, align: "center", templet: tplImg5 },
            { field: 'star', title: '星级', minWidth: 50, width: 50, align: "center" },
            { field: 'state', title: '状态', minWidth: 50, width: 80, align: "center",templet: state },
            { title: '操作', minWidth: 180, templet: '#userListBar', fixed: "right", align: "center" }
        ]]
    });

    layui.use('layer', function(){
        var $ = layui.jquery, layer = layui.layer;
        $(document).on('click','.jump',function(){
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['500', '1200'], //宽高
                shadeClose: true, //开启遮罩关闭
                end: function (index, layero) {
                    return false;
                },
                content: '<div style="text-align:center"><img width="500"  src="' + $(this).attr('src') + '" /></div>'
            });
        });
        $(document).on('click','.jump1',function(){
            return  window.open($(this).attr('src'));
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['500', '95%'], //宽高
                //shadeClose: true, //开启遮罩关闭
                // end: function (index, layero) {
                //     return false;
                // },
                content: '<div><img   src="' + $(this).attr('src') + '" /></div>'
                //content: '<div style="text-align:center"><img width="500" height="600"  src="' + $(this).attr('src') + '" /></div>'
            });
        });
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
        var curr=$(".layui-laypage-em").next().html(); //当前页码值
        if (layEvent === 'del') { //删除
            layer.confirm('确定删除此用户？', { icon: 3, title: '提示信息' }, function (index) {
                console.log(data);
                var dataid=data.id;
                $.ajax({
                    type: "post",
                    url: '/index.php/admin/buyer/del_buyno/id/'+dataid+'',
                    data: {
                        'id':dataid
                    },
                    dataType: "json",
                    async:true,
                    success:function(data) {
                        if(data.code == 1){
                            layer.msg(data.msg, {icon: 1},function () {
                                // layui.layer.closeAll();

                                // parent.window.location.reload();
                                // 搜索条件
                                var name = $("input[name=name]").val(); //姓名
                                var phone = $("input[name=phone]").val(); //手机号
                                var state = $('#state1 option:selected').val(); //状态
                                var userphone = $("input[name=userphone]").val(); //买手号码
                                var alipayname = $("input[name=alipayname]").val(); //支付宝姓名
                                var detail_address = $("input[name=detail_address]").val(); //收货地址
                                var wangwang = $("input[name=wangwang]").val(); //旺旺号
                                var username = $("input[name=username]").val(); //用户名
                                var qq = $("input[name=qq]").val(); //QQ号
                                parent.layui.table.reload('userListTable', {
                                    method: 'post'
                                    , where: {
                                        'name': name, //姓名
                                        'phone': phone,  //收货人手机号码
                                        'userphone': userphone,  //买手号码
                                        'alipayname': alipayname, //支付宝姓名
                                        'detail_address': detail_address, //收货地址
                                        'wangwang': wangwang, //旺旺号
                                        'state': state, //状态
                                        'username': username, //用户名
                                        'qq': qq, //QQ号
                                    }
                                    , page: {
                                        curr: curr
                                    }
                                });
                                setTimeout(function () {
                                    parent.layui.layer.closeAll();
                                    //parent.window.document.getElementsByClassName("layui-layer-shade")[0].remove();
                                    // parent.window.document.getElementsByClassName("layui-layer")[0].remove();
                                    //top.layer.close(index);
                                    top.layer.msg("操作成功！");

                                }, 500);
                                return false;
                            });
                        }else{
                            layer.msg(data.msg, {icon: 2});
                            //layer.msg('删除失败', {icon: 2});
                        }
                    }
                });
                // tableIns.reload();
                // layer.close(index);
            });
        }else if(layEvent === 'examine') {
            examine(data)
        }else if(layEvent === 'edit') {
            maihaobianji(data)
        }else if(layEvent === 'select'){
            select(data)
        } else if (layEvent === 'editstar') {//提现
            editstar(data)
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
        //弹出loading 加载
        var index = top.layer.msg('数据提交中，请稍候', { icon: 16, time: false, shade: 0.8 });
        var name = field.name;  //姓名
        var phone = field.phone;  //收货人号码
        var userphone = field.userphone; //买手号码
        var wangwang = field.wangwang; //旺旺号
        var state = field.state; //状态
        var alipayname = field.alipayname; //支付宝姓名
        var username = field.username;  //用户名
        var qq = field.qq;  //QQ号
        var tjuser = field.tjuser;  //QQ号

        var detail_address = field.detail_address; //收货地址
        table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                  name: name    //姓名
                ,phone:phone   //收货人手机号码
                ,userphone:userphone   //买手号码
                , alipayname: alipayname    //支付宝姓名
                , detail_address: detail_address    //收货地址
                , wangwang: wangwang  //旺旺号
                // , address: address  //地址
                , state: state //状态
                , username: username //用户名
                , qq: qq //QQ号
                ,tjuser:tjuser
            }
        })
        setTimeout(function () {
            top.layer.close(index);
            top.layer.msg("搜索成功！");
        }, 500);
        return false;
    })
    function editstar(edit) {
        layui.layer.open({
            type: 2,
            content: "editbuynostar.html",
            area: ['900px', '650px'],
            title: '改星级',
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
    function select(edit) {
        console.log("123123");
        layui.layer.open({
            type: 2,
            content: "select.html",
            area: ['900px', '500px'],
            title: '查看',
            shadeClose: true,
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                //审核模态框中需要数据
                //因为名字我不知道 就简单写了两个 模仿即可
                if(edit){
                    console.log(body,1111111111111);

                    console.log(edit,1111111111111);
                    body.find(".img1").html("<img class='layui-col-xs3' src="+edit.idcardimg+" >");
                    console.log(edit.ipimg);
                    body.find(".value1").val(edit.ipimg);
                }
                setTimeout(function(){
                    layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
    }
    function examine(edit) {
        layui.layer.open({
            type: 2,
            content: "examine.html",
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
})
