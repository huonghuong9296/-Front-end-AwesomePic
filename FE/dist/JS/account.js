function showPassword() {
    var checkbox = document.getElementById("checkbox-password");
    var oldpassword = document.getElementById("oldpassword");
    var newpassword = document.getElementById("newpassword");
    var reenter = document.getElementById("re-enter");
    if (checkbox.checked == true) {
        oldpassword.style.display = "flex";
        newpassword.style.display = "flex";
        reenter.style.display = "flex";
    } else {
        oldpassword.style.display = "none";
        newpassword.style.display = "none";
        reenter.style.display = "none";
    }
}

