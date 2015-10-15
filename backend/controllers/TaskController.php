<?php 

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Task;
use common\helpers\Helper;
use yii\helpers\ArrayHelper;
	/**
	* 执行任务控制器
	*/
	class TaskController extends Controller
	{
			
			public  $layout = false; //不使用布局
 			public  $enableCsrfValidation=false;//不使用csrf
			/**
			 * 任务列表界面
			 */
			public function actionTasklist(){


				return $this->render('tasklist');
			}
			/**
			 * 任务json列表
			 */
			public function actionTasklistjson(){

				$taskModel 	= Task::getInstance();
				$pageIndex  = \Yii::$app->request->post('page');
	 			$pageSize   = \Yii::$app->request->post('rows');
	 			$page 		= ['pageSize'=>$pageSize,'pageIndex'=>$pageIndex];
	 			$tagsList  	= $taskModel::dataPage(null,$page);
	 			$total 		= $taskModel::dataCount();
	 		
	 			$json 		= ['total'=>$total,

	 					  		'rows'=>$tagsList
	 						   ];
	 			Helper::Echo_Json(1,$json);
			}
			/**
			 * 任务删除
			 */
			public function actionTaskdelete(){

				 $ids 			= \Yii::$app->request->post('ids');
				 $ids 			= explode(',',$ids);
				 $taskModel 	= Task::getInstance();	
				 $flag 			= $taskModel::dataDelete($ids,Task::tableName());
				 if($flag){

				 	Helper::Echo_Json(1,'数据删除成功');
				 }else{
				 	Helper::Echo_Json(0,'数据删除失败');
				 }

			}
			/**
			 * 执行队列任务
			 */
			public function actionTaskdo(){

				$id 				= \Yii::$app->request->post('id');
				$taskModel 			= Task::getInstance();
				//修改数据库状态
				$taskModel 			= Task::findOne($id);
				$taskModel->status 	= '2';
				$taskModel->save();
				$path 				= '../taskfiles/'.date('Y-m-d');
				$filename 			= time().rand(0,9).rand(0,9).rand(0,9).rand(0,9).'.csv';
				if(!file_exists($path)){

					mkdir($path,0777);
				}
				$fp = fopen($path.'/'.$filename,'w');
				//定义表头
				$column_name		= explode(',',$taskModel->exportcolumn);
				//写入标题
				fputcsv($fp, $column_name);
				//做分次读数据库
				$pagecount 			= 100;//一次读取多少条 
				//获取记录总数
				$cmodel      		= $taskModel->model;
				//实例化model对象
				$tmodel     		= Helper::getModelInstance($cmodel);
				$total				= $tmodel::dataCount();
				for ($i=0;$i<intval($total/$pagecount)+1;$i++){  

						$pageIndex  = $i*$pagecount;
	 					$pageSize   = $pagecount;	
	 					$page 		= ['pageSize'=>$pageSize,'pageIndex'=>$pageIndex];
	 					$taskList  	= $tmodel::dataPage(null,$page);
	 					foreach ( $taskList as $item ) {  
		                	$rows 	= [];  
			                foreach ( $item as $v){  

			                $rows[] = $v;  
			              } 
                			fputcsv($fp, $rows);  
            		}		  
				}
				fclose($fp);			
				$taskModel->status 	= '3';
				$taskModel->url     = $path.'/'.$filename;
				$taskModel->save();
			}
			/**
			 * 任务下载
			 */
			public function actionTaskdownload(){

				$id 				= \Yii::$app->request->get('id');
				$taskModel 			= Task::findOne($id);
				$url				= $taskModel->url;
				$start 				= strrpos($url, '/');
				$filename 			= substr($url, $start+1);	
				//打开文件      
		        $fp= fopen ( $url, "r" );      
		        //输入文件标签       
		        Header ( "Content-type: application/octet-stream" );      
		        Header ( "Accept-Ranges: bytes" );      
		        Header ( "Accept-Length: " . filesize ( $url ) );      
		        Header ( "Content-Disposition: attachment; filename=".$filename );      
		        //输出文件内容       
		        //读取文件内容并直接输出到浏览器      
		        while(!feof($fp)) {  

	                         set_time_limit(0);  
	                         echo fread($fp,1024);  
	                         flush();  
	                         ob_flush();  
		             }   
		        fclose ( $fp);      
		        exit ();  
			}
	    }

?>