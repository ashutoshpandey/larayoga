function addToCart(){

    var product_id = '';
    var quantity = '';
    var price = '';
    var options = '';

    var data = 'product_id=' + product_id + '&quantity=' + quantity + '&price=' + price + '&options=' + options;

    jsonCall('add-to-cart', 'GET', data, addedToCart);
}

function addedToCart(result){
    if(result.message=="added"){
        // result.count
    }
    else if(result.message=="error"){

    }
}

function getCartCount(){
    jsonCall('get-cart-count', 'GET', data, showCartCount);
}
function showCartCount(result){
    // result.count
}

function showCart(){
    jsonCall('get-cart', 'GET', '', displayCart);
}
function displayCart(result){

    if(result.count>0){

        var rows = result.rows;

        for(var i=0;i<rows.count;i++){

            var row = rows.data[i];
        }
    }
}

function removeFromCart(){

    var data = 'id=' + $(this).attr('rel');                     // example:   <span rel='4' class='removeFromCart'>x</span>

    jsonCall('remove-from-cart', 'GET', data, addedToCart);
}

function addedToCart(result){
    if(result.message=="added"){
        // result.count
    }
    else if(result.message=="error"){

    }
}
