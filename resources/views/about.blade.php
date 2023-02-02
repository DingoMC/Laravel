<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="JS Explorer - O nass..." />
        <meta name="author" content="Marcin Basak" />
        <title>JS Explorer - O nas...</title>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script src="/js/footer_loader.js"></script>
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
        <link href="/css/styles.css" rel="stylesheet" />
        <link href="/css/footer-styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        @include('layouts.navbar')
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <h3>Projekt został zrealizowany w ramach laboratorium "Programowanie Aplikacji Internetowych"</h3>
            <p>Tematyką projektu jest utworzenie aplikacji internetowej prowadzącej zapisy na kursy frameworków JS.</p>
            <p>Funckjonowanie projektu operate jest na Frameworku Laravel. Do stylizacji wykorzystano szablon Bootstrap oraz dodatkowe klasy CSS. Do ładowania treści z plików JSON wykorzystano język JavaScript z biblioteką jQuery. Do przechowywania danych użytkowników wykorzystano bazę danych PostgreSQL.</p>
        </div>
        <!-- Footer-->
        <div id="bottom-redux"></div>
        <footer></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="/js/scripts.js"></script>
    </body>
</html>
