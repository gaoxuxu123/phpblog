<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;
$this->title = '数据库列表';
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
				<th data-options="field:'mamager',align:'center',formatter:managerformater" width="10%">操作</th>
			</tr>
		</thead>
	</table>
	<div style="padding:5px;background:#fafafa;width:99.3%;border:1px solid #ccc">
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel">删除选中</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel">删除表</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="javascript:window.location.reload()" iconCls="icon-reload">刷新</a>
		<a href="javascript:void(0)" class="easyui-linkbutton columnAdd" iconCls="icon-add">添加字段</a>
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
<div id="modify" class="easyui-window" title="字段修改" closed="true" style="width:300px;height:400px;padding:5px;" align="left" >
		<input type="hidden" name="tableName" id="tableName" value="ligao_article">
		<input type="hidden" name="old_field_name" id="old_field_name" >
		<p>
				
			<label>字段名:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input type="text" name="field_name" id="field_name" >		

		</p>
		<p>
			<label>字段类型:&nbsp;&nbsp;</label>
			<select name="field_type" id="field_type">

				<?php foreach ($dbtype['usually'] as $k=>$v) :?>
					<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
				<?php endforeach;?>	
				<optgroup label="NUMERIC">
				<?php foreach ($dbtype['NUMERIC'] as $k=>$v) :?>
					<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
				<?php endforeach;?>	
				</optgroup>
				<optgroup label="DATE and TIME">
				<?php foreach ($dbtype['DATE and TIME'] as $k=>$v) :?>
					<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
				<?php endforeach;?>						
				</optgroup>
				<optgroup label="STRING">
				<?php foreach ($dbtype['STRING'] as $k=>$v) :?>
					<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
				<?php endforeach;?>		
				</optgroup>
				<optgroup label="SPATIAL">
				<?php foreach ($dbtype['SPATIAL'] as $k=>$v) :?>
					<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
				<?php endforeach;?>		
				</optgroup>
			</select>
		</p>
		<p>
			<label>字段长度:&nbsp;&nbsp;</label>
			<input type="text" name="filed_length" id="filed_length">
		</p>
		<p>
			<label>默认值:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<select name="field_default" id="field_default">
				<option value="NONE">无</option>
				<option value="USER_DEFINED" >定义:</option>
				<option value="NULL">NULL</option>
			</select>
			<br><br>
			<input type="text" name="userfiled" id="userfiled" style="display: none;margin-left:62px" >
		</p>
		<p>
			<label>是否为空:</label>
			<input type="radio" value="NULL" name="isnull" id="isnull1">空
			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" value="NOT NULL" name="isnull" id="isnull2">不为空
		</p>
		<p>
			<label>自动递增:&nbsp;&nbsp;</label>
			<input type="checkbox" name="auto_increment" id="auto_increment" >
		</p>
		<p>
			<label>注释:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input type="text" name="field_comment" id="field_comment" value="">
		</p>
		<div style="margin-left:62px">
			<a href="javascript:void(0)" class="easyui-linkbutton submit"  data-options="iconCls:'icon-ok'">保存</a>
			<a href="javascript:void(0)" class="easyui-linkbutton"  data-options="iconCls:'icon-cancel'">取消</a>
		</div>		
</div>
<div id="add" class="easyui-window" title="字段添加" closed="true" style="width:300px;height:400px;padding:5px;" align="left" >
		<input type="hidden" name="tableName" id="tableName_1" value="ligao_article">
		<p>
				
			<label>字段名:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input type="text" name="field_name" id="field_name_1" >		

		</p>
		<p>
			<label>字段类型:&nbsp;&nbsp;</label>
			<select name="field_type" id="field_type_1">

				<?php foreach ($dbtype['usually'] as $k=>$v) :?>
					<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
				<?php endforeach;?>	
				<optgroup label="NUMERIC">
				<?php foreach ($dbtype['NUMERIC'] as $k=>$v) :?>
					<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
				<?php endforeach;?>	
				</optgroup>
				<optgroup label="DATE and TIME">
				<?php foreach ($dbtype['DATE and TIME'] as $k=>$v) :?>
					<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
				<?php endforeach;?>						
				</optgroup>
				<optgroup label="STRING">
				<?php foreach ($dbtype['STRING'] as $k=>$v) :?>
					<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
				<?php endforeach;?>		
				</optgroup>
				<optgroup label="SPATIAL">
				<?php foreach ($dbtype['SPATIAL'] as $k=>$v) :?>
					<option value="<?php echo $v; ?>"><?php echo $v; ?></option>
				<?php endforeach;?>		
				</optgroup>
			</select>
		</p>
		<p>
			<label>字段长度:&nbsp;&nbsp;</label>
			<input type="text" name="filed_length" id="filed_length_1">
		</p>
		<p>
			<label>默认值:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<select name="field_default" id="field_default_1">
				<option value="NONE">无</option>
				<option value="USER_DEFINED" >定义:</option>
				<option value="NULL">NULL</option>
			</select>
			<br><br>
			<input type="text" name="userfiled" id="userfiled_1" style="display: none;margin-left:62px" >
		</p>
		<p>
			<label>是否为空:</label>
			<input type="radio" value="NULL" name="isnull_1" id="isnull1">空
			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" value="NOT NULL" name="isnull_1" id="isnull2">不为空
		</p>
		<p>
			<label>索引：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<select id="index" >
					<option value="">----</option>
					<option value="PRIMARY">主键索引</option>
					<option value="UNIQUE">唯一索引</option>
					<option value="INDEX">普通索引</option>
					<option value="FULLTEXT">全文索引</option>
			</select>
		</p>
		<p>
			<label>自动递增:&nbsp;&nbsp;</label>
			<input type="checkbox" name="auto_increment" id="auto_increment_1" >
		</p>
		<p>
			<label>注释:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			<input type="text" name="field_comment" id="field_comment_1" value="">
		</p>
		<div style="margin-left:62px">
			<a href="javascript:void(0)" class="easyui-linkbutton addColumn"  data-options="iconCls:'icon-ok'">保存</a>
			<a href="javascript:void(0)" class="easyui-linkbutton"  data-options="iconCls:'icon-cancel'">取消</a>
		</div>		
</div>
 <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>