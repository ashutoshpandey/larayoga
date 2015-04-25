<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>YOGASMOGA Import Products</title>

    <!-- Bootstrap core CSS -->
    {{HTML::style(asset("/public/css/bootstrap.css"))}}
    {{HTML::style(asset("/public/font-awesome/css/font-awesome.css"))}}
    {{HTML::style(asset("/public/css/zabuto_calendar.css"))}}
    {{HTML::style(asset("/public/lineicons/style.css"))}}
    {{HTML::style(asset("/public/css/style.css"))}}
    {{HTML::style(asset("/public/css/style-responsive.css"))}}
    {{HTML::style(asset("/public/css/site/admin/common.css"))}}
    {{HTML::style(asset("/public/css/site/admin/product/edit.css"))}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
@include('admin.includes.adminmenu')
<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
<section class="wrapper">

<div class="row">

<div class="col-lg-9 main-chart">


    <form id="frmproduct" target="ifr" method="post">

        <div class='formrow'>
            <label>Name</label>
            <input type="text" name="name" value="{{$product->name}}"/>

            <div class='clearfix'></div>
        </div>

        <div class='formrow'>
            <label>URL Key</label>
            <input type="text" name="url_key" value="{{$product->url_key}}"/>

            <div class='clearfix'></div>
        </div>

        <div class='formrow'>
            <label>Sku</label>
            <input type="text" name="sku" value="{{$product->sku}}"/>

            <div class='clearfix'></div>
        </div>

        <div class='formrow'>
            <label>Quantity</label>
            <input type="text" name="quantity" value="{{$product->quantity}}"/>

            <div class='clearfix'></div>
        </div>

        <div class='formrow'>
            <label>Price</label>
            <input type="text" name="price" value="{{$product->price}}"/>

            <div class='clearfix'></div>
        </div>

        <div class='formrow'>
            <label>Special Price</label>
            <input type="text" name="special_price" value="{{$product->special_price}}"/>

            <div class='clearfix'></div>
        </div>

        <div class="formrow">
            <label>Description</label>
            <textarea name="description">{{$product->description}}</textarea>

            <div class='clearfix'></div>
        </div>

        <div class='formrow'>
            <label>Pre-Order?</label>
            <input type="radio" name="pre_order" value="no" checked="checked"/>No &nbsp;
            <input type="radio" name="pre_order" value="yes"/>Yes

            <div class='clearfix'></div>
        </div>

        <div class="formrow">
            <label>Page title</label>
            <input type="text" name="page_title" value="{{$product->page_title}}"/>

            <div class='clearfix'></div>
        </div>

        <div class="formrow">
            <label>Header data</label>
            <textarea name="header_data">{{$product->header_data}}</textarea>

            <div class='clearfix'></div>
        </div>

        <div class="formrow">
            <label>Custom JSON data</label>
            <textarea name="custom_json_data">{{$product->custom_json_data}}</textarea>

            <div class='clearfix'></div>
        </div>

        <div class='formrow'>
            <label>Active</label>
            <input type="radio" name="status" value="no" checked="checked"/>No &nbsp;
            <input type="radio" name="status" value="yes"/>Yes

            <div class='clearfix'></div>
        </div>

        <label>&nbsp;</label>
        <input type='submit' name='btnupdateproduct' value='Update Product'/>
        <input type='hidden' name='id'/>
    </form>
    <iframe name='ifr' id='ifr' style="visibility: hidden; width:1px; height:1px;"></iframe>
    <div class='message'></div>

</div><!-- /col-lg-9 END SECTION MIDDLE -->


<!-- **********************************************************************************************************************************************************
RIGHT SIDEBAR CONTENT
*********************************************************************************************************************************************************** -->


</div>
</section>
</section>

<!--main content end-->
<!--footer start-->
<footer class="site-footer">
</footer>
<!--footer end-->
</section>

{{HTML::script(asset("/public/js/jquery-1.10.2.js"))}}
{{HTML::script(asset("/public/js/bootstrap.min.js"))}}

{{HTML::script(asset("/public/js/jquery.dcjqaccordion.2.7.js"))}}
{{HTML::script(asset("/public/js/jquery.scrollTo.min.js"))}}
{{HTML::script(asset("/public/js/jquery.nicescroll.js"))}}
{{HTML::script(asset("/public/js/common-scripts.js"))}}

{{HTML::script(asset("/public/js/site/common.js"))}}
{{HTML::script(asset("/public/js/site/admin/product/editproduct.js"))}}

<span class="root" rel="{{$root}}">&nbsp;</span>
</body>
</html>
