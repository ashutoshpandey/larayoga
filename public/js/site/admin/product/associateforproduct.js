$(function(){

    initializeLeftMenu();

    initTab();

    loadAssociatedProducts(1);

    loadProducts(1);
});

function initializeLeftMenu(){
    $('.product-menu > a').click();
    $('.associate-products > a').addClass('selected-navigation-menu');
}

function loadProducts(page){

    var data = 'page=1&count=20';

    jsonCall(root + '/load-products-for-associated-products', 'get', data, productsLoaded);
}

function productsLoaded(products){

    $("#productlist").html("");

    if(products!=undefined && products.length>0){

        var productTable = getProductTable(products);

        $("#productlist").html('<h4>Other products</h4>');

        $("#productlist").append(productTable);

        $("#table_products").dataTable();

        var str = '<input type="button" name="btnupdateassociation" value="Update Association"/>';

        $("#productlist").append(str);

        $("input[name='btnupdateassociation']").click(updateProductAssociation);
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

        $("#associatedproductlist").append('<h4>Already associated products</h4>');

        $("#associatedproductlist").append(productTable);

        $("#table_associated_products").dataTable();

        var str = '<input type="button" name="btnupdateexistingassociation" value="Remove associated products"/>';

        $("#associatedproductlist").append(str);

        $(".remove_associated_product").click(function(){
            var id = $(this).attr('rel');
            removeAssociatedProduct(id);
        });

        $("input[name='btnupdateexistingassociation']").click(updateAssociatedProductsAssociation);
    }
    else
        $("#associatedproductlist").html("<h3 class='noproducts'>No products associated</h3>");
}

function removeAssociatedProduct(id){

    ajaxCall(root + '/remove-associated-product/' + id, 'get', '', associatedProductRemoved);
}

function associatedProductRemoved(){

    loadAssociatedProducts(1);

    loadProducts(1);
}

function getProductTable(products){

    var table = '<table id="table_products"><thead>';

    table += '<tr>';

    table += '<td></td>';
    table += '<td>Sku</td>';
    table += '<td>Name</td>';
    table += '<td>Url Key</td>';
    table += '<td>Description</td>';

    table += '</tr>';

    table += '</thead><tbody>';

    for(var i=0; i< products.length; i++){

        table += '<tr>';

        var product = products[i];

        table += '<td><input type="checkbox" name="chkproduct" rel="' + product.id + '"/></td>';
        table += '<td>' + product.sku + '</td>';
        table += '<td>' + product.name + '</td>';
        table += '<td>' + product.url_key + '</td>';
        table += '<td>' + product.description + '</td>';

        table += '</tr>';
    }

    table += '</tbody></table>';

    return table;
}


function getAssociatedProductTable(products){

    var table = '<table id="table_associated_products"><thead>';

    table += '<tr>';

    table += '<td></td>';
    table += '<td>Sku</td>';
    table += '<td>Name</td>';
    table += '<td>Url Key</td>';
    table += '<td>Description</td>';
    table += '<td>Action</td>';

    table += '</tr>';

    table += '</thead><tbody>';

    for(var i=0; i< products.length; i++){

        table += '<tr>';

        var productObj = products[i];

        table += '<td><input type="checkbox" name="chkassociated" rel="' + productObj.id + '"/></td>';
        table += '<td>' + productObj.product.sku + '</td>';
        table += '<td>' + productObj.product.name + '</td>';
        table += '<td>' + productObj.product.url_key + '</td>';
        table += '<td>' + productObj.product.description + '</td>';
        table += '<td><span class="link remove_associated_product" rel="' + productObj.id + '">Remove</span></td>';

        table += '</tr>';
    }

    table += '</tbody></table>';

    return table;
}

function updateProductAssociation(){

    var str = 'ids=';

    $("input[name='chkproduct']:checked").each(function(){
        var id = $(this).attr('rel');

        str = str + id + ',';
    });

    if(str.substr(str.length-1,1)==',')
        str = str.substr(0, str.length-1);

    ajaxCall(root + '/add-product-association', 'post', str, associationUpdated);
}

function updateAssociatedProductsAssociation(){

    var str = 'ids=';

    $("input[name='chkassociated']:checked").each(function(){
        var id = $(this).attr('rel');

        str = str + id + ',';
    });

    if(str.substr(str.length-1,1)==',')
        str = str.substr(0, str.length-1);

    ajaxCall(root + '/update-product-association', 'post', str, associationUpdated);
}

function associationUpdated(){

    loadAssociatedProducts(1);

    loadProducts(1);
}

function initTab(){
    var tabItems = $('.cd-tabs-navigation a'),
        tabContentWrapper = $('.cd-tabs-content');

    tabItems.on('click', function(event){
        event.preventDefault();
        var selectedItem = $(this);
        if( !selectedItem.hasClass('selected') ) {
            var selectedTab = selectedItem.data('content'),
                selectedContent = tabContentWrapper.find('li[data-content="'+selectedTab+'"]'),
                slectedContentHeight = selectedContent.innerHeight();

            tabItems.removeClass('selected');
            selectedItem.addClass('selected');
            selectedContent.addClass('selected').siblings('li').removeClass('selected');
            //animate tabContentWrapper height when content changes
            tabContentWrapper.animate({
                'height': slectedContentHeight
            }, 200);
        }
    });

    //hide the .cd-tabs::after element when tabbed navigation has scrolled to the end (mobile version)
    checkScrolling($('.cd-tabs nav'));
    $(window).on('resize', function(){
        checkScrolling($('.cd-tabs nav'));
        tabContentWrapper.css('height', 'auto');
    });
    $('.cd-tabs nav').on('scroll', function(){
        checkScrolling($(this));
    });
}
function checkScrolling(tabs){
    var totalTabWidth = parseInt(tabs.children('.cd-tabs-navigation').width()),
        tabsViewport = parseInt(tabs.width());
    if( tabs.scrollLeft() >= totalTabWidth - tabsViewport) {
        tabs.parent('.cd-tabs').addClass('is-ended');
    } else {
        tabs.parent('.cd-tabs').removeClass('is-ended');
    }
}
