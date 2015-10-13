<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\helpers\Helper;
 class AdminController extends Controller
 {
 		public $layout = false; //不使用布局
 		public  $enableCsrfValidation=false;
 		
 		//后台主界面
 		public function actionIndex(){

 				//获取配置的菜单
 				$menus = \Yii::$app->params['menus'];

 				return $this->render('index',['menus'=>json_encode($menus)]);
 		}
 		//界面
 		public function actionUserlist(){

 				return $this->render('userlist');
 		}
 		//列表
 		public function actionUserjson(){

 			$arr = [

 					'total'=>'1',
 					'rows'=>[

 						['productid'=>'FI-SW-01','productname'=>'Dalmation','unitcost'=>'10.2','status'=>'P','listprice'=>'36.50','attr1'=>'Large','itemid'=>'EST-1']

 					]	
 			];
 			Helper::Echo_Json(1,$arr);
 		}
 }


?>