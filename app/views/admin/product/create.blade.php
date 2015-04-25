<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Create a new product</title>

    @include('admin.includes.common_css')
    {{HTML::style(asset("/public/css/site/admin/product/create.css"))}}

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
                <div class="col-lg-3" id="tree">
                </div>

                <div class="col-lg-9 main-chart">

                    <div id='category_to_add'></div>

                    <form id="frmproduct" target="ifr" method="post">

                        <div class='formrow'>
                            <label>Name</label>
                            <input type="text" name="name"/>

                            <div class='clearfix'></div>
                        </div>

                        <div class='formrow'>
                            <label>URL Key</label>
                            <input type="text" name="url_key"/>

                            <div class='clearfix'></div>
                        </div>

                        <div class='formrow'>
                            <label>Sku</label>
                            <input type="text" name="sku"/>

                            <div class='clearfix'></div>
                        </div>

                        <div class='formrow'>
                            <label>Quantity</label>
                            <input type="text" name="quantity"/>

                            <div class='clearfix'></div>
                        </div>

                        <div class='formrow'>
                            <label>Price</label>
                            <input type="text" name="price"/>

                            <div class='clearfix'></div>
                        </div>

                        <div class='formrow'>
                            <label>Special Price</label>
                            <input type="text" name="special_price"/>

                            <div class='clearfix'></div>
                        </div>

                        <div class="formrow">
                            <label>Description</label>
                            <textarea name="description"></textarea>

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
                            <input type="text" name="page_title"/>

                            <div class='clearfix'></div>
                        </div>

                        <div class="formrow">
                            <label>Header data</label>
                            <textarea name="header_data"></textarea>

                            <div class='clearfix'></div>
                        </div>

                        <div class="formrow">
                            <label>Custom JSON data</label>
                            <textarea name="custom_json_data"></textarea>

                            <div class='clearfix'></div>
                        </div>

                        <div class='formrow'>
                            <label>Active</label>
                            <input type="radio" name="status" value="no" checked="checked"/>No &nbsp;
                            <input type="radio" name="status" value="yes"/>Yes

                            <div class='clearfix'></div>
                        </div>

                        <label>&nbsp;</label>
                        <input type='submit' name='btncreateproduct' value='Create Product'/>
                        <input type='hidden' name='category_id'/>
                    </form>
                    <iframe name='ifr' id='ifr' style="visibility: hidden; width:1px; height:1px;"></iframe>
                    <div class='message'></div>
                </div>
                <!-- /col-lg-9 END SECTION MIDDLE -->


                <!-- **********************************************************************************************************************************************************
                RIGHT SIDEBAR CONTENT
                *********************************************************************************************************************************************************** -->


            </div>
            <! --/row -->
        </section>
    </section>

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
    </footer>
    <!--footer end-->
</section>

@include('admin.includes.common_js_bottom')
{{HTML::script(asset("/public/js/site/admin/product/create.js"))}}

</body>
</html>
