<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">

    <title>YOGASMOGA</title>

    {{HTML::style(asset("/public/css/bootstrap.css"))}}
    {{HTML::style(asset("/public/font-awesome/css/font-awesome.css"))}}
    {{HTML::style(asset("/public/css/header_footer.css"))}}
    {{HTML::style(asset("/public/css/home.css"))}}
    {{HTML::style(asset("/public/css/fonts.css"))}}
    {{HTML::style(asset("/public/css/home.css"))}}

    {{HTML::script(asset("/public/js/jquery-1.10.2.js"))}}
</head>

<body>

<section id="container" >
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        @include('includes.header')
    </header>
    <!--header end-->

    <!--main content start-->
    <section id="main-content">
        @include('includes.home.buckets')
    </section>
    <!--main content end-->

    <!--footer start-->
    <footer class="site-footer">
        @include('includes.footer')
    </footer>
    <!--footer end-->
</section>

{{HTML::script(asset("/public/js/bootstrap.min.js"))}}
{{HTML::script(asset("/public/js/jquery.flexslider-min.js"))}}
</body>
</html>
