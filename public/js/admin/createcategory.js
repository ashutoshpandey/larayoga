/*
$(function() {
    // Find list items representing folders and
    // style them accordingly.  Also, turn them
    // into links that can expand/collapse the
    // tree leaf.
    $('ul#tree li > ul').each(function(i) {
        // Find this list's parent list item.
        var parent_li = $(this).parent('li');

        // Style the list item as folder.
        parent_li.addClass('folder');

        // Temporarily remove the list from the
        // parent list item, wrap the remaining
        // text in an anchor, then reattach it.
        var sub_ul = $(this).remove();
        parent_li.wrapInner('<a/>').find('a').click(function() {
            // Make the anchor toggle the leaf display.
            sub_ul.toggle();
        });
        parent_li.append(sub_ul);
    });

    // Hide all lists except the outermost.
    $('ul#tree ul').hide();
});
*/

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
