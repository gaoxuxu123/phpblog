<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\base\BaseActiveRecord;


/**
* 
*/
class Articleclass extends BaseActiveRecord
{
	
	    private static $_instance;
 	
 		public static function tableName(){

 			return 'ligao_articleclass';
 		}
 		
		public static function getInstance(){

			if(!(self::$_instance instanceof self)){

				self::$_instance = new self;
			}
		   return self::$_instance;
		}
}