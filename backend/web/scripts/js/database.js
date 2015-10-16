 $(function(){
            $('#table').datagrid({
               
                width:'100%',
                height:'auto',
                autoRowHeight: false,
                border:true,
                collapsible:true,
                url:"admin.php?r=database/tabcolumninfos&tableName=ligao_article", //服务器地址,返回json格式数据
                loadMsg:'正在加载数据...',
                frozenColumns:[[
                    {field:'ck',width:80,checkbox:true}
                ]],
                pagination:false,  //分页控件
                toolbar:[]
            }); 

            $('#table1').datagrid({
               
                width:'100%',
                height:'auto',
                autoRowHeight: false,
                border:true,
                collapsible:true,
                url:"admin.php?r=database/tabinfos&tableName=ligao_article", //服务器地址,返回json格式数据
                loadMsg:'正在加载数据...',
                pagination:false,  //分页控件
                toolbar:[]
            }); 

        });

    function showcontent(table){
        
        $('#table').datagrid({url:"admin.php?r=database/tabcolumninfos&tableName="+table});
        $('#table').datagrid('reload'); 
        $('#table1').datagrid({url:"admin.php?r=database/tabinfos&tableName="+table});
        $('#table1').datagrid('reload'); 
    }
    function typeformater(value,row,index){

        var t = row.Type;

        if(t.indexOf("(") > 0){
            var tarr = t.split("(");
            return tarr[0];
        }else{

            return t;
        }
    }
    function lengthformater(value,row,index){

        
         var t = row.Type;
         if(t.indexOf("(") > 0){
             var tarr = t.split("(");
             var tarr1 = tarr[1].split(")"); 
            return tarr1[0];
        }else{
            return 0;
        }
    }
    function ispriformater(value,row,index){

        var pri = row.Key;
        if(pri == 'PRI'){

            return "是";
        }else{

            return "否";
        }
    }
    function isnullformater(value,row,index){

        var isnull = row.Null;
        if(isnull == "NO"){

            return "否";
        }else{

            return "是";
        }
    }
    function defaultformater(value,row,index){

        var isdefault = row.Default;
        if(isdefault){

            return isdefault;
        }else{

            return "NULL";
        }
    }
    function datalengthformater(value,row,index){

        var length = row.Data_length;
        return (length/1024).toFixed(2)+"kb";

    }
    function indexlengthformater(value,row,index){

        var length = row.Index_length;
        return (length/1024).toFixed(2)+"kb";

    }
    function tablelengthformater(value,row,index){

        var length = row.Data_free;
        return (length/1024).toFixed(2)+"kb";
    }