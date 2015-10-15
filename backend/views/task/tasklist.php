<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;
$this->title = '任务列表';
AppAsset::register($this);
AppAsset::addScript($this,WEBPATH.'/scripts/js/task.js');
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
    <!--去掉easyUI时时加载的动画效果-->
    <style type="text/css">
	 
	.datagrid-mask{
	  opacity:0;
	  filter:alpha(opacity=0);
	}
	.datagrid-mask-msg{
	   opacity:0;
	  filter:alpha(opacity=0);
	}
    </style>
</head>
<body style="background-color:white">
 <?php $this->beginBody() ?>

<table id="table">
    <thead>
    <tr>
    	<th data-options="field:'id',align:'center'" width="10%">TaskId</th>
        <th data-options="field:'taskname',align:'center'" width="30%">任务名称</th>
        <th data-options="field:'createtime',align:'center',formatter:timeformater" width="20%">任务创建时间</th>
        <th data-options="field:'status',align:'center',formatter:statusformater" width="10%">任务状态</th>
        <th data-options="field:'download',align:'center',formatter:downformater" width="15%">下载</th>
        <th data-options="field:'manager',align:'center',formatter:rowformater" width="12%">操作</th>
    </tr>
    </thead>
</table>



 <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>