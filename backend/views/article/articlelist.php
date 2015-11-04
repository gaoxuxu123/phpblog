<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use yii\helpers\Url;
$this->title = '文章列表';
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
<table id="article">
    <thead>
    <tr>
        <th data-options="field:'title',align:'center'" width="20%">文章标题</th>
        <th data-options="field:'tag',align:'center'" width="10%">Tag标记</th>
        <th data-options="field:'hits',align:'center'" width="5%">点击量</th>
        <th data-options="field:'pubtime',align:'center',formatter:timeformater" width="14%">发布时间</th>
        <th data-options="field:'istop',align:'center'" width="10%">是否置顶</th>
        <th data-options="field:'good',align:'center'" width="5%">顶</th>
        <th data-options="field:'bad',align:'center'" width="5%">踩</th>
        <th data-options="field:'brief',align:'center'" width="25%">文章简介</th>
        <th data-options="field:'manager',align:'center',formatter:rowformater" width="5%">操作</th>
    </tr>
    </thead>
</table>
<div id="openRoleDiv" class="easyui-window" closed="true" iconCls="icon-add" collapsible="false" modal="true" title="文章添加" style="width:1200px;height:850px;">
    <iframe scrolling="auto" id='openIframe' frameborder="0"  src="<?php  echo Url::toRoute('admin.php/article/addarticle') ?>" style="width:100%;height:800px;"></iframe>
</div>

  <?php $this->endBody() ?>
</body>
 <script type="text/javascript">SyntaxHighlighter.all();</script>  
    <!--用于消除右上角的广告-->  
    <script type="text/javascript">SyntaxHighlighter.defaults['toolbar'] = false;</script> 
</html>
<?php $this->endPage() ?>
