
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

});