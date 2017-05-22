var xhrHtml = function (ev) {
    ev.preventDefault();
    var xhr = new XMLHttpRequest();
    var idArticle = ev.currentTarget.getAttribute('data-id');
    xhr.open('GET', 'index.php?objet=article&action=supprimer&idArticle=' + idArticle);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.responseType = 'document';
    xhr.onload = function (ev) {
        document.querySelector('.soldiersList').removeChild(document.querySelector('.soldiersList li[data-id="' + idArticle + '"]'));
    };
    xhr.send();
};

function init()
{
    clean(document);
    var deleteBtn = document.querySelectorAll('.delete-btn');
    for (var i = 0; i < deleteBtn.length; i++) {
        deleteBtn[i].addEventListener('click', xhrHtml);
    }
}

window.addEventListener('load',init);