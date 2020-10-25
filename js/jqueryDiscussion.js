/*
    Handles all UI interactions for:
    -   viewing replies
    -   liking or disliking a forum or post
    -   writing a reply to a post or forum topic

*/

$(document).ready(function(){

    // Hides or Views replies on discussion card
    $('.view-replies').click(function(e){

        var replies = $(this).closest('span.discussion').find('div.reply-content');
        var replyDisplayText = $(this).find('span');

        if ($(replyDisplayText[0]).text() == 'View'){
            //display replies
            $(replies[0]).show();
            $(replyDisplayText[0]).text('Hide');

        }else{
            //hide replies
            $(replyDisplayText[0]).text('View');
            $(replies[0]).hide();
        }
    });

    //Like button on discussion UI
    $('.like').click(function(e){

        var likeCount = $(this).find('span').text();
        var dislike = $(this).parent().children()[1];

        if ($(dislike).hasClass('fa-thumbs-down')){
            //Unselect dislike
            var dislikeCount = $(dislike).find('span').text();
            
            $(dislike).toggleClass('fa-thumbs-down fa-thumbs-o-down');
            // $(dislike).toggleClass('fa-thumbs-o-down');
            $(dislike).find('span').text(--dislikeCount);

            console.log('thumb down is selected');
        }

        if ($(this).hasClass('fa-thumbs-o-up')){
            // Like the reply
            $(this).toggleClass('fa-thumbs-o-up fa-thumbs-up ');
            // $(this).toggleClass('fa-thumbs-up');
            $(this).find('span').text(++likeCount);


        }else{
            // remove like from reply
            $(this).toggleClass('fa-thumbs-up', false);
            $(this).toggleClass('fa-thumbs-o-up');
            $(this).find('span').text(--likeCount);
        }
        
    });
    //Dislike button on dicussion UI
    $('.dislike').click(function(e){

        var dislikeCount = $(this).find('span').text();
        var like = $(this).parent().children()[0];

        if ($(like).hasClass('fa-thumbs-up')){
            //Unselect dislike
            var likeCount = $(like).find('span').text();
            
            $(like).toggleClass('fa-thumbs-up fa-thumbs-o-up');
            // $(like).toggleClass('fa-thumbs-o-up');
            $(like).find('span').text(--likeCount);
        
        }

        if ($(this).hasClass('fa-thumbs-o-down')){
            // Like the reply
            $(this).toggleClass('fa-thumbs-o-down fa-thumbs-down');
            // $(this).toggleClass('fa-thumbs-down');
            $(this).find('span').text(++dislikeCount);


        }else{
            // remove like from reply
            $(this).toggleClass('fa-thumbs-down fa-thumbs-o-down');
            // $(this).toggleClass('fa-thumbs-o-down');
            $(this).find('span').text(--dislikeCount);
        }
        
    });
    $('.reply-to-forum').on('click', function(e){

        var replyInput = $(this).closest('span.discussion').find('div.reply-input');
        

        if ($(replyInput[0]).hasClass('d-none')){
            //Display Reply Input
            $(replyInput[0]).toggleClass('d-none d-block');
        }else{
            //Hide Reply Input
            $(replyInput[0]).toggleClass('d-block d-none');
        }
        

    });

    $('.cancel-form-reply').on('click', function (e){
        e.preventDefault();

        var replyInput = $(this).parent().parent().parent().parent();
        $(replyInput[0]).toggleClass('d-block d-none');

        // console.log(replyInput[0]);
        var replyField = $(replyInput[0]).find('.post-reply');
        console.log($(replyField[0]).val(''));

        // $(replyInput).hide();


    });

});