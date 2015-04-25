$(function(){

    initializeLeftMenu();

    getCategoryTree(showTree);

    $("input[name='btncreateproduct']").click(saveProduct);

    $('#ifr').load(function(){

        $('.message').html('');

        var result = $('#ifr').contents().find('body').html();

        productAdded(result);
    });

    bindKeyEvents();
});

function bindKeyEvents(){
    $('#frmproduct').find("input").keydown(function(){
        $('.message').html('');
    });
    $('#frmproduct').find("textarea").keydown(function(){
        $('.message').html('');
    });
}

function productAdded(result){

    $('#frmproduct').find("input[type='text']").val('');
    $('#frmproduct').find("input[type='file']").val('');
    $('#frmproduct').find('textarea').val('');

    if(result=='saved')
        $('.message').html('Product created successfully');
    else
        $('.message').html('Something wrong with product data');
}

function isValidProductForm(){
    return true;
}

function saveProduct(){

    if(isValidProductForm()){

        var category_id = $('.selected-category').attr('rel');

        $('#frmproduct').attr('action', root + '/save-product');

        $("input[name='category_id']").val(category_id);

        $('.msg').html('Creating product, please wait');

        return true;
    }
    else
        return false;
}

function showTree(result){
    $('#tree').html(result);

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

        setSelectedCategoryText();

        e.stopPropagation();
    });
}

function setSelectedCategoryText(){

    var category_name = $('.selected-category').attr('name');
    var category_id = $('.selected-category').attr('rel');

    $("input[name='category_id']").val(category_id);

    var str = 'Product will be added to category : ' + category_name + " <div class='remove'>x</div>";

    $('#category_to_add').html(str).show();

    // product will not be added to any category
    $('#category_to_add .remove').click(function(){
        $('#category_to_add').html('').hide();
        $("input[name='category_id']").val('');
        $('#tree').find('li').removeClass('selected-category');
    });
}

function initializeLeftMenu(){
    $('.product-menu > a').click();
    $('.create-product > a').addClass('selected-navigation-menu');
}