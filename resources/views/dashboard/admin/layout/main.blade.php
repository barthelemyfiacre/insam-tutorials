<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('dashboard.admin.layout.partials.head')
</head>

<body>
    <div class="wrapper">
        <div class="preloader"></div>
        @include('dashboard.admin.layout.partials.header')
        <section class="our-dashbord dashord pb50">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            @include('dashboard.admin.layout.partials.header2')
                            @include('dashboard.admin.layout.partials.leftaside')
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <a class="scrollToHome" href="#"><i class="flaticon-up-arrow-1"></i></a>
    </div>

    @include('dashboard.admin.layout.partials.footer_script')

    @yield('scripts')

</body>

</html>
