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
        if(wg===undefined){
            wg='---'
        }
        return '<span clas="wgbz">'+wg+'</span>';
    };

    var sellername = function (d) {
        return '<p class="p2">'+d.seller_info.seller_name+'</p>';
    };
    var shopname = function (d) {
        return '<span class="p2">' + d.shop.shop_name + '</span>';
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

    var express = function (d) {
        return '<p class="p2">'+d.delivery+`:`+d.delivery_num+'</p>';
    };
    var commission = function (d) {
        return '<p class="p2">'+d.commission+`+`+d.user_divided+'</p>';
    };
    var userListBar = function (d) {
        if(d.state!="买家已付款，待打印快递单"){
            return `<a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="setTop">查 看</a>`
        }else{
            return `<a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="setTop">查 看</a>
            <a class="layui-btn layui-btn-xs" lay-event="operation">修改单号</a>
            <a class="layui-btn layui-btn-xs" lay-event="operation1">修改淘宝单号</a>

`;
        }

    }

    var sellertjure = function (d) {
        return '<p class="p2">'+d.seller_info.tjuser+'</p>';
    };

    var buytjure = function (d) {
        return '<p class="p2">'+d.user_info.tjuser+'</p>';
    };

    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url: '/index.php/admin/task/PlatformCounterpayment',
        method:'post',
        toolbar: '#toolbarDemo',
        //cellMinWidth: 95,
        page: true,
        //height: "full-125",
        limits: [10, 15, 20, 25],
        limit: 20,
        id: "userListTable",
        // done: function (res, curr, count) {
        //     count || this.elem.next('.layui-table-view').find('.layui-table-header').css('overflow', 'auto');
        //     // layui.each($('select'), function (index, item) {
        //     //     var elem = $(item);
        //     //     elem.val(elem.data('value')).parents('div.layui-table-cell').css('overflow', 'visible');
        //     // });
        //     // form.render();
        // },
        //size: 'lg',
        cols: [[
            // {type: 'checkbox', fixed: 'left'},
            { field: 'task_number', title: '任务编号', width: 150, align: "center" },
            { field: 'create_time', title: '领取时间', minWidth: 50, width: 100, align: "center" },
            { field: 'table_order_id', title: '淘宝单号', minWidth: 50, width: 100, align: "center" },
            { field: 'delivery_num', title: '快递单号', minWidth: 55, width: 100, align: "center" ,templet:express },
           // { field: 'delivery', title: '快递公司', minWidth: 55, width: 100, align: "center" },
            { field: 'terminal', title: '平台终端', minWidth: 50, width: 100, align: "center" },
            { field: 'oneyInformation', title: '卖家用户名', minWidth: 50, width: 100, align: "center",templet:sellername },
            { field: 'oneyInformation', title: '卖家来源ID', minWidth: 50, width: 100, align: "center",templet:sellertjure },

            { field: 'collection', title: '卖家店铺名', minWidth: 50, width: 100, align: "center",templet: shopname },
            { field: 'shop_name', title: '发货人', minWidth: 50, width: 100, align: "center" },
            // { field: 'collectionNumber', title: '卖家旺旺号', minWidth: 50, width: 100, align: "center",templet: sellerwangwang },
            { field: 'newsTime', title: '买家用户名', minWidth: 50, width: 100, align: "center",templet: buyname },
            { field: 'newsTime', title: '买家来源ID', minWidth: 50, width: 100, align: "center",templet: buytjure },

            { field: 'remarks', title: '买家旺旺号', minWidth: 50, width: 100, align: "center" ,templet: buywangwang},
            { field: 'shipping_address', title: '发货地址', minWidth: 50, width: 100, align: "center" },
            { field: 'principal', title: '本金', minWidth: 50, width: 50, align: "center" },
            { field: 'commission', title: '佣金', minWidth: 50, width: 150, align: "center" ,templet: commission},
            { field: 'user_principal', title: '实付金额', minWidth: 50, width: 50, align: "center" },
            { field: 'state', title: '订单状态', minWidth: 50, width: 80, align: "center" },
            { field: 'delivery_state', title: '发货状态', minWidth: 50, width: 80, align: "center" },
            { title: '操作', minWidth: 100, width: 180, templet: userListBar, fixed: "right", align: "center" }
        ]]
    });

    // $('body').on('click','#daoru',function(){
    upload.render({ //允许上传的文件后缀
        elem: '#daoru'
        ,url: '/index.php/admin/task/import'
        ,accept: 'file' //普通文件
        ,exts: 'xls' //只允许上传压缩文件
        ,done: function(res){
            if(res.code==1){
                layer.msg(res.msg,{icon:1,time:3000},function () {
                  window.location.reload()
                });

            }else {
                return  layer.msg(res.msg,{icon:2});
            }
        }
      })
    // });


      $('.delAll_btn').click(function(obj){

        var checkStatus = table.checkStatus('userListTable'); //idTest 即为基础参数 id 对应的值

        console.log(checkStatus.data) //获取选中行的数据
console.log(checkStatus.data.length) //获取选中行数量，可作为是否有选中行的条件
console.log(checkStatus.isAll ) //表格是否全选
    });
    //列表操作
    table.on('tool(userList)', function (obj) {
        var that = this;
        var layEvent = obj.event,
            data = obj.data;
        if (layEvent === 'setTop') { //银锭
            setTop(data.id)
        }else if (layEvent === 'operation') { //银锭
            operation(data.id)
        }
        else if (layEvent === 'operation1') { //银锭
            operation1(data.id)
        }
    });
    //申请时间1
    var date2 = laydate.render({
        elem: '#application-Time'
        , type: 'datetime'
        , range: true
        , format: 'yyyyMMdd'
    })

    $('.delAll_btn').click(function(){
        layui.layer.open({
            type: 2,
            content: "addBuyer.html",
            area: ['800px', '500px'],
            title: '新增买家',
        })
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
        //第一种获取方法
        var id = $(".id").val(); //任务编号
        var wwid = $(".wwid").val(); //旺旺ID
        //第二种
        var time = field.time;  //接单时间
        var state = field.state; //状态
        var username = field.username; //状态
        var table_order_id = field.table_order_id; //状态

        table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                id: id    //任务编号
                , wwid: wwid  //旺旺ID
                , state: state  //状态
                , time: time  //接单时间
                , username: username  //接单时间
                ,table_order_id:table_order_id
            }
        })
        setTimeout(function () {
            top.layer.close(index);
            top.layer.msg("搜索成功！");
        }, 500);
        return false;
    });

    function setTop(id) {
        var index = layui.layer.open({
            type: 2,
            content: "/index.php/admin/task/selectPlatformCounterpayment/id/"+id,
            area: ['80%', '80%'],
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


    function operation(id) {
        layui.layer.open({
            type: 2,
            content:"/index.php/admin/task/operation/id/"+id,
            area: ['80%', '300px'],
            title: '修改单号',
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

    function operation1(id) {
        layui.layer.open({
            type: 2,
            content:"/index.php/admin/task/operation1/id/"+id,
            area: ['80%', '300px'],
            title: '修改淘宝单号',
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
