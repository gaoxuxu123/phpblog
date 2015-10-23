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

            $("#field_default").change(function(){
                
                    if($(this).val() == 'USER_DEFINED'){

                        $("#userfiled").css('display','block');
                    }else{
                        $("#userfiled").css('display','none');
                    }                
            });
            $(".submit").click(function(){

                    var field_default  = $("#field_default").val();
                    var auto_increment = $("#auto_increment").attr("checked");
                    var inc = '0';
                    if(auto_increment){
                         inc = '1';   
                    }
                    if(field_default == 'USER_DEFINED'){

                        field_default = $("#userfiled").val();
                    }
                    $.post(
                                "admin.php?r=database/columnmodify",
                                {
                                    tableName:$("#tableName").val(),
                                    field_name:$("#field_name").val(),
                                    field_type:$("#field_type").val(),
                                    filed_length:$("#filed_length").val(),
                                    field_default:$("#field_default").val(),
                                    isnull:$('input[name="isnull"]:checked ').val(),
                                    field_comment:$("#field_comment").val(),
                                     old_field_name:$("#old_field_name").val(),
                                     field_default:field_default,
                                     auto_increment:inc
                                },
                                function (data){

                                    $.messager.alert('消息',data.content);
                                    $('#table').datagrid('reload'); 
                                    $("#modify").dialog('close');    
                                },
                                "json"
                        );
                });

        });

    function showcontent(table){
        
        $("#tableName").val(table);
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
    function managerformater(value,row,index){

        return "<a href='javascript:void(0)' onclick=modify('"+row.Field+"','"+row.Type+"','"+row.Default+"','"+row.Comment+"','"+row.Extra+"','"+row.Null+"') class='easyui-linkbutton' iconCls='icon-reload'>修改</a>";
    }
    function modify(Field,Type,Default,Comment,Extra,Null){

        $("#field_name").val(Field);
        $("#old_field_name").val(Field);
        $("#field_comment").val(Comment);
        if(Extra){

            $("#auto_increment").attr("checked",true);
        }else{
            $("#auto_increment").attr("checked",false);
        }
        if(Null){

            $("#isnull2").attr("checked",true);
        }else{
            $("#isnull2").attr("checked",false);
            $("#isnull1").attr("checked",true);
        }
        var type;
        var length;
        if(Type.indexOf("(") > 0){
             type =  Type.split("(");
             length = type[1].split(")");
            type = type[0].toUpperCase(); 
        }else{
            type = Type.toUpperCase();
            length = '0';
        }
        
        
        $("#field_type option[value!='"+type+"']").attr("selected",false);
        $("#field_type option[value='"+type+"']").attr("selected",true);
        $("#filed_length").val(length[0]);
        if(Default != "null"){
            $("#field_default option[value='USER_DEFINED']").attr("selected",true);
            $("#userfiled").css('display','block');
            $("#userfiled").val(Default);

        }else{


        }      
        $("#modify").dialog('open');

    }