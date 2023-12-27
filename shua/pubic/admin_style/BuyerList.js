layui.use(['form', 'layer', 'table', 'laytpl', 'laydate'], function () {
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;
    laydate = layui.laydate;
    var wgbz2 = function (d) {
        var wg = d.collection;
        if(wg===undefined){
            wg='---'
        }
        return '<span class="wgbz">'+wg+'</span>';
    };
    var balance = function (d) {
        return `<div class="wgbz">`+`押金:`+d.balance+`</div><br/><div>`+`银锭:`+d.reward+`</div>`
    }
    var vip = function (d) {
        if(d.vip==0){
            return '<span class="red">否</span>';
        }else{
            return '<span class="green">是</span>';
        }
    }

    var citycity = function (d) {
        return d.province+`-`+d.city
    }

    var citycity1 = function (d) {
        return d.province1+`-`+d.city1
    }


    //用户列表
    var tableIns = table.render({
        elem: '#userList',
        url: '/index.php/admin/buyer/BuyerList',
        method:'POST',
        toolbar: '#toolbarDemo',
       // cellMinWidth: 95,
        page: true,
        //height: "full-125",
        limits: [10, 15, 20, 25,100],
        limit: 10,
        id: "userListTable",
        cols: [[
            { field: 'id', title: '序号', width: 60, align: "center" },
            { field: 'username', title: '用户名', minWidth: 50, width: 110, align: "center" },
            { field: 'mobile', title: '手机号', minWidth: 55, width: 110, align: "center" },
            { field: 'qq', title: 'QQ', minWidth: 50, width: 110, align: "center" },
            { field: 'wechat', title: '微信', minWidth: 50, width: 110, align: "center" },

            { field: 'city', title: '居住城市', minWidth: 50, width: 110, align: "center",templet:citycity },
            //{ field: 'city1', title: '身份证', minWidth: 50, width: 110, align: "center",templet:citycity1 },
            { field: 'create_time', title: '注册时间', minWidth: 50, width: 80, align: "center" },
            { field: 'balance/reward', title: '余额/银锭', minWidth: 50, width: 150, height:100, align: "center",templet: balance  },
            // { field: 'star', title: '星级', minWidth: 50, width: 60, align: "center" },
            // { field: 'collection', title: '违规备注', minWidth: 50, width: 120, align: "center",templet: wgbz2 },
            { field: 'vip', title: '是否VIP', minWidth: 50, width: 110, align: "center",templet: vip },
            { field: 'vip_time', title: 'VIP到期时间', minWidth: 50, width: 160,  sort: true, align: "center" },
            { field: 'tjuser', title: '来源用户ID', minWidth: 50, width: 110, align: "center" },
            { field: 'note', title: '违规备注', minWidth: 50, width: 110, align: "center" },
            { field: 'mc_task_num', title: '每月累计完成单数', minWidth: 80, width:95, align: "center" },
            { field: 'invite_code', title: '邀请码', minWidth: 50, width: 110, align: "center" },
            { title: '操作', minWidth: 100, width: 600, templet: '#userListBar', fixed: "right", align: "center" }
        ]]
    });
    //列表操作
    table.on('tool(userList)', function (obj) {
        var that = this;
        var layEvent = obj.event,
            data = obj.data;
        if (layEvent === 'setTop') { //银锭
            setTop(data)
        } else if (layEvent === 'yajin') {//押金
            yajin(data)
        } else if (layEvent === 'maihao') {//买号
            maihao(data)
        } else if (layEvent === 'tuijian') {//推荐
            tuijian(data)
        } else if (layEvent === 'wgbz') {//违规备注
            wgbz(data)
        } else if (layEvent === 'updatePwd') {//改密码
            updatePwd(data)
        } else if (layEvent === 'bianji') {//编辑账户
            bianji(data)
        } else if (layEvent === 'tixian') {//提现
            tixian(data)
        } else if (layEvent === 'editstar') {//提现
            editstar(data)
        } else if (layEvent === 'xiaoxi') {//消息
            xiaoxi(data)
        }else if (layEvent === 'del') { //删除
            layer.confirm('确定删除此用户？', { icon: 3, title: '提示信息' }, function (index) {
                console.log(data);
                var dataid=data.id;
                $.ajax({
                    type: "post",
                    url: '/index.php/admin/Buyer/del_buyuser/id/'+dataid+'',
                    data: {
                        'id':dataid
                    },
                    dataType: "json",
                    async:true,
                    success:function(data) {
                        if(data.code == 1){
                            layer.msg(data.msg, {icon: 1},function () {
                                // 搜索条件
                                var name = $("input[name=name]").val(); //姓名

                                var qq = $("input[name=qq]").val(); //手机号
                              table.reload('userListTable', {
                                    method: 'post'
                                    , where: {
                                        'name': name, //姓名
                                        'qq': qq,
                                    }
                                    , page: {
                                        curr: 1
                                    }
                                });
                                setTimeout(function () {
                                    parent.layui.layer.closeAll();
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
        }
    });
    //申请时间1
    var date2 = laydate.render({
        elem: '#application-Time'
        , type: 'datetime'
        , range: true
        , format: 'yyyyMMdd'
    })
    //申请时间2
    var date3 = laydate.render({
        elem: '#expireTime-Time'
        , type: 'datetime'
        , range: true
        , format: 'yyyyMMdd'
    })
    $('.delAll_btn').click(function(){
        layui.layer.open({
            type: 2,
            content: "addBuyer.html",
            area: ['800px', '700px'],
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
        var name = $(".name").val(); //名字
        var phone = $(".phone").val(); //手机号
        //第二种
        var registerTime = field.registerTime;  //注册时间
        var state = field.state; //状态 默认全部选中 请自行更改html
        var account = field.account; //账户
        var expireTime = field.expireTime; //会员到期
        var qq = field.qq;  //qq号
        var username = field.username;  //用户名
        var phone = field.phone;  //用户名
        var tjuser = field.tjuser;  //来源id


        table.reload("userListTable", {//搜索【此功能需要后台配合，所以暂时没有动态效果演示】
            page: {
                curr: 1 //重新从第 1 页开始
            },
            where: {
                name: name    //姓名
                , phone: phone  //手机号
                , state: state  //状态
                , account: account  //账户
                , expireTime: expireTime //会员到期
                , registerTime: registerTime //注册时间
                , qq: qq //注册时间
                , username: username //用户名
                , tjuser: tjuser //来源id

            }
        })
        setTimeout(function () {
            top.layer.close(index);
            top.layer.msg("搜索成功！");
        }, 500);
        return false;
    });
    function tixian(edit) {
        layui.layer.open({
            type: 2,
            content: "tixian.html",
            area: ['900px', '650px'],
            title: '提现',
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
    function xiaoxi(edit) {
        layui.layer.open({
            type: 2,
            content: "xiaoxi.html",
            area: ['1000px', '650px'],
            title: '消息',
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
    function bianji(edit) {

        layui.layer.open({
            type: 2,
            content: "bianji.html",
            area: ['900px', '550px'],
            title: '编辑资料',
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
    function editstar(edit) {
        layui.layer.open({
            type: 2,
            content: "editstar.html",
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
    function updatePwd(edit) {
        layui.layer.open({
            type: 2,
            content: "updatePwd.html",
            area: ['900px', '650px'],
            title: '改密码',
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
    function wgbz(edit) {
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
    function tuijian() {
        layui.layer.open({
            type: 2,
            content: "tuijian.html",
            area: ['900px', '650px'],
            title: '推荐下级'
        })
    }
    function maihao(edit) {
        layui.layer.open({
            type: 2,
            content: "maihao.html",
            area: ['1350px', '650px'],
            title: '买号',
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
    function yajin(edit) {
        layui.layer.open({
            type: 2,
            content: "yajin.html",
            area: ['900px', '650px'],
            title: '押金',
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
    function setTop(edit) {
        layui.layer.open({
            type: 2,
            content: "yinding.html",
            area: ['900px', '650px'],
            title: '银锭',
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                //审核模态框中需要数据
                //因为名字我不知道 就简单写了两个 模仿即可
                if(edit){
                    //console.log(edit,3123123123);
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
