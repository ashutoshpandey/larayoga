$(document).ready(function(){

    initializeLeftMenu();

    $('#ifr').load(function(){

        $('.msg').html('');

        var result = $('#ifr').contents().find('body').html();

        categoryUpdated(result);
    });
});

function isValidProductForm(){
    return true;
}

function updateProduct(){

    if(isValidProductForm()){

        var id = $('.selected-product').attr('rel');

        $("input[name='id']").val(id);

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