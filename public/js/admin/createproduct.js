$(function(){
    $("button[name='btncreateproduct']").click(saveProduct);
});

function isValidProductForm(){
    return true;
}

function saveProduct(){
alert('hi');
    if(isValidProductForm()){

        var formData = $(".frmcreateproduct").serialize();
alert(formData);
        ajaxCall('save-product', 'post', formData, productAdded);
    }
}

function productAdded(result){
alert(result);
}
