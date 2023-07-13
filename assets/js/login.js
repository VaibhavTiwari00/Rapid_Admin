function validate_login() {
    let mail = $("#user-email");
    let pass = $("#user-password");

    if (mail.val() != "") {
        if (pass.val() != "") {
            return true;
        } else {
            toast.error('Please enter your password');
            return false;

        }
    } else {
        toast.error('Please enter your email address');
        return false;
    }
}