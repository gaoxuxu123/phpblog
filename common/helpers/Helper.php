<?php
namespace common\helpers;
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
  }


?>