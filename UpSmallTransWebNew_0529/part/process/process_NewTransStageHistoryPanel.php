<div class="easyui-layout" data-options="fit:true">
    <div data-options="region:'north'" style="height:30px; width: 100%;overflow: hidden">
        <div class="easyui-panel" style="background-color: #E0ECFF;  width: 110%;height:30px;overflow: hidden">
    <span style="padding-left: 5px ;width: 100%">日期选择：
        <span><input id="StartDate_History" type="text" class="easyui-datebox"  name='StartDate_History' value="2019-11-18" style="width:120px;"></span>
        -
        <span><input id="EndDate_History" type="text" class="easyui-datebox" name='EndDate_History' value="2019-11-30" style="width:120px;"></span>
    </span>
            <span>统计范围：
        <span id='UnitType_Person_History' >
            <input type="radio" name="UnitType3_History" value="1" onclick={UnitType_RadioFun_History()} />个人
        </span>
        <span id='UnitType_Group_History'>
            <input type="radio" name="UnitType3_History" value="2" onclick={UnitType_RadioFun_History()} />小组
        </span>
        <span id='UnitType_Dept_History'>
            <input id='UnitType_Dept_History1' type="radio" name="UnitType3_History" value="3" onclick={UnitType_RadioFun_History()} checked="true"/>部门
        </span>
        <span id='UnitType_RegionType_History'>
            <input id='UnitType_RegionType1_History' type="radio" name="UnitType3_History" value="4" onclick={UnitType_RadioFun_History()} />中心
        </span>
    </span>

        </div>
    </div>
    <div data-options="region:'center'">
        <div id="Btns_History" >
        <span>
        用户来源：
        <select id="UserSourceid_History" class="easyui-combobox" name="UserSource"
                data-options="editable:false,panelHeight:'auto'"
                style="width:70px;">
            <option name="UnitType4_History" value="-1">所有</option>
            <option name="UnitType4_History" value="1">清洗</option>
            <option name="UnitType4_History" value="2">练习</option>
            <option name="UnitType4_History" value="3">新号</option>
            <option name="UnitType4_History" value="4">流转</option>
        </select>
        </span>
            <span>
        人员类型：
        <select id="PersonTypeid_History" class="easyui-combobox" name="PersonType"
                data-options="editable:false,panelHeight:'auto'"
                style="margin-left:10px;width:110px;" disabled>
            <option name="UnitType5_History" value="0">所有</option>
            <option name="UnitType5_History" value="600000">组长</option>
            <option name="UnitType5_History" value="800000">中级销售员</option>
            <option name="UnitType5_History" value="700000">初级销售员</option>
        </select>
    </span>
            <a id="user_maturityButton" href="javascript:OpenWindow();" class="easyui-linkbutton" data-options="iconCls:'icon-large-chart'">用户成熟度</a>
            <a id="searchButton_History" href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">刷新</a>
        </div>
        <div id="pp_History" style="background:#efefef;border:1px solid #ccc;"></div>
        <table id="dg_History" data-options="fit:true"></table>
    </div>
</div>
<!-- echarts 图标 window -->
<div id="Echarts_win" style="overflow: hidden">
    <div class="easyui-panel" style="background-color: #E0ECFF; width:100%;height:30px;">
        <span style="padding-left:5px;padding-right:10px;width: 300px;height: 30px;line-height: 30px; border-right: whitesmoke 1px solid">
            用户来源：
            <select id="sourceType2" class="easyui-combobox" name="UserSource"
                    data-options="editable:false,panelHeight:'auto'" style="height: 20px;line-height: 30px;margin:auto">
                <option name="sourceType_2" value="-1">所有</option>
                <option name="sourceType_2" value="1">清洗</option>
                <option name="sourceType_2" value="2">练习</option>
                <option name="sourceType_2" value="3">新号</option>
                <option name="sourceType_2" value="4">流转</option>
            </select>
        </span>
        <span id="username" style="padding-left: 10px"></span>
    </div>
    <div id="container" style="width:1000px;height:550px;"></div>
