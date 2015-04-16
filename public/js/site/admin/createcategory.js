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

        action = $("input[name='btncreatecategory']").attr('rel');

        if(action=='create'){

            $("#frmcategory").attr('action', 'save-category');

            var parent_id = $('.selected-category').attr('rel');

            $("input[name='parent_id']").val(parent_id);

            $('.msg').html('Creating category, please wait');

            return true;
        }
        else if(action=='update'){

            var id = $('.selected-category').attr('rel');

            $("input[name='id']").val(id);

            $("#frmcategory").attr('action', 'update-category');

            $('.msg').html('Updating category, please wait');

            return true;
        }
    }
    else
        return false;
}

function categoryAdded(result){

    if(action=='create'){
        $('#frmcategory').find("input[type='text']").val('');
        $('#frmcategory').find("input[type='file']").val('');
        $('#frmcategory').find('textarea').val('');

        $("input[name='btncreatecategory']").attr('rel', 'create');
        $("input[name='btncreatecategory']").val('Create Category');
    }
    else if(action=='update'){

        if(result.indexOf('done')>-1){
            var ar = result.split(':');

            var image_name = ar[1];         //   done:abc.jpg

            $('#category_image').attr('src', 'public/images/categories/' + image_name);
        }
    }
}

function loadCategory(id){
    var data = 'id=' + id;

    jsonCall('find-category', 'get', data, showCategoryData);
}

function showCategoryData(category){

    if(category!=null){

        $("input[name='name']").val(category.name);
        $("input[name='url_key']").val(category.url_key);
        $("textarea[name='description']").val(category.description);
        $("#category_image").show().attr('src', 'public/images/categories/' + category.image_saved_name);

        $("input[name='btncreatecategory']").attr('rel', 'update');
        $("input[name='btncreatecategory']").val('Update Category');
    }
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
            $(this).css('background-image', "url('public/css/admin/category/child.gif')");
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
                $(this).css('background-image', "url('public/css/admin/category/open.gif')");
            else
                $(this).css('background-image', "url('public/css/admin/category/closed.gif')");
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