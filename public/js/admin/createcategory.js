$(document).ready(function(){

    $("input[name='btncreatecategory']").click(saveCategory);

    // fix: removing extra 'ul'
    $('#tree').find('ul').each(function(){
        if($(this).children().length==0)
            $(this).remove();
        else
            $(this).addClass('folder');
    });

    $('.folder > li').click(function(e){
        $('#tree').find('li').removeClass('selected-category');

        if($(this).find('ul').length>0){
            $(this).find(">:first-child").toggle();
        }

        $(this).removeClass('non-selected-category');
        $(this).addClass('selected-category');
        $(this).children().addClass('non-selected-category');

        e.stopPropagation();
    });

    $('#tree li').click(function(){
        var id = $(this).attr('rel');

        loadCategory(id);
    });

    $('#tree').find('li').first().addClass('selected-category');

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

        $('.msg').html('');
    });
});

function isValidCategoryForm(){
    return true;
}

function saveCategory(){

    if(isValidCategoryForm()){

        var action = $("input[name='btncreatecategory']").attr('rel');

        if(action=='create'){

            $("#frmcategory").attr('action', 'save-category');

            var parent_id = $('.selected-category').attr('rel');

            $("input[name='parent_id']").val(parent_id);

            $('.msg').html('Creating category, please wait');

            return true;
        }
        else if(action=='update'){

            $("#frmcategory").attr('action', 'update-category');

            $('.msg').html('Updating category, please wait');

            return true;
        }
    }
    else
        return false;
}

function categoryAdded(result){
    $('#frmcategory').find("input[type='text']").val('');
    $('#frmcategory').find("input[type='file']").val('');
    $('#frmcategory').find("textarea").val('');

    $("input[name='btncreatecategory']").attr('rel', 'create');
    $("input[name='btncreatecategory']").val('Create Category');
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