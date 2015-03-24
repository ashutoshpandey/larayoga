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
    {{HTML::style(asset("/public/css/product/create.css"))}}

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
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="index.html" class="logo"><b>DASHGUM FREE</b></a>
    <!--logo end-->
    <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
            <!-- settings start -->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                    <i class="fa fa-tasks"></i>
                    <span class="badge bg-theme">4</span>
                </a>
                <ul class="dropdown-menu extended tasks-bar">
                    <div class="notify-arrow notify-arrow-green"></div>
                    <li>
                        <p class="green">You have 4 pending tasks</p>
                    </li>
                    <li>
                        <a href="index.html#">
                            <div class="task-info">
                                <div class="desc">DashGum Admin Panel</div>
                                <div class="percent">40%</div>
                            </div>
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="index.html#">
                            <div class="task-info">
                                <div class="desc">Database Update</div>
                                <div class="percent">60%</div>
                            </div>
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                    <span class="sr-only">60% Complete (warning)</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="index.html#">
                            <div class="task-info">
                                <div class="desc">Product Development</div>
                                <div class="percent">80%</div>
                            </div>
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                    <span class="sr-only">80% Complete</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="index.html#">
                            <div class="task-info">
                                <div class="desc">Payments Sent</div>
                                <div class="percent">70%</div>
                            </div>
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                    <span class="sr-only">70% Complete (Important)</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="external">
                        <a href="#">See All Tasks</a>
                    </li>
                </ul>
            </li>
            <!-- settings end -->
            <!-- inbox dropdown start-->
            <li id="header_inbox_bar" class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-theme">5</span>
                </a>
                <ul class="dropdown-menu extended inbox">
                    <div class="notify-arrow notify-arrow-green"></div>
                    <li>
                        <p class="green">You have 5 new messages</p>
                    </li>
                    <li>
                        <a href="index.html#">
                            <span class="photo">{{HTML::image(asset("/public/img/ui-zac.jpg"), 'Avatar')}}</span>
                                    <span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hi mate, how is everything?
                                    </span>
                        </a>
                    </li>
                    <li>
                        <a href="index.html#">
                            <span class="photo">{{HTML::image(asset("/public/img/ui-divya.jpg"), 'Avatar')}}</span>
                                    <span class="subject">
                                    <span class="from">Divya Manian</span>
                                    <span class="time">40 mins.</span>
                                    </span>
                                    <span class="message">
                                     Hi, I need your help with this.
                                    </span>
                        </a>
                    </li>
                    <li>
                        <a href="index.html#">
                            <span class="photo">{{HTML::image(asset("/public/img/ui-danro.jpg"), 'Avatar')}}</span>
                                    <span class="subject">
                                    <span class="from">Dan Rogers</span>
                                    <span class="time">2 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Love your new Dashboard.
                                    </span>
                        </a>
                    </li>
                    <li>
                        <a href="index.html#">
                            <span class="photo">{{HTML::image(asset("/public/img/ui-sherman.jpg"), 'Avatar')}}</span>
                                    <span class="subject">
                                    <span class="from">Dj Sherman</span>
                                    <span class="time">4 hrs.</span>
                                    </span>
                                    <span class="message">
                                        Please, answer asap.
                                    </span>
                        </a>
                    </li>
                    <li>
                        <a href="index.html#">See all messages</a>
                    </li>
                </ul>
            </li>
            <!-- inbox dropdown end -->
        </ul>
        <!--  notification end -->
    </div>
    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <li><a class="logout" href="../login.html">Logout</a></li>
        </ul>
    </div>
</header>
<!--header end-->

<!-- **********************************************************************************************************************************************************
MAIN SIDEBAR MENU
*********************************************************************************************************************************************************** -->
<!--sidebar start-->
@include('includes.adminmenu')
<!--sidebar end-->

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
<section class="wrapper">

<div class="row">
<div class="col-lg-9 main-chart">


    <form class="frmcreateproduct">
        <label>Name</label>
        <input type="text" name="name"/>

        <label>Sku</label>
        <input type="text" name="sku"/>

        <label>Quantity</label>
        <input type="text" name="quantity"/>


        <label>Price</label>
        <input type="text" name="price"/>

        <label>Special Price</label>
        <input type="text" name="specialprice"/>

        <label>Pre-Order?</label>
        <input type="radio" name="preorder" value="no" checked="checked"/>No &nbsp;
        <input type="radio" name="preorder" value="yes"/>Yes

        <label>&nbsp;</label>
        <button type="button" name="btncreateproduct">Create Product</button>
    </form>

</div><!-- /col-lg-9 END SECTION MIDDLE -->


