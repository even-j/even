<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/www/wwwroot/xbt.com/pubic/../application/mobile/view/my/withdrawal.html";i:1580885808;s:61:"/www/wwwroot/xbt.com/application/mobile/view/public/left.html";i:1577592620;s:63:"/www/wwwroot/xbt.com/application/mobile/view/public/footer.html";i:1578366492;}*/ ?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <title>本金提现</title>
    <link rel="stylesheet" href="/static/mobile/css/plugin.css" type="text/css">
    <link rel="stylesheet" href="/static/mobile/css/iconfont/iconfont.css" type="text/css">
    <link rel="stylesheet" href="/static/mobile/css/public.css" type="text/css">
    <link rel="stylesheet" href="/static/mobile/css/page.css" type="text/css">
    <script src="/static/mobile/js/all.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/jquery-1.12.4.min.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/vue-2.6.10.min.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/vant.min.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/muse-ui.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/js/public.js" type="text/javascript" charset="UTF-8"></script>
    <script src="/static/mobile/area/area.js" type="text/javascript" charset="UTF-8"></script>
    <script>

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
            var vm = new Vue({
                el: ".tfkz-container",
                data: function () {
                    return {
                        // 默认弹框不显示
                        dialogShow: false,
                        /* 按钮默认不禁用 */
                        curDisabled: false,
                        /*开户名状态*/
                        kaihumingstate:"<?php echo $withdrawl['state']; ?>",
                        // 默认显示绑定银行卡
                        yinHangList: [
                            <?php if(is_array($bank) || $bank instanceof \think\Collection || $bank instanceof \think\Paginator): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            "<?php echo $vo['name']; ?>",
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        ],
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
                        localFile: [],
                        localFile2: [],
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
                        localFile: [],
                        localFile2: [],
                        filelist: [{
                        url: '<?php echo $withdeawl['idcard_img_a']; ?>'
                    }],
                        filelist2: [{
                        url: '<?php echo $withdeawl['idcard_img_b']; ?>'
                    }],
                        province:"<?php echo $withdeawl['province']; ?>",
                        city:"<?php echo $withdeawl['city']; ?>",
                        <?php endif; ?>
                         province:"请选择省",
                        city:"请选择市",
                        // 表格数据
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
                    };
                },
                // 调用混入
                mixins: [areaMixin, singlePersonMixin],
                methods: {
                        /* 通过更换银行卡打开的话不初始化表单数据 */
                        openDialogForm2: function () {
                            /* 让弹框显示 */
                            this.dialogShow = true;
                            this.inputDisabled = true;
                        },
                    showDialog: function () {
                        this.dialogShow = true;
                    },
                    setAreaShow: function () {
                        this.areaShow = !this.areaShow;
                    },
                        kaihumingalert:function(){
                            
                            alert('开户名添加后就无法修改');
                        },
                    // 地区确认按钮
                    areaConfirm: function (val) {
                        this.province = val[0].name;
                        this.city = val[1].name;
                        this.areaShow = false;
                    },
                    // 修改表格样式
                    filterColor(id) {
                        if(id===0){
                            return "red";
                        }else if(id===1) {
                            return "blue";
                        }else if(id===2) {
                            return "red";
                        }
                    },
                        filterType(id){
                            if (id === 0) {
                                return this.tableData[0].zhuangTai = "待审核";
                            } else if(id === 1){
                               return this.tableData[0].zhuangTai = "审核完成";
                            }else if(id === 2){
                                return this.tableData[0].zhuangTai = "审核不通过";
                            }
                        },
                        // 弹框确认事件
                        bindActive: function () {
                        if(!this.form.name) {return alertError("请输入姓名");}
                        if(!this.form.yinHangName) {return alertError("请输入银行名称");}
                        if(!this.province) {return alertError("请选择开户行城市");}
                        if(!this.form.kaiHuName) {return alertError("请输入支行名称");}
                        if(!this.form.yinHangKaHao) {return alertError("请输入银行卡号");}
                        if (!bankreg.test(this.form.yinHangKaHao)) {
                            return alertError("银行卡号码格式不规范,请检查后重新输入");}
                        if(!this.form.shenFenZhengNum) {return alertError("请输入身份证号码");}
                        if (!idcardReg.test(this.form.shenFenZhengNum)) {
                            return alertError("身份证号码格式不规范,请检查后重新输入");}
                        if(!this.form.phoneNum) {return alertError("请输入银行预留手机号码");}
                        if (!phoneReg.test(this.form.phoneNum)) {
                            return alertError("手机号码格式不规范,请检查后重新输入");}
                            if(this.localFile.length<= 0 ) {return alertError("请上传身份证正面截图");}
                            if(this.localFile2.length<= 0) {return alertError("请上传身份证反面截图");}
                        $.ajax({
                            type : 'POST',
                            url : "<?php echo url('mobile/my/add_bank_card'); ?>",
                            async : true,
                            data : {
                                "name":vm.form.name,
                                "province":vm.province,
                                "city":vm.city,
                                "bank_no":vm.form.yinHangKaHao,
                                "branch_name":vm.form.kaiHuName,
                                "bank_id":vm.form.yinHangName,
                                "idcard":vm.form.shenFenZhengNum,
                                "mobile":vm.form.phoneNum,
                                "idcard_img_a":vm.localFile[0].content,
                                "idcard_img_b":vm.localFile2[0].content,
                            },
                            success : function(data){
                                if(data.code==1){
                                    alertSuccess(data.msg);
                                    setTimeout(function(){
                                        return location.href=data.url;
                                    },3000)

                                }else{
                                    return alertError(data.msg);
                                }
                            },
                            error : function(XMLHttpRequest, textStatus) {
                                alert(XMLHttpRequest.status + "," + textStatus);
                            }
                        });
                    },
                        /* 确定按钮进行表单验证 */
                        queDingBtnActive: function () {
                            var that = this;
                            if(!that.form.name) {return alertError("请输入姓名");}
                            if(!that.form.yinHangName) {return alertError("请输入银行名称");}
                            if(!that.provinceValue2) {return alertError("请选择开户行城市");}
                            if(!that.form.kaiHuName) {return alertError("请输入支行名称");}
                            if(!that.form.yinHangKaHao) {return alertError("请输入银行卡号");}
                            if (!bankreg.test(that.form.yinHangKaHao)) {
                                return alertError("银行卡号码格式不规范,请检查后重新输入");}
                            if(!that.form.shenFenZhengNum) {return alertError("请输入身份证号码");}
                            if (!idcardReg.test(that.form.shenFenZhengNum)) {
                                return alertError("身份证号码格式不规范,请检查后重新输入");}
                            if(!that.form.phoneNum) {return alertError("请输入银行预留手机号码");}
                            if (!phoneReg.test(that.form.phoneNum)) {
                                return alertError("手机号码格式不规范,请检查后重新输入");}
                            if(that.localFile.length<= 0) {return alertError("请上传身份证正面截图");}
                            if(that.localFile.length<= 0) {return alertError("请上传身份证反面截图");}
                            $.ajax({
                                type : 'POST',
                                url : "<?php echo url('mobile/my/edit_bank_card'); ?>",
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
                                    "idcard_img_a":vm.localFile[0].content,
                                    "idcard_img_b":vm.localFile2[0].content,
                                },
                                success : function(data){
                                    if(data.code==1){
                                        alertSuccess(data.msg);
                                        setTimeout(function(){
                                            return location.href=data.url;
                                        },3000)

                                    }else{
                                        return alertError(data.msg);
                                    }
                                },
                                error : function(XMLHttpRequest, textStatus) {
                                    alert(XMLHttpRequest.status + "," + textStatus);
                                }
                            });
                        },
                    // select的change事件
                    selectChange(val) {
                        // console.log(val);
                    },
                    // 图片change事件
                    imgchange:function (val) {
                        console.log(val);
                    },
                    imgchange2:function (val) {
                        console.log(val);
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
                },
                mounted: function () {
                    publicFunction();
                    this.btnDisabled();
                }
            });
        });
    </script>
    <script>
        window.alert = function(name){
            var iframe = document.createElement("IFRAME");
            iframe.style.display="none";
            iframe.setAttribute("src", 'data:text/plain,');
            document.documentElement.appendChild(iframe);
            window.frames[0].window.alert(name);
            iframe.parentNode.removeChild(iframe);
        }
    </script>
