<?php
namespace common\helpers;
use common\models\Tags;
use common\models\Articleclass;
  /**
   * 帮助工具类
   */
  class Helper {

  		/**
  		 * json输出方法
  		 * @param [type] $status  [description]
  		 * @param [type] $content [description]
  		 */
  		public static function Echo_Json($status,$content){


  				$json = ['status' => $status,'content'=>$content];
  				if(is_array($content)){

  					$json = json_encode($content);
  				}
  				else{

  					$json = json_encode($json);
  				}
  				die($json);	
  		}
      /**
       * 获取model
       */
      public static function getModelInstance($modelName = null){

        if($modelName == null){

          return false;
        }
        else{
            switch ($modelName) {
              case 'Tags':
                   return Tags::getInstance(); 
                break;
              case 'Articleclass':
                    return Articleclass::getInstance();
                break;
              default:
                return false;
                break;
            }
        }

      }
  }


?>