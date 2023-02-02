<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="JS Explorer - Kontakt" />
        <meta name="author" content="Marcin Basak" />
        <title>JS Explorer - Kontakt</title>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script src="/js/footer_loader.js"></script>
        <script src="/js/contact_loader.js"></script>
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
        <link href="/css/styles.css" rel="stylesheet" />
        <link href="/css/footer-styles.css" rel="stylesheet" />
        <link href="/css/contact-styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        @include('layouts.navbar')
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <div id="contact-info"></div>
            <h4>Znajdziesz nas tutaj</h4>
            <div id="map"></div>
            <h4>Zadaj nam pytanie</h4>
            <form action="mailto:s95365@pollub.edu.pl" method="get" id="help-form">
                <h5>Tytuł</h5>
                <input type="text" id="title" />
                <h5>Treść</h5>
                <textarea rows="5" id="content"></textarea>
                <div id="right"><button type="submit" id="send" disabled>Wyślij</button></div>
            </form>
        </div>
        <!-- Footer-->
        <div id="bottom-redux"></div>
        <footer></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="/js/scripts.js"></script>
        <script src="https://maps.google.com/maps/api/js"></script>
        <script>
            // Mapka
            let wsp = new google.maps.LatLng(51.2350835, 22.5493706);
            let opcjeMapy = {
                zoom: 16,
                center: wsp,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            let mapa = new google.maps.Map(document.getElementById("map"), opcjeMapy);
            // Zadaj nam pytanie - sprawdzenie czy pola są puste
            function updateButton () {
                if ($('#title').val() === '' || $('#content').val() === '') $('#send').attr('disabled','disabled');
                else $('#send').removeAttr('disabled');
            }
            $('#title').on('input click', function () {
                updateButton();
            });
            $('#content').on('input click', function () {
                updateButton();
            });
        </script>
    </body>
</html>
