<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:77:"D:\phpstudy\WWW\zhan\shua_li\pubic/../application/buy\view\my\withdrawal.html";i:1698557938;s:68:"D:\phpstudy\WWW\zhan\shua_li\application\buy\view\public\header.html";i:1698557938;s:66:"D:\phpstudy\WWW\zhan\shua_li\application\buy\view\public\left.html";i:1698723640;s:68:"D:\phpstudy\WWW\zhan\shua_li\application\buy\view\public\footer.html";i:1698558181;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>小白兔</title>
    <link rel="stylesheet" type="text/css" href="/static/buy/element-ui/lib/theme-chalk/index.css"/>
    <!-- 页面内容CSS -->
    <link rel="stylesheet" type="text/css" href="/static/buy/css/pageCss/zhangHaoTiXian.css"/>
    <link rel="Shortcut Icon" type="image/x-icon" href="/static/buy/img/index.png" />
    <script src="/static/buy/js/vue-2.6.10.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/element-ui/lib/index.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/js/axios.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/static/buy/js/jquery-1.12.4.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(function () {
            // 手机号正则表达式
            var phoneReg = /^1[3-9]\d{9}$/;
            // 身份证号码正则表达式
            var idcardReg = /^[1-9]\d{5}(18|19|20)\d{2}((0[1-9])|(1[0-2]))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/;
            // 银行卡正则
            var bankreg = /^(\d{16}|\d{17}|\d{18}|\d{19})$/;
            <?php if(!(empty($withdeawl) || (($withdeawl instanceof \think\Collection || $withdeawl instanceof \think\Paginator ) && $withdeawl->isEmpty()))): ?>
            var str = "<?php echo $withdeawl['bank_no']; ?>";
            var reg = /^(\d{4})\d+(\d{4})$/;
            str = str.replace(reg, "$1 **** **** $2");
            <?php endif; ?>
            /* 为element-ui组件提供数据绑定和事件 */
            var vm = new Vue({
               el: ".center_box",
                data: function () {
                    return {
                        dialogFormVisible: false,
                    <?php if(empty($withdeawl) || (($withdeawl instanceof \think\Collection || $withdeawl instanceof \think\Paginator ) && $withdeawl->isEmpty())): ?>
                    empty:0,
                        form: {
                            name: "",
                            yinHangName: "",
                            kaiHuName: "",
                            yinHangKaHao: "",
                            shenFenZhengNum: "",
                            phoneNum: ""
                        },
                        provinceValue2: "",
                        cityValue2: "",
                        /* 变量保存图片 */
                        localFile: "",
                        localFile2: "",
                        <?php endif; if(!(empty($withdeawl) || (($withdeawl instanceof \think\Collection || $withdeawl instanceof \think\Paginator ) && $withdeawl->isEmpty()))): ?>
                    empty:1,
                    form: {
                            name:"<?php echo $withdeawl['bank_user']; ?>",
                            yinHangName: "<?php echo $choose_bank['name']; ?>",
                            kaiHuName: "<?php echo $withdeawl['branch_name']; ?>",
                            yinHangKaHao: "<?php echo $withdeawl['bank_no']; ?>",
                            shenFenZhengNum: "<?php echo $withdeawl['idcard']; ?>",
                            phoneNum: "<?php echo $withdeawl['mobile']; ?>"
                    },
                    provinceValue2: "<?php echo $withdeawl['province']; ?>",
                        cityValue2: "<?php echo $withdeawl['city']; ?>",
                        /* 变量保存图片 */
                        localFile: "",
                        localFile2: "",
                        filelist: [{
                        url: '<?php echo $withdeawl['idcard_img_a']; ?>'
                    }],
                        filelist2: [{
                        url: '<?php echo $withdeawl['idcard_img_b']; ?>'
                    }],
                    <?php endif; ?>
                        yinHangList: [
                            <?php if(is_array($bank) || $bank instanceof \think\Collection || $bank instanceof \think\Paginator): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                "<?php echo $vo['name']; ?>",
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        ],
                        /* 省市常用登陆地 */
                        mapJson: "/static/buy/json/map.json",
                        blockValue2: "",
                        provinceList2: [],
                        cityList2: [],
                        blockList2: [],
                        newCity2: [],
                        newBlock2: [],
                        /* 默认只能选择一张图片 */
                        picNum: 1,

                        <?php if(!(empty($withdeawl) || (($withdeawl instanceof \think\Collection || $withdeawl instanceof \think\Paginator ) && $withdeawl->isEmpty()))): ?>

                        /* 表格数据 */
                        tableData: [{
                            kaiHuName: "<?php echo $withdeawl['bank_user']; ?>",
                            phoneNum: "<?php echo $withdeawl['mobile']; ?>",
                            shenFenZhengNum: str,
                            zhangHao: "<?php echo $choose_bank['name']; ?>",
                            zhuangTai: "待审核",
                            remarks: "<?php echo $withdeawl['remarks']; ?>",
                            id: <?php if($withdeawl['state'] == 1): ?>1 <?php elseif($withdeawl['state'] == 2): ?>2<?php elseif($withdeawl['state'] == 0): ?>0<?php endif; ?>
                        }],
                            <?php endif; ?>
                        /* 按钮默认不禁用 */
                        curDisabled: false,
                            // input默认不禁用
                            inputDisabled:false
                    }
                },
                methods: {

                    getMobile:function(){
                        $.post("<?php echo url('my/bankMobile'); ?>",{'mobile' : this.form.phoneNum},function(res){
                            if(res.code==1){
                            }else{  
                                vm.form.phoneNum='';
                                return vm.alertError(res.msg);
                            }
                        })
                    },
                    // 绑定银行卡确定事件
                    bindActive:function(){
                        console.log("绑定银行卡点击");
                        if(!this.form.name) {return vm.alertError("请输入姓名");}
                        if(!this.form.yinHangName) {return vm.alertError("请输入银行名称");}
                        if(!this.provinceValue2) {return vm.alertError("请选择开户行城市");}
                        if(!this.form.kaiHuName) {return vm.alertError("请输入支行名称");}
                        if(!this.form.yinHangKaHao) {return vm.alertError("请输入银行卡号");}
                        if (!bankreg.test(this.form.yinHangKaHao)) {
                            return vm.alertError("银行卡号码格式不规范,请检查后重新输入");}
                        if(!this.form.shenFenZhengNum) {return vm.alertError("请输入身份证号码");}
                        if (!idcardReg.test(this.form.shenFenZhengNum)) {
                            return vm.alertError("身份证号码格式不规范,请检查后重新输入");}
                        if(!this.form.phoneNum) {return vm.alertError("请输入银行预留手机号码");}
                        if (!phoneReg.test(this.form.phoneNum)) {
                            return vm.alertError("手机号码格式不规范,请检查后重新输入");}
                        $.ajax({
                            type : 'POST',
                            url : "<?php echo url('buy/my/add_bank_card'); ?>",
                            async : true,
                            data : {
                                "name":vm.form.name,
                                "province":vm.provinceValue2,
                                "city":vm.cityValue2,
                                "bank_no":vm.form.yinHangKaHao,
                                "branch_name":vm.form.kaiHuName,
                                "bank_id":vm.form.yinHangName,
                                "idcard":vm.form.shenFenZhengNum,
                                "mobile":vm.form.phoneNum,
                                "idcard_img_a":vm.localFile,
                                "idcard_img_b":vm.localFile2,
                            },
                            success : function(data){
                                if(data.code==1){
                                    vm.alertSuccess(data.msg);
                                    setTimeout(function(){
                                        return location.href=data.url;
                                    },3000)

                                }else{
                                    return vm.alertError(data.msg);
                                }
                            },
                            error : function(XMLHttpRequest, textStatus) {
                                alert(XMLHttpRequest.status + "," + textStatus);
                            }
                        });
                    },
                    /* 下拉菜单事件 */
                    handleOpen: function (key, keyPath) {
                        // console.log(key, keyPath);
                    },
                    handleClose: function (key, keyPath) {
                        // console.log(key, keyPath);
                    },
                    /* 消息弹框事件 */
                    openMsg: function () {
                        this.$alert("暂无消息通知", "个人通知", {});
                    },
                    /* 打开弹框的时候让表单初始化 */
                    openDialogForm: function () {
                        /* 让弹框显示 */
                        this.dialogFormVisible = true;
                        /* 清空表单数据 */
                        this.form.name = "";
                        this.form.yinHangName = "";
                        this.provinceValue2 = "";
                        this.cityValue2 = "";
                        this.form.kaiHuName = "";
                        this.form.yinHangKaHao = "";
                        this.form.shenFenZhengNum = "";
                        this.form.phoneNum = "";
                    },
                    /* 通过更换银行卡打开的话不初始化表单数据 */
                    openDialogForm2: function () {
                        /* 让弹框显示 */
                        this.dialogFormVisible = true;
                        this.inputDisabled = true;
                    },
                    /* 获取图片的base64路径 */
                    handleChange: function (e) {
                        var that = this;
                        var reader = new FileReader();
                        reader.readAsDataURL(e.raw);
                        reader.onload = function () {
                            // console.log(reader.result);
                            that.localFile = reader.result;
                        }
                    },
                    handleChange2: function (e) {
                        var that = this;
                        var reader = new FileReader();
                        reader.readAsDataURL(e.raw);
                        reader.onload = function () {
                            // console.log(reader.result);
                            that.localFile2 = reader.result;
                        }
                    },
                    /* 判断上传文件类型和大小 */
                    beforeUpload: function (file) {
                        var isJPG = file.type === "image/jpeg";
                        var isPng = file.type === "image/png";
                        var picSize = file.size / 1024 / 1024 < 2;

                        if (!(isJPG || isPng)) {
                            this.$message.error("上传头像图片只能是 JPG和PNG 格式");
                        }
                        if (!picSize) {
                            this.$message.error("上传图片大小不能超过 2MB");
                        }
                        return (isJPG && picSize) || (isPng && picSize);
                    },
                    /* 删除图片 */
                    handleRemove: function (file) {
                        // console.log(file);
                    },
                    handleRemove2: function (file) {
                        // console.log(file);
                    },
                    /* 给表格上色 */
                    cellStyle: function (e) {
                        var id = this.tableData[e.rowIndex].id;
                        if (e.columnIndex === 4) {
                            if (id === 0) {
                                this.tableData[e.rowIndex].zhuangTai = "待审核";
                                return "color:red;";
                            } else if(id === 1){
                                this.tableData[e.rowIndex].zhuangTai = "审核完成";
                                return "color:green;";
                            }else if(id === 2){
                                this.tableData[e.rowIndex].zhuangTai = "审核不通过";
                                return "color:red;";
                            }
                        }
                    },
                    /* 页面初始化的时候判断按钮是否禁用 */
                    btnDisabled: function () {
                        if(this.tableData){
                            for (var i = 0; i < this.tableData.length; i++) {
                                var id = this.tableData[i].id;
                                this.curDisabled = id === 0;
                            }
                        }
                    },
                    /* 省市区二级联动方法 */
                    // 获取json数据,二级联动
                    getCityData2: function () {
                        var that = this;
                        axios.get(this.mapJson).then(function (response) {
                            if (response.status === 200) {
                                var data = response.data;
                                // 省市区数据分类
                                for (var item in data) {
                                    if (item.match(/0000$/)) {
                                        that.provinceList2.push({
                                            id: item,
                                            value: data[item],
                                            children: []
                                        });
                                    } else if (item.match(/00$/)) {
                                        that.newCity2.push({
                                            id: item,
                                            value: data[item],
                                            children: []
                                        });
                                    } else {
                                        that.newBlock2.push({
                                            id: item,
                                            value: data[item]
                                        });
                                    }
                                }
                                // 分类市级
                                for (var index in that.provinceList2) {
                                    for (var index1 in that.newCity2) {
                                        if (that.provinceList2[index].id.slice(0, 2) === that.newCity2[index1].id.slice(0,
                                            2)) {
                                            that.provinceList2[index].children.push(that.newCity2[index1]);
                                        }
                                    }
                                }
                                // 分类区级
                                for (var item1 in that.newCity2) {
                                    for (var item2 in that.newBlock2) {
                                        if (that.newBlock2[item2].id.slice(0, 4) === that.newCity2[item1].id.slice(0, 4)) {
                                            that.newCity2[item1].children.push(that.newBlock2[item2]);
                                        }
                                    }
                                }
                            } else {
                                // console.log(response.status);
                            }
                        }).catch(function (error) {
                            // console.log(typeof + error);
                        })
                    },
                    // 选省
                    chooseProvince2: function (e) {
                        for (var index2 in this.provinceList2) {
                            if (e === this.provinceList2[index2].id) {
                                this.provinceValue2 = this.provinceList2[index2].value;
                                this.cityList2 = this.provinceList2[index2].children;
                                this.cityValue2 = this.provinceList2[index2].children[0].value;
                                this.blockList2 = this.provinceList2[index2].children[0].children;
                            }
                        }
                        console.log(this.provinceValue2, this.cityValue2);
                    },
                    // 选市
                    chooseCity2: function (e) {
                        for (var index3 in this.newCity2) {
                            if (e === this.newCity2[index3].id) {
                                this.cityValue2 = this.newCity2[index3].value;
                                this.blockList2 = this.newCity2[index3].children;
                            }
                        }
                        console.log(this.cityValue2);
                    },

                    /* 失败的弹框 */
                    alertError: function (e) {
                        this.$message.error(e);
                    },
                    /* 成功的弹框 */
                    alertSuccess: function (e) {
                        this.$message({
                            message: e,
                            type: "success"
                        });
                    },

                    /* 确定按钮进行表单验证 */
                    queDingBtnActive: function () {
                        var that = this;
                        if(!that.form.name) {return vm.alertError("请输入姓名");}
                        if(!that.form.yinHangName) {return vm.alertError("请输入银行名称");}
                        if(!that.provinceValue2) {return vm.alertError("请选择开户行城市");}
                        if(!that.form.kaiHuName) {return vm.alertError("请输入支行名称");}
                        if(!that.form.yinHangKaHao) {return vm.alertError("请输入银行卡号");}
                        if (!bankreg.test(that.form.yinHangKaHao)) {
                            return vm.alertError("银行卡号码格式不规范,请检查后重新输入");}
                        if(!that.form.shenFenZhengNum) {return vm.alertError("请输入身份证号码");}
                        if (!idcardReg.test(that.form.shenFenZhengNum)) {
                            return vm.alertError("身份证号码格式不规范,请检查后重新输入");}
                        if(!that.form.phoneNum) {return vm.alertError("请输入银行预留手机号码");}
                        if (!phoneReg.test(that.form.phoneNum)) {
                            return vm.alertError("手机号码格式不规范,请检查后重新输入");}
                        console.log("更换银行卡点击")

                        $.ajax({
                            type : 'POST',
                            url : "<?php echo url('buy/my/edit_bank_card'); ?>",
                            async : true,
                            data : {
                                "name":vm.form.name,
                                "province":vm.provinceValue2,
                                "city":vm.cityValue2,
                                "bank_no":vm.form.yinHangKaHao,
                                "branch_name":vm.form.kaiHuName,
                                "bank_id":vm.form.yinHangName,
                                "idcard":vm.form.shenFenZhengNum,
                                "mobile":vm.form.phoneNum,
                                "idcard_img_a":vm.localFile,
                                "idcard_img_b":vm.localFile2,
                            },
                            success : function(data){
                                if(data.code==1){
                                    vm.alertSuccess(data.msg);
                                    setTimeout(function(){
                                        return location.href=data.url;
                                    },3000)

                                }else{
                                    return vm.alertError(data.msg);
                                }
                            },
                            error : function(XMLHttpRequest, textStatus) {
                                alert(XMLHttpRequest.status + "," + textStatus);
                            }
                        });
                    }
                },
                created: function () {
                    this.getCityData2();
                    this.btnDisabled();
                }
            });
        });

        /* 调用jQuery实现选择导航栏效果 */
        $(function () {

            $(".title a").click(function () {
                $(this).addClass("add_color").siblings().removeClass("add_color");
            });

        });
    </script>
