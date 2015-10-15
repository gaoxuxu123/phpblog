  $(function(){
        	
            $('#article').datagrid({
                title:'文章列表',
                iconCls:'icon r4_c7',
                width:'100%',
                height:'auto',
                autoRowHeight: false,
                border:true,
                collapsible:true,
                url:"admin.php?r=article/articlelistjson", //服务器地址,返回json格式数据
                loadMsg:'正在加载数据...',
                frozenColumns:[[
                    {field:'ck',width:80,checkbox:true}
                ]],
                pagination:true,  //分页控件
                toolbar:[{
                    id:'btnadd',
                    text:'添加',
                    iconCls:'icon-add',
                    handler:function(){
                        $('#btnsave').linkbutton('enable');
                        //window.location.href="<?php  echo Url::toRoute('article/addarticle') ?>";
                        $('#openRoleDiv').dialog('open');
                    }
                },{
                    id:'btncut',
                    text:'删除',
                    iconCls:'icon-remove',
                    handler:function(){
                        $('#btnsave').linkbutton('enable');
                        $.messager.alert('消息','删除');
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
                            $('#btnexport').linkbutton('enable');
                            $.messager.alert('消息', '导出');
                        }
                    },'-',{
                        id: 'btnview',
                        text: '预览',
                        iconCls: 'icon r18_c15',
                        handler: function () {
                            $('#btnview').linkbutton('enable');
                            //$.messager.alert('消息', '预览');
                             var selected = $('#article').datagrid('getSelected');
                                if (selected){
                                    
                                var iHeight = 700;
                                var iWidth = 800;
                                var url= "admin.php?r=article/articledetail"+"&id="+selected.id;
                                var name='';
                                var iTop = (window.screen.availHeight-30-iHeight)/2;       //获得窗口的垂直位置;
                                var iLeft = (window.screen.availWidth-10-iWidth)/2;           //获得窗口的水平位置;
                                window.open(url,name,'height='+iHeight+',innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=yes,resizeable=no,location=no,status=no');      

                                }else{

                                    $.messager.alert('消息', '请选择要预览的文章');
                                }
                            
                        }
                    }
                ]
            });
            var p = $('#article').datagrid('getPager');
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
        });

        function rowformater(value,row,index){

            return "<a href='javascript:void(0)' onclick=modify('"+row.id+"','"+row.title+"')  iconCls='icon-search'>修改</a>";
        }
        function timeformater(value,row,index){

            var timespance = row.pubtime;
            return getLocalTime(timespance);
        }
        function getLocalTime(nS) {   

           return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");      
        } 