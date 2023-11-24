<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('bootstrap') }}/css/bootstrap.min.css" >
    <link rel="stylesheet" href="{{asset('bootstrap-sweetalert')}}/sweetalert.css" />

    @yield('header')
</head>
<body>

    @yield('content')



    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>

    <script src="{{asset('bootstrap')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('bootstrap-sweetalert')}}/sweetalert.min.js"></script>

    <script>

        (function($){

            @if ($message = Session::get('success'))

                swal({
                    title: " ",
                    text: "{{ $message }}",
                    imageUrl: '{{ asset('img/sent.jpg') }}'
                });

            @endif

            @if ($message = Session::get('error'))

                swal({
                    title: "",
                    text: "{{ $message }}",
                    type: "warning",
                    showConfirmButton: true,
                    confirmButtonClass: "btn-danger",
                });

            @endif

        })(jQuery);

    </script>

    @yield('footer')


</body>
</html>