</div>
<script type="text/javascript" src="js/datagrid_config.js?ver=<?php echo time(); ?>"></script>
<script type="text/javascript">
    $(function () {
        var selectType = 3;
        var sourceType = -1;
        var id = 0;

        //查询按钮
        $('#searchButton_History').click(function(){
            $("#dg_History").datagrid("loading");
            $("#dg_History").datagrid("loadData",{total:0,rows:[]});
            $("#dg_History").datagrid("sort",{sortName: '', sortOrder: ''});
            getData();
        });

        // 数据网格
        $('#dg_History').datagrid().datagrid({
            method:"get",
            toolbar:"#pp_History",
            striped:true,
            singleSelect:true,
            collapsible:false,
            loadMsg:"正在努力加载数据....",
            remoteSort:false,
            sortOrder:'asc',

            columns:process_NewTransStageHistory,

            onBeforeSortColumn:function(sort, order){
                // datagrid排序前把全部数据加载进去
                if (dg_data != null){
                    var data = dg_data;
                    if (!data.rows){
                        ((data.data).stdata).forEach(function (value,index) {
                            value["rowId"] = -1;
                        });
                        (((data.data).data).data).forEach(function (value,index) {
                            value["rowId"] = index+1;
                        });
                        var new_stdata = data.data.stdata;
                        var new_data = data.data.data.data;
                        data = {
                             total: new_data.length,
                            rows: new_data,
                            stdata: new_stdata
                        };
                        $("#dg_History").datagrid('loadData', data);
                    }
                }
            },

            onSortColumn:function(sort,order){
                var new_rows = [];
                var rowId = 1;
                var data = $("#dg_History").datagrid("getData");
                var rows = data.rows;
                for(var i=0;i<rows.length;i++){
                    var row = rows[i];
                    if(row["rowId"] == -1){
                        new_rows.splice(0,0,row)
                    }else {
                        row["rowId"] = rowId;
                        new_rows.splice(i,0,row);
                        rowId += 1;
                    }
                }
                data.rows = new_rows;
                data = loadFilter(data);
                data = pageFilter(data);
                $("#dg_History").datagrid('loadData', data);

                if (data.stdata) {
                    for (var j = 0; j < data.stdata.length; j++) {
                        $('#dg_History').datagrid('insertRow', {
                            index: j,
                            row: data.stdata[j]
                        });
                    }
                }
            },

            rowStyler: function(index,row){
                if (row["rowId"] == -1){
                    return 'color:#0000FF;'
                }
            },
        });

        //分页
        $('#pp_History').pagination({
            pageList: [100, 200, 400, 1000],
            pageSize: 400,
            pageNumber:1,
            total:0,
            showRefresh: false,
            buttons: '#Btns_History',
            onChangePageSize:function(pageSize){
                pageSize=pageSize;
            },
            onSelectPage: function (pageNumber, pageSize) {
                var data = load_data;
                pageNumber = pageNumber;
                pageSize = pageSize;
                total = data.total;
                data = pageFilter(data);
                $("#dg_History").datagrid('loadData', data);
                if (data.stdata) {
                    for (var j = 0; j < data.stdata.length; j++) {
                        $('#dg_History').datagrid('insertRow', {
                            index: j,
                            row: data.stdata[j]
                        });
                    }
                }
            }
        });
        // 过滤数据
        function loadFilter(data) {
            if (!data.rows) {
                ((data.data).stdata).forEach(function (value, index) {
                    value["rowId"] = -1;
                });
                (((data.data).data).data).forEach(function (value, index) {
                    value["rowId"] = index + 1;
                });
                var new_stdata = data.data.stdata;
                var new_data = data.data.data.data;
                data = {
                    total: new_data.length,
                    rows: new_data,
                    stdata: new_stdata
                };
            }
            return data;
        }
        // 前端分页
        function pageFilter(data) {
            var opts=$("#pp_History").pagination("options");
            if(opts.pageNumber == 0){opts.pageNumber = 1}
            var start = (opts.pageNumber - 1) * parseInt(opts.pageSize);
            var end = start + parseInt(opts.pageSize);
            if (!data.originalRows) {
                data.originalRows = (data.rows);
            }
            var slice_rows = data.originalRows.slice(start, end);
            data.rows = slice_rows;
            return data
        }



        // 向后台传递日期等参数变量
         function getData(){
            $("#dg_History").datagrid("loadData",{total:0,rows:[]});
            var StartDate_History=$('#StartDate_History').datebox('getValue');
            var EndDate_History=$('#EndDate_History').datebox('getValue');
            var StartDate_History=dateToInt(StartDate_History);
            var EndDate_History=dateToInt(EndDate_History);
            var selectType = $('input[name="UnitType3_History"]:checked').val();
            var sourceType = $('option[name="UnitType4_History"]:checked').val();
            // var sourceType2 = $('option[name="UnitType6"]:checked').val();
            var PersonType = $('option[name="UnitType5_History"]:checked').val();       //id
            // var id = $('#MainTree').tree('getSelected').id;
            var id = $('#MainTree').tree('getSelected').id + parseInt(PersonType);
             $.ajax({
                 type: 'GET',
                 url: "interface/asynRead.php?cmd=getData",
                 data: {
                     "command": "get360GuoChengInfo",
                     "startDate": StartDate_History,
                     "endDate": EndDate_History,
                     "id": id,
                     "type": meType,
                     "selectType": selectType,
                     "cs": selectType,
                     "sourceType": sourceType,
                     "isHistory":1,
                 },
                 dataType: "json",
                 success: function (data) {
                     if (data.result != "OK"){
                         $.messager.alert('消息提示', data.result, 'info');
                         $("#dg_History").datagrid('loaded');
                         return;
                     } else {
                         dg_data = data;
                         data = loadFilter(data);
                         load_data = data;
                         data = pageFilter(data);
                         $('#pp_History').pagination('refresh',{total:data.total});
                         $("#dg_History").datagrid("loadData", data);
                         if (data.stdata) {
                             for (var j = 0; j < data.stdata.length; j++) {
                                 $('#dg_History').datagrid('insertRow', {
                                     index: j,
                                     row: data.stdata[j]
                                 });
                             }
                         }
                         $('#dg_History').datagrid("reload");
                     }
                 },
                 error:function () {
                     $.messager.alert('消息提示', "解析错误！");
                     $("#dg_History").datagrid('loaded');
                     return;
                 }
             })
        }

        function dateToInt(str) {
            //在全文查找用g ‘-’在正则中直接写，不用加引号
            var str1=str.replace(/-/g,'');
            var num = parseInt(str1);
            return num;
        }
    });

    function UnitType_RadioFun_History(){
        var dg_History=$('#dg_History');
        dg_History.datagrid("loadData",{total:0,rows:[]});
        if($('input[name="UnitType3_History"]:checked').val() == 1){
            $("#PersonTypeid_History").combobox("enable");
            dg_History.datagrid('showColumn','DeptName');
            dg_History.datagrid('showColumn','HireDate');
            dg_History.datagrid('showColumn','PositionName');
            dg_History.datagrid('showColumn','IsLeave');
        }else{
            $("#PersonTypeid_History").combobox("disable");
            dg_History.datagrid('hideColumn','DeptName');
            dg_History.datagrid('hideColumn','HireDate');
            dg_History.datagrid('hideColumn','PositionName');
            dg_History.datagrid('hideColumn','IsLeave');
        }
    }
</script>
<script type="text/javascript" charset="UTF-8" src="js/echarts.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="js/echarts-gl.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="js/echarts_use_setting.js?ver=<?php echo time();?>"></script>
