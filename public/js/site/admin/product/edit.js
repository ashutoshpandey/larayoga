$(document).ready(function(){

    initializeLeftMenu();

    $("input[name='btnupdateproduct']").click(updateProduct);

    $('#ifr').load(function(){

        $('.msg').html('');

        var result = $('#ifr').contents().find('body').html();

        productUpdated(result);
    });
});

function isValidProductForm(){
    return true;
}

function updateProduct(){

    if(isValidProductForm()){

        $('#frmproduct').attr('action', root + '/update-product');

        $('.msg').html('Updating product, please wait');

        return true;
    }
    else
        return false;
}

function productUpdated(result){

    if(result.indexOf('done')>-1){
    }
}

function initializeLeftMenu(){
    $('.product-menu > a').click();
    $('.manage-products > a').addClass('selected-navigation-menu');
}