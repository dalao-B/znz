<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>销售上拽统计</title>
    <link rel="stylesheet" type="text/css" href="/easyui_1.7.1/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/easyui_1.7.1/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="/easyui_1.7.1/demo/demo.css">
    <script type="text/javascript" src="/easyui_1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="/easyui_1.7.1/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/easyui_1.7.1/locale/easyui-lang-zh_CN.js" ></script>
</head>
<body>
<div class="easyui-layout"  data-options='fit:true'>
    <div data-options="region:'south'" style="height:30px; overflow: hidden">
        <div style="line-height:28px;text-align:center;cursor:default">Copyright © 北京指南针股份有限公司版权所有 </div>
    </div>
    <div data-options="region:'west',collapsible:true" title="菜单栏" style="width:16% ">
        <ul id="MainTree" class="easyui-tree"></ul>
    </div>
    <div data-options="region:'center',title:'销售业绩指标分析系统'">
        <div id="MainPanel" class="easyui-layout" data-options="fit:true">
<!--            选择页面按钮-->
            <div data-options="region:'north'" style="height: 30px; background-color: #E0ECFF;line-height: 30px;overflow: hidden">
                <span id=''>
                    <input type="radio" name="UnitType1" value="1" onclick={UnitType1_RadioFun()} />结果类指标
                </span>
                <span id=''>
                    <input type="radio" name="UnitType1" value="2" onclick={UnitType1_RadioFun()} checked="true"/>过程类指标
                </span>
                <span id=''>
                    <input type="radio" name="UnitType1" value="3" onclick={UnitType1_RadioFun()} />劳动类指标
                </span>
                <span id=''>
                    <input type="radio" name="UnitType2" value="1" onclick={UnitType1_RadioFun()} checked="true"/>小单开新
                </span>
                <span id=''>
                    <input type="radio" name="UnitType2" value="2" onclick={UnitType1_RadioFun()} />3600上拽
                </span>
                <span id=''>
                    <input type="radio" name="UnitType2" value="3" onclick={UnitType1_RadioFun()} />18000上拽
                </span>
                <span id=''>
                    <input type="radio" name="UnitType2" value="4" onclick={UnitType1_RadioFun()} />财富掌门上拽
                </span>
            </div>
        <!--            中心内容-->
            <div data-options="region:'center'">
