<html>
    <head>
        @foreach($pages as $page)
        @endforeach
        <title>{{$page->title}}</title>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">
            <title>Home | E-Shopper</title>
            <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
            <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
            <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
            <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
            <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
         <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
         <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
           <link href="{{asset('frontend/css/track.css')}}" rel="stylesheet">
            <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
            <script src="js/respond.min.js"></script>
            <![endif]-->
            <link rel="shortcut icon" href="images/ico/favicon.ico">
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
            <link rel="apple-touch-icon-precomposed" href="{{asset('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
             <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet">
            <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet">
            <link href="{{asset('assets/css/docs.css" rel="stylesheet')}}" >

            <link href="bootstrap-social.css" rel="stylesheet" >
            <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
                <script src="http://parsleyjs.org/dist/parsley.min.js" type="text/javascript"></script>
        <link href="https://parsleyjs.org/src/parsley.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
        <script src="http://parsleyjs.org/dist/parsley.js"></script>

    </head>
    <body>
      @include('Frontend.layouts.header')

       <section>
          <div class="container">
          {!! $page->content !!}
          </div>
        </section>
        @include('Frontend.layouts.footer')


        @yield('script')
    </body>
</html>
