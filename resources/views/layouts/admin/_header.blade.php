<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" style="font-family: 'Cairo', 'sans-serif';" href="{{ route('admin.home') }}">Movies</a>

    <!-- Sidebar toggle button-->
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

    <!-- Navbar Right Menu-->
    <ul class="app-nav">

{{--        <!-- User Menu-->--}}
{{--        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-flag fa-lg"></i></a>--}}
{{--        <ul class="dropdown-menu settings-menu dropdown-menu-left">--}}
{{--        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
{{--        <li>--}}
{{--        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
{{--        {{ $properties['native'] }}--}}
{{--        </a>--}}
{{--        </li>--}}
{{--        @endforeach--}}
{{--        </ul>--}}
{{--        </li>--}}

{{--        notification--}}
{{--        <li class="dropdown" id="notifications">--}}
{{--            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications" style="position:relative;">--}}
{{--                <i class="fa fa-bell-o fa-lg"></i>--}}
{{--                <span class="badge badge-danger" id="unread-notifications-count" style="position:absolute; top: 10px; right: 5px;">10</span>--}}
{{--            </a>--}}

{{--            <ul class="app-notification dropdown-menu dropdown-menu-right">--}}

{{--                <div class="app-notification__content">--}}


{{--                    <li>--}}
{{--                        <a class="app-notification__item" href="#">--}}
{{--                                <span class="app-notification__icon">--}}
{{--                                    <span class="fa-stack fa-lg">--}}
{{--                                        <i class="fa fa-circle fa-stack-2x text-primary"></i>--}}
{{--                                        <i class="fa fa-address-book fa-stack-1x fa-inverse"></i>--}}
{{--                                    </span>--}}
{{--                                </span>--}}
{{--                            <div>--}}
{{--                                <p class="app-notification__message">Notification title</p>--}}
{{--                                <p class="app-notification__meta">2 mins ago</p>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                </div>--}}

{{--                <li class="app-notification__footer"><a href="#">@lang('site.all') @lang('notifications.notifications')</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}

        {{--languages--}}
{{--        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-flag fa-lg"></i></a>--}}
{{--            <ul class="dropdown-menu settings-menu dropdown-menu-right">--}}
{{--                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
{{--                    <li>--}}
{{--                        <a rel="alternate" hreflang="{{ $localeCode }}" class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
{{--                            {{ $properties['native'] }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </li>--}}

        {{--user menu--}}
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item" href="page-login.html" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-lg"></i>
                        @lang('site.logout')
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</header>
