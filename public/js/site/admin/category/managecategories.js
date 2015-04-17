var currentCategoryId;          // for displaying categories from categories

$(function(){

   getCategoryTree(showTree);

   loadCategories(1, -1);
});

function loadCategories(page, parent){

    var data = 'page=1&count=20&parent_id=' + parent;

    jsonCall('load-categories', 'get', data, categoriesLoaded);
}

function categoriesLoaded(categories){

    $("#categorylist").html("");

    if(categories!=undefined && categories.length>0){

        $('#categorylist').WATable({
            filter: true,
            data: generateCategoryGrid(categories),
            pageSizes: [20,50,100]  //Set custom pageSizes. Leave empty array to hide button.
        });

        var update_grid_button = "<input type='button' name='btn_update_grid' value='Update Grid'/>";
        var update_grid_message = "<span class='update_grid message'></span>";

        $('#categorylist').append(update_grid_button);

        $("input[name='btn_update_grid']").click(updateCategoryGrid);

        $(".lnkremove").click(function(){
            var id = $(this).attr('rel');

            if(confirm("Are you sure to remove this category?"))
                removeCategory(id);
        });
    }
    else
        $("#categorylist").html("<h3 class='nocategories'>No categories available</h3>");
}

function updateCategoryGrid(){

    var str = 'category_sort_data=';

    $("input[name='sort_order']").each(function(){
        var category_id = $(this).attr('rel');
        var sort_order = $(this).val();

        str = str + category_id + ':' + sort_order + ',';
    });

    if(str.substr(str.length-1,1)==',')
        str = str.substr(0, str.length-1);

    ajaxCall('update-category-grid-order', 'get', str, categoryGridUpdated);
}

function categoryGridUpdated(result){

}

function generateCategoryGrid(categories){

    var cols = {
        Name: {
            index: 1,
            sortOrder: "asc",
            tooltip: "Name of category"
        },
        Url_Key: {
            index: 2,
            sortOrder: "asc",
            tooltip: "URL Key"
        },
        Description: {
            index: 3,
            sortOrder: "asc",
            tooltip: "Description"
        },
        BelongsTo: {
            index: 4,
            sortOrder: "asc",
            tooltip: "Belongs to"
        },
        Sort_Order: {
            index: 5
        },
        Action: {
            index: 6
        }
    };

    var rows = [];

    for(var i=0; i< categories.length; i++){

        var row = {};

        var category = categories[i];

        row.Name = category.name;
        row.Url_Key = category.url_key;
        row.Description = category.description;
        row.BelongsTo = category.parent_id;
        row.Sort_Order = "<input type='text' name='sort_order' rel='" + category.id + "' class='sort_order' maxlength='2' value='" + category.sort_order + "'/>";
        row.Action = "<a href='edit-category/" + category.id + "'>Edit</a> &nbsp;&nbsp; <span class='lnkremove' rel='" + category.id + "'>Remove</span>";

        rows.push(row);
    }

    var data = {
        cols: cols,
        rows: rows
    };

    return data;
}

// for removing single category
function removeCategory(id){

    var data = 'id=' + id;

    ajaxCall('remove-category', 'get', data, categoryRemoved);
}

// remove single category result
function categoryRemoved(result){

    if(result=="removed"){

        var parent_id = $(".selected-category").attr('rel');

        getCategoryTree(showTree);

        loadCategories(1, parent_id);
    }
    else if(result=="not found"){

    }
    else if(result=="invalid"){

    }
    else{

    }
}

function loadCategoriesFromCategory(id, page){

    var data = 'id=' + id + '&page=' + page;

    jsonCall('category-categories', 'get', data, categoryCategoriesLoaded);
}

function categoryCategoriesLoaded(result){

    if(result!=undefined && result.length>0){

        $(".category-list").html("");

        for(var i=0;i<result.length;i++){
            var category = result[i];

            // show categories in grid
        }

        $(".remove-category").click(function(){
            var id = $(this).attr('rel');
            removeCategory(id);
        });

        $(".edit-category").click(function(){
            var id = $(this).attr('rel');
            editCategory(id);
        });
    }
}

function showTree(tree){

    $('#tree').html(tree);

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

        loadCategories(1, id);
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

        e.stopPropagation();
    });

    $('#tree').find('li').first().addClass('selected-category');
}
