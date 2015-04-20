$(document).ready(function(){

    initializeLeftMenu();

    getCategoryTree(showTree);
});

function loadProducts(page, category_id){

    var data = 'page=1&count=20&category_id=' + category_id;

    jsonCall(root + '/load-products', 'get', data, productsLoaded);
}

function productsLoaded(products){

    $("#productlist").html("");

    if(products!=undefined && products.length>0){

        var productTable = getProductTable(products);

        $("#productlist").html(productTable);

        $("#table_product").dataTable();

        var update_grid_button = "<input type='button' name='btn_update_grid' value='Update Grid'/>";
        var update_grid_message = "<span class='update_grid message'></span>";

        $('#productlist').append(update_grid_button);

        $("input[name='btn_update_grid']").click(updateProductGrid);

        $(".lnkremove").click(function(){
            var id = $(this).attr('rel');

            if(confirm("Are you sure to remove this product?"))
                removeProduct(id);
        });
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
    table += '<td>Sorting</td>';
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

        table += "<td><input type='text' name='sort_order' rel='" + product.id + "' class='sort_order' maxlength='2' value='" + product.sort_order + "'/></td>";
        table += "<td><a href='edit-product/" + product.id + "'>Edit</a> &nbsp;&nbsp; <span class='lnkremove' rel='" + product.id + "'>Remove</span></td>";

        table += '</tr>';
    }

    table += '</tbody></table>'

    return table;
}

function initializeLeftMenu(){
    $('.product-menu > a').click();
    $('.manage-products > a').addClass('selected-navigation-menu');
}

function updateProductGrid(){

    var str = 'product_sort_data=';

    $("input[name='sort_order']").each(function(){
        var product_id = $(this).attr('rel');
        var sort_order = $(this).val();

        str = str + product_id + ':' + sort_order + ',';
    });

    if(str.substr(str.length-1,1)==',')
        str = str.substr(0, str.length-1);

    ajaxCall('update-product-grid-order', 'post', str, productGridUpdated);
}

function productGridUpdated(result){

}


function showTree(result){
    $('#tree').html(result);

    bindTreeEvents();

    var category_id = $('.selected-category').attr('rel');

    loadProducts(1, category_id);
}
function bindTreeEvents(){

    // fix: removing 'ul' with no 'li'
    $('#tree').find('ul').each(function(){
        if($(this).children().length==0)
            $(this).remove();
        else
            $(this).addClass('folder');
    });

    // fix: removing 'ul' with no 'li'
    $('#tree').find('li').each(function(){
        if($(this).children().length==0)
            $(this).css('background-image', "url('" + root + "/public/css/site/admin/category/child.gif')");
    });

    $('.folder > li').click(function(e){
        $('#tree').find('li').removeClass('selected-category');

        if($(this).find('ul').length>0){
            $(this).find(">:first-child").toggle();

            var background = $(this).css('background-image');

            if(background.indexOf('closed')>-1)
                $(this).css('background-image', "url('" + root + "/public/css/site/admin/category/open.gif')");
            else
                $(this).css('background-image', "url('" + root + "/public/css/site/admin/category/closed.gif')");
        }

        $(this).removeClass('non-selected-category');
        $(this).addClass('selected-category');
        $(this).children().addClass('non-selected-category');

        e.stopPropagation();
    });

    $('#tree').find('li').first().addClass('selected-category');

    $('#tree').find('li').click(function(){
        var category_id = $('.selected-category').attr('rel');

        loadProducts(1, category_id);
    });
}