</head>
<body>
<div class="tfkz-container">

    <!-- 页面头部 -->
    <div class="page-header">
        <div class="arrow-left" onclick="javascript:history.back(-1);">
            <van-icon class="arrow-left-item" name="arrow-left" />
        </div>
        <div class="page-title">账号提现</div>
        <div class="menu-box" onclick="slideBarClick()">
            <van-icon class="menu-box-item" name="bars" />
        </div>
    </div>

    <!-- 下拉菜单 -->
    <link rel="stylesheet" type="text/css" href="/static/mobile/css/table.css"/>
<!-- 下拉菜单 -->
<div class="silde-bar">
    <div class="slide-bar-item">
        <div class="slide-bar-item-title <?php if(!(empty($topnav) || (($topnav instanceof \think\Collection || $topnav instanceof \think\Paginator ) && $topnav->isEmpty()))): if($topnav ==1): ?>add-color<?php endif; endif; ?>">
            <img src="/static/mobile/img/mycenter_active.png" alt="">
            <a href="<?php echo url('my/index',['hnav'=>'0','nav'=>'1']); ?>">个人中心</a>
        </div>
    </div>
    <div class="slide-bar-item">
        <div class="slide-bar-item-title">
            <img src="/static/mobile/img/helpcenter.png" alt="">
            <a href="<?php echo url('helpcenter/index'); ?>">帮助中心</a>
        </div>
    </div>
    <div class="slide-bar-item">
        <div class="slide-bar-item-title">
            <img src="/static/mobile/img/yindingchongzhi.png" alt="">
            <span>银锭充值</span>
            <van-icon class="slide-arrow" name="arrow-down" />
        </div>
        <div class="slide-bar-item-detail">
            <a href="<?php echo url('money/withsilver'); ?>">银锭充值</a>
            <a href="<?php echo url('money/withsilver',['show'=>'2']); ?>">银锭记录</a>
        </div>
    </div>
    <div class="slide-bar-item">
        <div class="slide-bar-item-title">
            <img src="/static/mobile/img/benjintixian.png" alt="">
            <span>提现</span>
            <van-icon class="slide-arrow" name="arrow-down" />
        </div>
        <div class="slide-bar-item-detail">
            <a href="<?php echo url('money/withdrawal'); ?>">提现</a>
            <a href="<?php echo url('money/withdrawal',['show'=>'2']); ?>">本金记录</a>
        </div>
    </div>
    <div class="slide-bar-item">
        <div class="slide-bar-item-title">
            <img src="/static/mobile/img/renwudating.png" alt="">
            <a href="<?php echo url('task/index'); ?>">任务大厅</a>
        </div>
    </div>
    <div class="slide-bar-item">
        <div class="slide-bar-item-title">
            <img src="/static/mobile/img/renwuguanli.png" alt="">
            <a href="<?php echo url('my/taskmanagement'); ?>">任务管理</a>
        </div>
    </div>
