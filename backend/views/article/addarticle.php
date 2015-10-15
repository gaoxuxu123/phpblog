<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;
$this->title = '添加文章';
AppAsset::register($this);
AppAsset::addScript($this,WEBPATH.'/scripts/js/ueditor/ueditor.config.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/ueditor/ueditor.all.min.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/ueditor/lang/zh-cn/zh-cn.js');

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
<body style="background-color:#FFFFFF">
 <?php $this->beginBody() ?>
 <div style="border:1px solid #ccc;padding:5px;">

 <form id="form1"  method="post" style="margin-top:20px;margin-left:10px" action="<?php echo Url::toRoute('article/addarticledo') ?>">
       <div>
       		<label>文章标题:</label>
       		<input name="title" class="easyui-validatebox" required="true" style="width:950px;height:20px" missingMessage="文章标题不能为空">
       </div>
        <div>
       		<p>文章内容:</p>
       		<div>
       			<script id="editor" type="text/plain" style="width:1000px;height:500px;"></script>
       		</div>
       </div>
       <br>
       <div>
       		<fieldset style="width:660px;border:1px solid #ccc">      			
       			<legend>选择Tag标签:</legend>
				<div>    
            <?php foreach($tagsList as $v):?>  			
       			    <input type="checkbox" name='tag[]' value="<?php echo $v['tagname'] ?>"><?php echo $v['tagname'] ?>
       			 <?php endforeach;?> 
       		</div>
       		</fieldset>
       </div>
       <br>
       <div>
		<fieldset style="width:660px;border:1px solid #ccc">   
			<legend>文章分类</legend>
			<div>
       <?php foreach($classList as $v):?>  
			  <input type="radio" name='class' value="<?php echo $v['id'] ?>"><?php echo $v['classname'] ?>
		   <?php endforeach;?> 
		</div>
		</fieldset>
       </div>
       <br>
       <div>
		 <p>文章摘要：</p>
		  <div>
		  	<textarea rows="5" cols="165" name="brief"></textarea>
		  </div>
       </div>
        <br>
       <div style="padding:15px;background:#fafafa;width:980px;border:1px solid #ccc;" align="right">
       		<a href="javascript:void(0)" class="easyui-linkbutton submit" iconCls="icon-ok">提交</a>
			     <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel">取消</a>
	   </div>
    </form>
</div>
 <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script type="text/javascript">
	
	  $(function(){

        	var ue = UE.getEditor('editor');
           SyntaxHighlighter.all() //执行代码高亮
           SyntaxHighlighter.defaults['toolbar'] = false;
        	$(".submit").click(function(){

        			$("#form1").submit();
        	});
   
        });

</script>