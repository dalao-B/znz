var process_NewTransStage = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:100,align:'left',rowspan:2,sortable:true,},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {formatter:numFormatter,field:'Class_All_360',title:'总用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'PersonCountAvg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SignInArriveSeatNumber',title:'平均到岗人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_Avg_360',title:'人均资源',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'sumHold',title:'日人均通时（小时）',width:150,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallCountArg',title:'日人均通次（次）',width:150,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SmallTransNum',title:'成交订单',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SmallTransNumAvg',title:'人均订单',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SmallTransIsNew',title:'新单数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SmallTransIsNewAvg',title:'人均新单',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'NewTrans_Class_B1_Rate',title:'新单B1率',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'Class_A0',halign:"center",colspan:2,title:"A0类用户"},
    {field:'Class_A',halign:"center",colspan:2,title:"A类合计"},
    {field:'Class_D',halign:"center",colspan:2,title:"D类用户"},
    {field:'Class_C',halign:"center",colspan:3,title:"C类用户"},
    {field:'Class_B',halign:"center",colspan:8,title:"B类用户"},
    {field:'UserMaturity',halign:"center",colspan:9,title:"用户成熟度"},
],[
    {formatter:numFormatter,field:'Class_A0_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A0_360',title:'占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_A_All_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A_All_360',title:'占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_D_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_D_360',title:'占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_C_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_C_360',title:'占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_C_Change_360',title:'新增总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B_360',title:'占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B_Avg_360',title:'人均B',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B_Change_360',title:'新增总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_C_B_Change_360',title:'转化率',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B_Change_Avg_360',title:'人均新增B',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1_Change_360',title:'新增B1总数',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1_Change_Avg_360',title:'人均新增B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B0_360',title:'B0',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1_360',title:'B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0ToB1_360',title:'转化率',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B2_360',title:'B2',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B3_360',title:'B3',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Bplus_360',title:'B+',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1to3_All_360',title:'合计',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Today_B3_360',title:'B3当天',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Today_B3_360',title:'B3当天比',width:100,align:'right',sortable:true},

]];

var process_NewTransStageHistory = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:80,align:'left',rowspan:2,sortable:true,},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {formatter:numFormatter,field:'Class_All_360',title:'总用户数',width:100,align:'right',rowspan:2,sortable:true,},

    {field:'Pre_Mature',halign:"center",colspan:3,title:"用户成熟度指数"},

    {formatter:numFormatter,field:'PersonCountAvg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'sumHold',title:'日人均通时（小时）',width:150,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallCountArg',title:'日人均通次（次）',width:150,align:'right',rowspan:2,sortable:true,},

    {formatter:numFormatter,field:'GoodRatio',title:'好评率(%)',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'Class_D',halign:"center",colspan:2,title:"D类用户"},
    {field:'Class_C',halign:"center",colspan:3,title:"C类用户"},
    {field:'Class_B',halign:"center",colspan:7,title:"B类用户"},
    {field:'UserMaturity',halign:"center",colspan:6,title:"用户成熟度"},
    {formatter:numFormatter,field:'SmallTransNum',title:'成交订单',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SmallTransNumAvg',title:'人均订单',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SmallTransIsNew',title:'新单数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SmallTransIsNewAvg',title:'人均新单',width:100,align:'center',rowspan:2,sortable:true,},
    {field:'Class_A0',halign:"center",colspan:2,title:"A0类用户"},
    {field:'Class_A',halign:"center",colspan:2,title:"A类合计"},
    {field:'Class_A1',halign:"center",colspan:2,title:"A1类用户"},
    {field:'Class_A2',halign:"center",colspan:2,title:"A2类合计"},
    {field:'Class_A3',halign:"center",colspan:2,title:"A3类用户"},
],[
    {formatter:numFormatter,field:'Pre_Mature_Sum',title:'售前总数',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'Pre_Mature_Avg',title:'售前总用户人均',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'Pre_Mature_Person_Avg',title:'系统销售员人均',width:120,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_D_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_D_360',title:'占比',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_C_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_C_360',title:'占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_C_Change_360',title:'新增总数',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_B_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B_360',title:'占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B_Change_360',title:'新增总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_C_B_Change_360',title:'转化率',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B_Change_Avg_360',title:'人均新增B',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1_Change_360',title:'新增B1总数',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1_Change_Avg_360',title:'人均新增B1',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_B0_360',title:'B0',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1_360',title:'B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B2_360',title:'B2',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B3_360',title:'B3',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Bplus_360',title:'B+',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1to3_All_360',title:'合计',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_A0_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A0_360',title:'占比',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_A_All_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A_All_360',title:'占比',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_A1_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A1_360',title:'占比',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_A2_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A2_360',title:'占比',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_A3_360',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A3_360',title:'占比',width:100,align:'right',sortable:true},


]];

