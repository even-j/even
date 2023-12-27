// 点击展开下拉菜单
function slideBarClick() {
    $(".silde-bar").slideToggle(300);
}

// 成功的弹框
function alertSuccess(msg) {
    vant.Notify({type: "success", message: msg});
}

// 失败的弹框
function alertError(msg) {
    vant.Notify({type: "danger", message: msg});
}

// 公用方法
function publicFunction() {

    var slideBatItem = $(".silde-bar .slide-bar-item");

    // 动态修改tabBar颜色
    $(".public-tabBar .public-tabBar-item").click(function () {
        $(this).children(".public-tabBar-item-title").addClass("add-color").parent().siblings().children(".public-tabBar-item-title").removeClass("add-color");
        $(this).children(".public-tabBar-item-detail").fadeToggle(300).parent().siblings().children(".public-tabBar-item-detail").fadeOut(300);
    });

    // tabBar子选项
    $(".public-tabBar .public-tabBar-item .public-tabBar-item-detail p").click(function (e) {
        e.stopPropagation();
        $(this).addClass("add-color").siblings().removeClass("add-color");
    });

    // 动态修改导航栏
    slideBatItem.click(function () {

        // 添加颜色
        $(this).children(".slide-bar-item-title").addClass("add-color").parent().siblings().children(".slide-bar-item-title").removeClass("add-color");

        // 手风琴效果
        $(this).children(".slide-bar-item-detail").slideToggle(300).parent().siblings().children(".slide-bar-item-detail").slideUp(300);

        // 箭头旋转
        $(this).find(".slide-arrow").toggleClass("rotate").parent().parent().siblings().find(".slide-arrow").removeClass("rotate");
    });

    // 导航详情点击
    $(".silde-bar .slide-bar-item .slide-bar-item-detail p").click(function (e) {
        e.stopPropagation();
        $(this).addClass("add-color").siblings().removeClass("add-color");
    });

    // 添加移除图片
    slideBatItem.eq(0).click(function () {
        $(this).find("img").attr("src", "/static/mobile/img/mycenter_active.png");
        slideBatItem.eq(1).find("img").attr("src", "/static/mobile/img/helpcenter.png");
        slideBatItem.eq(2).find("img").attr("src", "/static/mobile/img/yindingchongzhi.png");
        slideBatItem.eq(3).find("img").attr("src", "/static/mobile/img/benjintixian.png");
        slideBatItem.eq(4).find("img").attr("src", "/static/mobile/img/renwudating.png");
        slideBatItem.eq(5).find("img").attr("src", "/static/mobile/img/renwuguanli.png");
        slideBatItem.eq(6).find("img").attr("src", "/static/mobile/img/xiaoxitongzhi.png");
    });
    slideBatItem.eq(1).click(function () {
        $(this).find("img").attr("src", "/static/mobile/img/helpcenter_active.png");
        slideBatItem.eq(0).find("img").attr("src", "/static/mobile/img/mycenter.png");
        slideBatItem.eq(2).find("img").attr("src", "/static/mobile/img/yindingchongzhi.png");
        slideBatItem.eq(3).find("img").attr("src", "/static/mobile/img/benjintixian.png");
        slideBatItem.eq(4).find("img").attr("src", "/static/mobile/img/renwudating.png");
        slideBatItem.eq(5).find("img").attr("src", "/static/mobile/img/renwuguanli.png");
        slideBatItem.eq(6).find("img").attr("src", "/static/mobile/img/xiaoxitongzhi.png");
    });
    slideBatItem.eq(2).click(function () {
        $(this).find("img").attr("src", "/static/mobile/img/yindingchongzhi_active.png");
        slideBatItem.eq(0).find("img").attr("src", "/static/mobile/img/mycenter.png");
        slideBatItem.eq(1).find("img").attr("src", "/static/mobile/img/helpcenter.png");
        slideBatItem.eq(3).find("img").attr("src", "/static/mobile/img/benjintixian.png");
        slideBatItem.eq(4).find("img").attr("src", "/static/mobile/img/renwudating.png");
        slideBatItem.eq(5).find("img").attr("src", "/static/mobile/img/renwuguanli.png");
        slideBatItem.eq(6).find("img").attr("src", "/static/mobile/img/xiaoxitongzhi.png");
    });
    slideBatItem.eq(3).click(function () {
        $(this).find("img").attr("src", "/static/mobile/img/benjintixian_active.png");
        slideBatItem.eq(0).find("img").attr("src", "/static/mobile/img/mycenter.png");
        slideBatItem.eq(1).find("img").attr("src", "/static/mobile/img/helpcenter.png");
        slideBatItem.eq(2).find("img").attr("src", "/static/mobile/img/yindingchongzhi.png");
        slideBatItem.eq(4).find("img").attr("src", "/static/mobile/img/renwudating.png");
        slideBatItem.eq(5).find("img").attr("src", "/static/mobile/img/renwuguanli.png");
        slideBatItem.eq(6).find("img").attr("src", "/static/mobile/img/xiaoxitongzhi.png");
    });
    slideBatItem.eq(4).click(function () {
        $(this).find("img").attr("src", "/static/mobile/img/renwudating_active.png");
        slideBatItem.eq(0).find("img").attr("src", "/static/mobile/img/mycenter.png");
        slideBatItem.eq(1).find("img").attr("src", "/static/mobile/img/helpcenter.png");
        slideBatItem.eq(2).find("img").attr("src", "/static/mobile/img/yindingchongzhi.png");
        slideBatItem.eq(3).find("img").attr("src", "/static/mobile/img/benjintixian.png");
        slideBatItem.eq(5).find("img").attr("src", "/static/mobile/img/renwuguanli.png");
        slideBatItem.eq(6).find("img").attr("src", "/static/mobile/img/xiaoxitongzhi.png");
    });
    slideBatItem.eq(5).click(function () {
        $(this).find("img").attr("src", "/static/mobile/img/renwuguanli_active.png");
        slideBatItem.eq(0).find("img").attr("src", "/static/mobile/img/mycenter.png");
        slideBatItem.eq(1).find("img").attr("src", "/static/mobile/img/helpcenter.png");
        slideBatItem.eq(2).find("img").attr("src", "/static/mobile/img/yindingchongzhi.png");
        slideBatItem.eq(3).find("img").attr("src", "/static/mobile/img/benjintixian.png");
        slideBatItem.eq(4).find("img").attr("src", "/static/mobile/img/renwudating.png");
        slideBatItem.eq(6).find("img").attr("src", "/static/mobile/img/xiaoxitongzhi.png");
    });
    slideBatItem.eq(6).click(function () {
        $(this).find("img").attr("src", "/static/mobile/img/outhover.png");
        slideBatItem.eq(0).find("img").attr("src", "/static/mobile/img/mycenter.png");
        slideBatItem.eq(1).find("img").attr("src", "/static/mobile/img/helpcenter.png");
        slideBatItem.eq(2).find("img").attr("src", "/static/mobile/img/yindingchongzhi.png");
        slideBatItem.eq(3).find("img").attr("src", "/static/mobile/img/benjintixian.png");
        slideBatItem.eq(4).find("img").attr("src", "/static/mobile/img/renwudating.png");
        slideBatItem.eq(5).find("img").attr("src", "/static/mobile/img/renwuguanli.png");
    });
}

