$(document).ready(function () {
    $("#brandButton").click(function () {
        $("#brand-plus").toggle();
        $("#brand-cross").toggle();
        $("#filter-brand-mobile").toggle();
    });
    $("#categoryButton").click(function () {
        $("#category-plus").toggle();
        $("#category-cross").toggle();
        $("#filter-category-mobile").toggle();
    });
});