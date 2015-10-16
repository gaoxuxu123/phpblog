<?php
/**
 * 配置菜单
 */
return [
		'menus'=>[
          'menus'=>[

          			['menuid'=>'1','icon'=>'r26_c14','menuname'=>'系统管理',
          			'menus'=>[

	          					['menuid'=>'2','menuname'=>'用户管理','icon'=>'icon-users','url'=>'admin.php?r=admin/userlist'],
	          					['menuid'=>'3','menuname'=>'数据库管理','icon'=>'icon-role','url'=>'admin.php?r=database/index'],
	          					['menuid'=>'4','menuname'=>'权限设置','icon'=>'icon-set','url'=>''],
	          					['menuid'=>'5','menuname'=>'系统日志','icon'=>'icon-log','url'=>''],
	          					['menuid'=>'9','menuname'=>'回收站','icon'=>'r3_c18','url'=>'']
          			       ]
          			 ],
          			 [
          			 	'menuid'=>'6','icon'=>'r4_c7','menuname'=>'文章管理',
          			 	'menus'=>[
          			 				['menuid'=>'7','menuname'=>'文章列表','icon'=>'r4_c14','url'=>'admin.php?r=article/index'],
          			 				['menuid'=>'8','menuname'=>'Tag标签管理','icon'=>'r3_c14','url'=>'admin.php?r=tag/taglist'],
                                             ['menuid'=>'10','menuname'=>'文章分类管理','icon'=>'r17_c2','url'=>'admin.php?r=articleclass/index']
          			 	        ]
          			 ],
                          [
                              'menuid'=>'11','icon'=>'r3_c17','menuname'=>'任务管理',
                              'menus'=>[
                                        ['menuid'=>'12','menuname'=>'任务列表','icon'=>'r2_c10','url'=>'admin.php?r=task/tasklist']
                                       ]


                          ]
                ]
          ]
];
