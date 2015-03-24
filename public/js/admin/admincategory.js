function createCategory(){
    ajaxCall('create-category', 'get', '', createCategoryNow);
}

function createCategoryNow(result){

    $("button[name='createcategory']").click(saveCategory);
}

function isValidCategoryForm(){

}

function saveCategory(){

    if(isValidCategoryForm()){

        var formData = $(".frmcategoryupdate").serialize();

        ajaxCall('save-category', 'post', formData, categoryAdded);
    }
}

function categoryAdded(result){

}

function editCategory(id){

    var data = 'id=' + id;

    jsonCall('find-category', 'get', data, editCategoryNow);
}

function editCategoryNow(result){

    $("button[name='updatecategory']").click(updateCategory);
}

// for removing single category
function removeCategory(id){

    var data = 'id=' + id;

    ajaxCall('remove-category', 'get', data, categoryRemoved);
}

// remove single category result
function categoryRemoved(result){

    if(result=="removed"){

    }
    else if(result=="not found"){

    }
    else if(result=="invalid"){

    }
    else{

    }
}

// for removing category when displayed in list
function removeCategoryFromList(categoryId){

    var data = 'id=' + id;

    ajaxCall('remove-category', 'get', data, categoryRemoved);
}

// for removing category when displayed in list
function categoryRemovedFromList(result){
    loadCategorysFromCategory(currentCategoryId);
}

function updateCategory(){

    if(isValidCategoryForm()){

        var formData = $(".frmcategoryupdate").serialize();

        ajaxCall('update-category', 'post', formData, categoryUpdated);
    }
}

function categoryUpdated(result){

}

function loadChildCategories(id, page){

    var data = 'id=' + id + '&page=' + page;

    jsonCall('category-categorys', 'get', data, categoryCategorysLoaded);
}

function childCategoriesLoaded(result){

    if(result!=undefined && result.length>0){

        $(".category-list").html("");

        for(var i=0;i<result.length;i++){
            var category = result[i];

            // show categorys in grid
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