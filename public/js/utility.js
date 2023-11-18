/* 
|   For long texts see more
*/
$('.truncate-text').each(function(){
    const text = $(this).text();
    if(text.length > 220){
        $(this).text(text.substring(0, 220) + ' ' + '...');
    }
})