<!--                --><?php //include_once "part/process/process_UpdateTrans.php" ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        //初始化默认首页
        var ActType = parseInt(getQueryVariable('ActType'));
        switch (ActType) {
            case 1:
                $("input[type='radio'][name='UnitType2'][value='1']").attr("checked",true);
                $("#MainPanel").layout("remove",'center');
                $("#MainPanel").layout("add",{
                    region:'center',
                    href:"part/process/process_NewTrans.php"
                });
                break;
            case 2:
                $("input[type='radio'][name='UnitType2'][value='2']").attr("checked",true);
                $("#MainPanel").layout("remove",'center');
                $("#MainPanel").layout("add",{
                    region:'center',
                    href:"part/process/process_UpdateTrans.php"
                });
                break;
            case 3:
                $("input[type='radio'][name='UnitType2'][value='3']").attr("checked",true);
                $("#MainPanel").layout("remove",'center');
                $("#MainPanel").layout("add",{
                    region:'center',
                    href:"part/process/process_AdvanceTrans.php"
                });
                break;
            case 4:
                $("input[type='radio'][name='UnitType2'][value='4']").attr("checked",true);
                $("#MainPanel").layout("remove",'center');
                $("#MainPanel").layout("add",{
                    region:'center',
                    href:"part/process/process_OrganizationTrans.php"
                });
                break;
            default:
                $("input[type='radio'][name='UnitType2'][value='1']").attr("checked",true);
                $("#MainPanel").layout("remove",'center');
                $("#MainPanel").layout("add",{
                    region:'center',
                    href:"part/process/process_NewTrans.php"
                });
                break;
        }
    });

    var meType = "ALL";
    var dg_data = null;
    var load_data = null;
    var Id=0;

    //   对左边的树进行单击的时候
    $("#MainTree").tree({
        url:'interface/asynRead.php?cmd=menuGet',
        animate: true,
        lines:true,
        onSelect:function(node){
            Id=node.id;
            if(node.attributes.Type==1||node.attributes.Type==100){
                meType='company';
            }else if(node.attributes.Type==2){
                meType='department';
            }else{
                meType='group';
            }
            if(Id==-1){
                Id=0;
                meType='All';
            }
            var NodeType = node.attributes.Type;
            if(NodeType == 2){
                if($('#UnitType_RegionType').length > 0){
                    if($('#UnitType_RegionType').children()[0].checked == true){
                        $('#UnitType_Dept').children()[0].checked=true;
                    }
                    // $('#UnitType_RegionType').hide();
                    $("#UnitType_RegionType").css({color:"gray"});
                    $('#UnitType_RegionType1').attr("disabled",true);
                }
            }else{
                if($('#UnitType_RegionType').length > 0 && NodeType != 3){
                    // $('#UnitType_RegionType').show();
                    $("#UnitType_RegionType").css({color:"black"});
                    $('#UnitType_RegionType1').attr("disabled",false);
                }
            }
            if(NodeType == 3){
                if($('#UnitType_Dept').length > 0){
                    if($('#UnitType_Person').children()[0].checked == false){
                        $('#UnitType_Group').children()[0].checked=true;
                    }
                    // $('#UnitType_Dept').hide();
                    $("#UnitType_RegionType").css({color:"gray"});
                    $('#UnitType_RegionType1').attr("disabled",true);
                    $("#UnitType_Dept").css({color:"gray"});
                    $('#UnitType_Dept1').attr("disabled",true);
                }
            }else{
                if($('#UnitType_Dept').length > 0 && NodeType != 2){
                    // $('#UnitType_Dept').show();
                    $("#UnitType_RegionType").css({color:"black"});
                    $('#UnitType_RegionType1').attr("disabled",false);
                    $("#UnitType_Dept").css({color:"black"});
                    $('#UnitType_Dept1').attr("disabled",false);
                }else {
                    $("#UnitType_Dept").css({color:"black"});
                    $('#UnitType_Dept1').attr("disabled",false);
                }
            }
        },
        onLoadSuccess:function(node,data){
            var node = $('#MainTree').tree('find',-1);
            $('#MainTree').tree('select',node.target);
        }
    });


    //选择按钮：radio1：1、结果类，2、过程类，3、劳动类
    //          radio2：1、小单 ，2、3600 ，3、18000，4、财富掌门
    function UnitType1_RadioFun(){
        var radio1 = parseInt($('input[name="UnitType1"]:checked').val());
        var radio2 =parseInt($('input[name="UnitType2"]:checked').val());
        if (radio1 ===2 && radio2 === 1) {
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/process/process_NewTrans.php"
            });
        }else if (radio1 ===2 && radio2 ===2) {
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/process/process_UpdateTrans.php"
            });
        }else if (radio1 ===2 && radio2 ===3) {
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/process/process_AdvanceTrans.php"
            });
        }else if (radio1 ===2 && radio2 ===4) {
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/process/process_OrganizationTrans.php"
            });
        }else if(radio1 ===1 && radio2 ===1){
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/result/result_NewTransStage.php"
            });
        }else if(radio1 ===1 && radio2 ===2){
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/result/result_UpdateTransStage.php"
            });
        }else if(radio1 ===1 && radio2 ===3){
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/result/result_AdvanceTransStage.php"
            });
        }else if(radio1 ===1 && radio2 ===4){
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/result/result_OrganizationTransStage.php"
            });
        }else if (radio1 ===3 && radio2 ===1) {
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/labor/labor_NewTransStage.php"
            });
        }else if (radio1 ===3 && radio2 ===2) {
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/labor/labor_UpdateTransStage.php"
            });
        } else if (radio1 ===3 && radio2 ===3) {
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/labor/labor_AdvanceTransStage.php"
            });
        }else if (radio1 ===3 && radio2 ===4) {
            $("#MainPanel").layout("remove",'center');
            $("#MainPanel").layout("add",{
                region:'center',
                href:"part/labor/labor_OrganizationTransStage.php"
            });
        }else {
            $("#MainPanel").layout("remove",'center');
        }
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


</body>
</html>
