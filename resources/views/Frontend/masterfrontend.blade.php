<html>
    <head>
        <title>Shop</title>
         @include('Frontend.layouts.css')
    </head>
    <body>
    @include('Frontend.layouts.header')
       <section>
          <div class="container">
            @yield('content')
          </div>
        </section>
        @include('Frontend.layouts.footer')

        @yield('script')
    </body>
</html>
