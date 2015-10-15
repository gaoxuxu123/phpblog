 $(function(){
            $('#table').datagrid({
                title:'任务列表',
                iconCls:'icon r2_c15',
                width:'100%',
                height:'auto',
                autoRowHeight: false,
                border:true,
                collapsible:true,
                url:"admin.php?r=task/tasklistjson", //服务器地址,返回json格式数据
                loadMsg:'正在加载数据...',
                frozenColumns:[[
                    {field:'ck',width:80,checkbox:true}
                ]],
                pagination:true,  //分页控件
                toolbar:[{
                    id:'btncut',
                    text:'删除',
                    iconCls:'icon-remove',
                    handler:function(){
                        $('#btnsave').linkbutton('enable');
                       
                        $.messager.confirm('消息','确定删除吗?',function(r){

                            if(r){
                             var ids = [];
                             var rows = $('#table').datagrid('getSelections');
                             for(var i=0;i<rows.length;i++){
                                    ids.push(rows[i].id);
                                }
                              $.post(
                                    "admin.php?r=task/taskdelete",
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
            //任务时时刷新
            setInterval("Reflash()",5000);           
        });
     function rowformater(value,row,index){

        if(row.status == '1'){

            return "<a href='javascript:void(0)' onclick=start('"+row.id+"')  iconCls='icon-search'>开始任务</a>";
        }else if(row.status == '2'){

            return "任务进行中";
        }else{

            return "任务已完成";
        }
        
     }
     function downformater(value,row,index){

        if(row.status == '3'){

            return "<a href='javascript:void(0)' onclick=down('"+row.id+"')  iconCls='icon-search'>开始下载</a>";
        }else{

            return "等待任务完成才可以下载";
        }
        
     }
     function statusformater(value,row,index){

        if(row.status == '1'){

            return "未开始";
        }else if(row.status == '2'){

            return "正在执行";
        }else if(row.status == '3'){

             return "已完成";
        }
     }
     function timeformater(value,row,index){

        var timespance = row.createtime;
        return getLocalTime(timespance);

     }
     function start(id){

        $.post(
                "admin.php?r=task/taskdo",
                {id:id},
                function (){

                },
                "json"
            );
             $('#table').datagrid('reload');
            $.messager.alert('消息','任务已经成功执行');
            
        
     }
     function down(id){

        location.href="admin.php?r=task/taskdownload&id="+id;    
     }
      function Reflash(){

            $('#table').datagrid('reload');
     }
     function getLocalTime(nS) {   

       return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");      
    } 