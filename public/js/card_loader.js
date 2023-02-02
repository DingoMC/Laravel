// Ładowanie kart (index)
$(document).ready(function () {
    fetch('/json/cards.json')
    .then(response => response.json())
    .then(data => {
        let innerHTML = '';
        for (let i = 0; i < data.cards.length; i++) {
            innerHTML += '<div class="col-md-4 col-sm-6 mb-5"><div class="card h-100 ' + data.cards[i].title.toLowerCase() + '"><div class="card-body">';
            innerHTML += '<h2 class="card-title"><img src="zdjecia/' + data.cards[i].title.toLowerCase() + '.png" />' + data.cards[i].title + '</h2>';
            innerHTML += '<p class="card-text">' + data.cards[i].content + '</p>';
            innerHTML += '</div>';
            innerHTML += '<div class="card-footer"><a class="btn btn-primary btn-sm" target="blank" href="' + data.cards[i].url + '">Czytaj więcej...</a></div>';
            innerHTML += '</div></div>';
        }
        $('#cards')[0].innerHTML = innerHTML;
    })
    .catch(console.error);
});