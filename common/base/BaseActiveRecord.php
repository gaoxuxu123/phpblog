<?php
   
namespace common\base;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
/**
 * 基础的数据操作类
 */
class BaseActiveRecord extends ActiveRecord{
	/**
	 * 单条数据查询
	 * $where 条件数组
	 * $order 排序字段
	 * return array
	 */
	public static function findOne($where=null,$order=null){
			$query = static::find();
			//条件为空
			if($where == null){
				//排序不为空	
				if($order !== null){

						$query = $query->orderBy($order);
				  }

				return $query->one();
			}
			//判断数组是否是关联数组
			else if(ArrayHelper::isAssociative($where)){

					$result = $query->andWhere($where);
					if($order !== null){

						$result = $result->orderBy($order);
				  	}
				  return $result->one();		
			}
			else{

				// 根据主键查询
				 $primaryKey = static::primaryKey();
					if(isset($primaryKey[0]))
					{
						$ret = $query->andWhere([$primaryKey[0] => $where]);
						if($order !== null)
						{
							$ret = $ret->orderBy($order);
						}
						return $ret->one();
					}
					else
					{
						throw new InvalidConfigException(get_called_class() . ' must have a primary key.');
					}
			}
	}
	/**
	 * 多条数据查询
	 * $where 条件数组
	 * $order 排序字段
	 * return array
	 */
	public static function findAll($condition = null, $order = null){

		$query = static::find();

		if($condition == null)
		{
			if($order !== null)
			{
				$query = $query->orderBy($order);
			}
			return ArrayHelper::toArray($query->all());
		}
		
		if(ArrayHelper::isAssociative($condition))
		{
			
			$ret = $query->andWhere($condition);
			if($order !== null)
			{
				$ret = $ret->orderBy($order);
			}
			return ArrayHelper::toArray($ret->all());
		}
		else
		{
			// 根据主键查询
			$primaryKey = static::primaryKey();
			if(isset($primaryKey[0]))
			{
				$ret = $query->andWhere([$primaryKey[0] => $condition]);
				if($order !== null)
				{
					$ret = $ret->orderBy($order);
				}
				return ArrayHelper::toArray($ret->all());
			}
			else
			{
				throw new InvalidConfigException(get_called_class() . ' must have a primary key.');
			}
		}
	}
	/**
	 * 分页方法
	 */
	public static function dataPage($where = null,$page = null){

		$query = static::find();
			//每页显示几条
			$limit  = $page['pageSize'];
			//计算分页
			$offset = ($page['pageIndex'] - 1) * $limit;
		if($where == null){
			
			$ret  = $query->offset($offset)->limit($limit)->all();
		}else{

				$ret = $query->andWhere($where);
				$ret  = $query->offset($offset)->limit($limit)->all();
		}
		return ArrayHelper::toArray($ret);
	}
	/**
	 * 获取总页数
	 * $where 查询条件数组
	 */
	public static function dataCount($where = null){

			$query = static::find();
			if($where == null){

				$totalCount = $query->count();
			}else{

				$totalCount = $query->andWhere($where)->count();
			}
			return $totalCount;
	}
	/**
	 * 删除方法
	 * params 
	 * ids  id 数组 
	 * $tableName 数据库表名字
	 */
	public static function dataDelete($ids = null,$tableName){


			if($ids == null){

				return false;
			}
			else{
						$connection = static::getDb();
						$len 		= count($ids);
						$SQL 		= 'DELETE FROM '.$tableName.' WHERE id in (';
						for ($i = 0; $i<$len;$i++) {
							
							$SQL.=$ids[$i];
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

?>