// 日期混入
var dateMixin = {
    data: function () {
        return {
            defaultDate: "",
            defaultDate2: "",
            defaultDate3: "",
            defaultDate4: ""
        };
    }
};

// 省市区混入
var areaMixin = {
    data: function () {
        return {
            areaList: areaData,
            areaShow: false,
            areaShow2: false
        };
    },
    methods: {
        // 地区取消按钮
        areaCancel: function () {
            this.areaShow = false;
        },
        areaCancel2: function () {
            this.areaShow2 = false;
        }
    }
};

// tab标签混入
var tabMixin = {
    data: function () {
        return {
            // 显示和隐藏
            isShow: true,
            // 动态修改颜色
            showType: 0
        };
    },
    methods: {
        // 修改tab样式
        setTabColor: function (e) {
            var type = e.target.dataset.type;
            if (type === "0") {
                this.isShow = true;
                this.showType = 0;
            } else {
                this.isShow = false;
                this.showType = 1;
            }
        }
    }
};

// 个人通知混入
var singlePersonMixin = {
    data: function () {
        return {
            // 右上角标签默认显示
            tagShow: true,
            tagNum: 0,
            msgPage: 1,
            msgTotal: 0,
            // 数据列表
            singlePersonList: [],
        };
    },
    methods: {
        msgGetData: function () {
            var that = this;
            $.post("/mobile/helpcenter/msg", {page: this.msgPage}, function (res) {
                console.log(res);
                if (res.code == 1) {
                    that.singlePersonList = res.data.list;
                    that.msgTotal = res.data.total;
                    var arr = [];
                    for (var i = 0; i < that.singlePersonList.length; i++) {
                        if (that.singlePersonList[i].look == 0) {
                            arr.push(that.singlePersonList[i].look);
                        }
                    }
                    if (arr.length === 0) {
                        that.tagShow = false;
                    } else {
                        that.tagNum = arr.length;
                    }
                } else {
                    alertError('网络错误');
                }
            })
        },
    },
    mounted: function () {
        this.msgGetData();
    }
};
