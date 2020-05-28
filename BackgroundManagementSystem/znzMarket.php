<div style="background-color: #F4F4F4">
    <span style="margin-left:8px;">
        选择活动类型：<input id="ActType" name="ActType" style="width:80px;" data-options="editable:false,panelHeight:'auto'">
        选择活动：<input id="Act" name="ActId" style="width:200px;" value="所有" data-options="editable:false,panelWidth:320">
</span>
    <span style="margin-left:2px;">日期选择：
        <input id="StartDate" type="text"  name='StartDate'  style="width:120px;">
        -
        <input id="EndDate" type="text"   name='EndDate'  style="width:120px;">
</span>
</div>
<table id="dg" data-options='fit:true,fitColumns:true'></table>
<div id="Btns" style="height:auto">
    <span style="margin-left:8px;">
        任务类型：
        <select id="Sourceid" class="easyui-combobox" name="Source"
                data-options="editable:false,panelHeight:'auto'"
                style="width:100px;">
            <option name="UnitType" value="">所有</option>
            <option name="UnitType" value="M_单量">M_单量</option>
            <option name="UnitType" value="M_新单量">M_新单量</option>
            <option name="UnitType" value="M_通次">M_通次</option>
            <option name="UnitType" value="M_业绩">M_业绩</option>
            <option name="UnitType" value="M_当日听课">M_当日听课</option>
        </select>
    </span>
    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="addrow()">添加任务</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-add',plain:true" onclick="addrow(1)">复制添加</a>
    <a id="searchButton" href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-reload',plain:true">刷新</a>
