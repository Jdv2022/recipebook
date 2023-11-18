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
$(".upload-recipe-button").click(function () {
    const dataSubValue = $(this).attr('data-sub');
    $('#hidden-sub-pics').attr('value', dataSubValue)
    $('#edit-sub-recipe-modal').modal('show');
});