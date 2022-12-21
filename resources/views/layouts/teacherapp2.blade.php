<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->

    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

    <!-- JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".mozgat").draggable({
                helper: "clone",
                appendTo: "body",
                revert: "invalid",
                snap: ".tapad",
                stack: ".mozgat",
                scroll: false
            });
            $("#ch_dndBoard1").droppable({
                cursor: "move",
                accept: ".mozgat",
                activeClass: "snaptarget-hover",
                drop: function(event, ui) {
                    var ct = $(this);
                    var item = $(ui.draggable);
                    var origPos;
                    var ctPos = ct.offset();

                    if (item.is('.tapad')) {
                        origPos = item.offset();
                        ct.append(item);
                    } else {
                        origPos = ui.offset;
                        item = item.clone();
                        ct.append(item);
                        item.removeClass("ui-draggable");
                        item.addClass('tapad');
                        item.draggable({
                            containment: "#dndBoard",
                            snap: ".tapad",
                            stack: ".mozgat",
                            scroll: false
                        });
                        item.on('dragend', function() {
                            alert(item.getPosition().x + "/" + item.getPosition().y);
                        });
                        item.resizable();
                        item.addClass('remove');
                        var ex = $('<a href="Javascript:void(0)" class="delete" title="Remove">X</a>').css({
                            'position': 'absolute',
                            'bottom': 110,
                            'right': 15,
                            'height': 10,
                            'width': 10,
                            'background-color': 'transparent'
                        });
                        $(ex).insertAfter($(item.find('p')));
                        item.appendTo('#droppable');
                        $('.delete').on('click', function() {
                            $(this).parent('span').remove();
                        });
                        var ro = $('<div class="rotator"></div>').addClass('handler').css({
                            'position': 'absolute',
                            'bottom': 100,
                            'right': 75,
                            'height': 10,
                            'width': 10,
                            'background-color': 'green'
                        });
                        $(ro).insertAfter($(item.find('p')));
                        item.appendTo('#droppable');
                        applyRotation();
                    }
                    item.css({
                        top: origPos.top - ctPos.top - 1,
                        left: origPos.left - ctPos.left - 1
                    });
                }
            });
            $('#snaptarget3').droppable({
                over: function(event, ui) {
                    ui.draggable.remove();
                }
            });
        });

        function applyRotation() {
            $('.handler').draggable({
                opacity: 0.01,
                helper: 'clone',
                drag: function(event, ui) {
                    var rotateCSS = 'rotate(' + ui.position.left + 'deg)';

                    $(this).parent().css({
                        '-moz-transform': rotateCSS,
                        '-webkit-transform': rotateCSS
                    });
                }
            });
        }
    </script>

</head>

<body class="{{ $class ?? '' }}">
    @auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('layouts.navbars.teachersidebar')
    @endauth

    <div class="main-content">
        @include('layouts.navbars.teachernavbar')
        @yield('content')
    </div>

    @guest()
    @include('layouts.footers.guest')
    @endguest

</body>

</html>