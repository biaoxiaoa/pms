$('#addAccount').on('click', function () {
    parent.winui.window.open({
        id: 'account_add'  
        ,type: 2
        ,title: '账户添加'
        ,content: '/account_add'
        ,area: ['400px', '250px']
        ,max:false
        ,resize:false
    });
})
layui.use(['form'],function(){
    var form = layui.form;
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
        $.ajax({
            type:'post',
            url:'/submit_add_account',
            data:data.field,
            success:function(response){
                console.log(response);
            },
            error:function(error){
                console.log(error);
            }
        })
        return false;
    })
})