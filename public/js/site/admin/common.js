function getCategoryTree(callback){
    ajaxCall(root + '/admin-category-tree','get','',callback);
}
