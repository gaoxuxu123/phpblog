 $(function(){
            $('#table').datagrid({
                title:'Tags列表',
                iconCls:'icon r18_c8',
                width:'100%',
                height:'auto',
                autoRowHeight: false,
                border:true,
                collapsible:true,
                url:"admin.php?r=tag/taglistjson", //服务器地址,返回json格式数据
                loadMsg:'正在加载数据...',
                frozenColumns:[[
                    {   field:'ck',
                        width:80,
                        formatter: function (value,row,index) {
                            return "<input type=\"checkbox\"  name=\"tids\" value=\"" + row.id + "\" >";
                        },
                        
                  }
                ]],
                pagination:true,  //分页控件
                toolbar:[{
                    id:'btnadd',
                    text:'添加',
                    iconCls:'icon-add',
                    handler:function(){
                        $('#btnsave').linkbutton('enable');
                       
                        $('#add').dialog('open');
                    }
                },{
                    id:'btncut',
                    text:'删除',
                    iconCls:'icon-remove',
                    handler:function(){
                        $('#btnsave').linkbutton('enable');
                         var items = $("input[name='tids']:checked");
                            
                        $.messager.alert('消息',items.length);
                    }
                },'-',{
                    id:'btnsave',
                    text:'修改',
                    iconCls:'icon-edit',
                    handler:function(){
                        $('#btnsave').linkbutton('enable');
                        $.messager.alert('消息','修改');
                    }
                },
                    {
                        id: 'btnexport',
                        text: '导出',
                        iconCls: 'icon-print',
                        handler: function () {
                            $('#btnsave').linkbutton('enable');
                            $.messager.alert('消息', '导出');
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
            //tag添加方法
            $(".submit").click(function(){

               $.post(
                        "admin.php?r=tag/tagadd",
                        {
                            tagname:$("#tagname1").val()
                        },
                        function (data){

                            if(data.status == 1){

                                 $.messager.alert('消息',data.content);
                            }else{

                                $.messager.alert('消息',data.content);
                            }
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
            //tag修改js方法
            $(".modifysubmit").click(function(){
            		//$.messager.alert('消息','ok');
                    $.post(
                             "admin.php?r=tag/tagmodify",
                             {
                                id:$("#id").val(),
                                tagname:$("#tagname").val()
                             },
                             function (data){
                                if(data.status == 1){

                                     $.messager.alert('消息',data.content);
                                    
                                }else{

                                    $.messager.alert('消息',data.content);
                                }    
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
		 	return "<a href='javascript:void(0)' onclick=modify('"+row.id+"','"+row.tagname+"')  class='easyui-linkbutton'  data-options=iconCls:'icon-ok'>修改</a>";
		 }
		 function modify(id,tagname){

		 		$('#modify').dialog('open');
		 		$("#id").val(id);
		 		$("#tagname").val(tagname);
		 }
             