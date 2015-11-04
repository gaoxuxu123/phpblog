<?php
/**
 * 配置菜单
 */
return [
		'menus'=>[
          'menus'=>[

          			['menuid'=>'1','icon'=>'r26_c14','menuname'=>'系统管理',
          			'menus'=>[

	          					['menuid'=>'2','menuname'=>'用户管理','icon'=>'icon-users','url'=>'admin.php/admin/userlist'],
	          					['menuid'=>'3','menuname'=>'数据库管理','icon'=>'icon-role','url'=>'admin.php/database/'],
	          					['menuid'=>'4','menuname'=>'权限设置','icon'=>'icon-set','url'=>''],
	          					['menuid'=>'5','menuname'=>'系统日志','icon'=>'icon-log','url'=>''],
	          					['menuid'=>'9','menuname'=>'回收站','icon'=>'r3_c18','url'=>'']
          			       ]
          			 ],
          			 [
          			 	'menuid'=>'6','icon'=>'r4_c7','menuname'=>'文章管理',
          			 	'menus'=>[
          			 				['menuid'=>'7','menuname'=>'文章列表','icon'=>'r4_c14','url'=>'admin.php/article/'],
          			 				['menuid'=>'8','menuname'=>'Tag标签管理','icon'=>'r3_c14','url'=>'admin.php/tag/taglist'],
                                             ['menuid'=>'10','menuname'=>'文章分类管理','icon'=>'r17_c2','url'=>'admin.php/articleclass/']
          			 	        ]
          			 ],
                          [
                              'menuid'=>'11','icon'=>'r3_c17','menuname'=>'任务管理',
                              'menus'=>[
                                        ['menuid'=>'12','menuname'=>'任务列表','icon'=>'r2_c10','url'=>'admin.php/task/tasklist']
                                       ]


                          ]
                ]
          ],
          'dbtype'=>[
                      'usually'=>['INT','VARCHAR','TEXT','CHAR','FLOAT','DOUBLE'],
                      'NUMERIC'=>['TINYINT','SMALLINT','MEDIUMINT','BIGINT','DECIMAL','REAL','BIT','BOOLEAN','SERIAL'],
                      'DATE and TIME'=>['DATE','DATETIME','TIMESTAMP','TIME','YEAR'],
                      'STRING'=>['TINYTEXT','MEDIUMTEXT','LONGTEXT','BINARY','VARBINARY','TINYBLOB','MEDIUMBLOB','BLOB','LONGBLOB','ENUM','SET'],
                      'SPATIAL'=>['GEOMETRY','POINT','LINESTRING','POLYGON','MULTIPOINT','MULTILINESTRING','MULTIPOLYGON','GEOMETRYCOLLECTION']
          ]
];
