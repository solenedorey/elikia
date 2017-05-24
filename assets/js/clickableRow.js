var doAction = function (ev) {
    var url = ev.currentTarget.getAttribute('data-url');
    window.location.href = url;
};

function init()
{
    clean(document);
    var clickableRow = document.querySelectorAll('.clickable-row');
    for (var i = 0; i < clickableRow.length; i++) {
        clickableRow[i].addEventListener('click', doAction);
    }
}

window.addEventListener('load',init);
