var root;

$(function(){
    root = $(".root").attr('rel') + '/';

    $("button[name='btnupdateproduct']").click(updateProduct);
});

function updateProduct(){

    if(isValidProductForm()){

        var formData = $(".frmupdateproduct").serialize();

        ajaxCall(root + 'update-product', 'post', formData, productUpdated);
    }
}

function productUpdated(result){

}

function isValidProductForm(){
    return true;
}
