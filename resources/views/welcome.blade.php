<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script src="/js/card_loader.js"></script>
        <link href="/css/styles.css" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
        <link href="/css/index-styles.css" rel="stylesheet" />
        <title>JS Explorer</title>
    </head>
    <body>
        <!-- Responsive navbar-->
        @include('layouts.navbar')
        <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div class="col-lg-7" id="slideshow">
                    <img class="img-fluid rounded mb-4 mb-lg-0 active" src="zdjecia/baner1.png" alt="image1" />
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="zdjecia/baner2.png" alt="image2" />
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="zdjecia/baner3.png" alt="image3" />
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="zdjecia/baner4.png" alt="image4" />
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="zdjecia/baner5.png" alt="image5" />
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="zdjecia/baner6.png" alt="image6" />
                </div>
                <div class="col-lg-5">
                    <h1 class="font-weight-light">JS Explorer</h1>
                    <p>Jeżeli chcesz w tempie ekspresowym nauczyć się pracy z frameworkami JavaScript to nasze kursy są idelane dla Ciebie. Zamiast wydawać ciężkie pieniądze na szkolenia, naucz się tworzenia aplikacji webowych nie wychodząc z domu i za niską cenę. Poniżej przedstawiamy listę frameworków wraz z ich krótkim opisem. Aby zapisać się na kurs zarejestruj się i zamów tyle kursów ile potrzebujesz :).</p>
                </div>
            </div>
            <!-- Content Row-->
            <div class="row gx-4 gx-lg-5" id="cards"></div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script>
            // Slider
            function slideSwitch () {
                let $active = $('#slideshow IMG.active');
                if ($active.length === 0) $active = $('#slideshow IMG:last');
                let $next = $active.next().length ? $active.next() : $('#slideshow IMG:first');
                $active.addClass('last-active');
                $next.css({opacity: 0.0})
                .addClass('active')
                .animate({opacity: 1.0}, 1000, function () {
                    $active.removeClass('active last-active');
                });
            }
            $(function () {
                setInterval("slideSwitch()", 5000);
            });
        </script>
        <script src="/js/footer_loader.js"></script>
        <style>
            footer {
                position: fixed;
                z-index: 10;
                bottom: 0;
                left: 0;
                right: 0;
                display: grid;
                grid-auto-flow: column;
                place-items: center;
                text-align: center;
                font-family: Arial, Helvetica, sans-serif;
                color: #ffffff;
                height: fit-content;
                background: linear-gradient(0deg, rgba(52, 58, 64, 0.9), rgba(52, 58, 64, 0.7));
                box-shadow: 0 -0.5rem 0.2rem 0.2rem rgba(52, 58, 64, 0.7);
            }
            footer > span {padding: 0 0 0.5rem 0;}
            #bottom-redux {
                display: block;
                height: 3rem;
            }
            @media screen and (max-width: 720px) {
                footer {
                    font-size: 0.9rem;
                    box-shadow: 0 -0.33rem 0.15rem 0.15rem rgba(52, 58, 64, 0.7);
                }
                footer > span {padding: 0 0 0.33rem 0;}
            }
            @media screen and (max-width: 384px) {
                footer {
                    font-size: 0.75rem;
                    box-shadow: 0 -0.25rem 0.1rem 0.1rem rgba(52, 58, 64, 0.7);
                }
                footer > span {padding: 0 0 0.25rem 0;}
            }
        </style>
        <!-- Footer -->
        <div id="bottom-redux"></div>
        <footer></footer>
    </body>
</html>