<!--include file "admin_include.php"-->
<div class="container clearfix">
    <div class="main-wrap">
       <!--include file "admin_nav.php"-->
        <div class="search-wrap">
            <div class="search-content">
                <form action="/index.php" method="get">
                    <input type="hidden" name="app" value="admin" >
                    <input type="hidden" name="mod" value="user" >
                    <input type="hidden" name="ac" value="view" >
                    <table class="search-tab">
                        <tr>
                            <th width="70">用户姓名:</th>
                            <td><input class="common-text" style="width:80px;" placeholder="用户ID/姓名" name="uid" value="<?php echo empty($_GET['uid'])?'':$_GET['uid']?>" id="" type="text"></td>
                            <th width="90">手机账号:</th>
                            <td><input class="common-text" style="width:120px;" placeholder="手机账号" name="mobile" value="<?php echo empty($_GET['mobile'])?'':$_GET['mobile']?>" id="" type="text"></td>
<!--                            <th width="90">银行卡状态:</th>
                            <td>
                                <select name="is_audit">
                                    <option value="" selected>全部</option>
                                    <option value="0" <?php if(isset($_GET['is_audit']) && $_GET['is_audit']=='0' ) {echo 'selected="selected"';}?> >待审核</option>
                                    <option value="1" <?php if(isset($_GET['is_audit']) && $_GET['is_audit']=='1' ) {echo 'selected="selected"';}?>>已审核</option>
                                    <option value="2" <?php if(isset($_GET['is_audit']) && $_GET['is_audit']=='2' ) {echo 'selected="selected"';}?>>审核未通过</option>
                                </select>
                            </td>-->
                             <th width="90">银行卡绑定:</th>
                            <td width="90">
                                <select name="is_bankbind">
                                    <option value="" selected>全部</option>
                                    <option value="0" <?php if(isset($_GET['is_bankbind']) && $_GET['is_bankbind']=='0' ) {echo 'selected="selected"';}?> >未设置</option>
                                    <option value="1" <?php if(isset($_GET['is_bankbind']) && $_GET['is_bankbind']=='1' ) {echo 'selected="selected"';}?>>已绑定</option>
                                </select>
                            </td>
                            <th width="90">实名认证:</th>
                            <td width="90">
                                <select name="is_realname">
                                    <option value="" selected>全部</option>
                                    <option value="0" <?php if(isset($_GET['is_realname']) && $_GET['is_realname']=='0' ) {echo 'selected="selected"';}?> >未设置</option>
                                    <option value="1" <?php if(isset($_GET['is_realname']) && $_GET['is_realname']=='1' ) {echo 'selected="selected"';}?>>已认证</option>
                                </select>
                            </td>
                            <th>推荐人手机:</th>
                            <td><input class="common-text" style="width:100px;" placeholder="代理手机号" name="agent_mobile" value="<?php echo empty($_GET['agent_mobile'])?'':$_GET['agent_mobile']?>" id="" type="text"></td>
                           
                            <th width="90">分组:</th>
                            <td width="90">
                                <select name="group_id" class="select">
                                    <option value="">全部</option>
                                    <?php foreach($group_list as $key=>$itme) { ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($_GET['group_id']) && $_GET['group_id']==$key) {echo  'selected="selected"';} ?> ><?php echo $itme['name']; ?></option>
                                    <?php }?>
                                </select>
                            </td>
                        </tr>
                         <tr>
                            <th width="90">免费体验:</th>
                            <td>
                                <select name="is_free">
                                    <option value="" selected>全部</option>
                                    <!--<option value="0" <?php if(isset($_GET['is_free']) && $_GET['is_free']=='0' ) {echo 'selected="selected"';}?>>无</option>-->
                                    <option value="1" <?php if(isset($_GET['is_free']) && $_GET['is_free']=='1' ) {echo 'selected="selected"';}?>>有</option>
                                </select>
                            </td>
                             <th width="90">按日策略:</th>
                            <td>
                                <select name="is_day">
                                    <option value="" selected>全部</option>
                                    <!--<option value="0" <?php if(isset($_GET['is_day']) && $_GET['is_day']=='0' ) {echo 'selected="selected"';}?>>无</option>-->
                                    <option value="1" <?php if(isset($_GET['is_day']) && $_GET['is_day']=='1' ) {echo 'selected="selected"';}?>>有</option>
                                </select>
                            </td>
                            <th width="90">按月策略:</th>
                            <td>
                                <select name="is_month">
                                    <option value="" selected>全部</option>
                                    <!--<option value="0" <?php if(isset($_GET['is_month']) && $_GET['is_month']=='0' ) {echo 'selected="selected"';}?>>无</option>-->
                                    <option value="1" <?php if(isset($_GET['is_month']) && $_GET['is_month']=='1' ) {echo 'selected="selected"';}?>>有</option>
                                </select>
                            </td>
                            
                            <th width="90" style="display: none">操盘贷:</th>
                            <td style="display: none">
                                <select name="is_cpd">
                                    <option value="" selected>全部</option>
                                    <option value="0" <?php if(isset($_GET['is_cpd']) && $_GET['is_cpd']=='0' ) {echo 'selected="selected"';}?>>无</option>
                                    <option value="1" <?php if(isset($_GET['is_cpd']) && $_GET['is_cpd']=='1' ) {echo 'selected="selected"';}?>>有</option>
                                </select>
                            </td>
                         	
                         	 <th width="90" style="display: none">P2P投资:</th>
                            <td  width="90" style="display: none">
                                <select name="is_p2p_tz">
                                    <option value="" selected>全部</option>
                                    <option value="0" <?php if(isset($_GET['is_p2p_tz']) && $_GET['is_p2p_tz']=='0' ) {echo 'selected="selected"';}?>>无</option>
                                    <option value="1" <?php if(isset($_GET['is_p2p_tz']) && $_GET['is_p2p_tz']=='1' ) {echo 'selected="selected"';}?>>有</option>
                                </select>
                            </td>
                            <th style="display: none">投操盘:</th>
                            <td style="display: none">
                                <select name="is_tcp">
                                    <option value="" selected>全部</option>
                                    <option value="0" <?php if(isset($_GET['is_tcp']) && $_GET['is_tcp']=='0' ) {echo 'selected="selected"';}?>>无</option>
                                    <option value="1" <?php if(isset($_GET['is_tcp']) && $_GET['is_tcp']=='1' ) {echo 'selected="selected"';}?>>有</option>
                                </select>
                            </td>
                            <th>状态:</th>
                            <td>
                                <select name="status">
                                    <option value="" selected>全部</option>
                                    <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0' ) {echo 'selected="selected"';}?>>不可用</option>
                                    <option value="1" <?php if(isset($_GET['status']) && $_GET['status']=='1' ) {echo 'selected="selected"';}?>>可用</option>
                                </select>
                            </td>
                            <td colspan="2"><input class="btn btn-primary btn10" name="sub" value="查询" type="submit"></td>
                            
                         </tr>
                    </table>
                </form>
            </div>
        </div>
      <div class="toolbar-wrap pl20 mt10">
            <div class="toolbar-item">
               <a href="<?php echo str_replace('view', 'sms', $_SERVER['REQUEST_URI']);?>"><i class="icon-font"></i> 短信群发</a>
				 <!--<a href="/index.php?app=admin&mod=user&ac=sms"><i class="icon-font"></i> 短信群发</a>-->
                <a href="/index.php?app=admin&mod=user&ac=add"><i class="icon-font"></i> 添加会员</a>
                <a href="/index.php?app=admin&mod=user&ac=modifygroup" target="_blank"><i class="icon-font"></i> 批量分组</a>
                <a href="javascript:export_data()"><i class="icon-font">&#xe03e;</i> 导出数据</a>
                <!--<a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>-->
            </div>
        </div>
        <div class="result-wrap">
           
            <form name="myform" id="myform" method="post">
                <div id="div_content" class="result-content" style="width:100%;overflow: auto">
                    <table class="result-tab" style="width:100%" >
                        <tr>
                            <!--<th class="tc" width="40px"><input class="allChoose" name="" type="checkbox"></th>-->
                            <th style="width:60px">用户ID</th>
                            <th style="width:100px">手机号码</th>
                            <th style="width:60px">真实姓名</th>
                            <th style="width:120px">身份证</th>
                            <th style="width:60px">银行卡</th>
                            <th style="width:100px">可用余额</th>
                            <th style="width:100px">赠送余额</th>
                            <th style="width:120px">注册时间</th>
                            <th style="width:80px">注册IP</th>
                            <th style="width:60px">注册地址</th>
                            <th style="width:60px">推荐人</th>
                            <th style="width:120px">登录IP</th>
                            <th style="width:60px">等级</th>
                            <th style="width:60px">用户状态</th>
                            <th style="width:60px">注册域名</th>
                            <th style="width:60px">分组</th>
                            <th style="width:180px">操作</th>

                        </tr>
                        <?php foreach ($list as $item){?>
                            <tr>
                                <!--<td class="tc"><input name="id[]" value="59" type="checkbox"></td>-->
                                <td><a href="javascript:void(0);" onclick="show('预览用户详细信息','/index.php?app=admin&mod=user&ac=info&uid=<?php echo $item['uid'];?>');" title="查看个人详细信息"><?php echo $item['uid'] ?></a></td>
                                <td><?php echo $item['mobile'] ?></td>
                                <td><?php echo $item['true_name'] ?></td>
                                <td><?php echo $item['id_card'] ?></td>
                                <td><?php echo $item['bank_status'] ?></td>
                                <td><?php echo '¥ '.number_format(($item['balance']/100),2); ?></td>
                                <td><?php echo '¥ '.number_format(($item['send']/100),2); ?></td>
                                <td><?php echo empty($item['reg_time'])?'':date('Y-m-d H:i',$item['reg_time']) ?></td>
                                <td><?php echo $item['reg_ip'];?></td>
                                <td><?php echo str_replace('-', '', \App::convert_ip($item['reg_ip']));?></td>
                                <td><?php echo $item['agent_mobile'] ?></td>
                                <td><?php echo $item['last_login_ip']; ?></td>
                                <td><?php echo $item['level']==0?'普通会员':'VIP会员'?></td>
                                <td><?php echo $item['user_status']?></td>
                                <td><?php echo $item['reg_domain']?></td>
                                <td><?php if(isset($group_list[$item['group_id']])){echo $group_list[$item['group_id']]['name'];}?></td>
                                <td align="center">
                                    <a class="link-update" href="javascript:void(0);" onclick="show('预览用户详细信息','/index.php?app=admin&mod=user&ac=info&uid=<?php echo $item['uid'];?>');">预览</a>
                                    &nbsp;&nbsp;<a class="link-del" href="/index.php?app=admin&mod=user&ac=edit&uid=<?php echo $item['uid'];?>">编辑/审核</a>
                                    &nbsp;&nbsp;<a class="link-del" href="/index.php?app=admin&mod=peizi&ac=view&uid=<?php echo $item['uid'];?>">策略</a>
                                    &nbsp;&nbsp;<a class="link-del" href="/index.php?app=admin&mod=user&ac=telmsg&uid=<?php echo $item['uid'];?>">短信</a>
                                    &nbsp;&nbsp;<a class="link-del" href="javascript:del(<?php echo $item['uid'];?>)">删除</a>
                                    &nbsp;&nbsp;<a class="link-del" href="/index.php?app=admin&mod=user&ac=domodpwd&mobile=<?php echo $item['mobile'];?>">修改密码</a>
                                    &nbsp;&nbsp;<a target="_blank" class="link-del" href="/index.php?app=admin&mod=user&ac=view&agent_mobile=<?php echo $item['mobile'];?>">推荐用户</a>
                                    <?php if($item['status']==1){ ?>
                                    &nbsp;&nbsp;<a class="link-del" href="/index.php?app=admin&mod=user&ac=dofrozen&uid=<?php echo $item['uid'];?>">冻结</a>
                                    <?php }elseif($item['status']==2){?>
                                    &nbsp;&nbsp;<a class="link-del" href="/index.php?app=admin&mod=user&ac=dounfrozen&uid=<?php echo $item['uid'];?>">解冻</a>
                                    <?php }?>
                                    &nbsp;&nbsp;<a class="link-del" href="/index.php?app=admin&mod=admin&ac=balance&uid=<?php echo $item['uid'];?>">余额</a>
                                </td>
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
<script>
    function del(uid){
        if(window.confirm('你确定要删除用户吗？')){
            window.location.href = "/index.php?app=admin&mod=user&ac=del&uid="+uid;
        }
    }
    function export_data(){
        $.post("<?php echo \App::URL('admin/user/exportdata');?>",{},function(res){
            window.location.href = "/logs/"+res.msg;
            //window.open("/uploads/"+res.msg);
        },'json')
    }
</script>
<!--include file "admin_bottom.php"-->