<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;
$this->title = 'ligaoblog管理后台';
AppAsset::register($this);
AppAsset::addScript($this,WEBPATH.'/scripts/js/jquery-easyui-1.4.3/outlook2.js');
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
<body class="easyui-layout" style="overflow-y: hidden"  scroll="no">
 <?php $this->beginBody() ?>
   <!--top-->
    <div data-options="region:'north',border:false" style="height:7%;background:#E0ECFF;text-align: center" class="head">
    	
		<!--头部内容-->

    </div>
    <div region="west" hide="true" split="true" title="导航菜单" style="width:200px;" id="west">
        <div id="nav" class="easyui-accordion" fit="true" border="false">
            <!--  导航内容 -->
        </div>
    </div>
    <!--center-->
    <div id="mainPanle" region="center" style="background: #eee; overflow-y:hidden">
        <div id="tabs" class="easyui-tabs"  fit="true" border="false" >
            <div title="欢迎使用" style="padding:20px;overflow:hidden; color:red; " >
                <iframe scrolling="auto" frameborder="0" name="content"  src="demo.html" style="width:100%;height:100%;"></iframe>
            </div>
        </div>
    </div>
    <!--footer-->
    <div data-options="region:'south',border:false"  class="footer">Copyright©2015 ligaoBlog版权所有</div>
 <?php $this->endBody() ?>

 </body>
 </html>
 <?php $this->endPage() ?>
    <script type="text/javascript">
        var _menus = <?php echo $menus ?>;
  </script>