</head>
<body>
<div class="container">

    <!-- 头部 -->
    <link rel="stylesheet" type="text/css" href="/static/buy/css/header.css"/>
<div class="header" v-cloak>
    <div class="top_bg">
        <div class="top">
            <div class="top_left">
                <span><?php echo $users['username']; ?></span>
                <span class="gang">|</span>
                <a href="javascript:void (0)" class="tuichu">退出</a>
            </div>
            <div class="top_right">
                <span>本金: <span class="price_color"><?php echo $users['balance']; ?></span>元</span>
                <span class="gang">|</span>
                <span>银锭: <span class="price_color"><?php echo $users['reward']; ?></span>银锭</span>
            </div>
        </div>
    </div>
    <!-- 导航栏 -->
    <div class="nav">
        <a href="javascript:"><img class="logo" src="/static/buy/img/logo.png" alt="小白兔"/></a>
        <div class="title">
            <a href="<?php echo url('my/index'); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 1): ?>class="add_color" <?php endif; endif; ?>>
            个人中心</a>
            <a href="<?php echo url('helpcenter/index'); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 2): ?>class="add_color" <?php endif; endif; ?>> 帮助中心</a>
            <a href="<?php echo url('money/withsilver',['hnav'=>'3','nav'=>'2']); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 3): ?>class="add_color" <?php endif; endif; ?>> 银锭充值</a>
            <a href="<?php echo url('money/withdrawal',['hnav'=>'3','nav'=>'1']); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 4): ?>class="add_color" <?php endif; endif; ?>> 提现</a>
            <a href="<?php echo url('task/index',['hnav'=>'2','nav'=>'1']); ?>" <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav == 5): ?>class="add_color" <?php endif; endif; ?>>
            任务大厅</a>
        </div>
        <div class="bell_btn">
            <button type="button" class="el-button el-button--default el-button--small is-circle"
                    @click="dialogVisible = true">
                <i class="el-icon-bell"></i>
            </button>
            <div class="red_type" v-show="num > 0">{{num}}</div>
        </div>
        <div class="renwu_btn">
            <button class="el-button el-button--danger" @click="maketask">
                <img class="renwu_img" src="/static/buy/img/renwu.png" alt=""/>
                <span>继续任务</span>
            </button>
        </div>
    </div>
    <!-- 弹出框内容 -->
    <el-dialog :visible.sync="dialogVisible" title="个人通知">
        <div v-if="state==1" class="center_box1">

            <!-- 左边部分 -->
            <div class="left_box1">
                <div class="left_table">
                    <div :class="[index>=1?'hide_border':'',currentIndex===index?'selectOn':'']"
                         @click="handleClickTable(index)"
                         class="left_table_item"
                         v-for="(item,index) in tableList">
                        <div class="txt">
                            <span :class="item.look==1?'type_color':''"></span>
                            <p v-html="item.title"></p>
                        </div>
                        <div class="time">
                            <i class="el-icon-time"></i>
                            <span v-html="item.create_time"></span>
                        </div>
                    </div>
                </div>
                <div class="fenye">
                    <el-pagination @current-change="setPage"
                                   :page-size="5"
                                   :total="total" :pager-count="5"
                                   background
                                   layout="prev, pager, next">
                    </el-pagination>
                </div>
            </div>

            <!-- 右边盒子部分 -->
            <div class="right_box1">
                <h1 v-html="title" style="margin-bottom: 20px;"></h1>
                <div>
                    <p style="text-indent: 2em" v-html="content">
                </div>
                <div style="display: flex;flex-direction: column;align-self: flex-end;justify-content: flex-end; margin-top: 20px">
                    <p v-html="admin"></p>
                    <p v-html="datetime"></p>
                </div>
            </div>

        </div>
                <div v-else>
                    <span class="masigg">暂无通知</span>
                </div>
    </el-dialog>

