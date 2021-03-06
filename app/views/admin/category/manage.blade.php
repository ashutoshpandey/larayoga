<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>YOGASMOGA Manage Categories</title>

    @include('admin.includes.common_css')
    {{HTML::style(asset("/public/css/jquery.dataTables.css"))}}
    {{HTML::style(asset("/public/css/site/admin/category/manage.css"))}}

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
                  <div class="col-lg-3" id="tree">
                  </div>
                  <div class="col-lg-9" id="categorylist">

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
  {{HTML::script(asset("/public/js/jquery.dataTables.min.js"))}}
  {{HTML::script(asset("/public/js/site/admin/category/manage.js"))}}

  </body>
</html>
