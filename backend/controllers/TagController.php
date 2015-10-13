<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Tags;
use common\helpers\Helper;
/**
* 标签控制器
*/
class TagController extends Controller
{
	
		public  $layout = false; //不使用布局
 		public  $enableCsrfValidation=false;//不使用csrf
 		//标签列表
 		public function actionTaglist(){
 			
 			return $this->render('taglist');	
 		}
 		/*
 		  标签列表的json数据
 		  要分页
 		 */
 		public function actionTaglistjson(){
 			//获取tags
 			$tagModel 	= Tags::getInstance();
 			$pageIndex  = \Yii::$app->request->post('page');
 			$pageSize   = \Yii::$app->request->post('rows');
 			$page 		= ['pageSize'=>$pageSize,'pageIndex'=>$pageIndex];
 			$tagsList  	= $tagModel::dataPage(null,$page);
 			$total 		= $tagModel::dataCount();
 		
 			$json 		= ['total'=>$total,

 					  		'rows'=>$tagsList
 						   ];
 			Helper::Echo_Json(1,$json);		
 		}
 		/**
 		 * 标签修改
 		 */
 		public function actionTagmodify(){

 			$tagModel 			= Tags::findOne(\Yii::$app->request->post('id'));
 			$tagModel->tagname  = \Yii::$app->request->post('tagname');
 			if($tagModel->save()){

 				Helper::Echo_Json(1,'数据修改成功');
 			}else{

 				Helper::Echo_Json(0,'数据修改失败');
 			}
 		}
 		/**
 		 * 标签添加
 		 */
 		public function actionTagadd(){

 			$tagModel			= Tags::getInstance();
 			$tagModel->tagname  = \Yii::$app->request->post('tagname');
 			if($tagModel->save()){

 				Helper::Echo_Json(1,'数据添加成功');
 			}else{

 				Helper::Echo_Json(0,'数据添加失败');
 			}
 		}
 		/**
 		 * 标签删除
 		 */
 		public function actionTagdelete(){

 			$ids 	= \Yii::$app->request->post('ids');
 			$tids 	= explode(',', $ids);
 			$flag  	=Tags::tagsDelete($tids);
 			if($flag){

 				Helper::Echo_Json(1,'数据删除成功');
 			}else{

 				Helper::Echo_Json(0,'数据删除失败');
 			}
 		}
 		/**
 		 * 标签导出任务创建
 		 */
 		public function actionTagexport(){

 				$taskModel 				= new \common\models\Task();
 				$taskModel->taskname 	= 'Tags标签导出';
 				$taskModel->createtime 	= time();
 				$taskModel->sql         = 'SELECT * FROM '.Tags::tableName();
 				$taskModel->status      = '1';
 				if($taskModel->save()){

 					Helper::Echo_Json(1,'队列任务添加成功');
 				}else{

 					Helper::Echo_Json(0,'队列任务添加失败');
 				}

 		}
}