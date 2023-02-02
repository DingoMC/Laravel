// Ładowanie stopki
function setFooterContent () {
    let footerHTML = '';
    fetch('/json/footer.json')
    .then(response => response.json())
    .then(data => {
        for (let i = 0; i < data.footer.length; i++) {
            footerHTML += '<span>' + data.footer[i] + '</span>';
        }
        $('footer')[0].innerHTML = footerHTML;
    })
    .catch(console.error);
}
// Ładowanie nawigacji
function setNavContent () {
    fetch('/json/navlinks.json')
    .then(response => response.json())
    .then(data => {
        let innerHTML = '';
        for (let i = 0; i < data.links.length; i++) {
            innerHTML += '<li class="nav-item"><a class="nav-link" href="' + data.links[i].href + '">' + data.links[i].title + '</a></li>';
        }
        $('#navlinks')[0].innerHTML = innerHTML;
    })
    .catch(console.error);
}
// Ładowanie listy kursów (kursy)
function setCourseList () {
    fetch('../json/cards.json')
    .then(response => response.json())
    .then(data => {
        let innerHTML = '';
        for (let i = 0; i < data.cards.length; i++) {
            innerHTML += '<option '+ (i == 0 ? 'selected="selected"' : '') +' value="' + data.cards[i].title.toLowerCase() + '" >' + data.cards[i].title + '</option><span class="option">' + data.cards[i].title + '</span>';
        }
        $('#kurs')[0].innerHTML = innerHTML;
    })
    .catch(console.error);
}
// Lista kursów do edycji (admin)
function setEditCourseList (selectedOption) {
    fetch('../json/cards.json')
    .then(response => response.json())
    .then(data => {
        let innerHTML = '';
        for (let i = 0; i < data.cards.length; i++) {
            option = data.cards[i].title.toLowerCase();
            innerHTML += '<option '+ (option == selectedOption ? 'selected="selected"' : '') +' value="' + option + '" >' + data.cards[i].title + '</option>';
        }
        $('#course')[0].innerHTML = innerHTML;
    })
    .catch(console.error);
}
// Ładowanie nagłówków kolumn (admin)
function setColumnHeaders () {
    const xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    if (xhr) {
        let url = '../json/columns.json';
        xhr.open("GET", url);
        xhr.addEventListener("readystatechange", function () {
            if (xhr.readyState === 4) {
                let cols = xhr.response;
                let innerHTML = '', tr2 = '';
                for (let i = 0; i < cols.names.length; i++) {
                    innerHTML += '<th>' + cols.names[i] + '</th>';
                    if (i < cols.names.length - 1) tr2 += '<th><div id="wrap"><input type="button" class="sort" onclick="SortBy(' + i + ')" value="Sortuj" /><div class="sorting-arrows"><div class="arrow-up inactive au-col-' + i + '"></div><div class="arrow-none an-col-' + i + '"></div><div class="arrow-down inactive ad-col-' + i + '"></div></div></div></th>';
                    else tr2 += '<th></th>';
                }
                $('#theaders')[0].innerHTML = innerHTML;
                $('#tr2')[0].innerHTML = tr2;
            }
        });
        xhr.send(null);
    }
}
// Ładowanie danych kontaktowych
function setContactData () {
    
}