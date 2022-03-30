function delete_alert(e){
    if(!window.confirm('本当に削除しますか？')){
    document.getElementById('popup').style.display = 'block';
        return false;
    }
    document.deleteform.submit();
}

function okfunc() {
    document.contactform.submit();
}

function nofunc() {
    document.getElementById('popup').style.display = 'none';
}