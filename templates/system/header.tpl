<div id="page-container" class="sidebar-l sidebar-mini sidebar-o side-scroll header-navbar-fixed enable-cookies">
    
    #SITE_MENU#

    <nav id="sidebar">
        <div id="sidebar-scroll">
            <div class="sidebar-content">

                <div class="side-header side-content bg-white-op">
                    <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="btn-group pull-right">
                        <button class="btn btn-link text-gray dropdown-toggle" data-toggle="dropdown" type="button">
                            <i class="si si-drop"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right font-s13 sidebar-mini-hide">
                            <li>
                                <a data-toggle="theme" data-theme="default" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-default pull-right"></i> <span class="font-w600">Default</span>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="theme" data-theme="{D_URL_THEMES_L}/assets/css/themes/amethyst.min.css" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-amethyst pull-right"></i> <span class="font-w600">Amethyst</span>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="theme" data-theme="{D_URL_THEMES_L}/assets/css/themes/city.min.css" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-city pull-right"></i> <span class="font-w600">City</span>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="theme" data-theme="{D_URL_THEMES_L}/assets/css/themes/flat.min.css" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-flat pull-right"></i> <span class="font-w600">Flat</span>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="theme" data-theme="{D_URL_THEMES_L}/assets/css/themes/modern.min.css" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-modern pull-right"></i> <span class="font-w600">Modern</span>
                                </a>
                            </li>
                            <li>
                                <a data-toggle="theme" data-theme="{D_URL_THEMES_L}/assets/css/themes/smooth.min.css" tabindex="-1" href="javascript:void(0)">
                                    <i class="fa fa-circle text-smooth pull-right"></i> <span class="font-w600">Smooth</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--
                    <span class="sidebar-mini-hide">
                        <a href="{D_SITEURL}">
                            <img src="{D_URL_IMAGES}/logo-small.png" title="{D_SLOGAN}" alt="{D_SLOGAN}" />
                        </a>
                    </span>
                    //-->
                </div>

                <div class="side-content">
                    <ul class="nav-main">
                        #SYSTEM_MENU#
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header id="header-navbar" class="content-mini content-mini-full">
        <!-- Navigation Right -->
        <ul class="nav-header pull-right">
            #TOP_MENU#
        </ul>

        <!-- Navigation Left -->
        <ul class="nav-header pull-left">
            <li class="hidden-md hidden-lg">
                <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                    <i class="fa fa-navicon"></i>
                </button>
            </li>
            
            <!-- Search Bar -->
            <li class="visible-xs">
                <button class="btn btn-default" data-toggle="class-toggle" data-target=".js-header-search" data-class="header-search-xs-visible" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </li>
            <li class="js-header-search header-search">
                <form id="fq" class="form-horizontal" action="{D_SITEURL}/search/" method="post">
                    <div class="form-material form-material-primary input-group remove-margin-t remove-margin-b">
                        <input class="form-control col-xs-12" type="text" id="q" name="q" maxlength="255" autocomplete="off" placeholder="{SEARCH}...">
                        <span class="input-group-addon"><i class="si si-magnifier"></i></span>
                    </div>
                </form>
            </li>
        </ul>
    </header>