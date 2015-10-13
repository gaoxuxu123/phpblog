<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //全局的js和css
    public $css = [
        'backend/web/scripts/css/default.css',
        'backend/web/scripts/js/jquery-easyui-1.4.3/themes/icon.css',
        'backend/web/scripts/js/jquery-easyui-1.4.3/themes/easyui_icons.css',
        'backend/web/scripts/js/jquery-easyui-1.4.3/themes/default/easyui.css'
    ];
    public $js = [
        'backend/web/scripts/js/jquery-easyui-1.4.3/jquery.min.js',
        'backend/web/scripts/js/jquery-easyui-1.4.3/jquery.easyui.min.js'
    ];
    public $depends = [
        
    ];
    //定义按需加载JS方法，注意加载顺序在最后  
    public static function addScript($view, $jsfile) {  
        $view->registerJsFile($jsfile, ['depends'=>['backend\assets\AppAsset']]);  
    }  
      
   //定义按需加载css方法，注意加载顺序在最后  
    public static function addCss($view, $cssfile) {  
        $view->registerCssFile($cssfile, ['depends'=>['backend\assets\AppAsset']]);  
    }  

}
