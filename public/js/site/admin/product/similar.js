$(function(){

    initializeLeftMenu();

    loadProducts(1);
});

function initializeLeftMenu(){
    $('.product-menu > a').click();
    $('.similar-products > a').addClass('selected-navigation-menu');
}

function loadProducts(page){

    var category_id = -1;

    if($('.selected-category').length>0)
        category_id = $('.selected-category').attr('rel');

    var status = $("input[name='active_filter']:checked").val();

    var data = 'page=1&count=20&category_id=' + category_id + '&status=' + status;

    jsonCall(root + '/load-products', 'get', data, productsLoaded);
}

function productsLoaded(products){

    $("#productlist").html("");

    if(products!=undefined && products.length>0){

        var productTable = getProductTable(products);

        $("#productlist").html(productTable);

        $("#table_product").dataTable();
    }
    else
        $("#productlist").html("<h3 class='noproducts'>No products available</h3>");
}

function getProductTable(products){

    var table = '<table id="table_product"><thead>';

    table += '<tr>';

    table += '<td>Id</td>';
    table += '<td>Name</td>';
    table += '<td>Url Key</td>';
    table += '<td>Description</td>';
    table += '<td>Action</td>';

    table += '</tr>';

    table += '</thead><tbody>';

    for(var i=0; i< products.length; i++){

        table += '<tr>';

        var product = products[i];

        table += '<td>' + product.id + '</td>';
        table += '<td>' + product.name + '</td>';
        table += '<td>' + product.url_key + '</td>';
        table += '<td>' + product.description + '</td>';

        table += "<td><a href='" + root + "/similar-for-product/" + product.id + "'>Set similar products</a></td>";

        table += '</tr>';
    }

    table += '</tbody></table>';

    return table;
}
