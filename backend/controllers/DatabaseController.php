<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\helpers\Helper;
use common\models\Database;
 class DatabaseController extends Controller
 {
 		public $layout = false; //不使用布局
 		public  $enableCsrfValidation=false;


 		public function actionIndex(){


 			
 			$base   = Database::getInstance();
 			$tables = $base::getTables();
 			return $this->render('tablelist',['tables'=>$tables]);
 		}
 		/**
 		 * 获取表列信息
 		 */
 		public function actionTabcolumninfos(){

 			$tableName = \Yii::$app->request->get('tableName');
 			$base   = Database::getInstance();
 			$tableInfos = $base::getColumnInfos($tableName);
 			$table  = $base::getTableInfo($tableName);
 			/*echo "<pre>";
 			print_r($table);
 			exit;*/
 			$json 			= ['total'=>count($tableInfos),

	 					  		'rows'=>$tableInfos
	 						   ];	

			Helper::Echo_Json(1,$json);	
 		}
 		/**
 		 * 获取结构信息
 		 */
 		public function actionTabinfos(){

 			$tableName = \Yii::$app->request->get('tableName');
 			$base   = Database::getInstance();	
 			$table  = $base::getTableInfo($tableName);
 			$json 			= ['total'=>count($table),

	 					  		'rows'=>$table
	 						   ];	

			Helper::Echo_Json(1,$json);	
 		}

 }