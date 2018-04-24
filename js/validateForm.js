function validateForm() {
    var x = document.forms['form']['first_name'].value;
    if (x == null || x == '' || x.length==0) {
        document.getElementById('namef').innerHTML='*обязательно для заполнения';
        return false;
    }
    var y = document.forms['form']['last_name'].value;
    if (y == null || y == '' || y.length==0) {
        document.getElementById('namel').innerHTML='*обязательно для заполнения';
        return false;
    }
    var z = document.forms['form']['title'].value;
    if (z == null || z == '' || z.length==0) {
        document.getElementById('titel').innerHTML='*обязательно для заполнения';
        return false;
    }
}
document.getElementById('reset').onclick = function () {
    document.getElementById('namef').innerHTML = '';
    document.getElementById('namel').innerHTML = '';
    document.getElementById('titel').innerHTML = '';
};