var displayFormFilter = function (ev) {
    document.querySelector('.add-filter').style.display = 'none';
    document.querySelector('.form-filter').style.display = 'block';
}

var changeFilterOption = function (ev) {
    var valueSelected = ev.currentTarget.options[ev.currentTarget.selectedIndex].value;
    if (valueSelected == 'promotion') {
        document.querySelector('.filter-retire').className += " hide";
        document.querySelector('.filter-promotion').classList.remove("hide");
    } else if (valueSelected == 'retire') {
        document.querySelector('.filter-promotion').className += " hide";
        document.querySelector('.filter-retire').classList.remove("hide");
    }
}

var applyFilters = function (ev) {
    var valueFilter1 = document.querySelector('.filter-1').options[document.querySelector('.filter-1').selectedIndex].value;
    var valueFilter2 = document.querySelector('.filter:not(.hide) .filter-2').options[document.querySelector('.filter:not(.hide) .filter-2').selectedIndex].value;
    console.log(valueFilter1 + valueFilter2);
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'index.php?object=soldier&action=displayListWithFilters&filter=' + valueFilter1 + '&value=' + valueFilter2);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.responseType = 'document';
    xhr.onload = function (ev) {
    };
    xhr.send();
}

function init()
{
    clean(document);
    var addFilterBtn = document.querySelector('.add-filter');
    addFilterBtn.addEventListener('click', displayFormFilter);
    var filter1 = document.querySelector('.filter-1');
    filter1.addEventListener('change', changeFilterOption);
    var filterActionBtn = document.querySelector('.btn-filter-action');
    filterActionBtn.addEventListener('click', applyFilters);
}

window.addEventListener('load',init);
