<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;
$this->title = '文章列表';
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
<body style="background-color:white">
 <?php $this->beginBody() ?>
<table id="article">
    <thead>
    <tr>
        <th data-options="field:'title',align:'center'" width="20%">文章标题</th>
        <th data-options="field:'tag',align:'center'" width="10%">Tag标记</th>
        <th data-options="field:'hits',align:'center'" width="5%">点击量</th>
        <th data-options="field:'pubtime',align:'center'" width="20%">发布时间</th>
        <th data-options="field:'istop',align:'center'" width="10%">是否置顶</th>
        <th data-options="field:'good',align:'center'" width="5%">顶</th>
        <th data-options="field:'bad',align:'center'" width="5%">踩</th>
        <th data-options="field:'brief',align:'center'" width="25%">文章简介</th>
    </tr>
    </thead>
</table>
<div id="openRoleDiv" class="easyui-window" closed="true" iconCls="icon-add" collapsible="false" modal="true" title="文章添加" style="width:1200px;height:850px;">
    <iframe scrolling="auto" id='openIframe' frameborder="0"  src="<?php  echo Url::toRoute('article/addarticle') ?>" style="width:100%;height:800px;"></iframe>
</div>
  <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script type="text/javascript">
        $(function(){
        	
            $('#article').datagrid({
                title:'文章列表',
                iconCls:'icon r4_c7',
                width:'100%',
                height:'auto',
                autoRowHeight: false,
                border:true,
                collapsible:true,
                url:"", //服务器地址,返回json格式数据
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
                        //window.location.href="<?php  echo Url::toRoute('article/addarticle') ?>";
                        $('#openRoleDiv').dialog('open');
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
                    },'-',{
                        id: 'btnview',
                        text: '预览',
                        iconCls: 'icon r18_c15',
                        handler: function () {
                            $('#btnview').linkbutton('enable');
                            $.messager.alert('消息', '预览');
                        }
                    }
                ]
            });
            var p = $('#article').datagrid('getPager');
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


           
        });
       
    </script>