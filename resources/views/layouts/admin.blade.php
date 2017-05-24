<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <title>{{$title}}</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ asset("assets/css/styles.css") }}" />
        {{ Html::style('css/style.css') }}
        {{ Html::style('css/bootstrap.css') }}
        {{ Html::style('css/bootstrap-datetimepicker.css') }}
        {{ Html::style('css/app.css') }}
    @yield('style')
        <!-- jQuery -->
        {{ Html::script('js/jquery.js') }}
        {{ Html::script('js/moment.js') }}
        <script src="{{ asset("assets/js/frontend.js") }}" type="text/javascript"></script>
    </head>

    <body>
        <div id="wrapper">
            @include('elements.navigation')
        </div>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row col-lg-12">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @yield('content')
            </div>
            <!-- /#page-wrapper -->
        </div>
        {{ Html::script('js/bootstrap-datetimepicker.js') }}
        {{ Html::script('js/admin.js') }}
        {{ Html::script('js/app.js') }}
        @yield('script')
    </body>
</html>