</div>
<script type="text/javascript">
    //参数校验规则
    $.extend($.fn.validatebox.defaults.rules, {
        Nonnegative : {
            validator: function(value, param){
                return value>=0;
            },
            message: '请输入大于0的数！！！'
        },
        isNull:{
            validator: function(value, param){
                return value != null;
            },
            message: '非空！！！'
        }
    });

    var Sort = null;
    var Order = null;
    var is_add = false;
    var ActList =getActList();

    $(function () {
        var now = new Date(); //当前日期
        var nowMonth = now.getMonth(); //当前月
        var nowYear = now.getFullYear(); //当前年
        //本月的开始时间
        var monthStartDate = new Date(nowYear, nowMonth, 1);
        //本月的结束时间
        var monthEndDate = new Date(nowYear, nowMonth+1, 0);
        monthStartDate = monthStartDate.getFullYear() + "-" + (monthStartDate.getMonth() + 1) + "-" + monthStartDate.getDate();
        monthEndDate = monthEndDate.getFullYear() + "-" + (monthEndDate.getMonth() + 1) + "-" + monthEndDate.getDate();
        //设置默认时间
        $("#StartDate").datebox({});
        $("#StartDate").datebox('setValue',monthStartDate);
        $("#EndDate").datebox({});
        $("#EndDate").datebox('setValue',monthEndDate);
    });

    
    //数据表格
    $('#dg').datagrid({
        // url:"interface/asynRead.php?cmd=getAllProcess",
        method: 'get',
        iconCls:'icon-edit',
        pagination:true,
        pagePosition:"top",
        rownumbers:true,
        remoteSort:true,
        singleSelect: true,
        onSortColumn:function(sort,order){
            Sort = sort;
            Order = order;
            getData()
        },
        columns:[[
            // {field:'MissionId',title:'任务Id',width:100,align:'center',sortable:true,},
            {field:'MissionName',title:'任务名称',width:120,halign:'center',align:'left',sortable:true,
                editor:{
                    type:'validatebox',
                    options:{
                        required:true,
                        validType:'isNull'
                    }
                },
            },
            {field:'Source',title:'任务类型',width:100,halign:'center',align:'left',sortable:true,
                editor:{
                    type:'combobox',
                    options:{
                        editable:false,
                        panelHeight:'auto',
                        valueField:'Source',
                        textField:'Source',
                        data:[{'Source':'M_单量'},{'Source':'M_新单量'},
                            {'Source':'M_通次'},{'Source':'M_业绩'},
                            {'Source':'M_当日听课'},],
                        required:true,
                    }
                },
            },
            {field:'ActId',title:'活动Id',width:250,halign:'center',align:'left',sortable:true,
                editor:{
                    type:'combobox',
                    options:{
                        editable:false,
                        panelHeight:'auto',
                        valueField:'ActId',
                        textField:'ActId',
                        data:[{'ActId':ActList[0].ActName},{'ActId':ActList[1].ActName},
                            {'ActId':ActList[2].ActName},{'ActId':ActList[3].ActName},
                            {'ActId':ActList[4].ActName},],
                        required:true,
                    }
                },
                formatter:function (value, row, index) {
                    for (var i=0;i<ActList.length;i++){
                        if (value == ActList[i].ActId) {
                            return ActList[i].ActName
                        }
                    }
                }
            },
            {field:'Value',title:'任务量',width:100,halign:'center',align:'right',sortable:true,
                editor:{
                    type:'validatebox',
                    options:{
                        required:true,
                        validType:'Nonnegative'
                    }
                },
                formatter:function (value, row, index) {
                    if (row != null) {
                        return (value + '').replace(/\d{1,3}(?=(\d{3})+(\.\d*)?$)/g, '$&,');
                    }
                }
            },
            {field:'Money',title:'任务价值',width:100,halign:'center',align:'right',sortable:true,
                editor:{
                    type:'validatebox',
                    options:{
                        required:true,
                        validType:'Nonnegative'
                    }
                },
            },
            {field:'StartDate',title:'任务开始时间',width:100,halign:'center',align:'right',sortable:true,
                editor:{
                    type:'numberbox',
                    options:{
                        required:true,
                    }
                },
            },
            {field:'EndDate',title:'任务结束时间',width:100,halign:'center',align:'right',sortable:true,
                editor:{
                    type:'numberbox',
                    options:{
                        required:true,
                    }
                },
            },
            {field:'DisplayStartDate',title:'任务显示开始时间',width:100,halign:'center',align:'right',sortable:true,
                editor:{
                    type:'numberbox',
                    options:{
                        required:true,
                    }
                },
            },
            {field:'DisplayEndDate',title:'任务显示结束时间',width:100,halign:'center',align:'right',sortable:true,
                editor:{
                    type:'numberbox',
                    options:{
                        required:true,
                    }
                },
            },
            {field:'action',title:'',width:70,align:'center',
                formatter:function(value,row,index){
                    for (var i=0;i<ActList.length;i++){
                        if (row.ActId == ActList[i].ActId) {
                            var Sdate = ActList[i].StartDate;
                            var Edate = ActList[i].EndDate;
                            break;
                        }
                    }
                    //本地时间
                    var now_date = new Date();
                    now_date.setTime(now_date.getTime());
                    if (now_date > new Date(Edate).getTime() && !is_add) {
                        return "-"
                    }else {
                        if (row.editing){
                            var s = '<a href="#" onclick="saverow(this)">保存</a> ';
                            var c = '<a href="#" onclick="cancelrow(this)">取消</a>';
                            return s+c;
                        } else {
                            var e = '<a href="#" onclick="editrow(this)">编辑</a> ';
                            var d = '<a href="#" onclick="deleterow(this)">删除</a>';
                            return e+d;
                        }
                    }
                }
            }
        ]],
        onBeforeEdit:function(index,row){
            row.editing = true;
            updateActions(index);
        },
        onAfterEdit:function(index,row){
            row.editing = false;
            updateActions(index);
        },
        onCancelEdit:function(index,row){
            row.editing = false;
            updateActions(index);
        },
        onLoadSuccess:function(data){
            if(data.ret!="OK" && data.ret != null && data.ret != ''){
                $.messager.alert('提示','数据获取失败！','');
            }
        }
    });

    function updateActions(index){
        $('#dg').datagrid('updateRow',{
            index: index,
            row:{}
        });
        $('#dg').datagrid('refreshRow',index);
    }
    function getRowIndex(target){
        var tr = $(target).closest('tr.datagrid-row');
        return parseInt(tr.attr('datagrid-row-index'));
    }
    function editrow(target){
        $('#dg').datagrid('beginEdit', getRowIndex(target));
    }
    function addrow(x) {
        if (x==1){
            var row = $('#dg').datagrid('getSelected');
            if (row != null){
                row.editing = true;
                for (var i=0;i<ActList.length;i++){
                    if (row.ActId == ActList[i].ActId) {
                        row.ActId = ActList[i].ActName
                    }
                }
                $('#dg').datagrid('insertRow',{index:0,row:row});
                is_add = true;
                $('#dg').datagrid('beginEdit', 0);
                $('#dg').datagrid('selectRow',0);
            }else {
                $.messager.alert('提示','请选选择一行数据！！！')
            }
        }else {
            $('#dg').datagrid('insertRow',{index:0,row:{editing:true}});
            is_add = true;
            $('#dg').datagrid('beginEdit', 0);
            $('#dg').datagrid('selectRow',0);
        }
    }
    function deleterow(target){
        $.messager.confirm('提示','是否确认删除?',function(r){
            if (r){
                var row_index = getRowIndex(target);
                var row = $('#dg').datagrid('getRows')[row_index];
                $('#dg').datagrid('deleteRow', getRowIndex(target));
                $.ajax({
                    type:"post",
                    async:false,
                    url:'interface/asynRead.php?cmd=deleteProcess',
                    dataType: "json",
                    data: {
                        "missionid":parseInt(row.MissionId),
                    }
                });
            }
        });
    }
    function saverow(target){
        if (is_add){
            $('#dg').datagrid('endEdit', 0);
            var row = $('#dg').datagrid('getRows')[0];
            for (var i=0;i<ActList.length;i++){
                if (ActList[i].ActName == row.ActId) {
                    var actid = parseInt(ActList[i].ActId);
                    break;
                }
            }
            $.ajax({
                type:"post",
                async:false,
                url:'interface/asynRead.php?cmd=addProcess',
                dataType: "json",
                data: {
                    "source":row.Source,
                    "sdate":row.StartDate,
                    "edate":row.EndDate,
                    "value":parseInt(row.Value),
                    "money":parseInt(row.Money),
                    "missionname":row.MissionName,
                    "actid":actid,
                    "display_sdate":row.DisplayStartDate,
                    "display_edate":row.DisplayEndDate,
                }
            });
        }else {
            var row_index = getRowIndex(target);
            $('#dg').datagrid('endEdit', row_index);
            var row = $('#dg').datagrid('getRows')[row_index];
            for (var i=0;i<ActList.length;i++){
                if (ActList[i].ActName == row.ActId) {
                    var actid = parseInt(ActList[i].ActId);
                    break;
                }
            }
            $.ajax({
                type:"post",
                async:false,
                url:'interface/asynRead.php?cmd=updateProcess',
                dataType: "json",
                data: {
                    "missionid":parseInt(row.MissionId),
                    "source":row.Source,
                    "sdate":row.StartDate,
                    "edate":row.EndDate,
                    "value":row.Value,
                    "money":row.Money,
                    "missionname":row.MissionName,
                    "actid":actid,
                    "display_sdate":row.DisplayStartDate,
                    "display_edate":row.DisplayEndDate,
                }
            });
        }
        is_add = false;
        $('#dg').datagrid('reload');
    }
    function cancelrow(target){
        $('#dg').datagrid('cancelEdit', getRowIndex(target));
        $('#dg').datagrid('reload');
    }

    //分页
    $("#dg").datagrid('getPager').pagination({
        showRefresh:false,
        pageNumber:1,
        pageList:[10,20,40,100],
        pageSize:40,
        buttons:'#Btns',
        beforePageText: "第",
        afterPageText: "页    共 {pages} 页",
        displayMsg: "当前显示 {from} - {to} 条记录   共 {total} 条记录",
        onSelectPage:function(pageNumber,pageSize){
            getData()
        },
        onChangePageSize:function(pageSize){
            getData()
        }
    });

    //查询
    $('#searchButton').click(function(){
        $("#dg").datagrid("loading");
        $("#dg").datagrid("loadData",[]);
        $("#dg").datagrid("sort",{sortName: '', sortOrder: ''});
        getData();
        $('#dg').datagrid("loaded");
    });

    //活动类型
    $('#ActType').combobox({
        valueField:'ActType',
        textField:'ActTypeName',
        selectedIndex:1,
        url:'interface/asynRead.php?cmd=getActType',
        onSelect:function(record){
            var url = 'interface/asynRead.php?cmd=getActList&ActType='+record.ActType+'&GameType=-1';
            $("#Act").combobox('reload', url);
        },
        onLoadSuccess:function(){
            var ActType = getQueryVariable('ActType');
            var _ActType = -1;
            if (ActType == false) {
                _ActType = -1;
            }else if (ActType == 1 || ActType == 2||ActType == 3){
                _ActType = ActType;
            }else{
                _ActType = -1;
            }
            $('#ActType').combobox('select',_ActType);
        }
    });

    //活动类型
    $('#Act').combobox({
        valueField:'ActId',
        textField:'ActName',
        // url:'interface/asynRead.php?cmd=getActList&ActType=-1&GameType=-1',
        onSelect:function (value) {
            var sdate = value.StartDate;
            var edate = value.EndDate;
            //设置默认时间
            $("#StartDate").datebox({});
            $("#StartDate").datebox('setValue',sdate);
            $("#EndDate").datebox({});
            $("#EndDate").datebox('setValue',edate);
        }
    });

    //获取数据
    function getData(){
        var opts=$("#dg").datagrid('getPager').pagination("options");
        if(opts.pageNumber == 0){opts.pageNumber = 1}
        var start = (opts.pageNumber-1)*parseInt(opts.pageSize)+1;
        var end = start + parseInt(opts.pageSize)-1;
        var Sdate=$('#StartDate').datebox('getValue');
        if (Sdate != null){
            Sdate=dateToInt(Sdate);
        }
        var Edate=$('#EndDate').datebox('getValue');
        if (Edate != null){
            Edate=dateToInt(Edate);
        }
        var Source=$('#Sourceid').datebox('getValue');
        var ActId=$('#Act').datebox('getValue');
        if (ActId != null){
            ActId = parseInt(ActId)
        }
        $.get("interface/asynRead.php?cmd=getAllProcess",{
            'sdate':Sdate,
            'edate':Edate,
            'source':Source,
            'actid':ActId,
            'start':start,
            'end':end,
            'sort':Sort,
            'order':Order,
        },function (data) {
            if (data.ret != "OK"){
                $.messager.alert('消息提示', data.result, 'info');
                $("#dg").datagrid('loaded');
                return;
            } else {
                $("#dg").datagrid("loadData", data);
            }
        },"json")
    }

    // //获取表头列名
    // function getCols(){
    //     var columns = [];
    //     $.ajax({
    //         type: 'GET',
    //         url: "interface/asynRead.php?cmd=getAllProcess",
    //         data: {},
    //         async: false,
    //         dataType: 'json',
    //         success: function(data){
    //             var fields = Object.keys(data.rows[0]);
    //             if (fields != null && fields.length > 0) {
    //                 $.each(fields, function (i, item) {
    //                     if (item != 'rowid'){
    //                         columns.push({ "field": item, "title": item, "width": 100, "align": "center","sortable":true});
    //                     }
    //                 });
    //             }
    //         },
    //     });
    //     return columns
    // }
    function getActList() {
        var ActList = [];
        $.ajax({
            type: 'GET',
            url: "interface/asynRead.php?cmd=getActList",
            data: {ActType:-1,GameType:-1},
            async: false,
            dataType: 'json',
            success: function(data){
                for(var i=0;i<data.length;i++){
                    ActList.splice(i,0,data[i]);
                }
            },
        });
        return ActList
    }

    function dateToInt(str) {
        //在全文查找用g ‘-’在正则中直接写，不用加引号
        var str1=str.replace(/-/g,'');
        var num = parseInt(str1);
        return num;
    }

    function getQueryVariable(variable)
    {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i=0;i<vars.length;i++) {
            var pair = vars[i].split("=");
            if(pair[0] == variable){return pair[1];}
        }
        return(false);
    }

</script>