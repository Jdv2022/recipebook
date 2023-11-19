/* 
| Edits modals
*/
if(oldHidden === "edit-title-modal"){
    $(document).ready(function() {
        $('#edit-title-recipe-modal').modal('show');
    });
}
if(oldHidden === "edit-description-modal"){
    $(document).ready(function() {
        $('#edit-description-recipe-modal').modal('show');
    });
}
if(oldHidden === "edit-otherDetails-modal"){
    $(document).ready(function() {
        $('#edit-otherDetails-recipe-modal').modal('show');
    });
}
if(oldHidden === "edit-ingredients-modal"){
    $(document).ready(function() {
        $('#edit-ingredients-recipe-modal').modal('show');
    });
}
if(oldHidden === "edit-method-modal"){
    $(document).ready(function() {
        $('#edit-method-recipe-modal').modal('show');
    });
}
if(oldHidden === "main_recipeImg_modal"){
    $(document).ready(function() {
        $('#edit-mainImg-recipe-modal').modal('show');
    });
}
if(oldHidden === "main_sub_modal"){
    $(document).ready(function() {
        $('#edit-sub-recipe-modal').modal('show');
    });
}
/* 
|   This is for sub-images in recipe/ passes the original url to the modal . this is important
*/
$(".subs").click(function () {
    console.log('dataSubValue')
    const dataSubValue = $(this).attr('data-sub');
    $('#hidden-sub-pics').attr('value', dataSubValue)
    $('#edit-sub-recipe-modal').modal('show');
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