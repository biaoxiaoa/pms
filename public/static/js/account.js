$('#addAccount').on('click', function () {
    parent.winui.window.open({
        id: 'account_add'  
        ,type: 2
        ,title: '账户添加'
        ,content: '/account_add'
        ,area: ['400px', '300px']
        ,max:false
        ,resize:false
    });
})
function number(data){
    var ID = data.value
    var url ='/qrCode?id='+ID+'&type=number';
    layer.open({
        title:'账户号码',
        type: 2, 
        content: url,
        area: ['320px', '400px']
      });
}
function money(data){
    var ID = data.value
    var url ='/qrCode?id='+ID+'&type=money';
    layer.open({
        title:'账户额度',
        type: 2, 
        content: url,
        area: ['320px', '400px']
    });
}
function secret(data){
    var ID = data.value
    var url ='/qrCode?id='+ID+'&type=secret';
    layer.open({
        title:'账户校验码',
        type: 2, 
        content: url,
        area: ['320px', '400px']
      });
}
layui.use(['form','table'],function(){
    var form = layui.form;
    var table = layui.table;
    form.verify({
        name:function(value,item){
            var length = new RegExp(/^[\S]{1,10}$/);
            if (!length.test(value)) {
                return "账户名称不能超过10个字符";
            }
        },
        numbers:function(value,item){
            if(value.length>0){
                var number = new RegExp(/^[0-9]+$/);
                if (!number.test(value)) {
                    return "账户号码只能输入数字";
                }
            }
        },
        remain:function(value,item){
            if(value.length>0){
                var number = new RegExp(/^[0-9]+$/);
                if (!number.test(value)) {
                    return "账户额度只能输入数字";
                }
            }
        },
        secret:function(value,item){
            if(value.length>0){
                var number = new RegExp(/^[0-9]+$/);
                if (!number.test(value)) {
                    return "账户校验码只能输入数字";
                }
            }
        },
    })
    form.on('submit(add)',function(data){
        $("#add").attr('disabled',true);
        $.ajax({
            type:'post',
            url:'/submit_add_account',
            data:data.field,
            success:function(response){
                if(response.code!=2000){
                    layer.msg(response.msg);
                }
                location.reload()
                $("#add").removeAttr("disabled");
            },
            error:function(error){
                layer.msg('网络异常');
                $("#add").removeAttr("disabled");
            }
        })
        return false;
    })
    form.on('submit(number)', function(obj){
        layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
    });
    table.render({
        elem: '#list',
        url: '/account_list',
        page: true,
        cols: [[ //表头
            { type: 'checkbox', fixed: 'left' },
            { field: 'ID', title: 'ID', width: 80, sort: true, align: 'center' }
            , { field: 'name', title: '账户名称', align: 'center' }
            , { field: 'number', title: '账户号码', align: 'center' ,templet: '#numbers'}
            , { field: 'remainlines', title: '账户额度', align: 'center' ,templet: '#money'}
            , { field: 'secret', title: '账户校验码', align: 'center' ,templet: '#secret'}

            // , { field: 'desk_show', title: '桌面是否显示', align: 'center' }
            // , { field: 'maxOpen', title: '最大化(默认：禁用)', align: 'center' }
            // , { field: 'openType', title: '打开方式', align: 'center' }
        ]]
    })
    
})