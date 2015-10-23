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
 			//获取数据类型,读取配置文件
 			$dbtype = \Yii::$app->params['dbtype'];
 			return $this->render('tablelist',['tables'=>$tables,'dbtype'=>$dbtype]);
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
 		/**
 		 * 字段信息修改
 		 */
 		public function actionColumnmodify(){

 			$tableName 		= \Yii::$app->request->post('tableName');
 			$field_name 	= \Yii::$app->request->post('field_name');
 			$old_field_name = \Yii::$app->request->post('old_field_name');
 			$isnull    		= \Yii::$app->request->post('isnull');	
 			$field_type 	= \Yii::$app->request->post('field_type');
 			$filed_length 	= \Yii::$app->request->post('filed_length');
 			$field_default 	= \Yii::$app->request->post('field_default');
 			$field_comment 	= strip_tags(\Yii::$app->request->post('field_comment'));
 			$auto_increment = \Yii::$app->request->post('auto_increment');
 			if($field_default == 'NONE' || $field_default == 'NULL'){

 				$field_default = 'NULL';
 			}
 			//拼接SQL
 			$SQL 			 ="ALTER TABLE {$tableName} CHANGE  {$old_field_name}  {$field_name}  {$field_type}({$filed_length})  {$isnull} ";
 			if($auto_increment){

 				$SQL.= " AUTO_INCREMENT ";
 			}
 			$SQL.=" default {$field_default} COMMENT '".$field_comment."' ";
 			$base   		 = Database::getInstance();
 			$ret             = $base::executeSQL($SQL); 
 			Helper::Echo_Json(1,'字段修改成功');				
 		}

 }