</div>
<script>
    $(function () {

        vm=new Vue({
            el: ".header",
            data: function () {
                return {
                    curIndex: 0,
                    dialogVisible: false,
                    tableList: [],
                    currentIndex: 0,
                    title: "",
                    state: 0,
                    content: "",
                    datetime: "",
                    admin: "",
                    total: 0,
                    page: 1,
                    num:0
                }
            },
            methods: {
                maketask:function(){
                    location.href="<?php echo url('task/maketask'); ?>"
                },
                /* 消息弹框事件 */
                openMsg: function () {
                    this.dialogTableVisible = true;
                    if(this.tableList.length > 0){
                        this.setData(0);
                    }
                },
                handleClickTable: function (index) {
                    this.title = this.tableList[index].title;
                    this.content = this.tableList[index].content;
                    this.datetime = this.tableList[index].create_time;
                    this.admin = this.tableList[index].author;
                    this.currentIndex = index;
                    this.tableList[index].type = true;
                    this.setData(index);
                },
                getData: function () {
                    var that = this;
                    $.post("<?php echo url('index/msg'); ?>", {page: that.page}, function (res) {
                        if (res.code == 1) {
                            console.log(res);
                            that.tableList = res.data.list;
                            that.total = res.data.total;
                            that.num = res.data.num;
                            if (that.tableList.length > 0) {
                                that.state = 1;
                                that.title = that.tableList[0].title;
                                that.content = that.tableList[0].content;
                                that.datetime = that.tableList[0].create_time;
                                that.admin = that.tableList[0].author;
                            } else {
                                that.state = 0;
                            }
                        } else {
                            layer.msg('网络错误');
                        }
                    })
                },
                panduan:function(){
                    var timer = setInterval(function(){
                        $.post("<?php echo url('login/getSession'); ?>",{},function(res){
                            console.log(12);
                            if(res.code==1){
                                location.href="<?php echo url('login/index'); ?>";
                            }else{

                            }
                        })
                    },10000);
                },
                setData:function(index){
                    var that = this;
                    if(this.tableList[index].look==1)return;
                    that.tableList[index].look=1;
                    $.post("<?php echo url('index/setMsg'); ?>", {id: this.tableList[index].id}, function (res) {
                        if(res.data == 0)that.num=0;
                    })
                },
                setPage(val) {
                    this.page = val;
                    console.log(123);
                    this.getData();
                },
                addColor: function (index) {
                    this.curIndex = index;
                },

                /* 失败的弹框 */
                alertError: function (e) {
                    this.$message.error(e);
                },
                /* 成功的弹框 */
                alertSuccess: function (e) {
                    this.$message({
                        message: e,
                        type: "success"
                    });
                },
            },
            created() {
                this.getData();
                this.panduan();
            }
        });

        $(function () {
            $(".tuichu").click(function () {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo url('login/logout'); ?>",
                    async: true,
                    data: {
                        "aoData": 'aaaa',//测试数据,
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.code == 1) {
                            vm.alertSuccess(data.msg);
                            setTimeout(function () {
                                return location.href = data.url;
                            }, 3000)

                        } else {
                            return vm.alertError(data.msg);
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.status + "," + textStatus);
                    }
                });
            });
        });

    });
