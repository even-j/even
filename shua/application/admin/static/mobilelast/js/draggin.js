window.onload = function () {
    var div1 = document.querySelector(".public-count-down");

//限制最大宽高，不让滑块出去
    var maxW = document.querySelector(".scroll-wrapper").clientWidth - div1.offsetWidth;
    var maxH = document.querySelector(".scroll-wrapper").clientHeight - div1.offsetHeight;

//手指触摸开始，记录div的初始位置
    div1.addEventListener("touchstart", function (e) {
        var ev = e || window.event;
        var touch = ev.targetTouches[0];
        oL = touch.clientX - div1.offsetLeft;
        oT = touch.clientY - div1.offsetTop;
        document.addEventListener("touchmove", defaultEvent(e), false);
    });

//触摸中的，位置记录
    div1.addEventListener("touchmove", function (e) {
        var ev = e || window.event;
        var touch = ev.targetTouches[0];
        var oLeft = touch.clientX - oL;
        var oTop = touch.clientY - oT;
        if (oLeft < 0) {
            oLeft = 0;
        } else if (oLeft >= maxW) {
            oLeft = maxW;
        }
        if (oTop < 0) {
            oTop = 0;
        } else if (oTop >= maxH) {
            oTop = maxH;
        }
        div1.style.left = oLeft + "px";
        div1.style.top = oTop + "px";
    });

//触摸结束时的处理
    div1.addEventListener("touchend", function (e) {
        document.removeEventListener("touchmove", defaultEvent(e));
    });

//阻止默认事件
    function defaultEvent(e) {
        e.preventDefault();
    }
}


