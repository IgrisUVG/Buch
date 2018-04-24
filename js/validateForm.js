function validateForm() {
    var x = document.forms["form"]["first_name"].value;
    if (x == null || x == "" || x.length==0) {
        document.getElementById("namef").innerHTML='*обязательно для заполнения';
        return false;
    }
}
