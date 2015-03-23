<div class="wrapper">
    <div class="page">
        <div class="header-container">
            <div class="header">
                <div class="header-left">
                    <div class="header-left logo">
                        <a class="logo menu-heading menu-heading1" href="#">{{HTML::image(asset("/public/img/header/logo_header.png"))}}</a>
                    </div>
                    <ul class="header-left navigation-bar main-nav">
                        <li class="menu-heading">{{HTML::link('/women', 'women', array('class'=>'menu-heading'))}}
                            <ul class="sub-menu menu-ovr ">
                                <li>
                                    <ul>
                                        <li>{{HTML::link('/women/whats-new', "What's New")}}</li>
                                        <li>{{HTML::link('/women/one-too-many', "One 2 Many")}}</li>
                                    </ul>
                                </li>
                                <li>{{HTML::link('/women/tops', 'Tops')}}
                                    <ul>
                                        <li>{{HTML::link('/women/tops/bras', "Bras")}}</li>
                                        <li>{{HTML::link('/women/tops/tanks-tops', "Tanks/Tops")}}</li>
                                        <li>{{HTML::link('/women/tops/jackets', "Jackets")}}</li>
                                    </ul>
                                </li>
                                <li>{{HTML::link('/women/bottoms', 'Bottoms')}}
                                    <ul>
                                        <li>{{HTML::link('/women/bottoms/pants', "Pants")}}</li>
                                        <li>{{HTML::link('/women/bottoms/leggings', "Leggings")}}</li>
                                        <li>{{HTML::link('/women/bottoms/crops', "Crops")}}</li>
                                        <li>{{HTML::link('/women/bottoms/shorts', "Shorts")}}</li>
                                    </ul>
                                </li>
                                <li>{{HTML::link('/women/accessories', 'Accessories')}}
                                    <ul>
                                        <li>{{HTML::link('/women/accessories/head-bands', "Head Bands")}}</li>
                                        <li>{{HTML::link('/women/accessories/yoga-mats', "Yoga Mats")}}</li>
                                        <li>{{HTML::link('/women/accessories/yoga-towels', "Yoga Towels")}}</li>
                                        <li>{{HTML::link('/women/accessories/yoga-flops', "Yoga Flops")}}</li>
                                        <li>{{HTML::link('/women/accessories/namaskar-bracelets', "Namaskár Bracelets")}}</li>
                                    </ul>
                                </li>
                            </ul>

                        </li>
                        <li class="menu-heading">{{HTML::link('/men', 'men', array('class'=>'menu-heading'))}}
                            <ul class="sub-menu menu-ovr second-list">
                                <li>
                                    <ul>
                                        <li>{{HTML::link('/men/whats-new', "What's New")}}</li>
                                        <li>{{HTML::link('/men/top-sellers', 'Top Sellers')}}</li>
                                    </ul>
                                </li>

                                <li>{{HTML::link('/men/tops', 'Tops')}}
                                    <ul>
                                        <li>{{HTML::link('/men/tops/tees', 'Tees')}}</li>
                                        <li>{{HTML::link('/men/tops/jackets', 'Jackets')}}</li>
                                    </ul>
                                </li>
                                <li>{{HTML::link('/women/bottoms', 'Bottoms')}}
                                    <ul>
                                        <li>{{HTML::link('/men/bottoms/shorts', 'Shorts')}}</li>
                                        <li>{{HTML::link('/men/bottoms/pants', 'Pants')}}</li>
                                    </ul>
                                </li>
                                <li>{{HTML::link('/women/accessories', 'Accessories')}}
                                    <ul>
                                        <li>{{HTML::link('/men/accessories/yoga-mats', 'Yoga Mats')}}</li>
                                        <li>{{HTML::link('/men/accessories/yoga-towels', 'Yoga Towels')}}</li>
                                        <li>{{HTML::link('/men/accessories/namaskar-bracelets', 'Namaskár Bracelets')}}</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="f-right header-right">
                    <div class="right-top r-align">
                        <ul class="shipping-menu tr-menu">
                            <li class="free-shipping">
                        <span>Free shipping to US and Canada
                            <span>
                                {{HTML::image(asset("/public/img/header/usa.png"))}}
								{{HTML::image(asset("/public/img/header/canada.png"))}}
								{{HTML::image(asset("/public/img/header/globe.png"))}}
                            </span>
                        </span>
                            </li>
                            <li data-blockid="help-new">
                                <a href="#">Help</a>
                                <span>|</span>
                                <ul style="left: -87px;" class="sub-menu l-align cms-header-link">
                                    <li class="blank"></li>
                                    <li data-blockid="faq" style="padding-top: 16px;">{{HTML::link('/help#faq', 'FAQ')}}</li>
                                    <li data-blockid="shipping-returns">{{HTML::link('/help#shipping-returns', 'Shipping and Returns')}}</li>
                                    <li data-blockid="size-chart">{{HTML::link('/help#size-chart', 'Size Chart')}}</li>
                                    <li data-blockid="product-care">{{HTML::link('/help#product-care', 'Product Care')}}</li>
                                    <li class="last" data-blockid="email-us">{{HTML::link('/help#email-us', 'Email Us')}}</li>
                                </ul>
                            </li>
                            <li><a href="#" id="welcome-name">My Account</a>
                                <ul style="left: -64px;" class="sub-menu l-align my-acnt">
                                    <li class="blank"></li>
                                    <li style="padding-top: 16px;">{{HTML::link('/sales/order/history', 'track order')}}</li>
                                    <li>{{HTML::link('/customer/account/index', 'account settings')}}</li>
                                    <li class="last">{{HTML::link('javascript:void(0)', 'Sign In', array('id' => 'signin'))}}</li>
                                </ul>
                                <span>|</span>
                            </li>
                            <li><span id="cart" class="open-cart" href="">Shopping Bag (<span
                                        class="cartitemcount">0</span>)</span></li>

                        </ul>
                    </div>
                    <div class="right-bottom-block">
                        <div class="in-bl">
                            <ul class="main-nav main-nav2">
                                <li><a class="main-heading" href="http://yogasmoga.com/our-story">ys story</a>
                                    <ul style="left:-69px;" class="sub-menu l-align cms-header-link">
                                        <li><a href="http://yogasmoga.com/our-story">Our Story</a></li>
                                        <li><a href="http://yogasmoga.com/our-core-values">Our core values</a></li>
                                        <li><a href="http://yogasmoga.com/our-ethics">Our ethics</a></li>
                                        <li><a href="http://yogasmoga.com/made-in-usa">Made in usa</a></li>
                                        <li><a href="http://yogasmoga.com/principles-of-yoga">Principles of yoga</a>
                                        </li>
                                        <li><a href="http://yogasmoga.com/namaskar">Namaskár Foundation</a></li>
                                        <li><a href="http://yogasmoga.com/press">Press</a></li>
                                    </ul>

                                </li>
                                <li><a class="main-heading" href="http://yogasmoga.com/ys-fabric-tech">ys tech</a>
                                    <ul style="left:-73px;" class="sub-menu l-align cms-header-link">
                                        <li><a href="http://yogasmoga.com/ys-fabric-tech">ys fabric tech</a></li>
                                        <li><a href="http://yogasmoga.com/ys-color-tech">ys color tech</a></li>
                                        <li><a href="http://yogasmoga.com/design-elements">ys design elements</a></li>
                                    </ul>
                                </li>
                                <li><a class="main-heading" href="http://yogasmoga.com/smogi-bucks">Smogi Bucks</a>
                                    <ul style="left:-57px;" class="sub-menu mlink l-align">
                                        <li><a href="http://yogasmoga.com/smogi-bucks">what is smogi bucks</a></li>
                                        <li><a href="http://yogasmoga.com/smogi-bucks#get-smogi-bucks">how can i get
                                                them</a></li>
                                        <li><a href="http://yogasmoga.com/smogi-bucks#smogi-bucks-balance">smogi bucks
                                                balance</a></li>
                                    </ul>
                                </li>
                                <li class="rangoli"><a id="rangoli-head" class="rangoliBlu"
                                                       href="http://yogasmoga.com/rangoli">Rangoli</a></li>
                            </ul>
                        </div>

                        <div class="search-bar in-bl">
                            <form autocomplete="off" method="get" action="http://yogasmoga.com/catalogsearch/result/"
                                  id="search_frm">
                                <input type="text" maxlength="200" watermark="Search" value="" placeholder="Search"
                                       name="q" id="search_input" class="watermark">
                                <input type="submit" style="" value="Search" class="in-bl" id="search-btn">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!----header ends here----------------------------->
        </div>

    </div>
    <div class="shopping-cart" style="height:100%;display:none;">
        <!-- ContinueShoppingBtn -->
        <div class="cont-full capstxt">
            <a class="continuelink header-left grn" id="continuelink" href="">Keep Shopping</a>
            <span class="continuelink f-right">Checkout</span>
        </div>
        <!-- ContinueShoppingBtn -->
        <div class="empty-cart">your cart is empty</div>
    </div>

</div>
<script>

    $(function () {
        var expanded = false;
        $('#cart').click(function () {
            if (!expanded) {
                $('.page').animate({'margin-left': '0px'}, {duration: 400});
                $(".shopping-cart").hide();

                expanded = true;
            }
            else {
                $('.page').animate({'margin-left': '-454px'}, {duration: 400});
                $(".shopping-cart").show();
                expanded = false;
            }
        });
    });


</script>

