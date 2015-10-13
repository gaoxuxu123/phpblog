<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Article;
use common\models\Tags;
use common\models\Articleclass;
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


	 				$postdata = \Yii::$app->request->post();
	 				echo '<pre>';
	 				print_r($postdata);
 				
 				
 		}
 		//文章列表
 		public function actionArticlelist(){

 			$articleModel = Article::getInstance();
 			$list = $articleModel::findAll();
 			echo '<pre>';
 			print_r($list);


 		}



}