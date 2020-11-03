/*
    This files hold the global variables that can be used throughout all the js files.
    Most of the functions here will be called in class.interface.php for those views that interact with a js plugin.
    Functions can also be called in other js files or plugins.

*/
// Constant variable
var BASE_URL;

var paginationTotalCount = 0;
var courseOutlineCardCount = 0;
var couseOutlineContentCount = 0;

// SET FUNCTIONS

function setPaginationTotalCount(num){
    paginationTotalCount = num;
}
function setCourserOutlineCardCount(num){
    courseOutlineCardCount = num;
}
function setCouseOutlineContentCount(num){
    couseOutlineContentCount = num;
}


// GET FUNCTIONS

function getCourserOutlineCardCount(){
    return courseOutlineCardCount;
}
function getCouseOutlineContentCount(){
    return couseOutlineContentCount;
}
function getPaginationTotalCount(){
    return paginationTotalCount;
}