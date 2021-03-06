<div class="easyui-layout" data-options="fit:true">
    <div data-options="region:'north'" style="height:30px; width: 100%;overflow: hidden">
        <div class="easyui-panel"  style="background-color: #E0ECFF;  width: 110%;height:30px;overflow: hidden">
    <span style="padding-left: 5px ;width: 100%">成单日期：
        <span><input id="StartDate_History" type="text" class="easyui-datebox"  name='StartDate_History' value="2018-11-12" style="width:120px;"></span>
        -
        <span><input id="EndDate_History" type="text" class="easyui-datebox" name='EndDate_History' value="2018-12-18" style="width:120px;"></span>
    </span>
            <span>统计范围：
        <span id='UnitType_Person_History' >
            <input type="radio" name="UnitType3_History" value="1" onclick={UnitType_RadioFun_History()} />个人
        </span>
        <span id='UnitType_Group_History'>
            <input type="radio" name="UnitType3_History" value="2" onclick={UnitType_RadioFun_History()} />小组
        </span>
        <span id='UnitType_Dept_History'>
            <input id='UnitType_Dept1_History' type="radio" name="UnitType3_History" value="3" onclick={UnitType_RadioFun_History()} checked="true"/>部门
        </span>
        <span id='UnitType_RegionType_History'>
            <input id='UnitType_RegionType1_History' type="radio" name="UnitType3_History" value="4" onclick={UnitType_RadioFun_History()} />中心
        </span>
    </span>
            <span style="padding-left: 10px">列排序选择：
        <span id='' >
            <input type="radio" name="UnitType4_History" value="1" onclick={ColumnSort_RadioFun_History()} >用户激活期
        </span>
        <span id=''>
            <input type="radio" name="UnitType4_History" value="2" onclick={ColumnSort_RadioFun_History()} >用户响应期
        </span>
        <span id=''>
            <input type="radio" name="UnitType4_History" value="3" onclick={ColumnSort_RadioFun_History()} >用户上拽期
        </span>
    </span>

        </div>
    </div>
    <div data-options="region:'center'">
        <div id="Btns_History" >
        <span>
        用户类型：
        <select  class="easyui-combobox" name="serviceLevelId_History"
                 data-options="editable:false,panelHeight:'auto'"
                 style="width:120px;">
            <option name="UnitType5_History" value="-1">所有</option>
            <option name="UnitType5_History" value="1">360所有</option>
            <option name="UnitType5_History" value="4">360老用户</option>
            <option name="UnitType5_History" value="5">360新用户</option>
            <option name="UnitType5_History" value="2">3600所有</option>
            <option name="UnitType5_History" value="6">3600老用户</option>
            <option name="UnitType5_History" value="7">3600新用户</option>
            <option name="UnitType5_History" value="3">18000</option>
        </select>
        </span>
            <!--        <span>-->
            <!--        人员类型：-->
            <!--        <select  id="PersonTypeid" class="easyui-combobox" name="PersonType"-->
            <!--                 data-options="editable:false,panelHeight:'auto'"-->
            <!--                 style="margin-left:10px;width:110px;" disabled>-->
            <!--            <option name="UnitType6" value="0">所有</option>-->
            <!--            <option name="UnitType6" value="600000">组长</option>-->
            <!--            <option name="UnitType6" value="800000">中级销售员</option>-->
            <!--            <option name="UnitType6" value="700000">初级销售员</option>-->
            <!--        </select>-->
            <!--        </span>-->
            <span>
            基数选择：
        <select class="easyui-combobox" name="ClassName_History"
                data-options="editable:false,panelHeight:'auto'"
                style="width:95px;">
            <option name="UnitType7_History" value="7" >当前资源</option>
            <option name="UnitType7_History" value="1" selected>锁定资源</option>
            <option name="UnitType7_History" value="2">转B资源</option>
            <option name="UnitType7_History" value="5">B1资源</option>
            <option name="UnitType7_History" value="3">B3资源</option>
            <option name="UnitType7_History" value="4">B+资源</option>
            <option name="UnitType7_History" value="6">听课人数</option>
        </select>
        </span>
            <a id="searchButton_History" href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload'">刷新</a>
        </div>
        <div id="pp_History" style="background:#efefef;border:1px solid #ccc;"></div>
        <table id="dg_History"  data-options="fit:true"></table>
    </div>