<div class="slide-bar-item">
    <div class="slide-bar-item-title">
        <img src="/static/mobile/img/loginout.png" alt="">
        <a class="tuichu" href="javascript:void (0)" >退出登录</a>
    </div>
</div>
</div>
<script>
    $(function () {
        var timer = setInterval(function(){
            $.post("<?php echo url('login/getSession'); ?>",{},function(res){
                console.log(12);
                if(res.code==1){
                    location.href="<?php echo url('login/index'); ?>";
                }else{

                }
            })
        },10000);
        $(".tuichu").click(function () {
            $.ajax({
                type: 'POST',
                url: "<?php echo url('mobile/login/logout'); ?>",
                async: true,
                data: {
                    "aoData": 'aaaa',//测试数据,
                },
                success: function (data) {
                    console.log(data);
                    if (data.code == 1) {
                        alertSuccess(data.msg);
                        setTimeout(function () {
                            return location.href = data.url;
                        }, 3000)

                    } else {
                        return alertError(data.msg);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.status + "," + textStatus);
                }
            });
        });
    });
</script>


    <!-- 滚动容器 -->
    <div class="scroll-wrapper" style="padding-bottom: 1.6rem">

        <!-- 公用tab标签 -->
        <div class="public-tab-title">
            <span class="active">提现账户管理</span>
        </div>

        <!-- 提现账户管理 -->
        <div class="zhanghu-guanli">
            <?php if(empty($withdeawl) || (($withdeawl instanceof \think\Collection || $withdeawl instanceof \think\Paginator ) && $withdeawl->isEmpty())): ?>
            <!-- 暂未绑定银行卡 -->
            <div class="no-yinghangka" >
                <div class="img-box"><img src="/static/mobile/img/yinhangka.png" alt=""></div>
                <p>暂未绑定银行卡</p>
                <div class="yinhangka-btn" @click="showDialog">
                    <van-button class="yinhangka-btn-item" icon="plus" type="primary">绑定银行卡</van-button>
                </div>
            </div>
            <?php endif; if(!(empty($withdeawl) || (($withdeawl instanceof \think\Collection || $withdeawl instanceof \think\Paginator ) && $withdeawl->isEmpty()))): ?>
            <!-- 更换银行卡 -->
            <div class="change-yinhangka" >
