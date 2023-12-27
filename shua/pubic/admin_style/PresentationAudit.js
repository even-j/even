layui.use(['form', 'layer', 'table', 'laytpl', 'laydate'], function () {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;
        laydate = layui.laydate;
    var num2 = function (d) {
        console.log(d.uid.type)
        if(d.pay_type==1)
        return `<div class="">银行:<span class="yinhang">`+d.bank_name+`</span></div>
        <div class="text-warning">银行卡号:<span>`+d.bank_number+`</span></div>
        <div class="text-info">姓名:<span>`+d.bank_seller+`</span></div>`;
        if(d.pay_type==2)
            return `<div class="">支付宝:<span class="yinhang">`+d.zfb+`</span></div>`;

    };
    var num3 = function (d) {
        return `<div class="text-success">申请金额:<span>`+d.price+`元</span></div>
        <div class="text-warning">手续费:<span>`+d.poundage+`元</span></div>
        <div class="text-danger">转账金额:<span>`+d.toaccount+`元</span></div>`;
    };
    var userListBar = function (d) {
        if(d.state!=0){
            return `<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="see" style="color: #ffffff!important;">查看</a>`;
        }else{
            return `<a class="layui-btn layui-btn-xs layui-btn-normal" lay-event="see" style="color: #ffffff!important;">待审核</a>`;
        }
    }
    var newsStatus = function (d) {
        if(d.state==0) {
            return '<p class="p2" style="color: #ccc">待审核</p>';
        }else if(d.state==1){
            return '<p class="p2" style="color: green">已审核待转账</p>';
        }else if(d.state==2){
            return '<p class="p2" style="color: red">拒绝</p>';
        }else if(d.state==3){
            return '<p class="p2" style="color: orange">转账成功</p>';
        }else{
            return '<p class="p2">未知</p>';
        }
    }
    var remarks = function (d) {
        return `<div class="">`+d.uid.username+` 提取`+d.price+d.type+`,即现金`+d.toaccount+`元</div>`;
    }
    var phone = function (d) {
        return `<div>`+d.uid.username+`
   <div class="text-warning">手机号:<span>`+d.uid.mobile+`</span></div>
   </div>`;
    }
    var user_type = function (d) {
        return `<div class="">`+d.uid.type+`</div>`;
    }
    var tjuser = function (d) {
        return `<div class="">`+d.uid.tjuser+`</div>`;
    }
    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url: "/index.php/admin/finance/PresentationAudit",
        method:'post', //默认是get
        toolbar: '#toolbarDemo',
        page: true,
        limits: [ 10, 15, 20, 25],
        limit: 10,
        height: "full-125",
        id: "userListTable",
        /*done: function (res, curr, count) {
            count || this.elem.next('.layui-table-view').find('.layui-table-header').css('overflow', 'auto');
            layui.each($('select'), function (index, item) {
                var elem = $(item);
                elem.val(elem.data('value')).parents('div.layui-table-cell').css('overflow', 'visible');
            });
            // form.render();
        },*/
        cols: [[
            { type: "checkbox",width:50},
            { field: 'id', title: 'ID' , align: "center",width:50},
            { field: 'type', title: '类型', align: "center" ,width:80},
            { field: 'user_type', title: '用户类型',align: "center", templet:user_type,width:100},
            { field: 'phone', title: '用户名/手机号',align: "center", templet:phone,width:100},
            { field: 'tjuser', title: '来源ID',align: "center", templet:tjuser,width:100},
            { field: 'create_time', title: '时间',align: "center" ,width:100},
            // { field: 'price', title: '收款',align: "center" ,width:150},
            { field: 'collectionNumber', title: '收款账号', align: "center", templet:num2 ,width:300},
            { field: 'moneyInformation', title: '金额信息', align: "center", templet:num3 ,width:200},
            { field: 'memo', title: '备注', align: "center" ,width:300 ,templet:remarks},
            { field: 'newsStatus', title: '状态', align: 'center',templet: newsStatus,width:150},
            { title: '操作', templet: userListBar, align: "center",width:150}
        ]]
    });

    //批量审核
    $('body').on('click','.examineAll_btn',function(){
        var checkStatus = table.checkStatus('userListTable'); //idTest 即为基础参数 id 对应的值
        var curr=$(".layui-laypage-em").next().html(); //当前页码值
        $.post("/index.php/admin/finance/allCheck",{data:checkStatus.data},function (res) {
            return  layer.msg(res.msg,{},function () {
                // 搜索条件
                var name = $("input[name=name]").val(); //姓名
                var time = $("input[name=time]").val(); //时间
                var phone = $("input[name=phone]").val(); //手机号
                var state = $("input[name=state]").val(); //状态
                var type = $("input[name=type]").val(); //身份
                var account = $("input[name=account]").val(); //账户
                var bank_seller = $("input[name=bank_seller]").val(); //开户人
                table.reload('userListTable', {
                    method: 'post'
                    , where: {
                        'name': name, //姓名
                        'time': time,  //时间
                        'phone': phone, //手机号
                        'state': state, //状态
                        'type': type, //身份
                        'account': account, //账户
                        'bank_seller': bank_seller, //开户人
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
    $('body').on('click','.refundsALL_btn',function(){
        var checkStatus = table.checkStatus('userListTable'); //idTest 即为基础参数 id 对应的值
        var curr=$(".layui-laypage-em").next().html(); //当前页码值
        $.post("/index.php/admin/finance/confirmPaymentAll",{data:checkStatus.data},function (res) {
            return  layer.msg(res.msg,{},function () {
                // 搜索条件
                var name = $("input[name=name]").val(); //姓名
                var time = $("input[name=time]").val(); //时间
                var phone = $("input[name=phone]").val(); //手机号
                var state = $("input[name=state]").val(); //状态
                var type = $("input[name=type]").val(); //身份
                var account = $("input[name=account]").val(); //账户
                var bank_seller = $("input[name=bank_seller]").val(); //开户人
                table.reload('userListTable', {
                    method: 'post'
                    , where: {
                        'name': name, //姓名
                        'time': time,  //时间
                        'phone': phone, //手机号
                        'state': state, //状态
                        'type': type, //身份
                        'account': account, //账户
                        'bank_seller': bank_seller, //开户人
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


    //列表操作
    table.on('tool(userList)', function (obj) {
        var layEvent = obj.event,
            data = obj.data;
        if (layEvent === 'see') { //查看
            edit(data)
        }
    });


    //申请时间
    var date2 = laydate.render({
        elem: '#application-Time'
        , type: 'datetime'
        , range: true
        , format: 'yyyy-MM-dd HH:mm:ss'

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
        var name = $(".name").val(); //名字
        var phone = $(".phone").val(); //手机号
        //第二种
        var time = field.time;  //时间
        var state = field.state; //状态 默认全部选中 请自行更改html
        var type = field.type;
        var account = field.account; //账户
        var bank_seller = field.bank_seller; //开户人
        // $.post('/index.php/admin/finance/PresentationAudit',field,function (res) {
        //     console.log(res);return ;
        // })
        table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                  name: name    //姓名
                , time: time    //时间
                , phone: phone  //手机号
                , state: state  //状态
                , type: type  //身份
                , account: account  //账户
                , bank_seller: bank_seller  //开户人
            }
        })
        setTimeout(function () {
           // top.layer.close(index);
            top.layer.msg("搜索成功！");
        }, 500);
        return false;
    })
    function edit(edit) {
		layui.layer.open({
			type: 2,
            content: "/index.php/admin/finance/addCommissionRate/id/"+edit.id+'/user_type/'+edit.uid.type,
			area: ['800px', '550px'],
			title: '提现信息',
			success: function (layero, index) {
				var body = layui.layer.getChildFrame('body', index);
				if (edit) {
                    body.find(".yhm").text(edit.newsName);
                    body.find(".sqje").text(edit.newsName);
                    body.find(".sxf").text(edit.newsName);
                    body.find(".zz").text(edit.newsName);
                    body.find(".bjtx").text(edit.newsName);
                    body.find(".sszh").text(edit.newsName);
                    body.find(".yinhang").text(edit.newsName);
                    body.find(".yhkh").text(edit.newsName);
                    body.find(".xm").text(edit.newsName);
                    body.find(".bz").text(edit.newsName);
				}
				setTimeout(function () {
					layui.layer.tips('点击此处返回', '.layui-layer-setwin .layui-layer-close', {
						tips: 3
					});
				}, 500)
			}
		})
	}
})
