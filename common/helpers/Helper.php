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
      /**
       * alert操作提示输出方法
       */
      public static function alert_msg($flag){

        if($flag){

         echo "<script>alert('操作成功');parent.location.reload();</script>";

        }else{

            echo "<script>alert('操作失败');parent.location.reload();</script>";
        }
      }
    /**
     * 删除文件夹以及下面的文件
     * @param  [type] $dir [description]
     * @return [type]      [description]
     */
    public static function deldir($dir) {

        $dh=opendir($dir);

        while ($file=readdir($dh)) {

            if($file!="." && $file!="..") {

                $fullpath=$dir."/".$file;

                if(!is_dir($fullpath)) {

                    unlink($fullpath);
                } else {

                    deldir($fullpath);
                }
            }
        }
        closedir($dh);
        if(rmdir($dir)) {
            return true;
          } else {
            return false;
        }
    }
  }


?>