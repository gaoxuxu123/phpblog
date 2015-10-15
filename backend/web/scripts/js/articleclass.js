 $(function(){
            $('#table').datagrid({
                title:'文章分类列表',
                iconCls:'icon r4_c12',
                width:'100%',
                height:'auto',
                autoRowHeight: false,
                border:true,
                collapsible:true,
                url:"admin.php?r=articleclass/articleclasslistjson", //服务器地址,返回json格式数据
                loadMsg:'正在加载数据...',
                frozenColumns:[[
                    {field:'ck',width:80,checkbox:true}
                ]],
                pagination:true,  //分页控件
                toolbar:[
                {
                    id:'btnadd',
                    text:'添加',
                    iconCls:'icon-add',
                    handler:function(){
                        $('#btnsave').linkbutton('enable');
                        $('#add').dialog('open');

                    }
                },
                {
                    id:'btncut',
                    text:'删除',
                    iconCls:'icon-remove',
                    handler:function(){
                        $('#btncut').linkbutton('enable');

                        $.messager.confirm('消息','确定删除吗?',function(r){

                            if(r){
                            //获取选择的checkbox
                            var ids = [];
                            var rows = $('#table').datagrid('getSelections');
                            for(var i=0;i<rows.length;i++){
                                ids.push(rows[i].id);
                            }
                            $.post(
                                     "admin.php?r=articleclass/articleclassdelete",
                                     {
                                        ids:ids.join(',')
                                     },
                                     function (data){

                                            $.messager.alert('消息',data.content);
                                            //防止IE下面url没有变化不刷新的情况
                                            var url = $('#table').datagrid('options').url;  
                                            if (url.indexOf("_t=") > 0) {  
                                                url = url.replace(/_t=\d+/, "_t=" + new Date().getTime());  
                                            } else {  
                                                url = url.indexOf("?") > 0  
                                                    ? url + "&_t=" + new Date().getTime()  
                                                    : url + "?_t=" + new Date().getTime();  
                                            }  
                                            $('#table').datagrid('reload'); 
                                     },
                                    "json"  
                                ); 
                            }
                            });                                          
                      }
                  },'-',
                    {
                        id: 'btnexport',
                        text: '导出',
                        iconCls: 'icon-print',
                        handler: function () {
                            $('#btnexport').linkbutton('enable');
                            $.post(
                                    "admin.php?r=articleclass/articleclassexport",
                                    {},
                                    function (data){

                                        $.messager.alert('消息',data.content);
                                    },
                                    "json"
                                );
                        }
                    }
                ]
            });
            var p = $('#table').datagrid('getPager');
            $(p).pagination({
                pageSize: 10,//每页显示的记录条数，默认为10
                pageList:[5,10,15,20],//每页显示几条记录
                beforePageText: '第',//页数文本框前显示的汉字
                afterPageText: '页    共 {pages} 页',
                displayMsg: '当前显示 {from} - {to} 条记录    共 {total} 条记录',
                onBeforeRefresh:function(){
                    $(this).pagination('loading');//正在加载数据中...
                    $(this).pagination('loaded'); //数据加载完毕
                }
            }); 
            //分类添加方法
            $(".submit").click(function(){
                    $.post(
                            "admin.php?r=articleclass/articleclassadd",
                            {
                                classname:$("#classname1").val()
                            },
                            function (data){

                                $.messager.alert('消息',data.content);
                                $('#add').dialog('close');
                                //防止IE下面url没有变化不刷新的情况
                                var url = $('#table').datagrid('options').url;  
                                if (url.indexOf("_t=") > 0) {  
                                    url = url.replace(/_t=\d+/, "_t=" + new Date().getTime());  
                                } else {  
                                    url = url.indexOf("?") > 0  
                                        ? url + "&_t=" + new Date().getTime()  
                                        : url + "?_t=" + new Date().getTime();  
                                }  
                                $('#table').datagrid('reload'); 
                            },
                            "json"
                        );
                });  
             $(".modifysubmit").click(function(){

                    $.post(
                             "admin.php?r=articleclass/articleclassmodify",
                             {
                                id:$("#id").val(),
                                classname:$("#classname").val()
                             },
                             function (data){

                                $.messager.alert('消息',data.content);
                                $('#modify').dialog('close');
                                //防止IE下面url没有变化不刷新的情况
                                var url = $('#table').datagrid('options').url;  
                                if (url.indexOf("_t=") > 0) {  
                                    url = url.replace(/_t=\d+/, "_t=" + new Date().getTime());  
                                } else {  
                                    url = url.indexOf("?") > 0  
                                        ? url + "&_t=" + new Date().getTime()  
                                        : url + "?_t=" + new Date().getTime();  
                                }  
                                $('#table').datagrid('reload'); 
                             },
                             "json"
                        );
             });        
        });
         function rowformater(value,row,index)
         {
            return "<a href='javascript:void(0)' onclick=modify('"+row.id+"','"+row.classname+"')  iconCls='icon-search'>修改</a>";
         }
          function modify(id,classname){

                $('#modify').dialog('open');
                $("#id").val(id);
                $("#classname").val(classname);
         }