</script>


    <!-- 中间内容部分 -->
    <div class="center_box">
        <!-- 下拉列表 -->
        <style>
    [v-cloak]{
        display: none!important;
    }
</style>
<div class="a_path" v-cloak>
    <el-col class="select_box">
        <el-menu default-active="<?php if(!(empty($hnav) || (($hnav instanceof \think\Collection || $hnav instanceof \think\Paginator ) && $hnav->isEmpty()))): ?><?php echo $hnav; ?>-<?php echo $nav; endif; ?>" class="el-menu-vertical-demo" unique-opened>
            <el-submenu default-openeds index="1">
                <template slot="title">
                    <img alt="" src="/static/buy/img/zhanghaoxinxi.png" style="width: 20px;margin-right: 5px;" />
                    <span>账号信息</span>
                </template>
                <el-menu-item-group class="el_menu1">
                    <el-menu-item class="el_item" index="1-1">基本信息</el-menu-item>
                    <el-menu-item  class="el_item" index="1-2">账号提现</el-menu-item>
                    <el-menu-item  class="el_item" index="1-3">买号添加</el-menu-item>
                    <!--
                    <el-menu-item  class="el_item" index="1-4">会员VIP</el-menu-item>-->
                </el-menu-item-group>
            </el-submenu>
            <el-submenu index="2">
                <template slot="title">
                    <img alt="" src="/static/buy/img/renwuqingkuang.png" style="width: 20px;margin-right: 5px;" />
                    <span>任务情况</span>
                </template>
                <el-menu-item-group class="el_menu2">
                    <el-menu-item  class="el_item" index="2-1">任务领取</el-menu-item>
                </el-menu-item-group>
            </el-submenu>
            <el-submenu index="3">
                <template slot="title">
                    <img alt="" src="/static/buy/img/zijinguanli.png" style="width: 20px;margin-right: 5px;" />
                    <span>资金管理</span>
                </template>
                <el-menu-item-group class="el_menu3">
                    <el-menu-item  class="el_item" index="3-1">提现</el-menu-item>
                    <el-menu-item  class="el_item" index="3-2">银锭充值</el-menu-item>
                    <el-menu-item  class="el_item" index="3-3">提现记录</el-menu-item>
                    <!--<el-menu-item  class="el_item" index="3-4">佣金记录</el-menu-item>-->
                </el-menu-item-group>
            </el-submenu>
            <el-submenu index="4">
                <template slot="title">
                    <img alt="" src="/static/buy/img/haoyouyaoqing.png" style="width: 20px;margin-right: 5px;" />
                    <span>好友邀请</span>
                </template>
                <el-menu-item-group class="el_menu4">
                    <el-menu-item  class="el_item" index="4-1">邀请好友</el-menu-item>
                    <el-menu-item  class="el_item" index="4-2">邀请记录</el-menu-item>
                </el-menu-item-group>
            </el-submenu>
        </el-menu>
    </el-col>
