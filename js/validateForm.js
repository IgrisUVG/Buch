function validateForm() {
    // var x = document.forms['form']['first_name'].value;
    // if (x == null || x == '' || x.length==0) {
    //     document.getElementById('first_name').value='Заполнить';
    //     return false;
    // }
    var y = document.forms['form']['last_name'].value;
    if (y == null || y == '' || y.length==0) {
        document.getElementById('last_name').value='Заполнить';
        return false;
    }
    var z = document.forms['form']['title'].value;
    if (z == null || z == '' || z.length==0) {
        document.getElementById('title').value='Заполнить';
        return false;
    }
}