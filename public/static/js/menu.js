layui.use(['table'], function () {
    var table = layui.table;
    table.render({
        elem: '#list',
        url: '/index.php/set/menu/list',
        page: true,
        cols: [[ //表头
            { type: 'checkbox', fixed: 'left' },
            { field: 'id', title: 'ID', width: 80, sort: true, align: 'center' }
            , { field: 'title', title: '菜单名称', align: 'center' }
            , { field: 'icon', title: '菜单图标', align: 'center' }
            , { field: 'desk_show', title: '桌面是否显示', align: 'center' }
            , { field: 'maxOpen', title: '最大化(默认：禁用)', align: 'center' }
            , { field: 'openType', title: '打开方式', align: 'center' }
        ]]
    })


    $('#deleteMenu').on('click', function () {
        var checkStatus = table.checkStatus("list");
        var checkCount = checkStatus.data.length;
        if (checkCount < 1) {
            layer.msg('请选择一条数据', {
                time: 2000
            });
            return false;
        }
        layer.confirm('真的删除行么', function (index) {
            var ids = '';
            $(checkStatus.data).each(function (index, item) {
                ids += item.id + ',';
            });
            var datas = { 'ids': ids };
            $.ajax({
                type: 'post',
                url: '/index.php/set/menu/delete',
                data: datas,
                success: function (response) {
                    layer.msg(response.msg, {
                        time: 2000
                    });
                    table.reload("list", {});
                    parent.winui.desktop.init();
                },
                error: function (error) {
                }
            })
            layer.close(index);
        });
    });

    $('#reloadTable').on('click', function () {
        table.reload("list", {});
    })

})