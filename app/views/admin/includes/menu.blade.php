<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered"><a href="{{$root}}/profile.html">{{HTML::image(asset("/public/img/ui-sam.jpg"), 'Avatar', array('class'=>'img-circle', 'style'=>'width:60'))}}</a></p>
            <h5 class="centered">Marcel Newman</h5>

            <li class="mt">
                <a class="active" href="{{$root}}/index.html">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sub-menu category-menu">
                <a href="{{$root}}/javascript:;" >
                    <i class="fa fa-cogs"></i>
                    <span>Category</span>
                </a>
                <ul class="sub">
                    <li class='create-category'><a href="{{$root}}/create-category">Create</a></li>
                    <li class='manage-categories'><a href="{{$root}}/manage-categories">Manage</a></li>
                    <li class='category-products'><a href="{{$root}}/category-products">Products</a></li>
                </ul>
            </li>

            <li class="sub-menu product-menu">
                <a href="{{$root}}/javascript:;" >
                    <i class="fa fa-desktop"></i>
                    <span>Product</span>
                </a>
                <ul class="sub">
                    <li class='create-product'><a href="{{$root}}/create-product">Create</a></li>
                    <li class='manage-products'><a href="{{$root}}/manage-products">Manage</a></li>
                    <li class='import-products'><a href="{{$root}}/import-products">Import</a></li>
                    <li class='associate-products'><a href="{{$root}}/associate-products">Associate</a></li>
                    <li class='similar-products'><a href="{{$root}}/similar-products">Similar</a></li>
                    <li class='package-products'><a href="{{$root}}/package-products">Package</a></li>
                </ul>
            </li>

            <li class="sub-menu">
                <a href="{{$root}}/javascript:;" >
                    <i class="fa fa-book"></i>
                    <span>Extra Pages</span>
                </a>
                <ul class="sub">
                    <li><a href="{{$root}}/blank.html">Blank Page</a></li>
                    <li><a href="{{$root}}/login.html">Login</a></li>
                    <li><a href="{{$root}}/lock_screen.html">Lock Screen</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="{{$root}}/javascript:;" >
                    <i class="fa fa-tasks"></i>
                    <span>Forms</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{$root}}/form_component.html">Form Components</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="{{$root}}/javascript:;" >
                    <i class="fa fa-th"></i>
                    <span>Data Tables</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{$root}}/basic_table.html">Basic Table</a></li>
                    <li><a  href="{{$root}}/responsive_table.html">Responsive Table</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="{{$root}}/javascript:;" >
                    <i class=" fa fa-bar-chart-o"></i>
                    <span>Charts</span>
                </a>
                <ul class="sub">
                    <li><a  href="{{$root}}/morris.html">Morris</a></li>
                    <li><a  href="{{$root}}/chartjs.html">Chartjs</a></li>
                </ul>
            </li>

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<span style="visibility: hidden" id='root' rel="{{$root}}"></span>