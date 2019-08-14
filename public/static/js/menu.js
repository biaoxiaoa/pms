layui.use(['table'],function(){
    var table = layui.table;
    table.render({
        elem:'#list',
        url:'/index.php/set/menu/list',
        page:true,
        cols: [[ //表头
            {field: 'id', title: 'ID', width:80, sort: true, fixed: 'left',align:'center'}
            ,{field: 'title', title: '菜单名称',align:'center'}
            ,{field: 'icon', title: '菜单图标',align:'center'}
            ,{field: 'desk_show', title: '桌面是否显示',align:'center'} 
            ,{field: 'maxOpen', title: '最大化(默认：禁用)',align:'center'}
            ,{field: 'openType', title: '打开方式',align:'center'}
          ]]
    })    
})