function textBecomeImg(text, fontsize, fontcolor) {
  var canvas = document.createElement("canvas");
  //小于32字加1  小于60字加2  小于80字加4    小于100字加6
  $buHeight = 0;
  if (fontsize <= 32) { $buHeight = 1; } else if (fontsize > 32 && fontsize <= 60) { $buHeight = 2;} else if (fontsize > 60 && fontsize <= 80) { $buHeight = 4;} else if (fontsize > 80 && fontsize <= 100) { $buHeight = 6;} else if (fontsize > 100) { $buHeight = 10;}
  //对于g j 等有时会有遮挡，这里增加一些高度
  canvas.height = fontsize + $buHeight;
  var context = canvas.getContext("2d");
  // 擦除(0,0)位置大小为200x200的矩形，擦除的意思是把该区域变为透明
  context.clearRect(0, 0, canvas.width, canvas.height);
  context.fillStyle = fontcolor;
  context.font = fontsize + "px Arial";
  //top（顶部对齐） hanging（悬挂） middle（中间对齐） bottom（底部对齐） alphabetic是默认值
  context.textBaseline = "middle";
  context.fillText(text, 0, fontsize / 2);

  //方案三：改变大小后，重新设置一次文字
  canvas.width = context.measureText(text).width;
  context.fillStyle = fontcolor;
  context.font = fontsize + "px Arial";
  context.textBaseline = "middle";
  context.fillText(text, 0, fontsize / 2);

  var dataUrl = canvas.toDataURL("image/png");//注意这里背景透明的话，需要使用png
  return dataUrl;
}
