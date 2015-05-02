$(function(){

    initializeLeftMenu();

    initTab();

    loadPackageProducts(1);

    loadProducts(1);
});

function initializeLeftMenu(){
    $('.product-menu > a').click();
    $('.package-products > a').addClass('selected-navigation-menu');
}

function loadProducts(page){

    var category_id = -1;

    if($('.selected-category').length>0)
        category_id = $('.selected-category').attr('rel');

    var status = $("input[name='active_filter']:checked").val();

    var data = 'page=1&count=20&category_id=' + category_id + '&status=' + status;

    jsonCall(root + '/load-products-for-package', 'get', data, productsLoaded);
}

function productsLoaded(products){

    $("#productlist").html("");

    if(products!=undefined && products.length>0){

        var productTable = getProductTable(products);

        $("#productlist").html('<h4>Tick products to add them to package</h4>');

        $("#productlist").append(productTable);

        $("#productlist").append("<div class='product_display_area'></div>");

        $("#productlist").append("<input type='button' name='btnAddProductsToPackage' value='Add products to package'/>");

        $("input[name='btnAddProductsToPackage']").click(addProductsToPackage);

        $("input[name='btnAddProductsToPackage']").hide();

        $("#table_products").dataTable();

        $("input[name='chkproduct']").click(function(){
            var id = $(this).attr('rel');
            var selected = $(this).is(':checked');

            updateProductDisplay(id, selected);
        });
    }
    else
        $("#productlist").html("<h3 class='noproducts'>No products available</h3>");
}

function updateProductDisplay(id, selected){

    if(selected){

        ajaxCall(root + '/find-product/' + id, 'get', null, showProductInDisplayArea);
    }
    else{
        $('.product_display_area').find('.product_' + id).remove();

        if($('.product_display_area').children().length==0)
            $("input[name='btnAddProductsToPackage']").hide();
    }
}

function showProductInDisplayArea(product){

    if(product!=undefined){

        var str = "<div class='product_box product_" + product.id + "' rel='" + product.id + "'>";
        str = str + product.name;
        str = str + "</div>";

        $('.product_display_area').append(str);

        $("input[name='btnAddProductsToPackage']").show();
    }
}

function addProductsToPackage(){

    var str = 'ids=';

    $('.product_display_area').find('.product_box').each(function(){
        var id = $(this).attr('rel');

        str = str + id + ',';
    });

    if(str.substr(str.length-1,1)==',')
        str = str.substr(0, str.length-1);

    ajaxCall(root + '/add-products-to-package', 'post', str, productsAddedToPackage);
}

function productsAddedToPackage(){

    $("input[name='btnAddProductsToPackage']").hide();

    $('.product_display_area').html('');

    loadProducts(1);

    loadPackageProducts(1);
}

function loadPackageProducts(page){

    var data = 'page=1&count=20';

    jsonCall(root + '/load-package-products', 'get', data, packageProductsLoaded);
}

function packageProductsLoaded(products){

    $("#packageproductlist").html("");

    if(products!=undefined && products.length>0){

        var productTable = getPackageProductTable(products);

        $("#packageproductlist").html('<h4>Tick products to create a package</h4>');

        $("#packageproductlist").append(productTable);

        $("#table_package_products").dataTable();

        $("#packageproductlist").append("<input type='button' name='btnRemovePackageProducts' value='Remove products from package'/>");

        $("input[name='btnRemovePackageProducts']").click(removePackageProducts);

        $("input[name='btnRemovePackageProducts']").hide();
        
        $(".remove_package_product").click(function(){
            var id = $(this).attr('rel');
            removePackageProduct(id);
        });

        $("input[name='chkpackageproduct']").click(function(){

            var selected_checkboxes = $("input[name='chkpackageproduct']:checked").length;

            if(selected_checkboxes>0)
                $("input[name='btnRemovePackageProducts']").show();
            else
                $("input[name='btnRemovePackageProducts']").hide();
        });

    }
    else
        $("#packageproductlist").html("<h3 class='noproducts'>No products available</h3>");
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

function getPackageProductTable(packages){

    var table = '<table id="table_package_products"><thead>';

    table += '<tr>';

    table += '<td></td>';
    table += '<td>Name</td>';
    table += '<td>Description</td>';
    table += '<td>Action</td>';

    table += '</tr>';

    table += '</thead><tbody>';

    for(var i=0; i< packages.length; i++){

        table += '<tr>';

        var packageObj = packages[i];

        table += '<td><input type="checkbox" name="chkpackageproduct" rel="' + packageObj.id + '"/></td>';
        table += '<td>' + packageObj.product.name + '</td>';
        table += '<td>' + packageObj.product.description + '</td>';
        table += "<td><span class='link remove_package_product' rel='" + packageObj.id + "'>Remove</span></td>";

        table += '</tr>';
    }

    table += '</tbody></table>';

    return table;
}

function removePackageProduct(id){

    ajaxCall(root + '/remove-package-product/' + id, 'get', '', packageProductRemoved);
}

function packageProductRemoved(){

    loadPackageProducts(1);

    loadProducts(1);
}

function removePackageProducts(){

    var str = 'ids=';

    $("input[name='chkpackageproduct']:checked").each(function(){
        var id = $(this).attr('rel');

        str = str + id + ',';
    });

    if(str.substr(str.length-1,1)==',')
        str = str.substr(0, str.length-1);

    ajaxCall(root + '/remove-package-products', 'post', str, packageProductsRemoved);
}

function packageProductsRemoved(){

    loadPackageProducts(1);

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