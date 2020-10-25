//checking if new pass and confirm pass are the same text entered
function checkPasswordMatch() {
    
    console.log('test');
    //$('#submit-button').prop('disabled', true);
    var decimal =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,16}$/;//rules that govern what is required of a password
    var password = $("#newPass").val();
    var confirmPassword = $("#confirmPass").val();

    if (password != confirmPassword && confirmPassword != ''){
     
        $('#change-pass-btn').prop('disabled', true);
        $("#divCheckPasswordMatch").html('<span class="text-danger">Passwords do not match!</span>');
    
    }else if(password == '' || confirmPassword == ''){

        $("#divCheckPasswordMatch").html(" ");
        $("#passRequirement").html(" ");
        $('#change-pass-btn').prop('disabled', true);
    
    }else{
        
        $("#divCheckPasswordMatch").html('<span class="text-success">Passwords match.</span>');
        
        if (password.match(decimal)){

            $("#passRequirement").html(" ");
            $('#change-pass-btn').prop('disabled', false);

        }else{

            $("#passRequirement").html('<span class="text-danger">Please meet the requirement stated above!</span>');

        }
    }
}

$(document).ready(function(e){

    //gets the profile image that is being uplaoded
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar-photo').attr('src', e.target.result);
            }
            
            // Displays the delete icon
            $('#remove-profile-pic').addClass('d-block');
    
            //Displays the delete icon
            $('#remove-course-pic').addClass('d-block');

            reader.readAsDataURL(input.files[0]);
        }
    }   


    // Used for change password in profile tab
    $("#newPass, #confirmPass").keyup(checkPasswordMatch);


    //script below are for image profile upload and removal

    //sends a ajax request to upload selected image
    $('#upload-profile-pic').on('click', function(e){

        e.preventDefault();
        $('#profile-pic-upload').click();

    });

    //Gets the image uplaoded and sends an ajax request to uplaod image as profile pic
    $("#profile-pic-upload").on('change', function(){
        readURL(this);
        var data = new FormData(document.getElementById("upload-img-form-2"));
        
        console.log(data);
        //sends a request to the change_profile_pic() function in the user controller
        // to change the users profile pic
        // $.ajax({
        //     url: base_url+'update-profile-picture',  
        //     type: 'POST',
        //     data: data,
        //     success:function(data){
        //         // location.reload(true);//reloading the current page from server not from cache
        //         location.reload(true);//reloading current page from server and not from cache
        //         console.log(data);
        //         alert(data);
        //     },
        //     cache: false,
        //     contentType: false,
        //     processData: false
        // });
    });

    //Gets the image uplaoded and displays it to the viewer 
    $("#course-pic-upload").on('change', function(){
        readURL(this);
        // var data = new FormData(document.getElementById("upload-img-form-2"));
        
       
    });
    //sends an ajax request to remove profile pic
    $('#remove-profile-pic').on('click', function(e){

        $('.avatar-photo').attr('src',BASE_URL+'img/profileImg/default-profile-pic.png');
        $(this).removeClass('d-block')

    });

    $('#request-course').on('click', function (e){

        $('#request-course-addition-modal').modal('hide');
        $('#success-modal').modal('show');

    });

    //NO LONGER IN USER SINCE ADD COURSE IS NOW A FORM I ITS OWN VIEW AND NOT A MODAL
    $('#add-course').on('click', function (e){

        $('#add-course-modal').modal('hide');
        $('#success-modal').modal('show');

    });

});

