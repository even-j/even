layui.use(['form', 'layer', 'table', 'laytpl', 'laydate', 'upload'], function () {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table,
        upload = layui.upload;
    laydate = layui.laydate;
    var ywc = function (d) {

        return '<p class="p1">已接:'+(d.num-d.complete_num-d.incomplete_num)+'</p> <p class="p2">完成:'+d.complete_num+'</p>';
    };
    var sdl = function (d) {
        return '<p class="p2">'+d.terminal+':'+d.num+'</p>';
    };
    var username = function (d) {
        return '<p class="p2">'+d.seller_id.seller_name+'</p>';
    };
    var tjuser = function (d) {
        return '<p class="p2">'+d.seller_id.tjuser+'</p>';
    };
    var shopname = function (d) {
        return '<p class="p2">'+d.shop_id.shop_name+'</p>';
    };

    var wangwang = function (d) {
        return '<p class="p2">'+d.shop_id.wangwang+'</p>';
    };

    var logistics = function (d) {
        return '<p class="p2">'+d.shop_id.logistics+'</p>';
    };
    var userListBar = function (d) {
        return `
<a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="setTop">详 情</a>
<a class="layui-btn layui-btn-xs" lay-event="jeidan">接单情况</a>
<!--<a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="fangqi">放弃情况</a>-->
<a class="layui-btn layui-btn-xs" lay-event="taskExamine">审核</a>
<!--<a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="Remarks">备注</a>-->
`;
    }
    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url: '/index.php/admin/task/task',
        method:'post',
        toolbar: '#toolbarDemo',
        page: true,
        limits: [10, 15, 20, 25],
        limit: 15,
        id: "userListTable",
        // done: function (res, curr, count) {
        //     count || this.elem.next('.layui-table-view').find('.layui-table-header').css('overflow', 'auto');
            // layui.each($('select'), function (index, item) {
            //     var elem = $(item);
            //     elem.val(elem.data('value')).parents('div.layui-table-cell').css('overflow', 'visible');
            // });
            // form.render();
        // },
        // size: 'lg',
        cols: [[
            {type: 'checkbox', fixed: 'left'},
            { field: 'rand_num', title: '任务id', width: 50, align: "center" },
            { field: 'task_number', title: '任务编号', width: 160, align: "center" },
            { field: 'type', title: '用户名', minWidth: 50, width: 100, align: "center", templet:username },
            { field: 'userType', title: '店铺名', minWidth: 55, width: 80 , templet:shopname},
            { field: 'phone', title: '商家旺旺ID', minWidth: 50, width: 80, templet:wangwang},
            { field: 'task_type', title: '订单类型', minWidth: 50, width: 100, align: "center" },
            { field: 'collection', title: '刷单量', minWidth: 50, width: 80, align: "center", templet:sdl },
            { field: 'collectionNumber', title: '已接/完成', width: 100, align: "center", templet:ywc },
            { field: 'goodss_num', title: '产品数量', minWidth: 50, width: 50, align: "center" },
            { field: 'goods_price', title: '商品售价', minWidth: 50, width: 80, align: "center" },
           // { field: 'is_free_shiping', title: '邮1费', minWidth: 50, width: 50, align: "center"},
            { field: 'publish_time', title: '发布时间', minWidth: 50, width: 150, align: "center" },
            { field: 'task_status', title: '支付状态', minWidth: 50, width: 150, align: "center" },
            { title: '操作', minWidth: 100, width: 180, templet: userListBar, fixed: "right", align: "center" },
            { field: 'task_status', title: '来源用户ID', minWidth: 50, width: 150, align: "center" , templet:tjuser },
        ]]
    });
    upload.render({ //允许上传的文件后缀
        elem: '#daoru'
        ,url: '/upload/'
        ,accept: 'file' //普通文件
        ,exts: 'xls' //只允许上传压缩文件
        ,done: function(res){
            console.log(res)
        }
    });
    //列表操作
    table.on('tool(userList)', function (obj) {
        var that = this;
        var layEvent = obj.event,
            data = obj.data;
        console.log(layEvent)
        if (layEvent === 'setTop') { //详情
            setTop(data.id)
        }else if(layEvent === 'jeidan') {//接单情况
            jeidan(data.id)
        }else if(layEvent === 'fangqi') {//放弃
            fangqi(data.id)
        }else if (layEvent === 'taskExamine') { //审核
            taskExamine(data.id)
        }else if (layEvent === 'Remarks') { //备注
            Remarks(data.id)
        }
    });
    //申请时间1
    var date2 = laydate.render({
        elem: '#application-Time'
        , type: 'datetime'
        , range: true
        , format: 'yyyyMMdd'
    })


    //批量审核
    $('body').on('click','.delAll_btn',function(){
        var checkStatus = table.checkStatus('userListTable'); //idTest 即为基础参数 id 对应的值
        var curr=$(".layui-laypage-em").next().html(); //当前页码值
        var data=checkStatus.data
        var ids=[];
        for (var i = 0; i < data.length; i++) {
            ids += data[i].id + ',';
        }
        ids = ids.substr(0, ids.length-1);
        $.post("/index.php/admin/task/allexamine",{ids:ids},function (res) {

            if(res.code==1){
                layer.msg(res.msg,{icon:1},function () {
                    // 搜索条件
                    var id = $("input[name=id]").val(); //任务编号
                    var wwid = $("input[name=wwid]").val(); //旺旺ID
                    var dpid = $("input[name=dpid]").val(); //店铺ID
                    var state = $("input[name=state]").val(); //状态
                    var task_type = $("input[name=task_type]").val(); //任务类型
                    var time = $("input[name=time]").val(); //接单时间
                    var rand_num = $("input[name=rand_num]").val(); //任务编号id

                    var seller_name = $("input[name=seller_name]").val(); //接单时间
                    table.reload('userListTable', {
                        method: 'post'
                        , where: {
                            'id': id, //任务编号
                            'wwid': wwid,  //旺旺ID
                            'dpid': dpid, //店铺ID
                            'state': state, //状态
                            'task_type': task_type, //任务类型
                            'time': time, //接单时间
                            'rand_num': rand_num, //任务编号id
                            'seller_name': seller_name, //接单时间
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
            }else{
                return  layer.msg(res.msg,{icon:2});
            }
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
        //弹出loading 加载
        var index = top.layer.msg('数据提交中，请稍候', { icon: 16, time: false, shade: 0.8 });
        //第一种获取方法
        var id = $(".id").val(); //任务编号
        var wwid = $(".wwid").val(); //旺旺ID
        //第二种
        var time = field.time;  //接单时间
        var rand_num = field.rand_num;  //任务编号id
        var state = field.state; //状态
        var dpid = field.dpid; //店铺ID
        var task_type = field.task_type; //任务类型
        var seller_name = field.seller_name; //用户名
        table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                id: id    //任务编号
                , wwid: wwid  //旺旺ID
                , dpid: dpid  //店铺ID
                , state: state  //状态
                , task_type: task_type  //任务类型
                , time: time  //接单时间
                , rand_num: rand_num  //任务编号id
                , seller_name: seller_name  //接单时间

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
            title: '编辑资料',

            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                //审核模态框中需要数据
                //因为名字我不知道 就简单写了两个 模仿即可
                if(edit){
                    var selected1 ='';
                    var selected2 ='';
                    if(edit.newsStatus==0){
                        selected1='selected'
                    }else if(edit.newsStatus==1){
                        selected2='selected'
                    }
                    body.find(".name").val(edit.newsName);
                    body.find(".phone").val(edit.abstract);
                    body.find(".examine").val(edit.abstract);
                    var optionStr = '<option value="0" '+selected1+'>是</option><option value="1" '+selected2+'>否</option>';
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
    function setTop(id) {
        var index = layui.layer.open({
            type: 2,
            content:"/index.php/admin/task/xiangqing/id/"+id,
            area: ['80%', '80%'],
            title: '详情',
            success : function(layero, index){
                setTimeout(function(){
                    layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            },btn: ['关闭']
            ,btn2: function(index, layero){
              //按钮【按钮二】的回调
              //return false 开启该代码可禁止点击该按钮关闭
            }
        })
    }
    function Remarks(id){
        layer.prompt({title: '请输入取消备注，并确认',value:"", formType: 0}, function(pass, index){
            var taskid=id;
            $.post("/index.php/admin/task/remarks_task",{id:taskid,key:pass},function (res) {
                if(res.code==0){
                    layer.msg(res.msg,{icon:2,time:1000});
                }else {
                    return  layer.msg(res.msg,{icon:1},function () {
                        window.location.reload()
                    });
                }

            })
            layer.close(index);
        });
    }
    function jeidan(id) {
        var index = layui.layer.open({
            type: 2,
            content: "/index.php/admin/task/jdxq/id/"+id,
            area: ['85%', '600px'],
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
    function fangqi(id) {
        var index = layui.layer.open({
            type: 2,
            content: "/index.php/admin/task/giveUp/id/"+id,
            area: ['80%', '80%'],
            title: '放弃情况',
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
    function taskExamine(id) {
        layui.layer.open({
            type: 2,
            content:"/index.php/admin/task/taskExamine/id/"+id,
            area: ['600px', '50%'],
            title: '任务审核',
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
