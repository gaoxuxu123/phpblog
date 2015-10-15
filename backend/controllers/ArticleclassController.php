<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Articleclass;
use common\helpers\Helper;
 class ArticleclassController extends Controller
 {
 		public $layout = false; //不使用布局
 		public  $enableCsrfValidation=false;//不使用csrf

 		/**
 		 * 文章分类首页
 		 * [actionIndex description]
 		 * @return [type] [description]
 		 */
 		public function actionIndex(){


 			  return $this->render('articleclasslist');
 		}
 		/**
 		 * 文章分类列表json数据
 		 */
 		public function actionArticleclasslistjson(){


 				$articleclassModel 	= Articleclass::getInstance();
 				$pageIndex  		= \Yii::$app->request->post('page');
	 			$pageSize   		= \Yii::$app->request->post('rows');
	 			$page 				= ['pageSize'=>$pageSize,'pageIndex'=>$pageIndex];
	 			$articleclassList  	= $articleclassModel::dataPage(null,$page);
	 			$total 				= $articleclassModel::dataCount();
	 		
	 			$json 				= ['total'=>$total,

			 					  		'rows'=>$articleclassList
			 						   ];
	 			Helper::Echo_Json(1,$json);	
 		}
 		/**
 		 * 文章分类添加
 		 */
 		public function actionArticleclassadd(){

 			$classname 			   = \Yii::$app->request->post('classname');
 			$classModel 		   = Articleclass::getInstance();
 			$classModel->classname = $classname;
 			if($classModel->save()){

				Helper::Echo_Json(1,'数据添加成功');
 			}else{

 				Helper::Echo_Json(0,'数据添加失败');
 			}
 		}
 		/**
 		 * 文章分类修改
 		 */
 		public function actionArticleclassmodify(){

 			$id        		   			  = \Yii::$app->request->post('id');
 			$classname 		   			  = \Yii::$app->request->post('classname');		
 			$articleclassModel 			  = Articleclass::findOne($id);
 			$articleclassModel->classname = $classname;
 			if($articleclassModel->save()){

 				Helper::Echo_Json(1,'数据修改成功');
 			}else{

 				Helper::Echo_Json(0,'数据修改失败');
 			}
 		}
 		/**
 		 * 文章分类删除
 		 */
 		public function actionArticleclassdelete(){

 			$ids 			= \Yii::$app->request->post('ids');
 			$ids 			= explode(',',$ids);
 			$classModel 	= Articleclass::getInstance();
 			$flag			= $classModel::dataDelete($ids,Articleclass::tableName());
 			if($flag){

 				Helper::Echo_Json(1,'数据删除成功');
 			}else{
 				Helper::Echo_Json(1,'数据删除失败');
 			}

 		}
 		/**
 		 * 文章分类添加导出队列任务
 		 */
 		public function actionArticleclassexport(){

 				$taskModel    			= new \common\models\Task();
 				$taskModel->taskname 	= '文章分类导出';
 				$taskModel->createtime 	= time();
 				$taskModel->status      = '1';
 				$taskModel->exportcolumn= 'ClassId,Classname'; 
 				$taskModel->model       = 'Articleclass';
 				if($taskModel->save()){

 					Helper::Echo_Json(1,'队列任务添加成功');
 				}else{

 					Helper::Echo_Json(0,'队列任务添加失败');
 				}
 		}

 }