<!-- 卡片 -->
                <div class="TaskManagement">
                    <div class="Task-management" v-for="(item,index) in tableData" :key="index">
                        <div class="TaskTop">
                            <div class="managementHeng" >
                                <p>开户名：</p>
                                <p >{{item.kaiHuName}}</p>
                            </div>
                            <div class="managementHeng">
                                <p>预留手机号码：</p>
                                <p>{{item.phoneNum}}</p>
                            </div>
                            <div class="managementHeng">
                                <p>银行卡号：</p>
                                <p>{{item.shenFenZhengNum}}</p>
                            </div>
                            <div class="managementHeng">
                                <p>银行：</p>
                                <p>{{item.zhangHao}}</p>
                            </div>
                            <div class="managementHeng">
                                <p>状态：</p>
                                <p
                                  :style="{color:filterColor(item.id)}">
                                    {{filterType(item.id)}}
                                </p>
                            </div>
                            <div class="managementHeng">
                                <p>备注：</p>
                                <p>{{item.remarks}}</p>
                            </div>
                        </div>
                        <div class="TaskBottom">
                            <img src="/static/mobile/img/bolang.png" alt="" />
                            <div class="TaskBottomPosition">
                                <p>
                                    操作：
                                    <b>
                                        <van-button
                                          round
                                          :disabled="curDisabled"
                                          @click="openDialogForm2"
                                          icon="edit"
                                          class="task-bottom-btn"
                                          type="warning">更换银行卡</van-button>
                                    </b>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="Task-management" v-if="tableData.length===0">
                        <div class="TaskTop" style="text-align: center">暂无内容</div>
                        <div class="TaskBottom">
                            <img src="/static/mobile/img/bolang.png" alt="" />
                            <div class="TaskBottomPosition"></div>
                        </div>
                    </div>
                </div>

            </div>
            <?php endif; ?>
            <!-- 银行卡弹框 -->
            <div class="public-dialog">
                <van-dialog
                        @confirm="empty==0?bindActive():queDingBtnActive()"
                        class="public-dialog-item"
                        v-model="dialogShow"
                        title="绑定银行卡"
                        show-cancel-button>
                    <!-- 绑定银行卡内容 -->
                    <div class="yinghangka-dialog">
                        <div class="yinghangka-dialog-input">
                            <span>开户名：</span>
                            <!--<span style="color:red;">*开户名添加后就无法修改</span>-->
                            <div class="public-input" >
                                <input type="text" :disabled="kaihumingstate==1" placeholder="请输入姓名" v-model="form.name">
                            </div>
                        </div>
                        <div class="yinghangka-select">
                            <span>银行：</span>
                            <div class="public-select">
                                <mu-select
                                        @change="selectChange"
                                        class="public-select-item"
                                        v-model="form.yinHangName"
                                        placeholder="请选择"
                                        full-width>
                                    <mu-option
                                            v-for="item in yinHangList"
                                            :label="item"
                                            :value="item"></mu-option>
                                </mu-select>
                            </div>
                        </div>
                        <div class="public-area">
                            <div class="public-area-item" @click="setAreaShow">
                                <span>开户行城市：</span>
                                <span>{{province}} {{city}}</span>
                            </div>
                            <div class="public-area-select">
                                <van-area
                                        v-show="areaShow"
                                        :columns-num="2"
                                        :area-list="areaList"
                                        @confirm="areaConfirm"
                                        @cancel="areaCancel"
                                        value="110101"></van-area>
                            </div>
                        </div>
                        <div class="yinghangka-dialog-input">
                            <span>开户行支行名称：</span>
                            <div class="public-input">
                                <input type="text" placeholder="请输入内容" v-model="form.kaiHuName">
                            </div>
                        </div>
                        <div class="yinghangka-dialog-input">
                            <span>银行卡号：</span>
                            <div class="public-input">
                                <input type="text" placeholder="请输入银行卡号" v-model="form.yinHangKaHao">
                            </div>
                        </div>
                        <div class="yinghangka-dialog-input">
                            <span>身份证号码：</span>
                            <div class="public-input">
                                <input type="text" placeholder="请输入身份证号码" v-model="form.shenFenZhengNum">
                            </div>
                        </div>
                        <div class="yinghangka-dialog-input">
                            <span>手机号码：</span>
                            <div class="public-input">
                                <input type="text" placeholder="请输入手机号码" maxlength="11" v-model="form.phoneNum">
                            </div>
                        </div>
                        <div class="upload-pic">
                            <span class="upload-pic-title">身份证上传(正面)：</span>
                            <div class="upload-pic-box">
                                <van-uploader
                                        v-model="localFile"
                                        @change="imgchange"
                                        multiple
                                        :max-count="1"></van-uploader>
                            </div>
                        </div>
                        <div class="upload-pic">
                            <span class="upload-pic-title">身份证上传(反面)：</span>
                            <div class="upload-pic-box">
                                <van-uploader
                                        v-model="localFile2"
                                        @change="imgchange2"
                                        multiple
                                        :max-count="1"></van-uploader>
                            </div>
                        </div>
                    </div>
                </van-dialog>
            </div>

        </div>

    </div>

    <!-- tabBar -->
