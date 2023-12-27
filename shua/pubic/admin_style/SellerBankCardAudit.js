layui.use(['form', 'layer', 'table', 'laytpl', 'laydate'], function () {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;
        laydate = layui.laydate;
    //身份证正面照
    var tplImg = function (d) {
        return '<img class="jump" src="'+d.idcard_img+'" style="height: 170px; width: 200px;" >';
    };

    var username = function (d) {
        return '<p class="p2">'+d.uid.seller_name+'</p>';
    };

    var qq = function (d) {
        return '<p class="p2">'+d.uid.qq+'</p>';
    };

    var sdl = function (d) {
        return '<p class="p2">'+d.terminal+':'+d.num+'</p>';
    };
    //身份证反面照
    var tplImg2 = function (d) {
        return '<img class="jump" src="'+d.idcard_img1+'" style="height: 170px; width: 200px;" >';
    };
    var bank = function (d) {
        return `<div class="text-danger">银行:<span class="yinhang">`+d.bank_id+`</span>(开户城市:`+d.city+`)</div>
        <div class="text-warning">银行卡号:<span>`+d.bank_number+`</span></div>
        <div class="text-info">姓名:<span>`+d.bank_seller+`</span></div>`;
    };
    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url: '/index.php/admin/finance/SellerBankCardAudit',
        toolbar: '#toolbarDemo',
        method:'post', //默认是get
        cellMinWidth: 60,
        page: true,
        height: "full-125",
        limits: [10, 15, 20, 25],
        limit: 10,
        id: "userListTable",
        cols: [[
            { field: 'id', title: '序号', minWidth: 100, align: "center" },
            { field: 'uid', title: '用户名', minWidth: 100, align: "center" ,templet: username},
            { field: 'idcard_img_a', title: '收款账号', minWidth: 100, width: 315, align: "center", templet: bank },
            // { field: 'bank_seller', title: '持卡人', minWidth: 100, align: "center" },
            // { field: 'bank_id', title: '银行名称', minWidth: 100, align: "center" },
            // { field: 'city', title: '开户行城市', minWidth: 165, align: "center" },
            // { field: 'branch_name', title: '开户支行名称', minWidth: 100, align: "center" },
            // { field: 'bank_number', title: '银行卡号', minWidth: 250, align: "center" },

            { field: 'zfb', title: '支付宝', minWidth: 100, width: 315, align: "center" },
            //{ field: 'idcard', title: '证件号码', minWidth: 250, align: "center" },
            { field: 'mobile', title: '手机号码', minWidth: 100, align: "center" },
            { field: 'uid', title: 'QQ', minWidth: 100, align: "center" ,templet: qq},
            //{ field: 'idcard_img_a', title: '身份证正面照', minWidth: 100, height: 315, align: "center", templet: tplImg },
            //{ field: 'idcard_img_1', title: '身份证正面照', minWidth: 100, height: 315, align: "center", templet: tplImg2 },
            { field: 'state', title: '状态', minWidth: 100, fixed: "right", align: "center"},
            { title: '操作', minWidth: 100, templet: '#userListBar', fixed: "right", align: "center" }
        ]]
    });

    layui.use('layer', function(){
        var $ = layui.jquery, layer = layui.layer;
        $(document).on('click','.jump',function(){
            return  window.open($(this).attr('src'));
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['500', '1200'], //宽高
                shadeClose: true, //开启遮罩关闭
                end: function (index, layero) {
                    return false;
                },
                content: '<div style="text-align:center"><img width="300"  src="' + $(this).attr('src') + '" /></div>'
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
                    newsId :  JSON.stringify(newsId) //将需要删除的newsId作为参数传入
                },function(data){
                tableIns.reload();
                layer.close(index);
                })
            })
        } else {
            layer.msg("请选择需要删除的用户");
        }
    })

    function examine(edit) {
        layui.layer.open({
            type: 2,
            content: "wgbz.html",
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
                $.post("/index.php/admin/finance/bank_del",{id:obj.data.id,type:1},function (res) {
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
            content:"/index.php/admin/finance/examine/id/"+edit.id+'/type/'+1,
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
        //第一种获取方法
        var name = $(".name").val(); //名字
        var phone = $(".phone").val(); //手机号
        //第二种
        var time = field.time;  //时间
        var state = field.state; //状态 默认全部选中 请自行更改html
        var account = field.account; //账户
        var bank_number = field.bank_number; //卡号
        var bank_seller = field.bank_seller; //开户人
        var qq = field.qq; //QQ号
        table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                  name: name    //姓名
                , time: time    //时间
                , phone: phone  //手机号
                , state: state  //状态
                , account: account  //账户
                , bank_number: bank_number  //卡号
                , bank_seller: bank_seller  //开户人
                , qq: qq  //QQ号
            }
        })
        setTimeout(function () {
            top.layer.close(index);
            top.layer.msg("搜索成功！");
        }, 500);
        return false;
    })
})
