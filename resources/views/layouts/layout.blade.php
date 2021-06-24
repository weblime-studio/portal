<!DOCTYPE html>
<html lang="ua">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='icon' type='image/svg+xml' sizes='any' href='/images/favicon.svg'>
        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="/css/reset.css" rel="stylesheet">
        <link href="/css/jquery.fancybox.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
        <link href="/css/extra.css" rel="stylesheet">        
    </head>
    <body class="home">
        <div class="header">
            <div class="inside flex flex-m">
                <div class="logo"><img src="/images/logo.png" alt=""></div>
                <div class="navigation">
                    <ul class="flex">
                        <li><a href="/">Головна</a></li>
                        <li><a href="/courses">Курси</a></li>
                        <li><a href="">Архів курсів</a></li>
                        <li><a href="">Блог</a></li>
                        <li><a href="#" attr-scrol-to=".footer" class="scroll">Контакти</a></li>
                    </ul>
                </div>
                <div class="admin">
                    @if(Auth::id())
                        <a href="/user/profile" class="flex flex-l">
                            <div class="image cover flex">
                                @if (Auth::user()->profile_photo_path)
                                    <img src="/storage/{{ Auth::user()->profile_photo_path }}" class="img-circle elevation-2" alt="User Image">
                                @else
                                    <img src="/images/user-default.png" alt="">
                                @endif
                            </div>
                            <span style="color: #000;">{{ Auth::user()->name }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}"><img src="/images/enter.png" alt=""></a>
                    @endif
                </div>
            </div>
        </div>
        @yield('main_content')
        
        <script src="/js/jquery-3.1.1.js"></script>
        <script src="/js/jquery.fancybox.js"></script>
        <script src="/js/scrol.js"></script>
        <script src="/js/chat.js"></script>
        <script src="/js/scripts.js"></script>
        
        
        <footer>
            <div class="inside flex flex-t">
                <div class="coll logo coll-1">
                    <a href=""><img src="/images/logo.png" alt=""></a>
                </div>
                
                <div class="coll coll-2">
                    <ul>
                        <li>
                            <a href="https://netzwerk-erinnerung.de/uk/proekt/" target="_blank">Проєкт</a>
                            <ul>
                                <li><a href="https://netzwerk-erinnerung.de/uk/projects/istorychne-pidgruntya/" target="_blank">Історичне підґрунтя</a></li>
                                <li><a href="https://netzwerk-erinnerung.de/uk/projects/diyalnist-proyektu/" target="_blank">Діяльність проєкту</a></li>
                                <li><a href="https://netzwerk-erinnerung.de/uk/projects/partnery/" target="_blank">Партнери</a></li>
                                <li><a href="https://netzwerk-erinnerung.de/uk/projects/spivrobitnyky/" target="_blank">Співробітники</a></li>
                            </ul>
                        </li>
                        <li><a href="https://netzwerk-erinnerung.de/uk/mistsya/" target="_blank">Місця</a></li>
                        <li><a href="https://netzwerk-erinnerung.de/uk/podiy/" target="_blank">Події</a></li>
                    </ul>
                </div>
                <div class="coll coll-3">
                    <ul>
                        <li><a href="tel:+490302639430">+49 030 263 9430</a></li>
                        <li>+49 030 263 9432 1 <span style="opacity: 0.5;">/fax</span></li>
                        <li><a href="mailto:info@erinnerung-bewahren.de">info@erinnerung-bewahren.de</a></li>
                        <li>Георгенштрассе, 23, Берлін, 10117</li>
                    </ul>
                </div>
                <div class="donate coll-4">
                    <div class="donate-inner">
                        <h4>Підтримайте наш проект</h4>
                        <p class="paragraph">Проект буде дуже вдячний за вашу фінансову підтримку. Будь ласка, вкажіть у призначенні платежу Protecting memory.</p>
                        <div class="flex flex-t">
                            <ul>
                                <li>DE24 1005 0000 6600 0076 62 <span style="opacity: 0.5;">/IBAN</span></li>
                                <li>BELADEBEXXX <span style="opacity: 0.5;">/BIC</span></li>
                                <li>Berliner Sparkasse <span style="opacity: 0.5;">/Financial</span></li>
                            </ul>
                            <ul>
                                <li><span style="opacity: 0.5;">Institution</span></li>
                                <li>100 500 00 <span style="opacity: 0.5;">/Bank Code</span></li>
                                <li>66 00 00 76 62 <span style="opacity: 0.5;">/Account Number</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="support flex flex-r">
                        <div>
                            <p>За підтримки:</p>
                            <div class="flex flex-t">
                                <a href="https://www.stiftung-denkmal.de/en/" target="_blank"><img src="/images/stiftung-denkmal.svg" alt="" width="122"></a>
                                <a href="https://www.auswaertiges-amt.de/de/" target="_blank"><img src="/images/auswartiges-amt.svg" alt="" width="147"></a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </footer>
        <div class="copy">
            <div class="inside">
                <ul class="flex flex-l">
                    <li><a href="https://netzwerk-erinnerung.de/uk/vykhidni-dani" target="_blank">Вихідні дані</a></li>
                    <li>|</li>
                    <li><a href="https://netzwerk-erinnerung.de/uk/pravyla-korystuvannya/" target="_blank">Правила користування</a></li>
                    <li>|</li>
                    <li><a href="https://netzwerk-erinnerung.de/uk/polityka/" target="_blank">Політика конфіденційності</a></li>
                </ul>
                <p>© Меморіал убитим євреям Європи, 2016–2021</p>
            </div>
        </div>
    </body>
</html>
