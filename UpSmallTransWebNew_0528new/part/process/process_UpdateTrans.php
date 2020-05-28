<div id="tabs" class="easyui-tabs" data-options="fit:true" >
    <div title="3600上拽统计"  data-options="href:'part/process/process_UpdateTransStagePanel.php'"></div>
<!--    <div title="3600用户成熟度统计" style="overflow: hidden" data-options="href:'part/process/process_UpdateClassBChange_DetailPanel.php'"></div>-->
<!--    <div title="3600淘人系统" style="overflow: hidden" data-options="href:'part/process/process_UpdateTransStage_obsoletePanel.php'"></div>-->
    <div title="3600上拽统计_历史"  data-options="href:'part/process/process_UpdateTransStageHistoryPanel.php'"></div>
</div>
<script type="text/javascript">
    $(function () {
        $('#tabs').tabs({
            onSelect:function(title,index){
                if (title == "3600上拽统计") {
                    $("#dg_History").datagrid("loadData",{total:0,rows:[]});
                    //   对左边的树进行单击的时候
                    $("#MainTree").tree({
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
                    });

                }else if (title == "3600上拽统计_历史"){
                    $("#dg").datagrid("loadData",{total:0,rows:[]});
                    //   对左边的树进行单击的时候
                    $("#MainTree").tree({
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
                                if($('#UnitType_RegionType_History').length > 0){
                                    if($('#UnitType_RegionType_History').children()[0].checked == true){
                                        $('#UnitType_Dept_History').children()[0].checked=true;
                                    }
                                    // $('#UnitType_RegionType').hide();
                                    $("#UnitType_RegionType_History").css({color:"gray"});
                                    $('#UnitType_RegionType1_History').attr("disabled",true);
                                }
                            }else{
                                if($('#UnitType_RegionType_History').length > 0 && NodeType != 3){
                                    // $('#UnitType_RegionType').show();
                                    $("#UnitType_RegionType_History").css({color:"black"});
                                    $('#UnitType_RegionType1_History').attr("disabled",false);
                                }
                            }
                            if(NodeType == 3){
                                if($('#UnitType_Dept_History').length > 0){
                                    if($('#UnitType_Person_History').children()[0].checked == false){
                                        $('#UnitType_Group_History').children()[0].checked=true;
                                    }
                                    // $('#UnitType_Dept').hide();
                                    $("#UnitType_RegionType_History").css({color:"gray"});
                                    $('#UnitType_RegionType1_History').attr("disabled",true);
                                    $("#UnitType_Dept_History").css({color:"gray"});
                                    $('#UnitType_Dept1_History').attr("disabled",true);
                                }
                            }else{
                                if($('#UnitType_Dept_History').length > 0 && NodeType != 2){
                                    // $('#UnitType_Dept').show();
                                    $("#UnitType_RegionType_History").css({color:"black"});
                                    $('#UnitType_RegionType1_History').attr("disabled",false);
                                    $("#UnitType_Dept_History").css({color:"black"});
                                    $('#UnitType_Dept1_History').attr("disabled",false);
                                }else {
                                    $("#UnitType_Dept_History").css({color:"black"});
                                    $('#UnitType_Dept1_History').attr("disabled",false);
                                }
                            }
                        },
                    });
                }
            }
        });
    })
</script>