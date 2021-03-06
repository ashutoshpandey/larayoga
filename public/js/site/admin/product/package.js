$(function(){

    initializeLeftMenu();

    initTab();

    loadPackages(1);

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

    jsonCall(root + '/load-products', 'get', data, productsLoaded);
}

function productsLoaded(products){

    $("#productlist").html("");

    if(products!=undefined && products.length>0){

        var productTable = getProductTable(products);

        $("#productlist").html('<h4>Tick products to create a package</h4>');

        $("#productlist").append(productTable);

        $("#table_products").dataTable();

        $("#productlist").append("<div class='product_display_area'></div>");

        $("#productlist").append("<div class='package_name'>Name : <input type='text' name='name'/></div>");
        $("#productlist").append("<div class='package_description'>Description : <textarea name='description' rows='4'></textarea></div>");
        $("#productlist").append("<input type='button' name='btncreatepackage' value='Create package'/>");

        $("input[name='btncreatepackage']").hide();
        $(".package_name").hide();
        $(".package_description").hide();

        $("input[name='btncreatepackage']").click(createPackage);

        $("input[name='chkproduct']").click(function(){
            var id = $(this).attr('rel');
            var selected = $(this).is(':checked');

            updateProductDisplay(id, selected);
        });
    }
    else
        $("#productlist").html("<h3 class='noproducts'>No products available</h3>");
}

function createPackage(){

    var str = 'ids=';

    $('.product_display_area').find('.product_box').each(function(){
        var id = $(this).attr('rel');

        str = str + id + ',';
    });

    if(str.substr(str.length-1,1)==',')
        str = str.substr(0, str.length-1);

    var name = $("input[name='name']").val();
    var description = $("textarea[name='description']").val();

    str = str + '&name=' + name + '&description=' + description;

    ajaxCall(root + '/create-package', 'post', str, packageCreated);
}

function packageCreated(result){
    loadPackages(1);
}

function updateProductDisplay(id, selected){

    if(selected){

        ajaxCall(root + '/find-product/' + id, 'get', null, showProductInDisplayArea);
    }
    else{
        $('.product_display_area').find('.product_' + id).remove();

        if($('.product_display_area').children().length==0)
            $("input[name='btncreatepackage']").hide();
    }
}

function showProductInDisplayArea(product){

    if(product!=undefined){

        var str = "<div class='product_box product_" + product.id + "' rel='" + product.id + "'>";
        str = str + product.name;
        str = str + "</div>";

        $('.product_display_area').append(str);

        $("input[name='btncreatepackage']").show();
        $(".package_name").show();
        $(".package_description").show();
    }
}

function loadPackages(page){

    var data = 'page=1&count=20';

    jsonCall(root + '/load-packages', 'get', data, packagesLoaded);
}

function packagesLoaded(packages){

    $("#packagelist").html("");

    if(packages!=undefined && packages.length>0){

        var packageTable = getPackageTable(packages);

        $("#packagelist").append('<h4>Existing packages</h4>');

        $("#packagelist").append(packageTable);

        $("#table_packages").dataTable();

        var str = '<input type="button" name="btnRemovePackages" value="Remove packages"/>';

        $("#packagelist").append(str);

        $("input[name='btnRemovePackages']").click(removeExistingPackages);

        $(".remove_package").click(function(){

            var id = $(this).attr('rel');

            removePackage(id);
        });
    }
    else
        $("#packagelist").html("<h3 class='noproducts'>No packages created</h3>");
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

function getPackageTable(packages){

    var table = '<table id="table_packages"><thead>';

    table += '<tr>';

    table += '<td></td>';
    table += '<td>Id</td>';
    table += '<td>Name</td>';
    table += '<td>Description</td>';
    table += '<td>Action</td>';

    table += '</tr>';

    table += '</thead><tbody>';

    for(var i=0; i< packages.length; i++){

        table += '<tr>';

        var packageObj = packages[i];

        table += '<td><input type="checkbox" name="chkpackage" rel="' + packageObj.id + '"/></td>';
        table += '<td>' + packageObj.id + '</td>';
        table += '<td>' + packageObj.name + '</td>';
        table += '<td>' + packageObj.description + '</td>';
        table += "<td><a href='" + root + "/edit-package/" + packageObj.id + "'>Edit</a> &nbsp;&nbsp; <span class='link remove_package' rel='" + packageObj.id + "'>Remove</span></td>";

        table += '</tr>';
    }

    table += '</tbody></table>';

    return table;
}

function removePackage(id){

    var str = 'id=' + id;

    ajaxCall(root + '/remove-package', 'post', str, packageRemoved);
}

function packageRemoved(){
    loadPackages(1);
}

function removeExistingPackages(){

    var str = 'ids=';

    $("input[name='chkpackage']:checked").each(function(){
        var id = $(this).attr('rel');

        str = str + id + ',';
    });

    if(str.substr(str.length-1,1)==',')
        str = str.substr(0, str.length-1);

    ajaxCall(root + '/update-packages', 'post', str, packagesUpdated);
}

function packagesUpdated(){

    loadPackages(1);

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