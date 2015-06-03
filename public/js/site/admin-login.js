$(function(){
    $("#btnlogin").click(checkLogin);
});

function checkLogin(){
    var data = $("#frm").serialize();

    $("#message").html("");

    $.ajax({
        url: root + '/is-valid-admin',
        type: 'post',
        data: data,
        success: function(result){
            if(result.indexOf("correct")>-1)
                window.location.replace(root + '/admin-section');
            else
                $("#message").html("Invalid login");
        }
    });
}