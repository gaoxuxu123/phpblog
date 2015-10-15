<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;
$this->title = '文章分类列表';
AppAsset::register($this);
AppAsset::addScript($this,WEBPATH.'/scripts/js/articleclass.js');
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
    	<th data-options="field:'id',align:'center'" width="20%">classId</th>
        <th data-options="field:'classname',align:'center'" width="60%">分类名称</th>
        <th data-options="field:'manager',align:'center',formatter:rowformater" width="15%">操作</th>
    </tr>
    </thead>
</table>

<div id="modify" class="easyui-dialog" modal="true" closed="true" align="center" style="padding:5px;width:300px;height:200px;padding-top:30px;"
     title="文章分类修改" iconCls="icon r1_c10"
     buttons="#bb">
       <table>

           <tr>
               <td>class Id:</td>
               <td><input name="id" class="easyui-validatebox" id="id" value="" readonly></td>
           </tr>
           <tr>
               <td>分类名称:</td>
               <td><input name="classname" class="easyui-validatebox" id="classname" value=""></td>
           </tr>
       </table>
</div>
<div id="add" class="easyui-dialog" modal="true" closed="true" align="center" style="padding:5px;width:300px;height:200px;padding-top:30px;"
     title="Tags添加" iconCls="icon-add"
     buttons="#cc">
       <table>

           <tr>
               <td>分类名称:</td>
               <td><input name="classname1" class="easyui-validatebox" id="classname1" value="" required="true" missingMessage="文章分类名称不能为空"></td>
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