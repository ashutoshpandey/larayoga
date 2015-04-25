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
            <div class="col-lg-9 main-chart">

                <?php if($found){ ?>

                <div class="row">
                    <div class="col-lg-3" id="tree">
                    </div>
                    <div class="col-lg-9">

                        <form id='frmcategory' action='{{$root}}/update-category' method='post' enctype='multipart/form-data'
                              target='ifr' onsubmit='return updateCategory()'>
                            <div class="formrow">
                                Name
                                <input type="text" name="name" value="{{$category->name}}"/>
                            </div>
                            <div class="formrow">
                                URL Key
                                <input type="text" name="url_key" value="{{$category->url_key}}"/>
                            </div>
                            <div class="formrow">
                                Image
                                <input type="file" name="image"/>
                            </div>
                            <div class="formrow">
                                Description
                                <textarea name="description">{{$category->description}}</textarea>
                            </div>
                            <div class="formrow">
                                <img id='category_image' src="{{$root}}/public/images/categories/{{$category->image_saved_name}}"/>
                            </div>
                            <div class="formrow">
                                <input type="submit" name="btnupdatecategory" value="Update Category" rel='create'/>
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

                <?php } else { ?>

                    <div class="row"><h3>Invalid category!</h3></div>

                <?php } ?>

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
{{HTML::script(asset("/public/js/site/admin/category/edit.js"))}}

</body>
</html>