</div>

<script>
    $(function () {
        $(".select_box .el_menu1 .el_item").click(function () {
            var index=$(this).index();
            //console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('my/information',['hnav'=>'1','nav'=>'1']); ?>"
            }
            else if(index===1){
                location.href="<?php echo url('my/withdrawal',['hnav'=>'1','nav'=>'2']); ?>"
            }
            else if(index===2){
                location.href="<?php echo url('my/add_buyno',['hnav'=>'1','nav'=>'3']); ?>"
            }else if(index===3){
                location.href="<?php echo url('my/vip_record',['hnav'=>'1','nav'=>'4']); ?>"
            }

        });
        $(".select_box .el_menu2 .el_item").click(function () {
            var index=$(this).index();
            console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('task/index',['hnav'=>'2','nav'=>'1']); ?>"
            }

        });
        $(".select_box .el_menu3 .el_item").click(function () {
            var index=$(this).index();
            console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('money/withdrawal',['hnav'=>'3','nav'=>'1']); ?>"
            }
            else if(index===1){
                location.href="<?php echo url('money/withsilver',['hnav'=>'3','nav'=>'2']); ?>"
            }
            else if(index===2){
                location.href="<?php echo url('money/drawal_record',['hnav'=>'3','nav'=>'3']); ?>"
            }
            else if(index===3){
                location.href="<?php echo url('money/commission',['hnav'=>'3','nav'=>'4']); ?>"
            }
        });
        $(".select_box .el_menu4 .el_item").click(function () {
            var index=$(this).index();
            console.log($(this).attr("index"));
            if(index===0){
                location.href="<?php echo url('recommend/index',['hnav'=>'4','nav'=>'1']); ?>"
            }
            else if(index===1){
                location.href="<?php echo url('recommend/record',['hnav'=>'4','nav'=>'2']); ?>"
            }
            else if(index===2){
                location.href="<?php echo url('money/drawal_record',['hnav'=>'3','nav'=>'3']); ?>"
            }
            else if(index===3){
                location.href="<?php echo url('money/commission',['hnav'=>'3','nav'=>'4']); ?>"
            }
        });
    });
