$(function(){

    initializeLeftMenu();
});

function initializeLeftMenu(){
    $('.product-menu > a').click();
    $('.similar-products > a').addClass('selected-navigation-menu');
}