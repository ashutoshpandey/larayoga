$(document).ready(function(){

    initializeLeftMenu();

    getCategoryTree(showTree);

    $("input[name='btncreateproduct']").click(saveProduct);

    $('#ifr').load(function(){

        $('.msg').html('');

        var result = $('#ifr').contents().find('body').html();

        productAdded(result);
    });
});

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

function productAdded(result){

    $('#frmproduct').find("input[type='text']").val('');
    $('#frmproduct').find("input[type='file']").val('');
    $('#frmproduct').find('textarea').val('');
}

function setSelectedCategoryText(){
    $('.sp_parent_product').text($('.selected-product').attr('name'));
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
        $('#tree').find('li').removeClass('selected-product');

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

    $('#tree').find('li').first().addClass('selected-category');

    setSelectedCategoryText();
}

function initializeLeftMenu(){
    $('.product-menu > a').click();
    $('.create-product > a').addClass('selected-navigation-menu');
}