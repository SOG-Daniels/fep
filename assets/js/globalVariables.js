/*
    This files hold the global variables that can be used throughout all the js files.
    Most of the functions here will be called in class.interface.php for those views that interact with a js plugin.
    Functions can also be called in other js files or plugins.

*/

var paginationTotalCount = 0;

// SET FUNCTIONS


function setPaginationTotalCount(num){
    paginationTotalCount = num;
}

// GET FUNCTIONS

function getPaginationTotalCount(){
    return paginationTotalCount;
}