</script>



        <!-- 右边盒子部分 -->
        <div class="right_box">
            <!-- 基本信息标题 -->
            <div class="msg_title">
                <p>个人中心&nbsp;/&nbsp;账号信息&nbsp;/&nbsp;<span class="msg_title_txt">基本信息</span></p>
            </div>
            <div class="user_content">

                <!-- 提现账户管理 -->
                <div class="web_gonggao">
                    <div class="gonggao_row">
                        <div class="gonggao_top">
                            <a href="javascript:" class="select_on">提现账户管理</a>
                        </div>
                    </div>
                </div>

                <?php if(empty($withdeawl) || (($withdeawl instanceof \think\Collection || $withdeawl instanceof \think\Paginator ) && $withdeawl->isEmpty())): ?>
                <!-- 暂无银行卡 -->
                <div class="yinhangka">
                    <img src="/static/buy/img/yinhangka.png" alt=""/>
                    <p>暂未绑定银行卡</p>
                    <el-button type="success" size="small" icon="el-icon-plus" @click="openDialogForm">绑定银行卡</el-button>
                </div>
                <?php endif; if(!(empty($withdeawl) || (($withdeawl instanceof \think\Collection || $withdeawl instanceof \think\Paginator ) && $withdeawl->isEmpty()))): ?>
                <!-- 更换银行卡 -->
                <div class="change">
                    <el-table :data="tableData"
                              border
                              header-cell-style="background:#f5f7fa;"
                              :cell-style="cellStyle"
                              style="width: 100%;margin: 20px 0;">
                        <el-table-column prop="kaiHuName" label="开户名" align="center">
                        </el-table-column>
                        <el-table-column prop="phoneNum" label="预留手机号码" align="center">
                        </el-table-column>
                        <el-table-column prop="shenFenZhengNum" label="银行卡号" align="center">
                        </el-table-column>
                        <el-table-column prop="zhangHao" label="银行" align="center">
                        </el-table-column>
                        <el-table-column prop="zhuangTai" label="状态" align="center">
                        </el-table-column>
                        <el-table-column prop="remarks" label="备注" align="center">
                        </el-table-column>
                        <el-table-column label="操作" align="center">
                            <el-button type="warning" icon="el-icon-edit" size="small" :disabled="curDisabled"
                                       @click="openDialogForm2">更换银行卡
                            </el-button>
                        </el-table-column>
                    </el-table>
                </div>
                <?php endif; ?>

                <!-- 嵌套表单内容 -->
                <el-dialog title="绑定银行卡" :visible.sync="dialogFormVisible">
                    <div class="form_box">
                        <el-form ref="form" :model="form" class="el_form">
                            <div class="el_form_item" style="position:relative;">
                                <p>开户名:</p>
                                <el-input v-model="form.name" :disabled="inputDisabled" placeholder="请输入姓名" class="el_form_width"></el-input>
                                <p style="position: absolute;right: -156px;top: 30px;color: red;font-size: 14px;width: 164px;">*开户名添加后就无法修改</p>
                            </div>
                            <div class="el_form_item">
                                <p>银行:</p>
                                <el-select v-model="form.yinHangName" placeholder="请选择银行" class="el_form_width">
                                    <el-option v-for="item in yinHangList" :value="item"></el-option>
                                </el-select>
                            </div>
                            <div class="el_form_item">
                                <p>开户行城市:</p>
                                <div class="el_form_width">
                                    <el-select class="el_select" v-model="provinceValue2" @change="chooseProvince2"
                                               placeholder="请选择省份">
                                        <el-option v-for="item in provinceList2" :key="item.id" :label="item.value" :value="item.id">
                                        </el-option>
                                    </el-select>
                                    <el-select class="el_select" v-model="cityValue2" @change="chooseCity2" placeholder="请选择城市">
                                        <el-option v-for="item in cityList2" :key="item.id" :label="item.value" :value="item.id">
                                        </el-option>
                                    </el-select>
                                </div>
                            </div>
                            <div class="el_form_item">
                                <p>开户行支行名称:</p>
                                <el-input v-model="form.kaiHuName" placeholder="请输入内容" class="el_form_width"></el-input>
                            </div>
                            <div class="el_form_item">
                                <p>银行卡号:</p>
                                <el-input v-model="form.yinHangKaHao" placeholder="请输入银行卡号" class="el_form_width"></el-input>
                            </div>
                            <div class="el_form_item">
                                <p>身份证号码:</p>
                                <el-input v-model="form.shenFenZhengNum" placeholder="请输入身份证号" class="el_form_width"></el-input>
                            </div>
                            <div class="el_form_item">
                                <p>手机号码:</p>
                                <el-input v-model="form.phoneNum" placeholder="请输入手机号" class="el_form_width" maxlength="11" @change="getMobile()"></el-input>
                            </div>

                            <!-- 头像上传 -->
                            <div class="upload_pic">
                                <p>身份证上传(正面):</p>
                                <div class="el_pic_upload">
                                    <el-upload ref="unload" action="string" list-type="picture-card" :on-remove="handleRemove"
                                               :before-upload="beforeUpload" :on-change="handleChange" :limit="1" :auto-upload="false"
                                               >
                                        <i class="el-icon-plus"></i>
                                    </el-upload>
                                </div>
                            </div>
                            <div class="upload_pic">
                                <p>身份证上传(反面):</p>
                                <div class="el_pic_upload">
                                    <el-upload ref="unload" action="string" list-type="picture-card" :on-remove="handleRemove2"
                                               :before-upload="beforeUpload" :on-change="handleChange2" :limit="1" :auto-upload="false"
                                               >
                                        <i class="el-icon-plus"></i>
                                    </el-upload>
                                </div>
                            </div>
                        </el-form>
                    </div>
                    <!-- 确定取消按钮 -->
                    <div slot="footer" class="dialog-footer" style="align-self: flex-end;margin: 20px;">
                        <el-button @click="dialogFormVisible = false" size="small">取 消</el-button>
                        <el-button type="primary" @click="empty==0?bindActive():queDingBtnActive()" size="small">确 定</el-button>
                    </div>
                </el-dialog>
            </div>
        </div>
    </div>

    <!-- 底部 -->
    <!-- 底部 -->
<link rel="stylesheet" type="text/css" href="/static/buy/css/footer.css" />
<div class="commonFooter">
    <div class="contents">
        <!--©版权所有: <a href="#">安徽云梭网络科技有限公司</a>-->
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        技术支持: <a style="margin-right: 70px;" href="#">小白兔 </a>

    </div>
</div>

</div>

</body>
</html>
