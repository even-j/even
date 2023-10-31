layui.use(['form', 'layer', 'table', 'laytpl', 'laydate'], function () {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;
    laydate = layui.laydate;

    var memo = function (d) {
        return `<div class="text-danger">`+d.memo+`</div>`;
    }
    var num1 = function (d) {
        if(d.price<0){
            return `<div class="text-danger">`+d.price+`银锭</div>`
        }else{
            return `<div class="text-success">`+d.price+`银锭</div>`
        }

    }
    var num2 = function (d) {
        return `<div class="text-danger">15219元</div>`
    }
    var userType = function (d) {
        return `<div class="text-danger">`+d.uid.type+`</div>`
    }
    var userName = function (d) {
        return `<div class="text-danger">`+d.uid.seller_name+`</div>`
    }
    var num3 = function (d) {
        return `<div class="text-danger">完成任务，返回本金：122.0 （任务编号：102340035482746880-102340174872051712）</div>`
    }
    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url: '/index.php/admin/finance/SellerRewardBalanceRecord',
        method:'post', //默认是get
        toolbar: '#toolbarDemo',
        page: true,
        limits: [10, 15, 20, 25],
        limit: 10,
        id: "userListTable",
        cols: [[
            { field: 'id', title: 'ID', width: 70,  align: "center" },
            { field: 'userName', title: '用户名', minWidth: 90, align: "center" ,templet:userName},
            { field: '1', title: '操作银锭', minWidth: 190, align: "center", templet:num1 },
            { field: 'yprice', title: '变动后', width: 90, align: "center" },
            { field: 'type', title: '财务类型', minWidth: 190, align: "center",},
            { field: '1', title: '备注', minWidth: 190, align: "center", templet:memo },
            { field: 'create_time', title: '时间', align: "center" },

        ]]
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
        var userType = field.userType;

        var account = field.account; //账户
        table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                  name: name    //姓名
                , phone: phone  //手机号
                , logType: logType  //状态
                , userType: userType
                , account: account  //账户
            }
        })
        setTimeout(function () {
            top.layer.close(index);
            top.layer.msg("搜索成功！");
        }, 500);
        return false;
    })
})
