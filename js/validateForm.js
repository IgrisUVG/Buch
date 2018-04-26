function validateForm() {
    var x = document.forms['form']['title'].value;
    if (x == null || x == '' || x.length == 0) {
        document.getElementById('title').placeholder = 'Заполните это поле';
        // document.getElementById('title').style.color = 'red';
        // document.getElementById('submit').style.pointerEvents = none;
        return false;
    }
}
document.getElementById('reset').onclick = function () {
    document.getElementById('title').placeholder = '';
};