<div class="public-tabBar">
    <div class="public-tabBar-item">
        <div class="public-tabBar-item-detail">
            <a href="<?php echo url('my/information'); ?>">基本信息</a>
            <a href="<?php echo url('my/withdrawal'); ?>">账号提现</a>
            <a href="<?php echo url('my/add_buyno'); ?>">买号添加</a>
            <a href="<?php echo url('my/vip_recharge'); ?>">会员VIP</a>
        </div>
        <div class="public-tabBar-item-title add-color">
            <span class="iconfont">&#xe60d;</span>
            <span>账号信息</span>
        </div>
    </div>
    <div class="public-tabBar-item">
        <div class="public-tabBar-item-detail">
            <a href="<?php echo url('task/maketask'); ?>">继续任务</a>
            <a href="<?php echo url('task/index'); ?>">任务大厅</a>
            <a href="<?php echo url('my/taskmanagement'); ?>">任务管理</a>
        </div>
        <div class="public-tabBar-item-title" style="    color: #fff;
    background-color: #ff976a;">
            <span class="iconfont">&#xe77a;</span>
            <span>任务情况</span>
        </div>
    </div>
    <div class="public-tabBar-item">
        <div class="public-tabBar-item-detail">
            <a href="<?php echo url('money/withdrawal'); ?>">提现</a>
            <a href="<?php echo url('money/withsilver'); ?>">银锭充值</a>
            <a href="<?php echo url('money/drawal_record'); ?>">提现记录</a>
        </div>
        <div class="public-tabBar-item-title">
            <span class="iconfont">&#xe601;</span>
            <span>资金管理</span>
        </div>
    </div>
    <div class="public-tabBar-item">
        <div class="public-tabBar-item-detail">
            <a href="<?php echo url('Recommend/index'); ?>">邀请好友</a>
            <a href="<?php echo url('Recommend/record'); ?>">邀请记录</a>
        </div>
        <div class="public-tabBar-item-title">
            <span class="iconfont">&#xe888;</span>
            <span>好友邀请</span>
        </div>
    </div>
</div>
</div>
</body>
</html>

