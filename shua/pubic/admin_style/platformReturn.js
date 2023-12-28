layui.use(['form', 'layer', 'table', 'laytpl', 'laydate', 'upload'], function () {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table,
        upload = layui.upload;
    laydate = layui.laydate;
    var tplImg1 = function (d) {
        return '<img class="jump" src="' + d.chatimg + '"  >';
    };
    var tplImg2 = function (d) {
        return '<img class="jump" src="' + d.order_detail_img + '"  >';
    };
    var tplImg3 = function (d) {
        return '<img class="jump" src="' + d.high_praise_img + '"  >';
    };

    var sellername = function (d) {
        return '<p class="p2">'+d.seller_info.seller_name+'</p>';
    };
    var shopname = function (d) {
        return '<p class="p2">' + d.shop.shop_name + '</p>';
    }
    var sellerwangwang = function (d) {
        return '<p class="p2">' + d.shop.wangwang + '</p>';
    }
    var buyname = function (d) {
        return '<p class="p2">' + d.user_info.username + '</p>';
    }
    var buywangwang = function (d) {
        return '<p class="p2">' + d.user_buyno_wangwang + '</p>';
    }
    var commission = function (d) {
        return '<p class="p2">'+d.commission+`+`+d.user_divided+'</p>';
    };
    var principal = function (d) {
        if(d.principal==d.seller_principal&&d.seller_principal==d.user_principal){
            return '<p>' + d.principal + '</p>';
        }else{
            return '<p style="color: red">' + d.principal + '</p>';
        }
    };
    var seller_principal = function (d) {
        if(d.principal==d.seller_principal&&d.seller_principal==d.user_principal){
            return '<p class="p2">' + d.seller_principal + '</p>';
        }else{
            return '<p style="color: red">' + d.seller_principal + '</p>';
        }
    };
    var user_principal = function (d) {
        if(d.principal==d.seller_principal&&d.seller_principal==d.user_principal){
            return '<p class="p2">' + d.user_principal + '</p>';
        }else{
            return '<p style="color: red">' + d.user_principal + '</p>';
        }
    };
    var userListBar = function (d) {
        if(d.state!="买手已确认收货，待返款"){
            return `<a class="layui-btn layui-btn-xs" lay-event="see">查 看</a>`;
        }else{
            if(d.is_ys==0){
                return `<a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="setTop">返款</a><a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="Regression">回退到待收货</a><a class="layui-btn layui-btn-xs" lay-event="see">查 看</a>`;
            }else{
                if(d.ok_yf==0 && d.ok_wk==0){
                    return `<a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="setTop1">预付返款</a><a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="setTop2">尾款返款</a><a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="Regression">回退到待收货</a><a class="layui-btn layui-btn-xs" lay-event="see">查 看</a>`;
                }else if(d.ok_yf==0){
                    return `<a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="setTop1">预付返款</a><a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="Regression">回退到待收货</a><a class="layui-btn layui-btn-xs" lay-event="see">查 看</a>`;
                }else if(d.ok_wk==0){
                    return `<a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="setTop2">尾款返款</a><a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="Regression">回退到待收货</a><a class="layui-btn layui-btn-xs" lay-event="see">查 看</a>`;
                }
                return `<a class="layui-btn layui-btn-xs" lay-event="see">查 看</a>`;
            }


        }
    }

    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url: '/index.php/admin/task/platformReturn',
        method:'post',
        toolbar: '#toolbarDemo',
        //cellMinWidth: 95,
        page: true,
        //height: "full-125",
        limits: [10, 15, 20, 25],
        limit: 20,
        id: "userListTable",
        cols: [[
            { type: 'checkbox' },
            { field: 'task_number', title: '任务编号', width: 90, align: "center" },
            { field: 'type', title: '卖家用户名', minWidth: 50, width: 100, align: "center",templet:sellername },
            { field: 'userType', title: '卖家店铺', minWidth: 55, width: 100, align: "center",templet: shopname },
            { field: 'phone', title: '买家用户名', minWidth: 50, width: 100, align: "center",templet:buyname },
            { field: 'oneyInformation', title: '买家旺旺号', minWidth: 50, width: 100, align: "center" ,templet: buywangwang },
            { field: 'collection', title: '聊天记录截图',width: 100, align: "center", templet: tplImg1 },
            { field: 'collectionNumber', title: '订单信息截图', minWidth: 50, width: 100, align: "center", templet: tplImg2 },
            { field: 'newsTime', title: '好评截图', minWidth: 50, width: 100, align: "center", templet: tplImg3 },
            { field: 'principal', title: '本金', minWidth: 50, width: 100, align: "center",templet: principal },
            { field: 'seller_principal', title: '返款金额', minWidth: 50, width: 100, align: "center" ,templet: seller_principal},
            { field: 'user_principal', title: '实付金额', minWidth: 50, width: 100, align: "center" ,templet: user_principal},
            { field: 'commission', title: '佣金', minWidth: 50, width: 150, align: "center" ,templet: commission},
            { field: 'high_praise_time', title: '确认收货时间', minWidth: 50, width: 80, align: "center" },
            { field: 'task_time', title: '发布时间', minWidth: 50, width: 80, align: "center" },
            { field: 'create_time', title: '领取时间', minWidth: 50, width: 80, align: "center" },
            { field: 'state', title: '订单状态', minWidth: 50, width: 100, align: "center" },
            // { field: 'delivery_state', title: '发货状态', minWidth: 50, width: 100, align: "center" },
            { title: '操作', minWidth: 100, width: 200, templet: userListBar, fixed: "right", align: "center" }
        ]]
    });
    layui.use('layer', function(){
        var $ = layui.jquery, layer = layui.layer;
        $(document).on('click','.jump',function(){
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
    upload.render({ //允许上传的文件后缀
        elem: '#daoru'
        , url: '/upload/'
        , accept: 'file' //普通文件
        , exts: 'xls' //只允许上传压缩文件
        , done: function (res) {
            console.log(res)
        }
    });
    //列表操作
    table.on('tool(userList)', function (obj) {
        var that = this;
        var curr=$(".layui-laypage-em").next().html(); //当前页码值
        var layEvent = obj.event,
            data = obj.data;
        if (layEvent === 'setTop') { //返款
            layer.confirm('确认返款?', function(index){
            $.post("/index.php/admin/task/returnPay",{id:data.id},function (res) {
                return  layer.msg(res.msg,{},function () {
                    // 搜索条件
                    var task_number = $("input[name=task_number]").val(); //任务编号
                    var wangwang = $("input[name=wangwang]").val(); //买家旺旺ID
                    var state = $("input[name=state]").val(); //状态
                    var shopname = $("input[name=shopname]").val(); //卖家店铺名
                    var delivery_state = $("input[name=delivery_state]").val(); //发货状态
                    var time = $("input[name=time]").val(); //接单时间
                    table.reload('userListTable', {
                        method: 'post'
                        , where: {
                            'task_number': task_number, //任务编号
                            'wangwang': wangwang,  //买家旺旺ID
                            'state': state, //状态
                            'shopname': shopname, //卖家店铺名
                            'time': time, //接单时间
                            'delivery_state': delivery_state, //发货状态
                        }
                        , page: {
                            curr: curr
                        }
                    });
                    setTimeout(function () {
                        top.layer.close(index);
                        top.layer.msg("操作成功！");
                    }, 500);
                    return false;
                })
            });
            })

        }else   if (layEvent === 'setTop1') { //返款
            layer.confirm('确认返款?', function(index){
                $.post("/index.php/admin/task/returnys",{id:data.id,type:1},function (res) {
                    return  layer.msg(res.msg,{},function () {
                        // 搜索条件
                        var task_number = $("input[name=task_number]").val(); //任务编号
                        var wangwang = $("input[name=wangwang]").val(); //买家旺旺ID
                        var shopname = $("input[name=shopname]").val(); //卖家店铺名
                        var state = $('#state1 option:selected').val(); //状态
                        var time = $("input[name=time]").val(); //接单时间
                        var delivery_state = $("input[name=delivery_state]").val(); //发货状态
                        table.reload('userListTable', {
                            method: 'post'
                            , where: {
                                'task_number': task_number, //任务编号
                                'wangwang': wangwang,    //买家旺旺ID
                                'state': state, //状态
                                'shopname': shopname, //卖家店铺名
                                'time': time, //接单时间
                                'delivery_state': delivery_state, //发货状态
                            }
                            , page: {
                                curr: 1
                            }
                        });
                        setTimeout(function () {
                            //top.layer.close(index);
                            top.layer.msg("操作成功！");
                        }, 500);
                        return false;

                        window.location.reload();
                    })
                });
            })

        }else if (layEvent === 'setTop2') { //返款
            layer.confirm('确认返款?', function(index){
                $.post("/index.php/admin/task/returnys",{id:data.id,type:2},function (res) {
                    return  layer.msg(res.msg,{},function () {
                        // 搜索条件
                        var task_number = $("input[name=task_number]").val(); //任务编号
                        var wangwang = $("input[name=wangwang]").val(); //买家旺旺ID
                        var shopname = $("input[name=shopname]").val(); //卖家店铺名
                        var state = $('#state1 option:selected').val(); //状态
                        var time = $("input[name=time]").val(); //接单时间
                        var delivery_state = $("input[name=delivery_state]").val(); //发货状态
                        table.reload('userListTable', {
                            method: 'post'
                            , where: {
                                'task_number': task_number, //任务编号
                                'wangwang': wangwang,    //买家旺旺ID
                                'state': state, //状态
                                'shopname': shopname, //卖家店铺名
                                'time': time, //接单时间
                                'delivery_state': delivery_state, //发货状态
                            }
                            , page: {
                                curr: 1
                            }
                        });
                        setTimeout(function () {
                            //top.layer.close(index);
                            top.layer.msg("操作成功！");
                        }, 500);
                        return false;

                        window.location.reload();
                    })
                });
            })

        }else if(layEvent === 'see'){
            see(data.id)
        }else if(layEvent === 'Regression'){
            Regression(data.id)
        }
    });
    //申请时间1
    var date2 = laydate.render({
        elem: '#application-Time'
        , type: 'datetime'
        , range: true
        , format: 'yyyyMMdd'
    })
/*
    var date22 = laydate.render({
        elem: '#application-Time1'
        , type: 'datetime'
        , range: true
        , format: 'yyyyMMdd'
    })*/
//批量发货
    $('body').on('click','.delAll_btn',function(){
        var checkStatus = table.checkStatus('userListTable'); //idTest 即为基础参数 id 对应的值
        var curr=$(".layui-laypage-em").next().html(); //当前页码值
        var data=checkStatus.data
        var ids=[];
        for (var i = 0; i < data.length; i++) {
            ids += data[i].id + ',';
        }
        ids = ids.substr(0, ids.length-1);
        $.post("/index.php/admin/task/allDelivery",{ids:ids},function (res) {
            return  layer.msg(res.msg,{},function () {
                // 搜索条件
                var task_number = $("input[name=task_number]").val(); //任务编号
                var wangwang = $("input[name=wangwang]").val(); //买家旺旺ID
                var state = $("input[name=state]").val(); //状态
                var shopname = $("input[name=shopname]").val(); //卖家店铺名
                var delivery_state = $("input[name=delivery_state]").val(); //发货状态
                var time = $("input[name=time]").val(); //接单时间
                table.reload('userListTable', {
                    method: 'post'
                    , where: {
                        'task_number': task_number, //任务编号
                        'wangwang': wangwang,  //买家旺旺ID
                        'state': state, //状态
                        'shopname': shopname, //卖家店铺名
                        'time': time, //接单时间
                        'delivery_state': delivery_state, //发货状态
                    }
                    , page: {
                        curr: curr
                    }
                });
                setTimeout(function () {
                    top.layer.close(index);
                    top.layer.msg("操作成功！");
                }, 500);
                return false;
            });
        })
    });

    //批量返款
    $('body').on('click','.refundsAll_btn',function(){
         var checkStatus = table.checkStatus('userListTable'); //idTest 即为基础参数 id 对应的值
        var curr=$(".layui-laypage-em").next().html(); //当前页码值
         var data=checkStatus.data
        var ids=[];
        for (var i = 0; i < data.length; i++) {
            ids += data[i].id + ',';
        }
        ids = ids.substr(0, ids.length-1);
        layer.confirm('确定批量返款？', {icon: 3, title: '提示信息'}, function (index) {
        $.post("/index.php/admin/task/returnPayss",{ids:ids},function (res) {
            return  layer.msg(res.msg,{},function () {
                // 搜索条件
                var task_number = $("input[name=task_number]").val(); //任务编号
                var wangwang = $("input[name=wangwang]").val(); //买家旺旺ID
                var state = $("input[name=state]").val(); //状态
                var shopname = $("input[name=shopname]").val(); //卖家店铺名
                var delivery_state = $("input[name=delivery_state]").val(); //发货状态
                var time = $("input[name=time]").val(); //接单时间
                table.reload('userListTable', {
                    method: 'post'
                    , where: {
                        'task_number': task_number, //任务编号
                        'wangwang': wangwang,  //买家旺旺ID
                        'state': state, //状态
                        'shopname': shopname, //卖家店铺名
                        'time': time, //接单时间
                        'delivery_state': delivery_state, //发货状态
                    }
                    , page: {
                        curr: curr
                    }
                });
                setTimeout(function () {
                    top.layer.close(index);
                    top.layer.msg("操作成功！");
                }, 500);
                return false;
            })
        });
        })
    });


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
        console.log(field);
        //弹出loading 加载
        var index = top.layer.msg('数据提交中，请稍候', { icon: 16, time: false, shade: 0.8 });
        //第一种获取方法
        var task_number = field.task_number; //任务编号
        var wangwang = field.wangwang; //买家旺旺
        var shopname = field.shopname; //卖家店铺名
        var time = field.time;  //接单时间
        var state = field.state; //状态
        var delivery_state = field.delivery_state; //发货状态
        table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                task_number: task_number    //任务编号
                , wangwang: wangwang  //买家旺旺ID
                , state: state  //状态
                , shopname: shopname  //卖家店铺名
                , delivery_state: delivery_state  //发货状态
                , time: time  //接单时间
            }
        })
        setTimeout(function () {
            top.layer.close(index);
            top.layer.msg("搜索成功！");
        }, 500);
        return false;
    });
    function tixian() {
        layui.layer.open({
            type: 2,
            content: "tixian.html",
            area: ['900px', '650px'],
            title: '提现',
        })
    }
    function xiaoxi() {
        layui.layer.open({
            type: 2,
            content: "xiaoxi.html",
            area: ['1000px', '650px'],
            title: '消息',
        })
    }
    function bianji(edit) {

        layui.layer.open({
            type: 2,
            content: "bianji.html",
            area: ['80%', '80%'],
            title: '编辑资料',
            success: function (layero, index) {
                var body = layui.layer.getChildFrame('body', index);
                //审核模态框中需要数据
                //因为名字我不知道 就简单写了两个 模仿即可
                if (edit) {
                    var selected1 = '';
                    var selected2 = '';
                    if (edit.newsStatus == 0) {
                        selected1 = 'selected'
                    } else if (edit.newsStatus == 1) {
                        selected2 = 'selected'
                    }
                    body.find(".name").val(edit.newsName);
                    body.find(".phone").val(edit.abstract);
                    body.find(".examine").val(edit.abstract);
                    var optionStr = '<option value="0" ' + selected1 + '>是</option><option value="1" ' + selected2 + '>否</option>';
                    body.find(".vip").append(optionStr);

                }
                setTimeout(function () {
                    layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                }, 500)
            }
        })

    }
    function updatePwd() {
        layui.layer.open({
            type: 2,
            content: "updatePwd.html",
            area: ['80%', '650px'],
            title: '改密码'
        })
    }
    function wgbz() {
        layui.layer.open({
            type: 2,
            content: "wgbz.html",
            area: ['80%', '300px'],
            title: '违规备注'
        })
    }
    function tuijian() {
        layui.layer.open({
            type: 2,
            content: "tuijian.html",
            area: ['80%', '650px'],
            title: '推荐下级'
        })
    }
    function maihao() {
        layui.layer.open({
            type: 2,
            content: "maihao.html",
            area: ['80%', '650px'],
            title: '押金'
        })
    }
    function yajin() {
        layui.layer.open({
            type: 2,
            content: "yajin.html",
            area: ['80%', '650px'],
            title: '押金'
        })
    }
    function see(id) {
        var index = layui.layer.open({
            type: 2,
            content: "/index.php/admin/task/selectPlatformCounterpayment/id/"+id,
            area: ['80%', '750px'],
            title: '接单情况',
            success : function(layero, index){
                setTimeout(function(){
                    layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            },btn: ['确认']
            ,btn2: function(index, layero){
                //按钮【按钮二】的回调
                //return false 开启该代码可禁止点击该按钮关闭
            }
        })
    }
    $('.img-rounded').click(function(){
        var img = $(this).attr('src');
        layer.open({
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['600px', '600px'], //宽高
            shadeClose: true, //开启遮罩关闭
            end: function (index, layero) {
                return false;
            },
            content: '<div style="text-align:center"><img src='+img+' style="width:90%"/></div>'
        });
    })
    function Regression(id) {
        layui.layer.open({
            type: 2,
            content:"/index.php/admin/task/regression/id/"+id,
            area: ['80%', '300px'],
            title: '违规备注',
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                //审核模态框中需要数据
                //因为名字我不知道 就简单写了两个 模仿即可

                setTimeout(function(){
                    layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
    }

})
