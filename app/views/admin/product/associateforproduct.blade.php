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
    {{HTML::style(asset("/public/css/jquery.dataTables.css"))}}
    {{HTML::style(asset("/public/css/site/admin/common.css"))}}
    {{HTML::style(asset("/public/css/site/admin/product/associateforproduct.css"))}}

    @include('admin.includes.common_js_top')
</head>

<body>

<section id="container" >
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

    <div><a href="{{$root}}/associate-products">Back</a></div>

    <?php if($found){ ?>

    <div>
        Product : {{$product_name}} ( {{$product_id}} )
    </div>

    <div id="associatedproductlist"></div>

    <hr/>

    <div id="productlist"></div>

    <?php } else{ ?>

        <h4>Invalid product selected</h4>

    <?php } ?>

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
{{HTML::script(asset("/public/js/site/admin/product/associateforproduct.js"))}}

</body>
</html>