function verify_code() {
    $('#captchaImg').attr('src','/captcha');
    $('#vercode').value="";   
}
$(function () {
layui.extend({
    loading:'/static/lib/layui/extend/loading/loading'
}).use(['form','loading','layer'],function(){
    var form = layui.form;
    var loading = layui.loading;
    var layer = layui.layer;
    form.verify({
        username:function(value,item){
            var length = new RegExp(/^[\S]{3,12}$/);
            var specialCharacters = new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$");//不包含特殊符号返回True
            if (!length.test(value)) {
                return "用户名必须3到12位";
            }
            if (!specialCharacters.test(value)) {
                return "用户名不能输入特殊字符";
            }
        },
        password:function(value,item){
            var length = new RegExp(/^[\S]{5,12}$/);
            if (!length.test(value)) {
                return "密码必须5到12位";
            }
        },
        vercodes:function(value,item){
            if (value.length != 5) {
                return "验证码必须5位";
            }
            var onlyNumber = new RegExp(/^\d+\d+\d$/);//只包含数字返回True
            if (!onlyNumber.test(value)) {
                return "验证码只能为数字";
            }
        }
    })
    form.on('submit(login)',function(data){
        var index = layer.load(2, {type:3,shade: [0.4,'#DCDCDC']});
        $("#login").attr('disabled',true);
        // $(window).loading('show',{
        //         "opacity": 0.7,
        //         "imgSrc": 9,
        //         "text": "正在登陆...",
        //         "textCss": {
        //             "color": "#666"
        //         }});
        $.ajax({
            type:'post',
            url:'/login_check',
            data:data.field,
                success:function(response){
                    // $(window).loading('hide');
                    layer.close(index);
                    if(response.code!=1000){
                        layer.msg(response.msg,{icon:2,anim:6});
                    }else{
                        window.location.href='/main'
                    }
                    $("#login").removeAttr("disabled");
                    verify_code();
                },
                error:function(error){
                    layer.close(index);
                    layer.msg("正在抢修网络....",{icon:2,anim:6});
                    $("#login").removeAttr("disabled");
                    verify_code();
                }
        })
    })
    
})
    
})