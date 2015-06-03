<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>YOGASMOGA Create Category</title>

    @include('admin.includes.common_css')
    {{HTML::style(asset("/public/css/site/admin/category/create.css"))}}

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
            <div class="col-lg-9 main-chart">

                <div class="row">
                    <div class="col-lg-3" id="tree">
                    </div>
                    <div class="col-lg-9" id="form">

                        <h4>Parent category : <span class='sp_parent_category'></span></h4>
                        <form id='frmcategory' action='save-category' method='post' enctype='multipart/form-data'
                              target='ifr' onsubmit='return saveCategory()'>
                            <div class="formrow">
                                <label>Name</label>
                                <input type="text" name="name"/>
                                <div class='clearfix'></div>
                            </div>
                            <div class="formrow">
                                <label>URL Key</label>
                                <input type="text" name="url_key"/>
                                <div class='clearfix'></div>
                            </div>
                            <div class="formrow">
                                <label>Description</label>
                                <textarea name="description"></textarea>
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
                            <div class="formrow">
                                <label>Image</label>
                                <input type="file" name="image"/>
                                <div class='clearfix'></div>
                            </div>
                            <div class="formrow">
                                <img id='category_image'/>
                            </div>
                            <div class="formrow">
                                <input type="submit" name="btncreatecategory" value="Create Category" rel='create'/>
                            </div>
                            <div class='formrow'>
                                <span class='msg'></span>
                            </div>
                            <input type='hidden' name='parent_id'/>
                            <input type='hidden' name='id'/>
                        </form>
                        <iframe id='ifr' name='ifr' style='width:1px;height:1px;visibility: hidden'></iframe>
                    </div>
                </div>

            </div>
            <!-- /col-lg-9 END SECTION MIDDLE -->

        </div>
        <!-- /row -->
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
{{HTML::script(asset("/public/js/site/admin/category/create.js"))}}

</body>
</html>
