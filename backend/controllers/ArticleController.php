<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Article;
use common\models\Tags;
use common\models\Articleclass;
use common\helpers\Helper;
 class ArticleController extends Controller
 {
 		public $layout = false; //不使用布局
 		public  $enableCsrfValidation=false;//不使用csrf
 
 		//文章首页
 		public function actionIndex(){


 			return $this->render('articlelist');
 		}
 		//添加文章界面跳转
 		public function actionAddarticle(){

 			//获取tags
 			$tagModel 	= Tags::getInstance();
 			$tagsList  	= $tagModel::findAll();
 			//获取文章分类列表
 			$classModel = Articleclass::getInstance();
 			$classList  = $classModel::findAll();	
 			return $this->render('addarticle',['tagsList'=>$tagsList,'classList'=>$classList]);
 		}
 		//添加文章处理
 		public function actionAddarticledo(){


	 		  $postdata 			 = \Yii::$app->request->post();	 		 
	 		  $articleModel 		 = Article::getInstance();
	 		  $articleModel->title 	 = $postdata['title'];
	 		  $articleModel->tag   	 = implode(',', $postdata['tag']);
	 		  $articleModel->content = $postdata['editorValue'];
	 		  $articleModel->pubtime = time();
	 		  $articleModel->brief   = $postdata['brief'];
	 		  $articleModel->classid = $postdata['class'];
	 		  $flag					 = $articleModel->save();
	 		  Helper::alert_msg($flag);
 		}
 		/**
 		 * 文章预览
 		 */
 		public function actionArticledetail(){

 			$id 			= \Yii::$app->request->get('id');
 			$articleModel 	= Article::getInstance();
 			$article 		= $articleModel::findOne($id);

 			return $this->render('articledetail',['article'=>$article]);


 		}
 		//文章列表
 		public function actionArticlelistjson(){

 			$articleModel 	= Article::getInstance();
 			$pageIndex  	= \Yii::$app->request->post('page');
 			$pageSize   	= \Yii::$app->request->post('rows');
 			$page 			= ['pageSize'=>$pageSize,'pageIndex'=>$pageIndex];
 			$articleList    = $articleModel::dataPage(null,$page);
 			$total 			= $articleModel::dataCount();	
 			$json 			= ['total'=>$total,

	 					  		'rows'=>$articleList
	 						   ];
 			Helper::Echo_Json(1,$json);	
 		}
}