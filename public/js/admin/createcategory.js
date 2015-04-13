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

    $('#tree').find('li').first().addClass('selected-category');
});

function isValidCategoryForm(){
    return true;
}

function saveCategory(){

    if(isValidCategoryForm()){

        var category = $('.selected-category').attr('rel');

        $("input[name='category']").val(category);
        alert(category);
        return;

        var formData = $(".frmcreatecategory").serialize();

        ajaxCall('save-category', 'post', formData, categoryAdded);
    }
}

function categoryAdded(result){

}
