/* 
|   Docu: Home page form submission and modal loading
*/
$("#submit-registration").click(function() {
    $('#register-form').submit();
});
$("#submit-login").click(function() {
    $('#login-form').submit();
});
$("#submit-logout").click(function() {
    $('#logout-modal').modal('show');
});
if(oldHidden === "register-modal" || register_error){
    $(document).ready(function() {
        $('#registration-modal').modal('show');
    });
}
if(oldHidden === "login-modal" || registered || loginError){
    $(document).ready(function() {
        $('#login-modal').modal('show');
    });
}