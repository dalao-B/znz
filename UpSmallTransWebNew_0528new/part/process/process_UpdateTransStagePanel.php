<div class="easyui-layout" data-options="fit:true">
    <div data-options="region:'north'" style="height:30px; width: 100%;overflow: hidden">
        <div class="easyui-panel" style="background-color: #E0ECFF;  width: 110%;height:30px;overflow: hidden">
            <span style="padding-left: 5px ;width: 100%">成单日期：
                <span><input id="StartDate" type="text" class="easyui-datebox" name='StartDate' value="2020-05-15"
                             style="width:120px;"></span>
                -
                <span><input id="EndDate" type="text" class="easyui-datebox" name='EndDate' value="x"
                             style="width:120px;"></span>
            </span>
                    <span>统计范围：
                <span id='UnitType_Person'>
                    <input type="radio" name="UnitType3" value="1" onclick={UnitType_RadioFun()}>个人
                </span>
                <span id='UnitType_Group'>
                    <input type="radio" name="UnitType3" value="2" onclick={UnitType_RadioFun()}>小组
                </span>
                <span id='UnitType_Dept'>
                    <input id='UnitType_Dept1' type="radio" name="UnitType3" value="3" onclick={UnitType_RadioFun()}
                           checked="true"/>部门
                </span>
                <span id='UnitType_RegionType'>
                    <input id='UnitType_RegionType1' type="radio" name="UnitType3" value="4" onclick={UnitType_RadioFun()}>中心
                </span>
            </span>
                    <span style="padding-left: 10px">列排序选择：
                <span id=''>
                    <input type="radio" name="UnitType4" value="1" onclick={ColumnSort_RadioFun()}>用户激活期
                </span>
                <span id=''>
                    <input type="radio" name="UnitType4" value="2" onclick={ColumnSort_RadioFun()} checked="true"/>用户响应期
                </span>
                <span id=''>
                    <input type="radio" name="UnitType4" value="3" onclick={ColumnSort_RadioFun()}>用户上拽期
                </span>
            </span>
        </div>
    </div>
    <div data-options="region:'center'">
        <div id="Btns">
                <span>
                用户类型：
                <select class="easyui-combobox" name="serviceLevelId"
                        data-options="editable:false,panelHeight:'auto',panelWidth:'auto'"
                        style="width:100px;">
                    <option name="UnitType5" value="-1">所有类型</option>
                    <option name="UnitType5" value="-123">360_合计</option>
                    <option name="UnitType5" value="1">360_20年01月01日后</option>
                    <option name="UnitType5" value="2">360_19年11月16日-20年01月01日</option>
                    <option name="UnitType5" value="3">360_19年11月16日前</option>
                    <option name="UnitType5" value="4">3600_12个月内到期</option>
                    <option name="UnitType5" value="5">3600_24个月内到期</option>
                    <option name="UnitType5" value="7">360_20年01月01日后_B0无B1</option>
                </select>
                </span>
            <span>
                人员类型：
                <select id="PersonTypeid" class="easyui-combobox" name="PersonType"
                        data-options="editable:false,panelHeight:'auto',panelWidth:'auto'"
                        style="margin-left:10px;width:70px;" disabled>
                    <option name="UnitType6" value="0">所有</option>
                    <option name="UnitType6" value="600000">组长</option>
                    <option name="UnitType6" value="800000">中级销售员</option>
                    <option name="UnitType6" value="700000">初级销售员</option>
                </select>
                </span>
            <span>
                    基数选择：
                <select class="easyui-combobox" name="ClassName"
                        data-options="editable:false,panelHeight:'auto'"
                        style="width:95px;">
                    <option name="UnitType7" value="7">当前资源</option>
                    <option name="UnitType7" value="1" selected>锁定资源</option>
                    <option name="UnitType7" value="2">转B资源</option>
                    <option name="UnitType7" value="5">B1资源</option>
                    <option name="UnitType7" value="3">B3资源</option>
                    <option name="UnitType7" value="4">B+资源</option>
                    <option name="UnitType7" value="6">听课人数</option>
                </select>
                </span>
            <a id="searchButton" href="javascript:void(0)" class="easyui-linkbutton"
               data-options="iconCls:'icon-reload'">刷新</a>
        </div>
        <div id="pp" style="background:#efefef;border:1px solid #ccc;"></div>
        <table id="dg" data-options="fit:true"></table>
    </div>
