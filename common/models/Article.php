<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\base\BaseActiveRecord;

 /**
 * 文章数据操作类
 */
 class Article extends BaseActiveRecord
 {
 		private static $_instance;
 	
 		public static function tableName(){

 			return 'ligao_article';
 		}
 		
		public static function getInstance(){

			if(!(self::$_instance instanceof self)){

				self::$_instance = new self;
			}
		   return self::$_instance;
		}
		/**
		 * 添加文章
		 * [addArticle description]
		 */
		public static function addArticle($postdata=null){

				if($postdata == null){

					return false;
				}
				$map['title'] = $postdata['title'];


		}	
 		
 }





?>