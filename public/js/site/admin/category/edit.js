var action;

$(document).ready(function(){

    initializeLeftMenu();

    getCategoryTree(showTree);

    $('#category_image').show();

    $('#ifr').load(function(){

        $('.msg').html('');

        var result = $('#ifr').contents().find('body').html();

        categoryUpdated(result);
    });
});

function isValidCategoryForm(){
    return true;
}

function updateCategory(){

    if(isValidCategoryForm()){

        var id = $('.selected-category').attr('rel');

        $("input[name='id']").val(id);

        $('.msg').html('Updating category, please wait');

        return true;
    }
    else
        return false;
}

function categoryUpdated(result){

    if(result.indexOf('done')>-1){
        var ar = result.split(':');

        var image_name = ar[1];         //   done:abc.jpg

        $('#category_image').attr('src', root + '/public/images/categories/' + image_name);

        getCategoryTree(showTree);
    }
}

function loadCategory(id){
    var data = 'id=' + id;

    jsonCall(root + '/find-category', 'get', data, showCategoryData);
}

function showCategoryData(category){

    if(category!=null){

        $("input[name='name']").val(category.name);
        $("input[name='url_key']").val(category.url_key);
        $("textarea[name='description']").val(category.description);
        $("#category_image").show().attr('src', root + '/public/images/categories/' + category.image_saved_name);

        $("input[name='btncreatecategory']").attr('rel', 'update');
        $("input[name='btncreatecategory']").val('Update Category');
    }
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

    $('#tree li').click(function(){
        var id = $(this).attr('rel');

        loadCategory(id);
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
}

function initializeLeftMenu(){
    $('.category-menu > a').click();
    $('.manage-categories > a').addClass('selected-navigation-menu');
}