var process_UpdateTransStage_1 = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:100,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {formatter:numFormatter,field:'GoodRatio',title:'好评率(%)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_3600',title:'当前用户总数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_Lock_All_3600',title:'锁定用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'PersonCountArg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_Avg',title:'人均资源',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SumHold_3600_Avg',title:'日人均通时(小时)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallNum_3600_Avg',title:'日人均通次',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_D',halign:"center",colspan:2,title:"D类用户"},
    {field:'class_C',halign:"center",colspan:2,title:"C类用户"},
    {field:'class_B',halign:"center",colspan:2,title:"B类用户"},
    {field:'class_B1to3_All',halign:"center",colspan:25,title:"用户成熟度"},
    {field:'class_A',halign:"center",colspan:2,title:"A类合计"},
    {formatter:numFormatter,field:'TransTotal3600',title:'成交订单',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_IO',title:'上拽率',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'DemandTicketNum',title:'索票数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_DemandTicketNum',title:'索票比例',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'RecommendSumHoldArg',title:'日人均推荐通时(小时)',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'PersonNum3600ALL',halign:"center",colspan:2,title:"成单人数"},
    // {formatter:numFormatter,field:'Ratio_OpenAccountAction',title:'开户申请率',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_OpenAccountActionSuccess',title:'开户成功率',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'RecommendSumHoldArg_Diff',title:'欠账日人均通时(小时）',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_OpenAccountActionSuccess_NewTrans',title:'上拽开户率',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_OpenAccountTrade',title:'有效交易率',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'PersonTypeDesc',title:'业务员分类',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CoursePersonNum',title:'听课人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_CoursePersonNum',title:'听课占比',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'VotePersonNum',title:'答题人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_VotePersonNum',title:'答题占比',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CoursePersonNum_Today',title:'当日听课人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_CoursePersonNum_Today',title:'当日听课占比',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_B1_3600',title:'有效用户数',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'SumHold_3600',title:'每用户平均通时(分钟)',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'GiveSoftFunctionNum',title:'索功能数',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_GiveSoftFunctionNum',title:'索功能比例',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'UserStockNum',title:'诊股用户数',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_UserStockNum',title:'诊股用户占比',width:100,align:'right',rowspan:2,sortable:true,},
],[
    {formatter:numFormatter,field:'Class_D_3600',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_D_3600',title:'占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_C_3600',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_C_3600',title:'占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B_3600',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B_3600',title:'占比',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_B0_3600',title:'B0',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0_3600',title:'B0占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B0NoB1_3600',title:'B0无B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0NoB1_3600',title:'B0无B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B0OrB1_3600',title:'B0或B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0OrB1_3600',title:'B0或B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B0AndB1_3600',title:'B0且B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0AndB1_3600',title:'B0且B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1_3600',title:'B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B1_3600',title:'B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B2_3600',title:'B2',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B2_3600',title:'B2占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B3_3600',title:'B3',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B3_3600',title:'B3占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Today_B3_3600',title:'B3当天',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Today_B3_3600',title:'B3当天占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B3_Change_3600',title:'B3新增',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B3_Change_3600',title:'B3新增占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Bplus_3600',title:'B+',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Bplus_3600',title:'B+占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Today_Bplus_3600',title:'B+当天',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Today_Bplus_3600',title:'B+当天占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Bplus_Change_3600',title:'B+新增',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Bplus_Change_3600',title:'B+新增占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1to3_All_3600',title:'合计',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_A_All_3600',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A_All_3600',title:'占比',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'PersonNum3600',title:'人数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'PersonNum3600_Ratio',title:'成单率',width:100,align:'right',sortable:true},
]];

var process_UpdateTransStage_2 = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:100,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {formatter:numFormatter,field:'GoodRatio',title:'好评率(%)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'PersonCountArg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_3600',title:'当前用户总数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_Lock_All_3600',title:'锁定用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_Avg',title:'人均资源',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SumHold_3600_Avg',title:'日人均通时(小时)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallNum_3600_Avg',title:'日人均通次',width:100,align:'right',rowspan:2,sortable:true,},

    {formatter:numFormatter,field:'RecommendSumHoldArg',title:'日人均推荐通时(小时)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'RecommendSumHoldArg_Diff',title:'欠账日人均通时(小时）',width:100,align:'right',rowspan:2,sortable:true,},

    {formatter:numFormatter,field:'CoursePersonNum',title:'听课人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_CoursePersonNum',title:'听课占比',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CoursePersonNum_Today',title:'当日听课人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_CoursePersonNum_Today',title:'当日听课占比',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'VotePersonNum',title:'答题人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_VotePersonNum',title:'答题占比',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'DemandTicketNum',title:'索票数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_DemandTicketNum',title:'索票比例',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_B',halign:"center",colspan:2,title:"B类用户"},
    {field:'class_B1to3_All',halign:"center",colspan:25,title:"用户成熟度"},
    {field:'class_A',halign:"center",colspan:2,title:"A类合计"},
    {formatter:numFormatter,field:'TransTotal3600',title:'成交订单',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_IO',title:'上拽率',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'PersonNum3600ALL',halign:"center",colspan:2,title:"成单人数"},
    // {formatter:numFormatter,field:'Ratio_OpenAccountAction',title:'开户申请率',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_OpenAccountActionSuccess',title:'开户成功率',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_OpenAccountActionSuccess_NewTrans',title:'上拽开户率',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_OpenAccountTrade',title:'有效交易率',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'PersonTypeDesc',title:'业务员分类',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_B1_3600',title:'有效用户数',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'SumHold_3600',title:'每用户平均通时(分钟)',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'GiveSoftFunctionNum',title:'索功能数',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_GiveSoftFunctionNum',title:'索功能比例',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'UserStockNum',title:'诊股用户数',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_UserStockNum',title:'诊股用户占比',width:100,align:'right',rowspan:2,sortable:true,},
],[
    {formatter:numFormatter,field:'Class_B_3600',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B_3600',title:'占比',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_B0_3600',title:'B0',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0_3600',title:'B0占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B0NoB1_3600',title:'B0无B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0NoB1_3600',title:'B0无B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B0OrB1_3600',title:'B0或B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0OrB1_3600',title:'B0或B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B0AndB1_3600',title:'B0且B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0AndB1_3600',title:'B0且B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1_3600',title:'B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B1_3600',title:'B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B2_3600',title:'B2',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B2_3600',title:'B2占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B3_3600',title:'B3',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B3_3600',title:'B3占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Today_B3_3600',title:'B3当天',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Today_B3_3600',title:'B3当天占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B3_Change_3600',title:'B3新增',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B3_Change_3600',title:'B3新增占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Bplus_3600',title:'B+',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Bplus_3600',title:'B+占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Today_Bplus_3600',title:'B+当天',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Today_Bplus_3600',title:'B+当天占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Bplus_Change_3600',title:'B+新增',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Bplus_Change_3600',title:'B+新增占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1to3_All_3600',title:'合计',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_A_All_3600',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A_All_3600',title:'占比',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'PersonNum3600',title:'人数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'PersonNum3600_Ratio',title:'成单率',width:100,align:'right',sortable:true},
]];

var process_UpdateTransStage_3 = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:100,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {formatter:numFormatter,field:'GoodRatio',title:'好评率(%)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_3600',title:'当前用户总数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_Avg',title:'人均资源',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_Lock_All_3600',title:'锁定用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'PersonCountArg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'PersonNum3600ALL',halign:"center",colspan:2,title:"成单人数"},
    // {formatter:numFormatter,field:'Ratio_OpenAccountAction',title:'开户申请率',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_OpenAccountActionSuccess',title:'开户成功率',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_OpenAccountActionSuccess_NewTrans',title:'上拽开户率',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_OpenAccountTrade',title:'有效交易率',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'PersonTypeDesc',title:'业务员分类',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SumHold_3600_Avg',title:'日人均通时(小时)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallNum_3600_Avg',title:'日人均通次',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_IO',title:'上拽率',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_A0',halign:"center",colspan:5,title:"A0类用户数",},
    {field:'class_A',halign:"center",colspan:2,title:"A类合计"},
    {field:'class_A1',halign:"center",colspan:2,title:"A1类用户"},
    {field:'class_A2',halign:"center",colspan:2,title:"A2类用户",},
    {field:'class_A3',halign:"center",colspan:2,title:"A3类用户",},
    {field:'class_B',halign:"center",colspan:2,title:"B类用户"},
    {formatter:numFormatter,field:'CoursePersonNum',title:'听课人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_CoursePersonNum',title:'听课占比',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'VotePersonNum',title:'答题人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_VotePersonNum',title:'答题占比',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CoursePersonNum_Today',title:'当日听课人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_CoursePersonNum_Today',title:'当日听课占比',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_B1to3_All',halign:"center",colspan:25,title:"用户成熟度"},
    {formatter:numFormatter,field:'DemandTicketNum',title:'索票数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_DemandTicketNum',title:'索票比例',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'TransTotal3600',title:'成交订单',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'RecommendSumHoldArg',title:'日人均推荐通时(小时)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'RecommendSumHoldArg_Diff',title:'欠账日人均通时(小时）',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_B1_3600',title:'有效用户数',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'SumHold_3600',title:'每用户平均通时(分钟)',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'GiveSoftFunctionNum',title:'索功能数',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_GiveSoftFunctionNum',title:'索功能比例',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'UserStockNum',title:'诊股用户数',width:100,align:'right',rowspan:2,sortable:true,},
    // {formatter:numFormatter,field:'Ratio_UserStockNum',title:'诊股用户占比',width:100,align:'right',rowspan:2,sortable:true,},
],[
    {formatter:numFormatter,field:'PersonNum3600',title:'人数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'PersonNum3600_Ratio',title:'成单率',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_A0_3600',title:'总数',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Ratio_A0_3600',title:'占比',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Class_Today_A0_3600',title:'A0当天',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Class_A0_Change_3600',title:'A0新增',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Ratio_A0_Change_3600',title:'A0新增占比',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Class_A_All_3600',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A_All_3600',title:'占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_A1_3600',title:'总数',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Ratio_A1_3600',title:'占比',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Class_A2_3600',title:'总数',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Ratio_A2_3600',title:'占比',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Class_A3_3600',title:'总数',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Ratio_A3_3600',title:'占比',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Class_B_3600',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B_3600',title:'占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B0_3600',title:'B0',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0_3600',title:'B0占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B0NoB1_3600',title:'B0无B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0NoB1_3600',title:'B0无B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B0OrB1_3600',title:'B0或B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0OrB1_3600',title:'B0或B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B0AndB1_3600',title:'B0且B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B0AndB1_3600',title:'B0且B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1_3600',title:'B1',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B1_3600',title:'B1占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B2_3600',title:'B2',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B2_3600',title:'B2占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B3_3600',title:'B3',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B3_3600',title:'B3占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Today_B3_3600',title:'B3当天',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Today_B3_3600',title:'B3当天占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B3_Change_3600',title:'B3新增',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_B3_Change_3600',title:'B3新增占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Bplus_3600',title:'B+',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Bplus_3600',title:'B+占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Today_Bplus_3600',title:'B+当天',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Today_Bplus_3600',title:'B+当天占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_Bplus_Change_3600',title:'B+新增',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_Bplus_Change_3600',title:'B+新增占比',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_B1to3_All_3600',title:'合计',width:100,align:'right',sortable:true},
]];

var process_AdvanceTransStage_1 = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:80,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},

    {formatter:numFormatter,field:'Class_All_18000',title:'当前用户总数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_Lock_All_18000',title:'锁定用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'PersonCount_18000_Avg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_18000_Avg',title:'人均资源数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SumHold_18000_Avg',title:'日人均通时(小时)',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallNum_18000_Avg',title:'日人均通次',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'GiveSoftFunctionNum_18000',title:'索功能数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_GiveSoftFunctionNum_18000',title:'索功能比例',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_D',halign:"center",colspan:2,title:"D类用户"},
    {field:'class_C',halign:"center",colspan:2,title:"C类用户"},
    {field:'class_B',halign:"center",colspan:2,title:"B类用户"},
    {field:'class_B1to3_All',halign:"center",colspan:9,title:"用户成熟度"},
    {formatter:numFormatter,field:'SumHoldAvg',title:'每用户平均通时(分钟)',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_A',halign:"center",colspan:2,title:"A类合计"},
    {field:'',halign:"center",colspan:2,title:"AB类合计"},
    {formatter:numFormatter,field:'Ratio_IO',title:'上拽率',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'DemandTicketNum',title:'索票数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_DemandTicketNum',title:'索票比例',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'',halign:"center",colspan:2,title:"成单人数"},
    {field:'',halign:"center",colspan:2,title:"听课"},
    {field:'',halign:"center",colspan:2,title:"答题"},
    {formatter:numFormatter,field:'GoodRatio',title:'好评率(%)',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'',halign:"center",colspan:2,title:"当日答题"},
    {field:'',halign:"center",colspan:2,title:"当日听课"},
],[
    {formatter:numFormatter,field:'Class_D_18000',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_D_18000',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_C_18000',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_C_18000',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B_18000',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B_18000',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B1_18000',title:'B1',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B1_18000',title:'B1占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B2_18000',title:'B2',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B2_18000',title:'B2占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B3_18000',title:'B3',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B3_18000',title:'B3占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Today_B3',title:'B3当天',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Bplus_18000',title:'B+',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B1to3_All_18000',title:'合计',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_A_All_18000',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A_All_18000',title:'占比(%)',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_AB_All_18000',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_AB_All_18000',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum18000',title:'人数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'PersonNum18000_Ratio',title:'成单率(%)',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'CoursePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'VotePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'VotePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CoursePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },
]];

var process_AdvanceTransStage_2 = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:80,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},

    {formatter:numFormatter,field:'PersonCount_18000_Avg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_18000',title:'当前用户总数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_Lock_All_18000',title:'锁定用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_18000_Avg',title:'人均资源数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SumHold_18000_Avg',title:'日人均通时(小时)',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallNum_18000_Avg',title:'日人均通次',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'',halign:"center",colspan:2,title:"听课"},
    {field:'',halign:"center",colspan:2,title:"当日听课"},
    {field:'',halign:"center",colspan:2,title:"答题"},
    {formatter:numFormatter,field:'DemandTicketNum',title:'索票数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_DemandTicketNum',title:'索票比例',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_B',halign:"center",colspan:2,title:"B类用户"},
    {field:'class_B1to3_All',halign:"center",colspan:9,title:"用户成熟度"},
    {field:'class_A',halign:"center",colspan:2,title:"A类合计"},
    {formatter:numFormatter,field:'Ratio_GiveSoftFunctionNum_18000',title:'索功能比例',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_IO',title:'上拽率',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'',halign:"center",colspan:2,title:"当日答题"},
    {field:'',halign:"center",colspan:2,title:"成单人数"},
    {field:'',halign:"center",colspan:2,title:"AB类合计"},
    {formatter:numFormatter,field:'SumHoldAvg',title:'每用户平均通时(分钟)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'GoodRatio',title:'好评率(%)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'GiveSoftFunctionNum_18000',title:'索功能数',width:100,align:'right',rowspan:2,sortable:true,},
],[
    {formatter:numFormatter,field:'CoursePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CoursePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'VotePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B_18000',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B_18000',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B1_18000',title:'B1',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B1_18000',title:'B1占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B2_18000',title:'B2',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B2_18000',title:'B2占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B3_18000',title:'B3',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B3_18000',title:'B3占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Today_B3',title:'B3当天',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Bplus_18000',title:'B+',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B1to3_All_18000',title:'合计',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_A_All_18000',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A_All_18000',title:'占比(%)',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'VotePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum18000',title:'人数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'PersonNum18000_Ratio',title:'成单率(%)',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_AB_All_18000',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_AB_All_18000',title:'占比(%)',width:100,align:'right',sortable:true,  },
]];

var process_AdvanceTransStage_3 = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:80,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},

    {formatter:numFormatter,field:'Class_All_18000',title:'当前用户总数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_Lock_All_18000',title:'锁定用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'PersonCount_18000_Avg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},

    {field:'',halign:"center",colspan:2,title:"成单人数"},
    {formatter:numFormatter,field:'Class_All_18000_Avg',title:'人均资源数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SumHold_18000_Avg',title:'日人均通时(小时)',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallNum_18000_Avg',title:'日人均通次',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_IO',title:'上拽率',width:100,align:'right',rowspan:2,sortable:true,},

    {field:'class_A0',halign:"center",colspan:3,title:"A0类用户"},
    {field:'class_A',halign:"center",colspan:2,title:"A类合计"},
    {field:'class_A1',halign:"center",colspan:2,title:"A1类用户"},
    {field:'class_A2',halign:"center",colspan:2,title:"A2类用户"},
    {field:'class_A3',halign:"center",colspan:2,title:"A3类用户"},
    {field:'class_B',halign:"center",colspan:2,title:"B类用户"},
    {field:'',halign:"center",colspan:2,title:"听课"},
    {formatter:numFormatter,field:'Ratio_GiveSoftFunctionNum_18000',title:'索功能比例',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'',halign:"center",colspan:2,title:"答题"},
    {field:'',halign:"center",colspan:2,title:"当日答题"},
    {field:'',halign:"center",colspan:2,title:"当日听课"},
    {field:'',halign:"center",colspan:2,title:"AB类合计"},
    {field:'class_B1to3_All',halign:"center",colspan:9,title:"用户成熟度"},
    {formatter:numFormatter,field:'DemandTicketNum',title:'索票数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_DemandTicketNum',title:'索票比例',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SumHoldAvg',title:'每用户平均通时(分钟)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'GoodRatio',title:'好评率(%)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'GiveSoftFunctionNum_18000',title:'索功能数',width:100,align:'right',rowspan:2,sortable:true,},



],[
    {formatter:numFormatter,field:'PersonNum18000',title:'人数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'PersonNum18000_Ratio',title:'成单率(%)',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_A0_18000',title:'总数',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Ratio_A0_18000',title:'占比(%)',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Class_Today_A0',title:'A0当天',width:100,align:'right',sortable:true,},

    {formatter:numFormatter,field:'Class_A_All_18000',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A_All_18000',title:'占比(%)',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_A1_18000',title:'总数',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Ratio_A1_18000',title:'占比(%)',width:100,align:'right',sortable:true,},

    {formatter:numFormatter,field:'Class_A2_18000',title:'总数',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Ratio_A2_18000',title:'占比(%)',width:100,align:'right',sortable:true,  },

    {formatter:numFormatter,field:'Class_A3_18000',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_A3_18000',title:'占比(%)',width:100,align:'right',sortable:true,  },

    {formatter:numFormatter,field:'Class_B_18000',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B_18000',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CoursePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'VotePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'VotePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CoursePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_AB_All_18000',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_AB_All_18000',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B1_18000',title:'B1',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B1_18000',title:'B1占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B2_18000',title:'B2',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B2_18000',title:'B2占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B3_18000',title:'B3',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B3_18000',title:'B3占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Today_B3',title:'B3当天',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Bplus_18000',title:'B+',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B1to3_All_18000',title:'合计',width:100,align:'right',sortable:true,  },
]];

var process_OrganizationStage_1 = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:100,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},

    {formatter:numFormatter,field:'Class_All_Organization',title:'当前用户总数',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'',halign:"center",colspan:2,title:"快递完成"},
    {formatter:numFormatter,field:'Class_Lock_All_Organization',title:'锁定用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Protected_SourceNum',title:'保护用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'PersonCount_Organization_Avg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_Organization_Avg',title:'人均资源数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SumHold_Organization_Avg',title:'日人均通时(小时)',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallNum_Organization_Avg',title:'日人均通次',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'OpenAccountPersonNum',halign:"center",colspan:2,title:"开户人数"},
    {formatter:numFormatter,field:'GiveSoftFunctionNum_Organization',title:'索功能数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_GiveSoftFunctionNum_Organization',title:'索功能比例',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_D',halign:"center",colspan:2,title:"D类用户"},
    {field:'class_C',halign:"center",colspan:2,title:"C类用户"},
    {field:'class_B',halign:"center",colspan:2,title:"B类用户"},
    {field:'class_B1to3_All',halign:"center",colspan:9,title:"用户成熟度"},
    {formatter:numFormatter,field:'SumHoldAvg',title:'每用户平均通时(分钟)',width:120,align:'right',rowspan:2,sortable:true,},
    {field:'class_A',halign:"center",colspan:2,title:"A类合计"},
    {field:'class_AB_All',halign:"center",colspan:2,title:"AB类合计"},
    {formatter:numFormatter,field:'Ratio_IO',title:'上拽率(%)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'DemandTicketNum',title:'报名数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'ModelSetup_PersonNum_Organization',title:'报名比例',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'ModelSetup_PersonNum',halign:"center",colspan:8,title:"参与测试人数"},
    {field:'PersonNum3600',halign:"center",colspan:11,title:"成单人数"},
    {field:'LightningPay_Bind',halign:"center",colspan:2,title:"绑定客户端人数"},
    {field:'LightningPay_Used',halign:"center",colspan:2,title:"闪电下单"},
    {formatter:numFormatter,field:'AssetSize_Avg_Organization',title:'平均资金量(万)',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'Course',halign:"center",colspan:2,title:"听课"},
    {field:'Vote',halign:"center",colspan:2,title:"答题"},
    {field:'Vote_Today',halign:"center",colspan:2,title:"当日答题"},
    {field:'Course_Today',halign:"center",colspan:2,title:"当日听课"},
    {formatter:numFormatter,field:'GoodRatio',title:'好评率(%)',width:100,align:'right',rowspan:2,sortable:true,},
],[
    {formatter:numFormatter,field:'ExpressStatus_Finished_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_ExpressStatus_Finished_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'OpenAccountPersonNum_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_OpenAccountPersonNum_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_D_Organization',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_D_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_C_Organization',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_C_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B_Organization',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B1_Organization',title:'B1',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B1_Organization',title:'B1占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B2_Organization',title:'B2',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B2_Organization',title:'B2占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B3_Organization',title:'B3',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B3_Organization',title:'B3占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Today_B3',title:'B3当天',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Bplus_Organization',title:'B+',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B1to3_All_Organization',title:'合计',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_A_All_Organization',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A_All_Organization',title:'占比(%)',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Class_AB_All_Organization',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_AB_All_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'ModelSetup_PersonNum_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_ModelSetup_PersonNum_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CapitalInit_Sum_Avg_Organization',title:'初始本金均值(万)',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CapitalLoss_Accept_Sum_Avg_Organization',title:'最大亏损均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'MaxDrawdown_Accept_Sum_Avg_Organization',title:'最大回撤均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Earnings_Real_Sum_Avg_Organization',title:'测试收益均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CapitalLoss_Real_Sum_Avg_Organization',title:'测试亏损均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'MaxDrawdown_Real_Sum_Avg_Organization',title:'测试回撤均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Organization',title:'总人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Organization_Ratio',title:'成单率(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level1_Organization',title:'基础版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level1_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level2_Organization',title:'高级版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level2_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level3_Organization',title:'专业版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level3_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level4_Organization',title:'定制版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level4_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {field:'SpareNum_5W',title:'剩余5万数量',width:100,align:'right',sortable:true,
        formatter: function(value,row,index){
            var jc = Math.floor(row.PersonNum_Level1_Organization/7);
            var gj = row.PersonNum_Level2_Organization > 0 ? row.PersonNum_Level2_Organization : 0;
            var a=jc-gj;
            return a.toFixed(0);
        }
    },
    {formatter:numFormatter,field:'LightningPay_Bind_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_LightningPay_Bind_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'LightningPay_Used_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_LightningPay_Used_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CoursePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'VotePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'VotePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CoursePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },
]];

var process_OrganizationStage_2 = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:100,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},

    {formatter:numFormatter,field:'PersonCount_Organization_Avg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'',halign:"center",colspan:2,title:"快递完成"},
    {formatter:numFormatter,field:'Class_All_Organization',title:'当前用户总数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_Lock_All_Organization',title:'锁定用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_Organization_Avg',title:'人均资源数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'SumHold_Organization_Avg',title:'日人均通时(小时)',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallNum_Organization_Avg',title:'日人均通次',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'OpenAccountPersonNum',halign:"center",colspan:2,title:"开户人数"},
    {field:'Course',halign:"center",colspan:2,title:"听课"},
    {field:'Course_Today',halign:"center",colspan:2,title:"当日听课"},
    {field:'Vote',halign:"center",colspan:2,title:"答题"},
    {formatter:numFormatter,field:'DemandTicketNum',title:'报名数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'ModelSetup_PersonNum_Organization',title:'报名比例',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_B',halign:"center",colspan:2,title:"B类用户"},
    {field:'class_B1to3_All',halign:"center",colspan:9,title:"用户成熟度"},
    {field:'class_A',halign:"center",colspan:2,title:"A类合计"},
    {field:'ModelSetup_PersonNum',halign:"center",colspan:8,title:"参与测试人数"},
    {field:'LightningPay_Bind',halign:"center",colspan:2,title:"绑定客户端人数"},
    {formatter:numFormatter,field:'Ratio_IO',title:'上拽率(%)',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'LightningPay_Used',halign:"center",colspan:2,title:"闪电下单"},
    {formatter:numFormatter,field:'AssetSize_Avg_Organization',title:'平均资金量(万)',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'PersonNum3600',halign:"center",colspan:11,title:"成单人数"},
    {formatter:numFormatter,field:'Protected_SourceNum',title:'保护用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'Vote_Today',halign:"center",colspan:2,title:"当日答题"},
    {formatter:numFormatter,field:'Ratio_GiveSoftFunctionNum_Organization',title:'索功能比例',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'GiveSoftFunctionNum_Organization',title:'索功能数',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_AB_All',halign:"center",colspan:2,title:"AB类合计"},
    {formatter:numFormatter,field:'SumHoldAvg',title:'每用户平均通时(分钟)',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'GoodRatio',title:'好评率(%)',width:100,align:'right',rowspan:2,sortable:true,},
],[
    {formatter:numFormatter,field:'ExpressStatus_Finished_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_ExpressStatus_Finished_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'OpenAccountPersonNum_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_OpenAccountPersonNum_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CoursePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CoursePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'VotePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Class_B_Organization',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B1_Organization',title:'B1',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B1_Organization',title:'B1占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B2_Organization',title:'B2',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B2_Organization',title:'B2占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B3_Organization',title:'B3',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B3_Organization',title:'B3占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Today_B3',title:'B3当天',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Bplus_Organization',title:'B+',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B1to3_All_Organization',title:'合计',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_A_All_Organization',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A_All_Organization',title:'占比(%)',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'ModelSetup_PersonNum_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_ModelSetup_PersonNum_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CapitalInit_Sum_Avg_Organization',title:'初始本金均值(万)',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CapitalLoss_Accept_Sum_Avg_Organization',title:'最大亏损均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'MaxDrawdown_Accept_Sum_Avg_Organization',title:'最大回撤均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Earnings_Real_Sum_Avg_Organization',title:'测试收益均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CapitalLoss_Real_Sum_Avg_Organization',title:'测试亏损均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'MaxDrawdown_Real_Sum_Avg_Organization',title:'测试回撤均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'LightningPay_Bind_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_LightningPay_Bind_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'LightningPay_Used_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_LightningPay_Used_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Organization',title:'总人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Organization_Ratio',title:'成单率(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level1_Organization',title:'基础版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level1_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level2_Organization',title:'高级版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level2_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level3_Organization',title:'专业版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level3_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level4_Organization',title:'定制版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level4_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {field:'SpareNum_5W',title:'剩余5万数量',width:100,align:'right',sortable:true,
        formatter: function(value,row,index){
            var jc = Math.floor(row.PersonNum_Level1_Organization/7);
            var gj = row.PersonNum_Level2_Organization > 0 ? row.PersonNum_Level2_Organization : 0;
            var a=jc-gj;
            return a.toFixed(0);
        }
    },
    {formatter:numFormatter,field:'VotePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_AB_All_Organization',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_AB_All_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
]];

var process_OrganizationStage_3 = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:100,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},

    {formatter:numFormatter,field:'Class_All_Organization',title:'当前用户总数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_Lock_All_Organization',title:'锁定用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'PersonCount_Organization_Avg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'PersonNum3600',halign:"center",colspan:11,title:"成单人数"},
    {field:'',halign:"center",colspan:2,title:"快递完成"},
    {field:'OpenAccountPersonNum',halign:"center",colspan:2,title:"开户人数"},
    {formatter:numFormatter,field:'SumHold_Organization_Avg',title:'日人均通时(小时)',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallNum_Organization_Avg',title:'日人均通次',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_IO',title:'上拽率(%)',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_A0',halign:"center",colspan:3,title:"A0类用户"},
    {field:'class_A',halign:"center",colspan:2,title:"A类合计"},
    {field:'class_A1',halign:"center",colspan:2,title:"A1类用户"},
    {field:'class_A2',halign:"center",colspan:2,title:"A2类用户"},
    {field:'class_A3',halign:"center",colspan:2,title:"A3类用户"},
    {field:'ModelSetup_PersonNum',halign:"center",colspan:8,title:"参与测试人数"},
    {field:'class_B',halign:"center",colspan:2,title:"B类用户"},
    {field:'LightningPay_Bind',halign:"center",colspan:2,title:"绑定客户端人数"},
    {field:'Course',halign:"center",colspan:2,title:"听课"},
    {field:'LightningPay_Used',halign:"center",colspan:2,title:"闪电下单"},
    {formatter:numFormatter,field:'AssetSize_Avg_Organization',title:'平均资金量(万)',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'Vote',halign:"center",colspan:2,title:"答题"},
    {formatter:numFormatter,field:'Class_All_Organization_Avg',title:'人均资源数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Protected_SourceNum',title:'保护用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'Vote_Today',halign:"center",colspan:2,title:"当日答题"},
    {field:'Course_Today',halign:"center",colspan:2,title:"当日听课"},
    {field:'class_B1to3_All',halign:"center",colspan:9,title:"用户成熟度"},
    {formatter:numFormatter,field:'DemandTicketNum',title:'报名数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'ModelSetup_PersonNum_Organization',title:'报名比例',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Ratio_GiveSoftFunctionNum_Organization',title:'索功能比例',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'GiveSoftFunctionNum_Organization',title:'索功能数',width:100,align:'right',rowspan:2,sortable:true,},
    {field:'class_AB_All',halign:"center",colspan:2,title:"AB类合计"},
    {formatter:numFormatter,field:'SumHoldAvg',title:'每用户平均通时(分钟)',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'GoodRatio',title:'好评率(%)',width:100,align:'right',rowspan:2,sortable:true,},
],[
    {formatter:numFormatter,field:'PersonNum_Organization',title:'总人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Organization_Ratio',title:'成单率(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level1_Organization',title:'基础版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level1_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level2_Organization',title:'高级版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level2_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level3_Organization',title:'专业版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level3_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level4_Organization',title:'定制版人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'PersonNum_Level4_Organization_Ratio',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {field:'SpareNum_5W',title:'剩余5万数量',width:100,align:'right',sortable:true,
        formatter: function(value,row,index){
            var jc = Math.floor(row.PersonNum_Level1_Organization/7);
            var gj = row.PersonNum_Level2_Organization > 0 ? row.PersonNum_Level2_Organization : 0;
            var a=jc-gj;
            return a.toFixed(0);
        }
    },
    {formatter:numFormatter,field:'ExpressStatus_Finished_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_ExpressStatus_Finished_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'OpenAccountPersonNum_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_OpenAccountPersonNum_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_A0_Organization',title:'总数',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Ratio_A0_Organization',title:'占比(%)',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Class_Today_A0',title:'A0当天',width:100,align:'right',sortable:true,},

    {formatter:numFormatter,field:'Class_A_All_Organization',title:'总数',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'Ratio_A_All_Organization',title:'占比(%)',width:100,align:'right',sortable:true},

    {formatter:numFormatter,field:'Class_A1_Organization',title:'总数',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Ratio_A1_Organization',title:'占比(%)',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Class_A2_Organization',title:'总数',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'Ratio_A2_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_A3_Organization',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_A3_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    //
    {formatter:numFormatter,field:'ModelSetup_PersonNum_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_ModelSetup_PersonNum_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CapitalInit_Sum_Avg_Organization',title:'初始本金均值(万)',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CapitalLoss_Accept_Sum_Avg_Organization',title:'最大亏损均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'MaxDrawdown_Accept_Sum_Avg_Organization',title:'最大回撤均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Earnings_Real_Sum_Avg_Organization',title:'测试收益均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CapitalLoss_Real_Sum_Avg_Organization',title:'测试亏损均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'MaxDrawdown_Real_Sum_Avg_Organization',title:'测试回撤均值',width:120,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B_Organization',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'LightningPay_Bind_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_LightningPay_Bind_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },

    {formatter:numFormatter,field:'CoursePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'LightningPay_Used_Organization',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_LightningPay_Used_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },

    {formatter:numFormatter,field:'VotePersonNum',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum',title:'占比(%)',width:100,align:'right',sortable:true,},
    {formatter:numFormatter,field:'VotePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_VotePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'CoursePersonNum_Today',title:'人数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_CoursePersonNum_Today',title:'占比(%)',width:100,align:'right',sortable:true,  },

    {formatter:numFormatter,field:'Class_B1_Organization',title:'B1',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B1_Organization',title:'B1占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B2_Organization',title:'B2',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B2_Organization',title:'B2占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B3_Organization',title:'B3',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_B3_Organization',title:'B3占比',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Today_B3',title:'B3当天',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_Bplus_Organization',title:'B+',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Class_B1to3_All_Organization',title:'合计',width:100,align:'right',sortable:true,  },

    {formatter:numFormatter,field:'Class_AB_All_Organization',title:'总数',width:100,align:'right',sortable:true,  },
    {formatter:numFormatter,field:'Ratio_AB_All_Organization',title:'占比(%)',width:100,align:'right',sortable:true,  },
]];

var result_NewTransStage = [[
    {field:'rowId',width:40,align:'left', title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    // {field:'report',title:'报告',width:40,align:'left'},
    {field:'Unitid',title:'编号',width:100,align:'left', sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left', sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left', sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left', sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left', sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave == 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left', sortable:true,hidden:true},
    {field:'isLeave',title:'淘汰建议',width:100,align:'left', sortable:true,hidden:true,formatter:function (value,row,index) {
            if(value!=3){
                return '正常';
            }else{
                return '建议淘汰';
            }
        }},

    {formatter:numFormatter,field:'PersonCountArg',title:'平均人数',width:100,align:'right', sortable:true,},
    {formatter:numFormatter,field:'smallOrder',title:'小额订单数',width:100,align:'right', sortable:true,},
    {formatter:numFormatter,field:'SmallTransIsNewNum',title:'新单数',width:100,align:'right', sortable:true,},
    {formatter:numFormatter,field:'SmallTransIsNewSumHoldAvg',title:'每10小时成单',width:120,align:'right', sortable:true,},
    {formatter:numFormatter,field:'SmallTransSelfBuyNum',title:'自助购买',width:100,align:'right', sortable:true,},
    {formatter:numFormatter,field:'validCallNumAvg',title:'日人均有效通次',width:120,align:'right', sortable:true,},
    {formatter:numFormatter,field:'sumHold',title:'日人均通时(小时)',width:120,align:'right', sortable:true,},
    {formatter:numFormatter,field:'CallCountArg',title:'日人均通次(次)',width:120,align:'right', sortable:true,},
    {formatter:numFormatter,field:'Class_All',title:'总用户数',width:100,align:'right', sortable:true,},

    {formatter:numFormatter,field:'Class_C_Change',title:'C类新增用户数',width:120,align:'right', sortable:true,},
    {formatter:numFormatter,field:'Class_B_Change',title:'B类新增用户数',width:120,align:'right', sortable:true,},
    {formatter:numFormatter,field:'Class_A0',title:'A0类新增用户数',width:120,align:'right', sortable:true,},
]];

var result_UpdateTransStage = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:100,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'isLeave',title:'淘汰建议',width:100,align:'left',rowspan:2,sortable:true,hidden:true,formatter:function (value) {
            if(value!=3){
                return '正常';
            }else{
                return '建议淘汰';
            }
        }},

    {formatter:numFormatter,field:'PersonCountArg',title:'平均人数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'3600TransTotal',title:'上拽订单数',width:100,align:'right',rowspan:2,sortable:true,},

    {field:'total_money',halign:"center",colspan:2,title:"总销售额"},

    {formatter:numFormatter,field:'3600TransIsNewTotal',title:'新单数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'3600TransSelfBuyTotal',title:'自助购买',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'validCallNumAvg',title:'日人均有效通次',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'sumHold',title:'日人均通时(小时)',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallCountArg',title:'日人均通次(次)',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All',title:'总用户数',width:100,align:'right',rowspan:2,sortable:true,},

    {formatter:numFormatter,field:'Class_A0',title:'A0类用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_B',title:'B类用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_C',title:'C类用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_D',title:'D类用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'smallOrder',title:'小额订单数',width:100,align:'right',rowspan:2,sortable:true,},
],[
    {formatter:numFormatter,field:'totalmoney',title:'金额(万元)',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'totalmoney_avg',title:'人均(万元)',width:100,align:'right',sortable:true},
]];

var result_AdvanceTransStage = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:100,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'isLeave',title:'淘汰建议',width:100,align:'left',rowspan:2,sortable:true,hidden:true,formatter:function (value) {
            if(value!=3){
                return '正常';
            }else{
                return '建议淘汰';
            }
        }},

    {formatter:numFormatter,field:'PersonCountArg',title:'平均人数',width:100,align:'left',rowspan:2,sortable:true,},

    {field:'',halign:"center",colspan:2,title:"上拽订单数"},
    {field:'',halign:"center",colspan:2,title:"成单人数"},
    {field:'',halign:"center",colspan:2,title:"总销售额"},

    {formatter:numFormatter,field:'18000TransIsNewTotal',title:'新单数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'18000TransSelfBuyTotal',title:'自助购买',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'validCallNumAvg',title:'日人均有效通次',width:120,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'sumHold',title:'日人均通时(小时)',width:120,align:'left',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CallCountArg',title:'日人均通次(次)',width:120,align:'right',rowspan:2,sortable:true,},

    {formatter:numFormatter,field:'CALLOUTNUM',title:'分号(呼出)',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'CALLCOST',title:'分号成本',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'ProfitRatio',title:'投产比',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_All_18000',title:'总用户数',width:100,align:'right',rowspan:2,sortable:true,},

    {formatter:numFormatter,field:'Class_A0_18000',title:'A0类用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_B_18000',title:'B类用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_C_18000',title:'C类用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'Class_D_18000',title:'D类用户数',width:100,align:'right',rowspan:2,sortable:true,},
    {formatter:numFormatter,field:'smallOrder',title:'小额订单数',width:100,align:'right',rowspan:2,sortable:true,},
],[
    {formatter:numFormatter,field:'TransTotal3600_SourceVer2',title:'3600',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'18000TransTotal',title:'18000',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'PersonNum3600_SourceVer2',title:'3600',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'PersonNum18000_all',title:'18000',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'totalmoney',title:'金额(万元)',width:100,align:'right',sortable:true},
    {formatter:numFormatter,field:'totalmoney_avg',title:'人均(万元)',width:100,align:'right',sortable:true},
]];

var labor_NewTransStage = [[
    {field:'rowId',width:40,align:'left',rowspan:2,title:"",formatter:function (value,row,index) {
            if(value == -1){
                return '合计';
            }else{
                return value;
            }
        }},
    {field:'Unitid',title:'编号',width:100,align:'left',rowspan:2,sortable:true},
    {field:'UnitName',title:'名称',width:150,align:'left',rowspan:2,sortable:true},
    {field:'DeptName',title:'部门名称',width:150,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'HireDate',title:'入职时间',width:100,align:'left',rowspan:2,sortable:true,hidden:true},
    {field:'IsLeave',title:'人员状态',width:100,align:'left',rowspan:2,sortable:true,hidden:true,
        formatter: function(value,row,index){
            if (row.IsLeave === 1){
                return "离职"
            } else {
                return "在职"
            }
        }},
    {field:'PositionName',title:'岗位',width:100,align:'left',rowspan:2,sortable:true,hidden:true},

    {field:'',halign:"center",colspan:2,title:"合计"},
    {field:'',halign:"center",colspan:12,title:"已成单"},
    {field:'',halign:"center",colspan:3,title:"未成单"},

],[
    {formatter:numFormatter,field:'sumHold',title:'日人均同时(小时)',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'callNum',title:'日人均通次',width:120,align:'right',sortable:true},

    {formatter:numFormatter,field:'labor_sale_360_valid_HoldSum',title:'360日人均通时(小时)',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_sale_360_valid_CallNum',title:'360日人均通次',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_sale_360_valid_CallNum_Ratio',title:'360通次比率(%)',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_sale_3600_valid_HoldSum',title:'3600日人均通时(小时)',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_sale_3600_valid_CallNum',title:'3600日人均通次',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_sale_3600_valid_CallNum_Ratio',title:'3600通次比率(%)',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_sale_18000_valid_HoldSum',title:'18000日人均通时(小时)',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_sale_18000_valid_CallNum',title:'18000日人均通次',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_sale_18000_valid_CallNum_Ratio',title:'18000通次比率(%)',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_sale_28800_valid_HoldSum',title:'28800日人均通时(小时)',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_sale_28800_valid_CallNum',title:'28800日人均通次',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_sale_28800_valid_CallNum_Ratio',title:'28800通次比率(%)',width:120,align:'right',sortable:true},

    {formatter:numFormatter,field:'labor_noSale_valid_HoldSum',title:'日人均通时',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_noSale_valid_CallNum',title:'日人均通次',width:120,align:'right',sortable:true},
    {formatter:numFormatter,field:'labor_noSale_valid_CallNum_Ratio',title:'通次比率',width:120,align:'right',sortable:true},
]];

//数据网格数据格式化
function numFormatter(value, row, ixndex) {
    if (value == null){
        return "-"
    } else {
        if (Number.isInteger(value) == true){
            return (value + '').replace(/\d{1,3}(?=(\d{3})+(\.\d*)?$)/g, '$&,');
        }else {
            return (parseFloat(value).toFixed(2) + '').replace(/\d{1,3}(?=(\d{3})+(\.\d*)?$)/g, '$&,');
        }
    }
}