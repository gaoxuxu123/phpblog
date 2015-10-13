<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;
$this->title = 'Tags列表';
AppAsset::register($this);
AppAsset::addScript($this,WEBPATH.'/scripts/js/tag.js');
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
	
	<table id="table">
    <thead>
    <tr>
    	<th data-options="field:'id',align:'center'" width="20%">TagId</th>
        <th data-options="field:'tagname',align:'center'" width="60%">Tag标题</th>
        <th data-options="field:'manager',align:'center',formatter:rowformater" width="15%">操作</th>
    </tr>
    </thead>
</table>

<div id="modify" class="easyui-dialog" modal="true" closed="true" align="center" style="padding:5px;width:300px;height:200px;padding-top:30px;"
     title="Tags修改" iconCls="icon r1_c10"
     buttons="#bb">
       <table>

           <tr>
               <td>Tags Id:</td>
               <td><input name="id" class="easyui-validatebox" id="id" value=""></td>
           </tr>
           <tr>
               <td>Tags 名称:</td>
               <td><input name="tagname" class="easyui-validatebox" id="tagname" value=""></td>
           </tr>
       </table>
</div>
<div id="add" class="easyui-dialog" modal="true" closed="true" align="center" style="padding:5px;width:300px;height:200px;padding-top:30px;"
     title="Tags添加" iconCls="icon-add"
     buttons="#cc">
       <table>

           <tr>
               <td>Tags 名称:</td>
               <td><input name="tagname1" class="easyui-validatebox" id="tagname1" value=""></td>
           </tr>
       </table>
</div>
<div id="bb">
	<a href="javascript:void(0)" class="easyui-linkbutton modifysubmit"  data-options="iconCls:'icon-ok'">保存</a>
</div>
<div id="cc">
	<a href="javascript:void(0)" class="easyui-linkbutton submit"  data-options="iconCls:'icon-ok'">保存</a>
</div>
 <?php $this->endBody() ?>
 </body>
</html>
<?php $this->endPage() ?>
