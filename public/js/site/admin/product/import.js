$(function(){

    initializeLeftMenu();

    $("#btnimportproducts").click(function(){
        $("#frmimportproducts").attr('action', root + '/upload-products');

        $(".message").html("Processing").show();
    });

    $("#ifr").load(function(){

        var result = $("#ifr").contents().find('body').text();

        $(".message").html(result);
    });
});

function initializeLeftMenu(){
    $('.product-menu > a').click();
    $('.import-products > a').addClass('selected-navigation-menu');
}