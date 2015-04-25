<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>YOGASMOGA Import Products</title>

    @include('admin.includes.common_css')
    {{HTML::style(asset("/public/css/site/admin/product/import.css"))}}

    @include('admin.includes.common_js_top')
</head>

<body>

<section id="container">
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    @include('admin.includes.header');
    <!--header end-->

    <!-- **********************************************************************************************************************************************************
    MAIN SIDEBAR MENU
    *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    @include('admin.includes.menu')
    <!--sidebar end-->

    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <div class="row">

                <div class="col-lg-9">

                    <form id="frmimportproducts" target="ifr" method="post" enctype="multipart/form-data">

                        Please choose a file : <input type='file' name='file'/> &nbsp; <input type='submit'
                                                                                              id='btnimportproducts'
                                                                                              value='Upload Products'/>

                        <span class="message"></span>
                    </form>
                    <iframe id="ifr" name="ifr" style="width:1px;height:1px;visibility: hidden"></iframe>

                </div>

            </div>

        </section>
    </section>

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            2014 - Alvarez.is
            <a href="index.html#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>

@include('admin.includes.common_js_bottom')
{{HTML::script(asset("/public/js/site/admin/product/import.js"))}}

</body>
</html>
