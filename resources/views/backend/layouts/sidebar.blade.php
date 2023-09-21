<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link" style="padding-bottom: 30px !important;">
        <img src="@if (systemSetting()->app_logo != null) {{ asset('/storage/uploads/files/' . systemSetting()->app_logo) }}
        @else {{ url('images/logo.jpg') }} @endif"
            alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light {{ setFont() }}" style="font-size: 22px;">
            @if (systemSetting())
                {{ getLan() == 'np' ? systemSetting()->app_short_name_np : systemSetting()->app_short_name }}
            @else
                {{ trans('message.pages.common.app_short_name') }}
            @endif
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @if (isset(userInfo()->image))
                <div class="image">
                    <img src="{{ asset('/storage/' . userProfilePath() . userInfo()->image) }}"
                        class="img-circle elevation-2" alt="User Image">
                </div>
            @else
                <div class="image">
                    <img src="{{ url('/images/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
            @endif
            <div class="info">
                <a href="{{ url('my-profile') }}" class="d-block">
                    @if (isset(userInfo()->full_name))
                        {{ userInfo()->full_name }}
                    @endif
                </a>
            </div>
        </div>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar {{ setFont() }}" type="search"
                    placeholder="{{ trans('common.menu_search') }}" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <hr style="border-color: #4f5962;">

        <?php
        $firstLevelMenus = \App\Repositories\Roles\MenuRepository::getMenu($id = 0);
        $secondLevelMenus = \App\Repositories\Roles\MenuRepository::getMenu($id = session('menuId'));
        $menus = \App\Repositories\Roles\MenuRepository::getMenus();
        
        ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            //get controller name
            session(['second_menu' => false]);
            
            function activeTabHome($controllerName, $parentMenu = 0)
            {
                $action = app('request')
                    ->route()
                    ->getAction();
                $controller = class_basename($action['controller']);
            
                [$controller, $action] = explode('@', $controller);
            
                // get menu link
                $menuLink = \App\Repositories\Roles\MenuRepository::getMenuLink($controller);
            
                if ($menuLink) {
                    if ($parentMenu != 0 && $menuLink->parent_id == $parentMenu) {
                        session(['second_menu' => true]);
                    } else {
                        session(['second_menu' => false]);
                    }
                }
            
                echo $controllerName == $controller ? 'active' : null;
            }
            ?>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link <?php activeTabHome('HomeController'); ?>">

                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="{{ setFont() }}">
                            {{ trans('message.dashboard.page_title') }}
                        </p>
                    </a>
                </li>
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if (count($firstLevelMenus) > 0)
                    @foreach ($menus as $menu)
                        @if ($menu->parent_id == 0)
                            <?php
                            $secondLevelMenus = \App\Repositories\Roles\MenuRepository::getMenu($menu->id);
                            ?>

                            @if (count($secondLevelMenus) > 0)
                                <?php
                                
                                $action = app('request')
                                    ->route()
                                    ->getAction();
                                $controller = class_basename($action['controller']);
                                
                                [$controller, $action] = explode('@', $controller);
                                // get menu link
                                $menuLink = \App\Repositories\Roles\MenuRepository::getMenuLink($controller);
                                
                                ?>

                                <li class="nav-item has-treeview <?php
                                
                                if ($menuLink) {
                                    if ($menuLink->parent_id == $menu->id) {
                                        echo ' menu-open';
                                    } else {
                                        echo '';
                                    }
                                }
                                
                                ?> ">

                                    <a href="#" class="nav-link ">
                                        <i class="{!! $menu->menu_icon !!}" aria-hidden="true"></i>
                                        &nbsp;
                                        <p class="{{ setFont() }}">
                                            @if (getLan() == 'en')
                                                {{ $menu->menu_name }}
                                            @else
                                                {{ $menu->menu_name_np }}
                                            @endif
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview">

                                        @foreach ($secondLevelMenus as $secondLevelMenu)
                                            <li class="nav-item">
                                                <a href="{{ url("$secondLevelMenu->menu_link") }}"
                                                    class="nav-link <?php activeTabHome($secondLevelMenu->menu_controller, $secondLevelMenu->parent_id); ?>">
                                                    <i class="{!! $secondLevelMenu->menu_icon !!}" aria-hidden="true"></i>
                                                    &nbsp;
                                                    <p class="{{ setFont() }}">
                                                        @if (getLan() == 'en')
                                                            {{ $secondLevelMenu->menu_name }}
                                                        @else
                                                            {{ $secondLevelMenu->menu_name_np }}
                                                        @endif

                                                    </p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>

                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ url($menu->menu_link) }}" class="nav-link <?php activeTabHome($menu->menu_controller); ?>">
                                        <i class="{!! $menu->menu_icon !!}" aria-hidden="true"></i>
                                        &nbsp;
                                        <p class="{{ setFont() }}">
                                            @if (getLan() == 'en')
                                                {{ $menu->menu_name }}
                                            @else
                                                {{ $menu->menu_name_np }}
                                            @endif
                                        </p>
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