</div>
<script type="text/javascript" src="js/datagrid_config.js?ver=<?php echo time(); ?>"></script>
<script type="text/javascript">
    var columns = [];
    $(function () {
        //设置激活响应上拽期
        var ActStartDate = ActList[1].ActStartDate;
        var ActEndDate = ActList[1].ActEndDate;
        var RespondStartDate = ActList[1].RespondStartDate;
        var RespondEndDate = ActList[1].RespondEndDate;
        var UpStartDate = ActList[1].UpStartDate;
        var UpEndDate = ActList[1].UpEndDate;
        var now_date = new Date();
        now_date.setTime(now_date.getTime());
        if (ActStartDate == null || ActEndDate == null ||
            RespondStartDate == null || RespondEndDate == null ||
            UpStartDate == null || UpEndDate == null){
            document.getElementsByName('UnitType4_History')[2].checked='checked';
            columns = process_AdvanceTransStage_3;
        } else {
            if(now_date >= new Date(ActStartDate).getTime() &&
                now_date <= new Date(ActEndDate).getTime()){
                document.getElementsByName('UnitType4_History')[0].checked='checked';
                columns = process_AdvanceTransStage_1;
            }else if (now_date >= new Date(RespondStartDate).getTime() &&
                now_date <= new Date(RespondEndDate).getTime()) {
                document.getElementsByName('UnitType4_History')[1].checked='checked';
                columns = process_AdvanceTransStage_2;
            }else if(now_date >= new Date(UpStartDate).getTime() &&
                now_date <= new Date(UpEndDate).getTime()){
                document.getElementsByName('UnitType4_History')[2].checked='checked';
                columns = process_AdvanceTransStage_3;
            }else {
                document.getElementsByName('UnitType4_History')[2].checked='checked';
                columns = process_AdvanceTransStage_3;
            }
        }

        var selectType = 3;
        var serviceLevelId = -1;
        var PersonType = 0;       //id
        var ClassName = 1;

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

            columns:columns,

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
            var sourceType = $('option[name="UnitType5_History"]:checked').val();
            // var PersonType = $('option[name="UnitType6"]:checked').val();       //id
            var ClassName = $('option[name="UnitType7_History"]:checked').val();
            var id = $('#MainTree').tree('getSelected').id;
             $.ajax({
                 type: 'GET',
                 url: "interface/asynRead.php?cmd=getData",
                 data: {
                     "command": "get18000GuoChengInfo",
                     "startDate": StartDate_History,
                     "endDate": EndDate_History,
                     "id": id,
                     "type": meType,
                     "selectType": selectType,
                     "sourceType":sourceType,
                     "cs": selectType,
                     "ClassName": ClassName,
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
            $("#PersonTypeid").combobox("enable");
            dg_History.datagrid('showColumn','DeptName');
            dg_History.datagrid('showColumn','HireDate');
            dg_History.datagrid('showColumn','PositionName');
            dg_History.datagrid('showColumn','IsLeave');
        }else{
            $("#PersonTypeid").combobox("disable");
            dg_History.datagrid('hideColumn','DeptName');
            dg_History.datagrid('hideColumn','HireDate');
            dg_History.datagrid('hideColumn','PositionName');
            dg_History.datagrid('hideColumn','IsLeave');
        }
    }
    function ColumnSort_RadioFun_History() {
        var dg_History=$('#dg_History');
        dg_History.datagrid("loadData",{total:0,rows:[]});
        var columnsort = parseInt($('input[name="UnitType4_History"]:checked').val());
        switch (columnsort) {
            case 1:
                $('#dg_History').datagrid({columns: process_AdvanceTransStage_1});
                break;
            case 2:
                $('#dg_History').datagrid({columns: process_AdvanceTransStage_2});
                break;
            case 3:
                $('#dg_History').datagrid({columns: process_AdvanceTransStage_3});
                break;
        }
    }

</script>
