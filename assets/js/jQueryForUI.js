
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
    //handles the contact form submitssion via a ajax request
    // $('#contactUsForm').submit(function(event){
    //     event.preventDefault();
        
    //     var formData = $(this).serialize();
    //     var url = $(this).attr('action');

    //     $.post( url, formData, function( data ) {
            
    //         $('#contactUsMessage').html(data.message);
    //         $console.log(data.message);
    //         $console.log($('#contactUsMessage'));

    //     }, "json");


    // });

    //Autocomplete for course search bar
    $( "#courseSearch" ).autocomplete({
        source: function( request, response ) {

            // Fetch data
            $.ajax({
                url: BASE_URL,
                type: 'post',
                dataType: "json",
                data: {
                    action : 'courseSearch',
                    search : request.term
                },
                success: function( data ) {
                    response( data );
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#courseSearch').val(ui.item.label); // display the selected text
            $('#courseSearch').closest("form").submit();
            
            return false;
        }
    });
    //Autocomplete for mentor search bar
    $( "#mentorSearch" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
                url: BASE_URL,
                type: 'post',
                dataType: "json",
                data: {
                    action : 'mentorSearch',
                    search : request.term
                },
                success: function( data ) {
                    response( data );
                    console.log(data);
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#mentorSearch').val(ui.item.label); // display the selected text
            $('#mentorSearch').closest("form").submit();
            
            
            return false;
        }
    });

    //Displays more mentors
    $('#view-all-mentors').click(function (e){
        // e.preventDefault();

        let icon = $(this)[0].children[0];
        $(icon).toggleClass('fa-eye fa-eye-slash')
        
        $('#more-mentors').toggleClass('d-none');
        

        if ($('#view-all-mentors-text').text() == 'View'){
            $('#view-all-mentors-text').text('Hide')
        }else{
            $('#view-all-mentors-text').text('View')
        }
    });

    //EVENT TRIGGERS BELOW ARE ARE FOR THE BACKEND UI OF THE WEBSITE

    //adds a new course outline card
    $('#add-course-card').click(function(e){
        e.preventDefault();
        var courseOutlineCard = '<div class="pd-20 mt-2 card-box shadow border rounded-0 course-outline-card">'+
                                    '<div class="row">'+
                                        '<div class="col-8">'+
                                            '<h4 class="text-blue h5">Outline Topic</h4>'+
                                        '</div>'+
                                        '<div class="col-4 d-flex justify-content-end">'+
                                            '<a href="'+BASE_URL+'index.php/?page=deleteCourseOutline&courseOutlineId=#" class="btn btn-light btn-sm remove-topic"><i class="fa fa-trash fa-lg text-danger"></i></a>'+
                                        '</div>'+
                                    '</div>'+
                                    '<hr>'+
                                    '<div class="row">'+
                                        '<div class="form-group col-12 col-md-12">'+
                                            '<label>Topic</label>'+
                                            '<input class="form-control name="course[][outline][title]" placeholder="e.g. Introduction...." value="" form-control-lg" type="text" required>'+
                                        '</div>'+
                                    '</div>'+
                                    '<span class="topic-content-container">'+
                                        '<div class="row content-list">'+
                                            '<div class="form-group col-12 col-md-12 mb-0">'+
                                                '<label>Topic Content </label> <i class="fa fa-info-circle"></i> '+
                                                '<div class="input-group">'+
                                                    '<textarea class="form-control" name="course[][outline][summary]" placeholder="This course wil help you understand...." style="height: 110px;" required></textarea>'+
                                                    '<div class="input-group-append">'+
                                                        '<button href="'+BASE_URL+'index.php/?page=removeTopicContent&contentId=#" class="btn btn-danger remove-content" type="">'+
                                                            '<i class="fa fa-trash fa-lg text-white">  '+             
                                                        '</i></button>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        
                                        '<div class="d-flex justify-content-center mb-4">'+
                                            '<a href="#" class="more-topic-content" class="btn btn-link text-primary btn-sm"><i class="fa fa-plus fa-lg m-auto"></i> Add More Content</a>'+
                                        '</div>'+
                                    '</span>'+
                                    
                                '</div>';

       
        $('#course-outline-container').append($(courseOutlineCard).hide().fadeIn(777));

        
    });
    //adds more textare fields for course topic
    $('#course-outline-container').on('click', '.more-topic-content', function(e){
        e.preventDefault();
        var contentInput = '<div class="form-group col-12 col-md-12 mb-0">'+
                                '<label>Topic Content </label>'+
                                '<div class="input-group">'+
                                    '<textarea class="form-control" name="course[][outline][summary]" placeholder="This course wil help you understand...." style="height: 110px;" required></textarea>'+
                                    '<div class="input-group-append">'+
                                        '<button href="'+BASE_URL+'index.php/?page=removeTopicContent&contentId=#" class="btn btn-danger remove-content" type=""><i class="fa fa-trash fa-lg text-white"></i></button>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
        
        // content-list
        var contentContainer = $(this).parent().parent().find('.content-list');
        console.log($(contentContainer)[0]);


        $(contentContainer).append($(contentInput).hide().fadeIn(777));
        
    });

    //removed the content title on the text area
    $('#course-outline-container').on( 'click', '.remove-content', function(e){
        e.preventDefault();

        var deleteUrl = $(this).attr('href');
        var removeCard = $(this).parent().parent().parent();

        //do a get request and on success remove the card
        $(removeCard).fadeOut(777);

    });

    // remove a course outline topic card
    $('#course-outline-container').on( 'click', '.remove-topic', function(e){
        e.preventDefault();

        var deleteUrl = $(this).attr('href');
        var removeCard = $(this).parent().parent().parent();

        console.log(deleteUrl);

        //do a get request and on success remove the card
        $(removeCard).fadeOut(777);
        


    });

});