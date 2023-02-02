// Ładowanie stopki
$(document).ready(function () {
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
});