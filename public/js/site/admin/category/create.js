var action;

$(document).ready(function(){

    initializeLeftMenu();

    getCategoryTree(showTree);

    $('#category_image').hide();

    $("input[name='btncreatecategory']").click(saveCategory);

    $('#ifr').load(function(){

        $('.msg').html('');

        var result = $('#ifr').contents().find('body').html();

        categoryAdded(result);
    });

    $("input[name='btncreatenew']").click(function(){
        $('#frmcategory').find("input[type='text']").val('');
        $('#frmcategory').find("input[type='file']").val('');
        $('#frmcategory').find("textarea").val('');

        $("input[name='btncreatecategory']").attr('rel', 'create');
        $("input[name='btncreatecategory']").val('Create Category');

        $('#category_image').attr('src', '');
        $('#category_image').hide();

        $('.msg').html('');
    });
});

function isValidCategoryForm(){
    return true;
}

function saveCategory(){

    if(isValidCategoryForm()){

        $("#frmcategory").attr('action', 'save-category');

        var parent_id = $('.selected-category').attr('rel');

        $("input[name='parent_id']").val(parent_id);

        $('.msg').html('Creating category, please wait');

        return true;
    }
    else
        return false;
}

function categoryAdded(result){

    $('#frmcategory').find("input[type='text']").val('');
    $('#frmcategory').find("input[type='file']").val('');
    $('#frmcategory').find('textarea').val('');

    $("input[name='btncreatecategory']").attr('rel', 'create');
    $("input[name='btncreatecategory']").val('Create Category');

    getCategoryTree(showTree);
}

function setParentCategoryText(){
    $('.sp_parent_category').text($('.selected-category').attr('name'));
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

        setParentCategoryText();

        e.stopPropagation();
    });

    $('#tree').find('li').first().addClass('selected-category');

    setParentCategoryText();
}

function initializeLeftMenu(){
    $('.category-menu > a').click();
    $('.create-category > a').addClass('selected-navigation-menu');
}