</div>
<script type="text/javascript" src="js/datagrid_config.js?ver=<?php echo time(); ?>"></script>
<script type="text/javascript">
    var columns = [];
    $(function () {
        var selectType = 3;
        var serviceLevelId = -1;
        var PersonType = 0;       //id
        var ClassName = 1;

        //查询按钮
        $('#searchButton').click(function () {
            $("#dg").datagrid("loading");
            $("#dg").datagrid("loadData", {total: 0, rows: []});
            $("#dg").datagrid("sort", {sortName: '', sortOrder: ''});
            getData();
        });

        // 数据网格
        $('#dg').datagrid().datagrid({
            method: "get",
            toolbar: "#pp",
            striped: true,
            singleSelect: true,
            collapsible: false,
            loadMsg: "正在努力加载数据....",
            remoteSort: false,
            sortOrder: 'asc',
            columns:process_UpdateTransStage_2,

            onBeforeSortColumn: function (sort, order) {
                // datagrid排序前把全部数据加载进去
                if (dg_data != null) {
                    var data = dg_data;
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
                        $("#dg").datagrid('loadData', data);
                    }
                }
            },

            onSortColumn: function (sort, order) {
                var new_rows = [];
                var rowId = 1;
                var data = $("#dg").datagrid("getData");
                var rows = data.rows;
                for (var i = 0; i < rows.length; i++) {
                    var row = rows[i];
                    if (row["rowId"] == -1) {
                        new_rows.splice(0, 0, row)
                    } else {
                        row["rowId"] = rowId;
                        new_rows.splice(i, 0, row);
                        rowId += 1;
                    }
                }
                data.rows = new_rows;
                data = loadFilter(data);
                data = pageFilter(data);
                $("#dg").datagrid('loadData', data);

                if (data.stdata) {
                    for (var j = 0; j < data.stdata.length; j++) {
                        $('#dg').datagrid('insertRow', {
                            index: j,
                            row: data.stdata[j]
                        });
                    }
                }
            },

            rowStyler: function (index, row) {
                if (row["rowId"] == -1) {
                    return 'color:#0000FF;'
                }
            },
        });

        //分页
        $('#pp').pagination({
            pageList: [100, 200, 400, 1000],
            pageSize: 400,
            pageNumber:1,
            total:0,
            showRefresh: false,
            buttons: '#Btns',
            onChangePageSize:function(pageSize){
                pageSize=pageSize;
            },
            onSelectPage: function (pageNumber, pageSize) {
                var data = load_data;
                pageNumber = pageNumber;
                pageSize = pageSize;
                total = data.total;
                data = pageFilter(data);
                $("#dg").datagrid('loadData', data);
                if (data.stdata) {
                    for (var j = 0; j < data.stdata.length; j++) {
                        $('#dg').datagrid('insertRow', {
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
            var opts=$("#pp").pagination("options");
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
        function getData() {
            $("#dg").datagrid("loadData", {total: 0, rows: []});
            var StartDate = $('#StartDate').datebox('getValue');
            var EndDate = $('#EndDate').datebox('getValue');
            var StartDate = dateToInt(StartDate);
            var EndDate = dateToInt(EndDate);
            var selectType = $('input[name="UnitType3"]:checked').val();
            var serviceLevelId = $('option[name="UnitType5"]:checked').val();
            var PersonType = $('option[name="UnitType6"]:checked').val();       //id
            var ClassName = $('option[name="UnitType7"]:checked').val();
            var id = $('#MainTree').tree('getSelected').id + parseInt(PersonType);
            $.ajax({
                type: 'GET',
                url: "interface/asynRead.php?cmd=getData",
                data: {
                    "command": "get3600GuoChengInfo",
                    "startDate": StartDate,
                    "endDate": EndDate,
                    "id": id,
                    "type": meType,
                    "selectType": selectType,
                    "cs": selectType,
                    "ClassName": ClassName,
                    "serviceLevelId": serviceLevelId,
                },
                dataType: "json",
                success: function (data) {
                    if (data.result != "OK") {
                        $.messager.alert('消息提示', data.result, 'info');
                        $("#dg").datagrid('loaded');
                        return;
                    } else {
                        dg_data = data;
                        data = loadFilter(data);
                        load_data = data;
                        data = pageFilter(data);
                        $('#pp').pagination('refresh', {total: data.total});
                        $("#dg").datagrid("loadData", data);
                        if (data.stdata) {
                            for (var j = 0; j < data.stdata.length; j++) {
                                $('#dg').datagrid('insertRow', {
                                    index: j,
                                    row: data.stdata[j]
                                });
                            }
                        }
                        $('#dg').datagrid("reload");
                    }
                },
                error:function () {
                    $.messager.alert('消息提示', "解析错误！");
                    $("#dg").datagrid('loaded');
                    return;
                }
            })
        }

        function dateToInt(str) {
            //在全文查找用g ‘-’在正则中直接写，不用加引号
            var str1 = str.replace(/-/g, '');
            var num = parseInt(str1);
            return num;
        }

    });

    function UnitType_RadioFun() {
        var dg = $('#dg');
        dg.datagrid("loadData", {total: 0, rows: []});
        if ($('input[name="UnitType3"]:checked').val() == 1) {
            $("#PersonTypeid").combobox("enable");
            dg.datagrid('showColumn', 'DeptName');
            dg.datagrid('showColumn', 'HireDate');
            dg.datagrid('showColumn', 'PositionName');
            dg.datagrid('showColumn', 'IsLeave');
        } else {
            $("#PersonTypeid").combobox("disable");
            dg.datagrid('hideColumn', 'DeptName');
            dg.datagrid('hideColumn', 'HireDate');
            dg.datagrid('hideColumn', 'PositionName');
            dg.datagrid('hideColumn', 'IsLeave');
        }
    }

    function ColumnSort_RadioFun() {
        var dg = $('#dg');
        dg.datagrid("loadData", {total: 0, rows: []});
        var columnsort = parseInt($('input[name="UnitType4"]:checked').val());
        switch (columnsort) {
            case 1:
                $('#dg').datagrid({columns: process_UpdateTransStage_1});
                break;
            case 2:
                $('#dg').datagrid({columns: process_UpdateTransStage_2});
                break;
            case 3:
                $('#dg').datagrid({columns: process_UpdateTransStage_3});
                break;
        }
    }

</script>



