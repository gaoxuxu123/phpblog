<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;
$this->title = '文章预览';
AppAsset::register($this);
AppAsset::addScript($this,WEBPATH.'/scripts/js/article.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/ueditor/third-party/SyntaxHighlighter/shCore.js');
AppAsset::addCss($this,WEBPATH.'/scripts/js/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css');
AppAsset::addScript($this,WEBPATH.'/scripts/js/syntaxjs/shBrushJScript.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/syntaxjs/shBrushPhp.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/syntaxjs/shBrushJava.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/syntaxjs/shBrushCpp.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/syntaxjs/shBrushAS3.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/syntaxjs/shBrushPython.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/syntaxjs/shBrushVb.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/syntaxjs/shBrushSql.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/syntaxjs/shBrushXml.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/syntaxjs/shBrushPlain.js');
AppAsset::addScript($this,WEBPATH.'/scripts/js/syntaxjs/shBrushJScript.js');
AppAsset::addCss($this,WEBPATH.'/scripts/js/shCoreEclipse.css');
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
		
		<?php echo $article->content;?>

 <?php $this->endBody() ?>
</body>
 <script type="text/javascript">SyntaxHighlighter.all();</script>  
    <!--用于消除右上角的广告-->  
    <script type="text/javascript">SyntaxHighlighter.defaults['toolbar'] = false;</script> 
</html>
<?php $this->endPage() ?>