<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\base\BaseActiveRecord;

 /**
 * 数据库操作类
 */
 class Database extends BaseActiveRecord
 {
 		private static $_instance;
 		private static $connection;
 		public function __construct(){

 			parent::__construct();
 			self::$connection =  static::getDb();

 		}
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
		 * 获取所有的表名
		 */
		public static function getTables(){

			
			$command      = self::$connection->createCommand('SHOW TABLES');
			$ret          = $command->queryAll();
			return $ret;
		}
		/**
		 * 获取表字段详细信息
		 */
		public static function getColumnInfos($table = null){

			if($table == null){

				return false;
			}
			else{

				$command      = self::$connection->createCommand('SHOW FULL COLUMNS FROM '.$table);

				$ret          = $command->queryAll();
				return $ret;
			}
		}
		/**
		 * 获取表详细信息
		 */
		public static function getTableInfo($table = null){

				if($table == null){

				return false;
				}
				else{

					$command      = self::$connection->createCommand("SHOW TABLE STATUS FROM phpblog WHERE Name = :name");
					$command->bindValue(':name', $table);
					$ret          = $command->queryAll();
					return $ret;
				}
		}
		/**
		 * 执行SQL语句
		 */
		public static function executeSQL($sql = null){

			if($sql == null){

				return false;
			}
			else{
					 return self::$connection->createCommand($sql)->execute();

			}
		}

}