<!-- **********************************************************************************************************************************************************
RIGHT SIDEBAR CONTENT
*********************************************************************************************************************************************************** -->

<div class="col-lg-3 ds">
    <!--COMPLETED ACTIONS DONUTS CHART-->
    <h3>NOTIFICATIONS</h3>

    <!-- First Action -->
    <div class="desc">
        <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
        </div>
        <div class="details">
            <p><muted>2 Minutes Ago</muted><br/>
                <a href="#">James Brown</a> subscribed to your newsletter.<br/>
            </p>
        </div>
    </div>
    <!-- Second Action -->
    <div class="desc">
        <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
        </div>
        <div class="details">
            <p><muted>3 Hours Ago</muted><br/>
                <a href="#">Diana Kennedy</a> purchased a year subscription.<br/>
            </p>
        </div>
    </div>
    <!-- Third Action -->
    <div class="desc">
        <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
        </div>
        <div class="details">
            <p><muted>7 Hours Ago</muted><br/>
                <a href="#">Brandon Page</a> purchased a year subscription.<br/>
            </p>
        </div>
    </div>
    <!-- Fourth Action -->
    <div class="desc">
        <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
        </div>
        <div class="details">
            <p><muted>11 Hours Ago</muted><br/>
                <a href="#">Mark Twain</a> commented your post.<br/>
            </p>
        </div>
    </div>
    <!-- Fifth Action -->
    <div class="desc">
        <div class="thumb">
            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
        </div>
        <div class="details">
            <p><muted>18 Hours Ago</muted><br/>
                <a href="#">Daniel Pratt</a> purchased a wallet in your store.<br/>
            </p>
        </div>
    </div>

    <!-- USERS ONLINE SECTION -->
    <h3>TEAM MEMBERS</h3>
    <!-- First Member -->
    <div class="desc">
        <div class="thumb">
            {{HTML::image(asset("/public/img/ui-divya.jpg"), 'Avatar', array('class'=>'img-circle', 'style'=>'width:35px;height:35px'))}}
        </div>
        <div class="details">
            <p><a href="#">DIVYA MANIAN</a><br/>
                <muted>Available</muted>
            </p>
        </div>
    </div>
    <!-- Second Member -->
    <div class="desc">
        <div class="thumb">
            {{HTML::image(asset("/public/img/ui-sherman.jpg"), 'Avatar', array('class'=>'img-circle', 'style'=>'width:35px;height:35px'))}}
        </div>
        <div class="details">
            <p><a href="#">DJ SHERMAN</a><br/>
                <muted>I am Busy</muted>
            </p>
        </div>
    </div>
    <!-- Third Member -->
    <div class="desc">
        <div class="thumb">
            {{HTML::image(asset("/public/img/ui-danro.jpg"), 'Avatar', array('class'=>'img-circle', 'style'=>'width:35px;height:35px'))}}
        </div>
        <div class="details">
            <p><a href="#">DAN ROGERS</a><br/>
                <muted>Available</muted>
            </p>
        </div>
    </div>
    <!-- Fourth Member -->
    <div class="desc">
        <div class="thumb">
            {{HTML::image(asset("/public/img/ui-zac.jpg"), 'Avatar', array('class'=>'img-circle', 'style'=>'width:35px;height:35px'))}}
        </div>
        <div class="details">
            <p><a href="#">Zac Sniders</a><br/>
                <muted>Available</muted>
            </p>
        </div>
    </div>
    <!-- Fifth Member -->
    <div class="desc">
        <div class="thumb">
            {{HTML::image(asset("/public/img/ui-sam.jpg"), 'Avatar', array('class'=>'img-circle', 'style'=>'width:35px;height:35px'))}}
        </div>
        <div class="details">
            <p><a href="#">Marcel Newman</a><br/>
                <muted>Available</muted>
            </p>
        </div>
    </div>

    <!-- CALENDAR-->
    <div id="calendar" class="mb">
        <div class="panel green-panel no-margin">
            <div class="panel-body">
                <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                    <div class="arrow"></div>
                    <h3 class="popover-title" style="disadding: none;"></h3>
                    <div id="date-popover-content" class="popover-content"></div>
                </div>
                <div id="my-calendar"></div>
            </div>
        </div>
    </div><!-- / calendar -->

</div><!-- /col-lg-3 -->
</div><! --/row -->
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

{{HTML::script(asset("/public/js/jquery-1.10.2.js"))}}
{{HTML::script(asset("/public/js/bootstrap.min.js"))}}
{{HTML::script(asset("/public/js/common.js"))}}
{{HTML::script(asset("/public/js/admin/createproduct.js"))}}

</body>
</html>
