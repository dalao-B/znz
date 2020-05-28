<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>指南针神经网络信息后台管理系统</title>
    <link rel="stylesheet" type="text/css" href="/easyui_1.7.1/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/easyui_1.7.1/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="/easyui_1.7.1/demo/demo.css">
    <script type="text/javascript" src="/easyui_1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="/easyui_1.7.1/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/easyui_1.7.1/locale/easyui-lang-zh_CN.js" ></script>
</head>
<body>
<div class="easyui-layout"  data-options='fit:true'>
<!--    下面标识-->
    <div data-options="region:'south'" style="height:30px; overflow: hidden">
        <div style="line-height:28px;text-align:center;cursor:default">Copyright © 北京指南针股份有限公司版权所有 </div>
    </div>
<!--    菜单树-->
    <div data-options="region:'west',collapsible:true" title="菜单栏" style="width:16% ">
        <ul id="tree" class="easyui-tree">
            <li>
                <span>指南针商城</span>
                <ul>
                    <li>Z币任务</li>
                    <li>指标数据</li>
                    <li>商品库存</li>
                </ul>
            </li>
        </ul>
    </div>
<!--    中心内容-->
    <div data-options="region:'center',title:'指南针神经网络信息后台管理系统'" style="overflow:hidden;">
        <div id="MainPanel" class="easyui-layout"  data-options='fit:true'>

        </div>
    </div>
</div>

<script type="text/javascript">
    $.parser.parse();
    $("#tree").tree({
        onClick: function (node) {
            if (node.text == 'Z币任务') {
                $("#MainPanel").layout("remove",'center');
                $("#MainPanel").layout("add",{
                    region:'center',
                    href:"znzMarket.php"
                });
            }
        }
    })
</script>
</body>
</html>
