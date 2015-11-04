<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\helpers\Helper;
 class TestController extends Controller
 {
 		public $layout = false; //不使用布局
 		public  $enableCsrfValidation=false;


 		public function actionArticlelist(){


 				print_r($_GET);

 		}
 		public function actionMymethod(){


 				echo "Hello";

 		}


 }