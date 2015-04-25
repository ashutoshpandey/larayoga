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
    {{HTML::style(asset("/public/css/site/admin/product/import.css"))}}

    {{HTML::script(asset("/public/js/jquery-1.10.2.js"))}}

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
      @include('admin.includes.header');
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

                  <div class="col-lg-9">

                      <form id="frmimportproducts" target="ifr" method="post" enctype="multipart/form-data">

                          Please choose a file : <input type='file' name='file'/> &nbsp; <input type='submit' id='btnimportproducts' value='Upload Products'/>

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

  {{HTML::script(asset("/public/js/bootstrap.min.js"))}}

  {{HTML::script(asset("/public/js/jquery.dcjqaccordion.2.7.js"))}}
  {{HTML::script(asset("/public/js/jquery.scrollTo.min.js"))}}
  {{HTML::script(asset("/public/js/jquery.nicescroll.js"))}}
  {{HTML::script(asset("/public/js/common-scripts.js"))}}

  {{HTML::script(asset("/public/js/site/common.js"))}}
  {{HTML::script(asset("/public/js/site/admin/common.js"))}}
  {{HTML::script(asset("/public/js/site/admin/product/import.js"))}}

  </body>
</html>
