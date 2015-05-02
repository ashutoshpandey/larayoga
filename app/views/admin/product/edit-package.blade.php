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
    {{HTML::style(asset("/public/css/tab.css"))}}
    {{HTML::style(asset("/public/css/jquery.dataTables.css"))}}
    {{HTML::style(asset("/public/css/site/admin/product/edit-package.css"))}}

    @include('admin.includes.common_js_top')
</head>

<body>

<section id="container">
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    @include('admin.includes.header')
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

                <div class="cd-tabs">
                    <nav>
                        <ul class="cd-tabs-navigation">
                            <li><a data-content="inbox" class="selected" href="#0">Package information</a></li>
                            <li><a data-content="new" href="#0">All products</a></li>
                        </ul> <!-- cd-tabs-navigation -->
                    </nav>

                    <ul class="cd-tabs-content">

                        <li data-content="inbox" class="selected">


                            <form id="frmproduct" target="ifr" method="post">

                                <div class='formrow'>
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{$package->name}}"/>

                                    <div class='clearfix'></div>
                                </div>

                                <div class='formrow'>
                                    <label>Description</label>
                                    <textarea name="description">{{$package->description}}</textarea>

                                    <div class='clearfix'></div>
                                </div>

                                <div class='formrow'>
                                    <label>&nbsp;</label>
                                    <input type="button" name="updatePackageInformation" value="Update package information"/>

                                    <div class='clearfix'></div>
                                </div>

                            </form>

                            <div id="packageproductlist"></div>
                        </li>

                        <li data-content="new">
                            <div id="productlist"></div>
                        </li>
                    </ul> <!-- cd-tabs-content -->
                </div>

            </div>
        </section>
    </section>

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
    </footer>
    <!--footer end-->
</section>

@include('admin.includes.common_js_bottom')
{{HTML::script(asset("/public/js/jquery.dataTables.min.js"))}}
{{HTML::script(asset("/public/js/site/admin/product/edit-package.js"))}}

</body>
</html>