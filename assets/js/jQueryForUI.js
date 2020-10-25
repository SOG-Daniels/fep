
$(document).ready(function (){

    //shows and hides password
    $('.show-pass').click(function (e){
        e.preventDefault();
        
        var eye = $(this)[0].children[0];
        var input = $(this).parent().parent()[0].children[1];

        if($(eye).hasClass('fa-eye')){
            // view password
            $(eye).removeClass('fa-eye');
            $(eye).addClass('fa-eye-slash');

            $(input).attr('type', 'text');
        }else{
            //hide password
            $(eye).removeClass('fa-eye-slash');
            $(eye).addClass('fa-eye');
            
            $(input).attr('type', 'password');
        }

    })
    
  
});