<!--include file "admin_include.php"-->
<link type="text/css" href="/public/admin/css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
<link type="text/css" href="/public/admin/css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
<script type="text/javascript" src="/public/admin/js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="/public/admin/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="/public/admin/js/jquery-ui-timepicker-zh-CN.js"></script>
<script type="text/javascript">
    $(function () {
        $(".ui_timepicker").datetimepicker();
    })
</script>

<div class="container clearfix">
    <div class="main-wrap">
       <!--include file "admin_nav.php"-->
        <div class="search-wrap">
            <div class="search-content">
                <form action="/index.php" method="get">
                    <input type="hidden" name="app" value="admin" >
                    <input type="hidden" name="mod" value="data" >
                    <input type="hidden" name="ac" value="invest" >
                    <table class="search-tab">
                        <tr>
                            <th width="80">日期:</th>
                            <td><input class="common-text ui_timepicker" placeholder="开始时间" name="begindate" value="<?php echo $condition['begindate']?>" id="begindate" type="text"> — </td>
                            <td><input class="common-text ui_timepicker" placeholder="结束时间" name="enddate" value="<?php echo $condition['enddate']?>" id="enddate" type="text"></td>
                            <th width="80"><input class="btn btn-primary ml10 btn10" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
      
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div id="div_content" class="result-content" style="width:100%;overflow: auto">
                    <table class="result-tab" style="width:100%" >
                        <tr>
                        	<th style="width: 25%;">投资用户数</th>
                        	<th style="width: 25%;">投资金额(元)</th>
                            <th style="width: 25%;">日期</th>
                        </tr>
                        <?php foreach ($list as $item){?>
                            <tr>
                                <td><?php echo $item['num'] ?></td>
                                <td><?php echo $item['tz_money']/100 ?></td>
                                <td><?php echo $item['tz_time'] ?></td>
                            </tr>
                        <?php }?>            
                    </table>
                    
                </div>
            </form>
        </div>
       <div class="list-page"><?php echo $pager;?></div>
    </div>
  
    <!--/main-->
</div>
<!--include file "admin_bottom.php"-->