var currentCategoryId;          // for displaying products from categories

// for removing single product
function removeProduct(id){

    var data = 'id=' + id;

    ajaxCall('remove-product', 'get', data, productRemoved);
}

// remove single product result
function productRemoved(result){

    if(result=="removed"){

    }
    else if(result=="not found"){

    }
    else if(result=="invalid"){

    }
    else{

    }
}

// for removing product when displayed in list
function removeProductFromList(productId){

    var data = 'id=' + id;

    ajaxCall('remove-product', 'get', data, productRemoved);
}

// for removing product when displayed in list
function productRemovedFromList(result){
    loadProductsFromCategory(currentCategoryId);
}

function loadProductsFromCategory(id, page){

    var data = 'id=' + id + '&page=' + page;

    jsonCall('category-products', 'get', data, categoryProductsLoaded);
}

function categoryProductsLoaded(result){

    if(result!=undefined && result.length>0){

        $(".product-list").html("");

        for(var i=0;i<result.length;i++){
            var product = result[i];

            // show products in grid
        }

        $(".remove-product").click(function(){
            var id = $(this).attr('rel');
            removeProduct(id);
        });

        $(".edit-product").click(function(){
            var id = $(this).attr('rel');
            editProduct(id);
        });
    }
}