layui.use(['form', 'layer', 'table', 'laytpl', 'laydate'], function () {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;
    laydate = layui.laydate;
    var num1 = function (d) {
        return `<div class="text-success">450</div>`
    }
    var num2 = function (d) {
        return `<div class="text-danger">接单银锭冻结 （93395198867931136）</div>`
    }
    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url: '/index.php/admin/finance/MembershipRecords',
        method:'post', //默认是get
        cellMinWidth: 95,
        page: true,
        height: "full-125",
        limits: [10, 15, 20, 25],
        limit: 10,
        id: "userListTable",
        cols: [[
            { field: 'id', title: '序号', width: 70, width: 70, align: "center" },
            { field: 'utype', title: '用户类型', minWidth: 80, width: 70, align: "center" },
            { field: 'name', title: '用户名', minWidth: 90,width: 130, align: "center" },
            { field: 'price', title: '金额', minWidth: 100, width: 130,align: "center" },
            { field: 'remarks', title: '备注', minWidth: 200, align: "center" },
            { field: 'create_time', title: '时间', minWidth: 70, align: "center" },
        ]]
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
            //if(!/^1[3456789]\d{9}$/.test(value)){
            //  return '手机号码有误，请重填';
            //}
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
        var time = field.time;
        var userType = field.userType;
        table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                  name: name    //姓名
                , time:time
                , userType:userType
            }
        })
        setTimeout(function () {
            top.layer.close(index);
            top.layer.msg("搜索成功！");
        }, 500);
        return false;
    })
})
