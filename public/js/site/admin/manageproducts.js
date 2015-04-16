var currentCategoryId;          // for displaying products from categories

$(function(){
   loadAllProducts(1);
});

function loadAllProducts(page){

    var data = 'page=1&count=20';

    jsonCall('load-all-products', 'get', data, productsLoaded);
}

function productsLoaded(products){

    $("#productlist").html("");

    if(products!=undefined && products.length>0){

        $('#productlist').WATable({
            data: generateProductGrid(products),
            pageSizes: [20,50,100]  //Set custom pageSizes. Leave empty array to hide button.
        });

        $(".lnkremove").click(function(){
            var id = $(this).attr('rel');

            if(confirm("Are you sure to remove this product?"))
                removeProductFromList(id);
        });
    }
    else
        $("#productlist").html("<h3 class='noproducts'>No products available</h3>");
}

function generateProductGrid(products){

    var cols = {
        ID: {
            index: 1,
            sortOrder: "asc",
            tooltip: "Id of the product"
        },
        SKU: {
            index: 2,
            sortOrder: "asc",
            tooltip: "SKU of the product"
        },
        Name: {
            index: 3,
            sortOrder: "asc",
            tooltip: "Name of the product"
        },
        Quantity: {
            index: 4,
            sortOrder: "asc",
            tooltip: "Quantity of the product"
        },
        Action: {
            index: 5
        }
    };

    var rows = [];

    for(var i=0; i< products.length; i++){

        var row = {};

        var product = products[i];

        row.ID = product.id;
        row.SKU = product.sku;
        row.Name = product.name;
        row.Quantity = product.quantity;
        row.Action = "<a href='edit-product/" + product.id + "'>Edit</span> &nbsp;&nbsp; <span class='lnkremove' rel='" + product.id + "'>Remove</span>";

        rows.push(row);
    }

    var data = {
        cols: cols,
        rows: rows
    };

    return data;
}

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

    var data = 'id=' + productId;

    ajaxCall('remove-product', 'get', data, productRemovedFromList);
}

// for removing product when displayed in list
function productRemovedFromList(result){
    loadAllProducts(1);
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