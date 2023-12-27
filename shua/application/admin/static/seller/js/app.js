var app = {
  /**
   * ajax
   * @param url
   * @param data
   * @param success
   * @param error
   */
  ajax: function (url, data, success, error) {
    var layerIndex;
    $.ajax({
      url: url,
      type: 'post',
      data: data,
      dataType: 'json',
      beforeSend: function () {
        layerIndex = layer.load(2);
      },
      success: success,
      error: error,
      complete: function () {
        layer.close(layerIndex);
      }
    });
  },
  /**
   * 执行请求
   * @param url       请求地址
   * @param data      数据
   * @param callback  后端返回成功后执行的回调
   * @returns {*|void}
   */
  request: function (url, data, callback) {
    return app.ajax(url, data, function (response) {
      $.toastr[response.code ? 'success' : 'error'](response.msg, {
        time: response.code ? 1000 : 2000,
        callback: function () {
          if (response.code) callback && callback();
        }
      });
    });
  },
  /**
   * form带文件以ajax的方式提交
   * @param form    Form document
   * @param url     提交地址
   * @param data    额外数据
   * @param success 成功后的回调
   * @param error   失败后的回调
   */
  formUpload: function (form, url, data, success, error) {
    var formData = new FormData(form), layerIndex;
    if (data) {
      for (x in data) {
        formData.append(x, data[x]);
      }
    }
    $.ajax({
      url: url,
      type: 'POST',
      data: formData,
      dataType: 'JSON',
      cache: false,
      processData: false,
      contentType: false,
      beforeSend: function () {
        layerIndex = layer.load(2);
      },
      success: success,
      error: error,
      complete: function () {
        layer.close(layerIndex);
      }
    })
  },
  /**
   * 打开iframe侧边栏
   *
   * 使用示例：
   * app.openSidebar({
   *   title: '新增分类',
   *   url: '/admin/category/add',
   *   btn: ['新增', '取消']
   * }, function (index, layero) {
   *   var body = layer.getChildFrame('body', index);
   *   var iframe = window[layero.find('iframe')[0]['name']]; //得到iframe页的窗口对象，执行iframe页的方法：iframeWin.method();
   *   console.log('点击新增后的回调')
   * });
   *
   * @param obj       参数，支持重新定义所有layer弹层参数
   * @param callback  点击第一个按钮后的回调，即layer yes的回调(obj定义了btn有效)
   * @returns {*}
   */
  openSidebar: function (obj, callback) {
    obj = obj || {};
    var params = {
      type: 2,
      title: obj.title || '未定义标题',
      shadeClose: false,
      offset: 'r',
      shade: .01,
      anim: 3,
      resize: false,
      move: false,
      closeBtn: 2,
      scrollbar: false,
      isOutAnim: false,
      area: ['50%', '100%'],
      content: obj.url || '',
      cancel: function(index, layero) {
        this.closeSidebar();
        return false;
      }.bind(this)
    };
    if (obj) {
      for (x in obj) {
        params[x] = obj[x];
      }
    }
    if (callback) {
      params.yes = callback;
    }
    params.skin = 'app-sidebar';
    return layer.open(params);
  },
  /**
   * 关闭sidebar
   * @param callback 关闭后的回调
   */
  closeSidebar: function (callback) {
    var sidebar = $('.app-sidebar');
    sidebar.addClass('layer-anim close-sidebar-anim');

    setTimeout(function () {
      layer.close(sidebar.attr('times'));
      callback && callback();
    }, 280);
  },
  /**
   * 拿数组中的一列数据
   * @param array 数组
   * @param name  键名
   * @returns {Array}
   */
  column: function (array, name) {
    var column = [];
    for (var i = 0; i < array.length; i++) {
      column.push(array[i][name])
    }
    return column;
  },
  /**
   * 重复字符串N次
   * @param str
   * @param n
   * @returns {string}
   */
  repeat: function(str , n) {
    return new Array(n + 1).join(str);
  }
};