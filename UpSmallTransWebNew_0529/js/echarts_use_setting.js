// 表格窗口
$('#Echarts_win').window({
    title: "用户成熟度度",
    width: 1020,
    height: 640,
    // top:($(window).height() - 420) * 0.5,   
    // left:($(window).width() - 450) * 0.5,
    shadow: true,
    modal:true,
    //maximized: true,
    closed: true
});

var myChart = echarts.init(document.getElementById('container'));



myChart.on('mouseover', function (params) {
    myChart.setOption({// 设置 鼠标移入后想要的样式
        series: {
            name: params.seriesName,
            lineStyle: {
                width: 3
            },
            symbolSize: 7,
        }
    })
});
myChart.on('mouseout', function (params) {
    myChart.setOption({// 设置 鼠标移入后想要的样式
        series: {
            name: params.seriesName,
            lineStyle: {
                width: 2
            },
            symbolSize: 5,
        }
    })
});
$(function () {
    $("#sourceType2").on('change',function () {
        myChart.clear();
        var sourceType_2 = $('option[name="sourceType_2"]:checked').val();
        var row = $('#dg').datagrid('getSelected');
        if (row == null){
            row = $('#dg_History').datagrid('getSelected');
        }
        if (row != null){
            var id = row["Unitid"];
        }
        var selectType = $('input[name="UnitType3"]:checked').val();
        // $('#sourceType2').combobox('setValue','-1');
        // echarts 加载数据
        myChart.showLoading();
        ajax(row,id,selectType,sourceType_2);
    });
});

function OpenWindow(){
    var row = $('#dg').datagrid('getSelected');
    if (row == null){
        row = $('#dg_History').datagrid('getSelected');
    }
    if (row != null){
        var id = row["Unitid"];
    }
    var selectType = $('input[name="UnitType3"]:checked').val();
    var sourceType_2 = $('option[name="sourceType_2"]:checked').val();
    // $('#sourceType2').combobox('setValue','-1');
    // echarts 加载数据
    myChart.showLoading();
    ajax(row,id,selectType,sourceType_2);
}

function ajax(row,id,selectType,sourceType_2) {
    $.ajax({
        type: 'GET',
        url: "interface/asynRead.php?cmd=getPreMatureDataInfo",
        data: {
            commond:"getMatureInfo",
            id:id,
            cs:selectType,
            serviceLevelId: "",
            sourceType2:sourceType_2,
        },
        success: function(data){
            // console.log(data);
            var Sdate = [];
            var Pre_Mature_Sum = [];
            var Pre_Mature_Avg = [];
            var Pre_Class_All = [];
            var Pre_No_Login_15 = [];
            var new_data = data.data.data.data;
            for (var i=0;i<new_data.length;i++){
                Sdate.push(new_data[i]["Sdate"]);
                Pre_Mature_Sum.push(new_data[i]["Pre_Mature_Sum"]);
                Pre_Mature_Avg.push(new_data[i]["Pre_Mature_Avg"].toFixed(2));
                Pre_Class_All.push(new_data[i]["Pre_Class_All"]);
                Pre_No_Login_15.push(new_data[i]["Pre_No_Login_15"]);
            }
            option = {
                tooltip : {
                    trigger: 'item',
                },
                grid:{
                    top:38,
                    right:70,
                    bottom:65,
                    left:60
                },
                legend: {
                    top:20,
                    left:'center',
                    data:['成熟度总数','用户总数','成熟度平均','15天无登录']
                },
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        axisLabel :{
                            // interval:0,
                            rotate:70,
                        },
                        data : Sdate
                    }
                ],
                yAxis : [
                    {
                        type: 'value',
                        nameLocation:"center",
                        nameGap:35,
                        nameRotate:0,
                        nameTextStyle:{
                            fontSize: 16,
                        },
                        splitLine:{show: false}
                    },
                    {
                        type: 'value',
                        nameLocation:"center",
                        nameGap:35,
                        nameRotate:0,
                        nameTextStyle:{
                            fontSize: 16,
                        },
                        splitLine:{show: false}
                    }
                ],
                series : [
                    {
                        name:'成熟度总数',
                        type:'line',
                        color:"#115FA6",
                        showAllSymbol: true,
                        symbol: 'circle',
                        symbolSize: 5,
                        smooth: true,
                        yAxisIndex: 0,
                        data:Pre_Mature_Sum,
                    },
                    {
                        name:'成熟度平均',
                        type:'line',
                        color:'#A61120',
                        showAllSymbol: true,
                        symbol: 'circle',
                        symbolSize: 5,
                        smooth: true,
                        yAxisIndex: 1,
                        data:Pre_Mature_Avg,
                    },
                    {
                        name:'用户总数',
                        type:'line',
                        color:'#94AE0A',
                        showAllSymbol: true,
                        symbol: 'circle',
                        symbolSize: 5,
                        smooth: true,
                        data:Pre_Class_All,
                    },
                    {
                        name:'15天无登录',
                        type:'line',
                        color:'#FF8809',
                        showAllSymbol: true,
                        symbol: 'circle',
                        symbolSize: 5,
                        smooth: true,
                        data:Pre_No_Login_15,
                    }
                ]
            };
            myChart.setOption(option);


            if (row != null){
                username = row["UnitName"];
                document.getElementById("username").innerText=username;
                myChart.hideLoading();
                // 打开窗口
                $('#Echarts_win').window('open');
            }else {
                $.messager.alert('警告','请选择一条数据！');
            }
        },
        dataType: 'json'
    });
}
