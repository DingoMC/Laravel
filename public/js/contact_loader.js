// Ładowanie kart (index)
$(document).ready(function () {
    fetch('../json/contact.json')
    .then(response => response.json())
    .then(data => {
        let innerHTML = '<h4>Dane adresowe</h4>';
        innerHTML += '<p>' + data.address.street + ' ' + data.address.bn + '</p>';
        innerHTML += '<p>' + data.address.postal_code + ' ' + data.address.city + '</p>';
        innerHTML += '<h4>Dane teleadresowe</h4>';
        innerHTML += '<p>Telefon: ' + data.contact.phone + '</p>';
        innerHTML += '<p>E-mail: ' + data.contact.email + '</p>'
        $('#contact-info')[0].innerHTML = innerHTML;
    })
    .catch(console.error);
});