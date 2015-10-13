<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;
$this->title = '用户列表';
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
 <?php $this->beginBody() ?>
<table id="test">
    <thead>
    <tr>
        <th data-options="field:'itemid',width:80">Item ID</th>
        <th data-options="field:'productid',width:100">Product</th>
        <th data-options="field:'listprice',width:80,align:'right'">List Price</th>
        <th data-options="field:'unitcost',width:80,align:'right'">Unit Cost</th>
        <th data-options="field:'attr1',width:240">Attribute</th>
        <th data-options="field:'attr1',width:240">productname</th>
        <th data-options="field:'status',width:60,align:'center'">Status</th>
    </tr>
    </thead>
</table>
<div id="add" class="easyui-dialog" style="padding:5px;width:600px;height:700px;"
     title="添加表单" iconCls="icon-ok"
     buttons="#dlg-buttons">
    <form id="ff" method="post">
       <table>

           <tr>
               <td>姓名:</td>
               <td><input name="firstname" class="easyui-validatebox" required="true" missingMessage="姓名不能为空"></td>
           </tr>
           <tr>
               <td>电话:</td>
               <td><input name="tel" class="easyui-validatebox" required="true" validType="length[11,11]" missingMessage="请填写电话号码" invalidMessage="电话号码格式错误"></td>
           </tr>
           <tr>
               <td>Email:</td>
               <td><input name="Email" class="easyui-validatebox" required="true" validType="email" missingMessage="请填写邮箱" invalidMessage="邮箱格式错误"></td>
           </tr>
       </table>
    </form>
</div>
<div id="dlg-buttons">
    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="javascript:alert('Ok')">提交</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#add').dialog('close')">取消</a>
</div>
 <?php $this->endBody() ?>
</body>
</html>
 <?php $this->endPage() ?>
<script type="text/javascript">
        $(function(){
            $('#test').datagrid({
                title:'我的表格',
                iconCls:'icon-save',
                width:'100%',
                height:'auto',
                autoRowHeight: false,
                border:false,
                collapsible:true,
                url:"<?php echo Url::toRoute('admin/userjson') ?>", //服务器地址,返回json格式数据
                idField:'code',
                loadMsg:'正在加载数据...',
                frozenColumns:[[
                    {field:'ck',width:80,checkbox:true}
                ]],
                pagination:true,  //分页控件
                toolbar:[{
                    id:'btnadd',
                    text:'添加',
                    iconCls:'icon-add',
                    handler:function(){
                        $('#btnsave').linkbutton('enable');
                        $('#add').dialog({
                            modal:true
                        });
                    }
                },{
                    id:'btncut',
                    text:'删除',
                    iconCls:'icon-remove',
                    handler:function(){
                        $('#btnsave').linkbutton('enable');
                        $.messager.alert('消息','删除');
                    }
                },'-',{
                    id:'btnsave',
                    text:'修改',
                    iconCls:'icon-edit',
                    handler:function(){
                        $('#btnsave').linkbutton('enable');
                        $.messager.alert('消息','修改');
                    }
                },
                    {
                        id: 'btnexport',
                        text: '导出',
                        iconCls: 'icon-print',
                        handler: function () {
                            $('#btnsave').linkbutton('enable');
                            $.messager.alert('消息', '导出');
                        }
                    }
                ]
            });
            var p = $('#test').datagrid('getPager');
            $(p).pagination({
                pageSize: 10,//每页显示的记录条数，默认为10
                pageList:[5,10,15,20],//每页显示几条记录
                beforePageText: '第',//页数文本框前显示的汉字
                afterPageText: '页    共 {pages} 页',
                displayMsg: '当前显示 {from} - {to} 条记录    共 {total} 条记录',
                onBeforeRefresh:function(){
                    $(this).pagination('loading');//正在加载数据中...
                    $(this).pagination('loaded'); //数据加载完毕
                }
            });
            $('#add').dialog('close');
        });
        function getSelected(){
            var selected = $('#test').datagrid('getSelected');
            if (selected){
                alert(selected.code+":"+selected.name+":"+selected.addr+":"+selected.col4);
            }
        }
        function getSelections(){
            var ids = [];
            var rows = $('#test').datagrid('getSelections');
            for(var i=0;i<rows.length;i++){
                ids.push(rows[i].code+":"+rows[i].name+":"+rows[i].addr+":"+rows[i].col4);
            }
            alert(ids.join(':'));
        }
        function clearSelections(){
            $('#test').datagrid('clearSelections');
        }
    </script>