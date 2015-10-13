<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\base\BaseActiveRecord;


class Tags extends BaseActiveRecord{

	    private static $_instance;
 	
 		public static function tableName(){

 			return 'ligao_tags';
 		}
 		
		public static function getInstance(){

			if(!(self::$_instance instanceof self)){

				self::$_instance = new self;
			}
		   return self::$_instance;
		}
		/**
		 * Tags删除，参数，tids数组
		 */
		public static function tagsDelete($tids = null){

			if($tids == null){

				return false;
			}
			else{

						$connection = \Yii::$app->db;
						$len 		= count($tids);
						$SQL 		= 'DELETE FROM '.static::tableName().' WHERE id in (';
						for ($i = 0; $i<$len;$i++) {
							
							$SQL.=$tids[$i];
							if($i<($len-1)){

								$SQL.=',';
							}
						}
						$SQL.=')';
						$command 	= $connection->createCommand($SQL);
						$flag 	 	= $command->execute();
						return $flag;
			}
		}
}