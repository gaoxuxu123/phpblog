<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;
$this->title = '文章分类列表';
AppAsset::register($this);
AppAsset::addScript($this,WEBPATH.'/scripts/js/database.js');
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
    <style type="text/css">
		
		ul li {list-style-type:none;}
    </style>
</head>
<body style="background-color:white">
 <?php $this->beginBody() ?>

	<div class="easyui-layout" style="width:100%;height:600px;">
		<div region="west" split="true" title="数据表" iconCls="icon r5_c7" style="width:200px;">
			
			<ul>
				
				<?php foreach ($tables as $key => $v): ?>

					<li>
					<a href="javascript:void(0)" onclick="showcontent('<?php echo $v['Tables_in_phpblog']; ?>')"><span class="icon r8_c1">&nbsp;</span><span><?php echo $v['Tables_in_phpblog']; ?></span>
					</a>
					</li>
					
				<?php endforeach; ?>
			</ul>
		</div>
		<div id="content" region="center"  title="数据表详细信息" iconCls="icon r5_c6" style="padding:5px;">

		<table id="table">
		<thead>
			<tr>
				<th data-options="field:'Field',align:'center'" width="10%">字段名</th>
				<th data-options="field:'Type',align:'center',formatter:typeformater" width="10%">字段类型</th>
				<th data-options="field:'length',align:'center',formatter:lengthformater" width="10%">长度</th>
				<th data-options="field:'Key',align:'center',formatter:ispriformater" width="10%">是否主键</th>
				<th data-options="field:'Null',align:'center',formatter:isnullformater" width="10%">是否为空</th>
				<th data-options="field:'Default',align:'center',formatter:defaultformater"  width="10%">默认值</th>
				<th data-options="field:'Extra',align:'center'"  width="10%">额外</th>
				<th data-options="field:'Comment',align:'center'" width="15%">注释</th>
				<th data-options="field:'mamager',align:'center'" width="10%">操作</th>
			</tr>
		</thead>
	</table>
	<div style="padding:5px;background:#fafafa;width:99.3%;border:1px solid #ccc">
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel">删除选中</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel">删除表</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload">刷新</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-add">添加字段</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon r17_c12">执行SQL语句</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-print">打印表结构</a>
	</div>
	<table id="table1">
		<thead>
			<tr>
				<th data-options="field:'Name',align:'center'" width="10%">表名</th>
				<th data-options="field:'Engine',align:'center'" width="10%">表引擎</th>
				<th data-options="field:'Rows',align:'center'" width="10%">行数</th>
				<th data-options="field:'Data_length',align:'center',formatter:datalengthformater" width="10%">数据大小</th>
				<th data-options="field:'Index_length',align:'center',formatter:indexlengthformater" width="10%">索引大小</th>
				<th data-options="field:'Data_free',align:'center',formatter:tablelengthformater" width="10%">表空间大小</th>
				<th data-options="field:'Auto_increment',align:'center'" width="10%">下一个自增值</th>
				<th data-options="field:'Create_time',align:'center'" width="10%">创建时间</th>
				<th data-options="field:'Update_time',align:'center'"  width="10%">最后更新</th>
				
			</tr>
		</thead>
	</table>
    </div>
</div>

 <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>