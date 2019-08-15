$('#addAccount').on('click', function () {
    parent.winui.window.open({
        id: 'account_add'  
        ,type: 2
        ,title: '账户添加'
        ,content: '/account_add'
    });
})