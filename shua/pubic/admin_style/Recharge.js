layui.use(['form', 'layer', 'table', 'laytpl', 'laydate'], function () {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;
    laydate = layui.laydate;
    var num1 = function (d) {
        if(d.num1>=0){
            return `<div class="text-success">1</div>`
        }else{
            return `<div class="text-danger">-1</div>`
        }
    }
    var num2 = function (d) {
        return `<div class="text-danger">接单银锭冻结 （93395198867931136）</div>`
    }

    var type = function (d) {
        return '<p class="p2">'+d.recharge_type+d.type+'</p>';
    };

    var pay_type = function (d) {
        return '<p class="p2">'+d.pay_type+'</p>';
    };
    var picUrl = function (d) {
        if(d.pic_url)
        return '<img class="jump" src="'+d.pic_url+'" style="height: 170px; width: 200px;" >';
        else
        return '';
    };

    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url: '/index.php/admin/finance/Recharge',
        method:'post', //默认是get
        cellMinWidth: 60,
        page: true,
        limits: [10, 15, 20, 25,500,3000,5000],
        limit: 10,
        totalRow: true,
        id: "userListTable",
        cols: [[
            { field: 'id', title: '序号', width: 80,  align: "center" , totalRowText: '合计行' },
            { field: 'number', title: '充值编号', Width: 90, align: "center" },
            { field: 'name', title: '用户名', Width: 90, align: "center" },
            { field: 'mobile', title: '手机号', Width: 90, align: "center" },
            { field: 'qq', title: 'qq', Width: 90, align: "center" },
            { field: 'user_type', title: '用户身份', Width: 90, align: "center" },
            { field: 'recharge_type', title: '类型/用途', Width: 90, align: "center" , templet:type},
            { field: 'pay_type', title: '支付方式', Width: 90, align: "center" , templet:pay_type},

            //{ field: 'type', title: '用途', width: 90, align: "center"},
            { field: 'price', title: '金额', Width: 250, align: "center" , totalRow: true},
            { field: 'state', title: '状态', Width: 250, align: "center" },
            { field: 'create_time', title: '时间', Width: 70, align: "center" },
            { field: 'pic_url', title: '转账截图',  minWidth: 100, height: 315, align: "center",templet:picUrl },
            { title: '操作', minWidth: 100, templet: '#userListBar', fixed: "right", align: "center" }
        ]]
    });

    //列表操作
    table.on('tool(userList)', function (obj) {
        var layEvent = obj.event,
            data = obj.data;
        if (layEvent === 'del') { //删除
            layer.confirm('确定删除？', { icon: 3, title: '提示信息' }, function (index) {
                // $.get("删除文章接口",{
                //     newsId : data.newsId  //将需要删除的newsId作为参数传入
                // },function(data){
                obj.del();
                layer.close(index);
                $.post("/index.php/admin/finance/Recharge_delete",{id:obj.data.id,type:1},function (res) {
                    return  layer.msg(res.msg);
                })
                tableIns.reload();
                layer.close(index);
                // })
            });
        }else if(layEvent === 'examine'){
            examine(data)
        }
    });
    function examine(edit) {
        console.log(edit)
        layui.layer.open({
            type: 2,
            content:"/index.php/admin/finance/examine_recharge/id/"+edit.id+'/type/'+1,
            area: ['900px', '300px'],
            title: '违规备注',
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


    layui.use('layer', function(){
        var $ = layui.jquery, layer = layui.layer;
        $(document).on('click','.jump',function(){
            return  window.open($(this).attr('src'));
        });
    });

    //申请时间
    var date2 = laydate.render({
        elem: '#application-Time'
        , type: 'datetime'
        , range: true
        , format: 'yyyyMMdd'
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
        console.log(field)
        //弹出loading 加载
        var index = top.layer.msg('数据提交中，请稍候', { icon: 16, time: false, shade: 0.8 });
        //第一种获取方法
        var name = $(".name").val(); //名字
        var phone = $(".phone").val(); //手机号
        //第二种
        var logType = field.logType;
        var time = field.time;
        var currencyType = field.currencyType;
        var transactionType = field.transactionType;
        var account = field.account; //账户
        var username = field.username; //用户名
        var qq = field.qq; //qq
        var number = field.number; //编号

        var pay_type = field.pay_type; //充值状态
        table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                  name: name    //姓名
                , phone: phone  //手机号
                , time:time
                , logType: logType  //状态
                , account: account  //账户
                , currencyType: currencyType //货币类型
                , userType: transactionType  //充值状态
                , pay_type: pay_type  //用户身份
                , username: username  //用名
                , qq: qq  //qq
                , number: number  //qq

            }
        })
        setTimeout(function () {
            top.layer.close(index);
            top.layer.msg("搜索成功！");
        }, 500);
        return false;
    })
})
