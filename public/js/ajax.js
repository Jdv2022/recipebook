 /* 
|   Docu: AJAX for comment and replies section
*/
$.ajax({
    type: 'GET',
    url: ajaxReview, 
    success: function(response) {
        $('#comments-container').html(response);
    },
});
$('#comments-form').submit(function(e) {
    e.preventDefault(); 
    const formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: commentsCreate, 
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(response) {
            console.log(response)
            $('#comment-input').val('');
            $('#comments-container').html(response);
        },
    });
});
$('#comments-container').on('submit','#reply-form',function(e) {
    e.preventDefault(); 
    const formData = $(this).serialize();
    $.ajax({
        type: 'POST',
        url: repliesCreate, 
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function(response) {
            console.log(response)
            $('#comment-reply').val('');
            $('#comments-container').html(response);
        },
    });
});
/* 
|   Star Review
*/
$.ajax({
    type: 'GET',
    url: ajaxRating, 
    success: function(response) {
        $('#ratings-container').html(response);
    },
});
$('.star').click(function(e) {
    $('.star').css('background-color', 'white');
    $('.star').attr('data-check', "false");
    $(this).attr('data-check', "true");
    const dataIdValue = $(this).attr('data-value') - 1;
    $('.star').each(function(index, element) {
        if (index <= dataIdValue) {
            $(element).css('background-color', 'orange');
        }
    });
});
$('.close-rating').click(function(){
    $('.star').css('background-color', 'white');
})
$('#submit-rating').click(function(event){
    $('.star').each(function(index, element) {
        if($(element).attr('data-check') === "true"){
            recipe_id = $(element).attr('data-recipe-id')
            rating = $(element).attr('data-value')
            $('.close-rating').click()
            $.ajax({
                type: 'POST',
                url: ratingCreate, 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {'recipe_id' : recipe_id, 'rating' : rating},
                success: function(response) {
                    $('#ratings-container').html(response);
                },
            }); 
        }
    });
}); 
/* 
|   This for image in preview. HOVER effect
*/
const imgRecipeURL = $("#prev-main-img").attr('src');
$(".recipe-imgs").mouseover(function () {
    $(this).css('opacity', '.5');
    $("#prev-main-img").attr("src", $(this).attr('src'));
});
$(".recipe-imgs").mouseout(function () {
    $(this).css('opacity', '1');
    $("#prev-main-img").attr("src", imgRecipeURL);
});