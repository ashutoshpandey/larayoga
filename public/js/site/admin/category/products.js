var currentCategoryId;          // for displaying categories from categories

$(function(){

    initializeLeftMenu();

    getCategoryTree(showTree);

    loadProducts(1, -1, 'all');

    $('#btndofilter').click(function(){

        var category_id = -1;

        var filter = $("select[name='filter']").val();

        if(filter=='selected'){
            if($('.selected-category').length>0)
                category_id = $('.selected-category').attr('rel');
        }

        loadProducts(1, category_id, filter);
    });
});

function loadProducts(page, category_id, filter){

    var data = 'page=1&count=20&category_id=' + category_id + '&filter=all';

    jsonCall(root + '/load-products', 'get', data, productsLoaded);
}

function productsLoaded(products){

    $("#productlist").html("");

    if(products!=undefined && products.length>0){

        var categoryTable = getProductTable(products);

        $("#productlist").html(categoryTable);

        $("#table_product").dataTable();

        var add_to_category_button = "<input type='button' name='btn_add_to_category' value='Add Products To Category'/>";
        var update_grid_button = "<input type='button' name='btn_update_grid' value='Update Sort Order'/>";
        var update_grid_message = "<span class='update_grid message'></span>";

        $('#productlist').append(add_to_category_button);
        $('#productlist').append(update_grid_button);
        $('#productlist').append(update_grid_message);

        $("input[name='btn_add_to_category']").click(addProductsToCategory);
        $("input[name='btn_update_grid']").click(updateProductGrid);
    }
    else
        $("#productlist").html("<h3 class='nocategories'>No products available</h3>");
}

function addProductsToCategory(){

    if($('.selected-category').length==0){
        $('.message').html('Please select a category first');
        return;
    }

    $('.message').html('');

    var category_id = $('.selected-category').attr('rel');

    var str = 'category_id=' + category_id + '&product_ids=';

    $("input[name='chk_product']").each(function(){
        var product_id = $(this).attr('rel');
        var status = $(this).is(':checked') ? 'add' : 'remove';

        str = str + product_id + ':' + status + ',';
    });

    if(str.substr(str.length-1,1)==',')
        str = str.substr(0, str.length-1);

    ajaxCall('update-products-in-category', 'post', str, productsInCategoryUpdated);
}

function productsInCategoryUpdated(result){

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

function getProductTable(products){

    var table = '<table id="table_product" class="dataTable display"><thead>';

    table += '<tr>';

    table += '<td></td>';
    table += '<td>Id</td>';
    table += '<td>Name</td>';
    table += '<td>Url Key</td>';
    table += '<td>Sorting</td>';

    table += '</tr>';

    table += '</thead><tbody>';

    for(var i=0; i< products.length; i++){

        table += '<tr>';

        var product = products[i];

        table += "<td><input type='checkbox' name='chk_product' rel='" + product.id + "'/></td>";
        table += '<td>' + product.id + '</td>';
        table += "<td title='" + product.description + "'>" + product.name + "</td>";
        table += '<td>' + product.url_key + '</td>';

        table += "<td><input type='text' name='sort_order' rel='" + product.id + "' class='sort_order' maxlength='2' value='" + product.sort_order + "'/></td>";

        table += '</tr>';
    }

    table += '</tbody></table>'

    return table;
}

function showTree(tree){

    $('#tree').html(tree);

    bindTreeEvents();
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
            $(this).css('background-image', "url('public/css/site/admin/category/child.gif')");
    });

    $('.folder > li').click(function(e){
        $('#tree').find('li').removeClass('selected-category');

        if($(this).find('ul').length>0){
            $(this).find(">:first-child").toggle();

            var background = $(this).css('background-image');

            if(background.indexOf('closed')>-1)
                $(this).css('background-image', "url('public/css/site/admin/category/open.gif')");
            else
                $(this).css('background-image', "url('public/css/site/admin/category/closed.gif')");
        }

        $(this).removeClass('non-selected-category');
        $(this).addClass('selected-category');
        $(this).children().addClass('non-selected-category');

        e.stopPropagation();
    });
}

function initializeLeftMenu(){
    $('.category-menu > a').click();
    $('.manage-categories > a').addClass('selected-navigation-menu');
}