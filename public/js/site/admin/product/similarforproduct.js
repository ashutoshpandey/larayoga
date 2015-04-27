$(function(){

    initializeLeftMenu();

    initTab();

    loadSimilarProducts(1);

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

        $("#productlist").html('<h4>Other products</h4>');

        $("#productlist").append(productTable);

        $("#table_products").dataTable();

        var str = '<input type="button" name="btnUpdateSimilarProducts" value="Update Association"/>';

        $("#productlist").append(str);

        $("input[name='btnUpdateSimilarProducts']").click(updateSimilarProducts);
    }
    else
        $("#productlist").html("<h3 class='noproducts'>No products available</h3>");
}

function loadSimilarProducts(page){

    var data = 'page=1&count=20';

    jsonCall(root + '/load-associated-products', 'get', data, similarProductsLoaded);
}

function similarProductsLoaded(products){

    $("#similarproductlist").html("");

    if(products!=undefined && products.length>0){

        var productTable = getExistingSimilarProductsTable(products);

        $("#similarproductlist").append('<h4>Similar products</h4>');

        $("#similarproductlist").append(productTable);

        $("#table_associated_products").dataTable();

        var str = '<input type="button" name="btnUpdateExistingSimilarProducts" value="Update Association"/>';

        $("#similarproductlist").append(str);

        $("input[name='btnUpdateExistingSimilarProducts']").click(updateExistingSimilarProducts);
    }
    else
        $("#similarproductlist").html("<h3 class='noproducts'>No products associated</h3>");
}

function getProductTable(products){

    var table = '<table id="table_products"><thead>';

    table += '<tr>';

    table += '<td></td>';
    table += '<td>Id</td>';
    table += '<td>Name</td>';
    table += '<td>Url Key</td>';
    table += '<td>Description</td>';

    table += '</tr>';

    table += '</thead><tbody>';

    for(var i=0; i< products.length; i++){

        table += '<tr>';

        var product = products[i];

        table += '<td><input type="checkbox" name="chkproduct" rel="' + product.id + '"/></td>';
        table += '<td>' + product.id + '</td>';
        table += '<td>' + product.name + '</td>';
        table += '<td>' + product.url_key + '</td>';
        table += '<td>' + product.description + '</td>';

        table += '</tr>';
    }

    table += '</tbody></table>';

    return table;
}


function getExistingSimilarProductsTable(products){

    var table = '<table id="table_associated_products"><thead>';

    table += '<tr>';

    table += '<td></td>';
    table += '<td>Id</td>';
    table += '<td>Name</td>';
    table += '<td>Url Key</td>';
    table += '<td>Description</td>';

    table += '</tr>';

    table += '</thead><tbody>';

    for(var i=0; i< products.length; i++){

        table += '<tr>';

        var product = products[i];

        table += '<td><input type="checkbox" name="chksimilar" rel="' + product.id + '"/></td>';
        table += '<td>' + product.id + '</td>';
        table += '<td>' + product.name + '</td>';
        table += '<td>' + product.url_key + '</td>';
        table += '<td>' + product.description + '</td>';

        table += '</tr>';
    }

    table += '</tbody></table>';

    return table;
}

function updateSimilarProducts(){

    var str = 'ids=';

    $("input[name='chkassociate']").each(function(){
        var id = $(this).attr('rel');

        str = str + id + ',';
    });

    if(str.substr(str.length-1,1)==',')
        str = str.substr(0, str.length-1);

    ajaxCall('add-product-association', 'post', str, categoryGridUpdated);
}

function updateExistingSimilarProducts(){

    var str = 'ids=';

    $("input[name='chkassociated']").each(function(){
        var id = $(this).attr('rel');

        str = str + id + ',';
    });

    if(str.substr(str.length-1,1)==',')
        str = str.substr(0, str.length-1);

    ajaxCall('update-product-association', 'post', str, similarProductsUpdated);
}

function similarProductsUpdated(){

    loadSimilarProducts(1);

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
