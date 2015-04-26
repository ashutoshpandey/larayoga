$(function(){

    loadAssociatedProducts(1);

    loadProducts(1);
});

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

        $("#table_products").dataTable();

        var str = '<input type="button" name="btnupdateassociation" value="Update Association"/>';

        $("#productlist").append(str);

        $("input[name='btnupdateassociation']").click(updateProductsAssociation);
    }
    else
        $("#productlist").html("<h3 class='noproducts'>No products available</h3>");
}

function loadAssociatedProducts(page){

    var data = 'page=1&count=20';

    jsonCall(root + '/load-associated-products', 'get', data, associatedProductsLoaded);
}

function associatedProductsLoaded(products){

    $("#associatedproductlist").html("");

    if(products!=undefined && products.length>0){

        var productTable = getAssociatedProductTable(products);

        $("#associatedproductlist").html(productTable);

        $("#table_associated_products").dataTable();

        var str = '<input type="button" name="btnupdateexistingassociation" value="Update Association"/>';

        $("#associatedproductlist").append(str);

        $("input[name='btnupdateexistingassociation']").click(updateAssociatedProductsAssociation);
    }
    else
        $("#associatedproductlist").html("<h3 class='noproducts'>No products associated</h3>");
}

function getProductTable(products){

    var table = '<table id="table_products"><thead>';

    table += '<tr>';

    table += '<td></td>';
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

        table += '<td><input type="checkbox" name="chkassociate" rel="' + product.id + '"/></td>';
        table += '<td>' + product.id + '</td>';
        table += '<td>' + product.name + '</td>';
        table += '<td>' + product.url_key + '</td>';
        table += '<td>' + product.description + '</td>';

        table += "<td><a href='" + root + "/associate-for-product/" + product.id + "'>Associate</a></td>";

        table += '</tr>';
    }

    table += '</tbody></table>';

    return table;
}


function getAssociatedProductTable(products){

    var table = '<table id="table_associated_products"><thead>';

    table += '<tr>';

    table += '<td></td>';
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

        table += '<td><input type="checkbox" name="chkassociate" rel="' + product.id + '"/></td>';
        table += '<td>' + product.id + '</td>';
        table += '<td>' + product.name + '</td>';
        table += '<td>' + product.url_key + '</td>';
        table += '<td>' + product.description + '</td>';

        table += "<td><a href='" + root + "/associate-for-product/" + product.id + "'>Associate</a></td>";

        table += '</tr>';
    }

    table += '</tbody></table>';

    return table;
}

function updateProductAssociation(){

}

function updateAssociatedProductsAssociation(){

}