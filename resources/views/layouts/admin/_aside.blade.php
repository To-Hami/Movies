<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="{{auth()->user()->image_path}}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            <p class="app-sidebar__user-designation">{{ auth()->user()->roles->first()->name }}</p>
        </div>
    </div>

    <ul class="app-menu">

        <li><a class="app-menu__item {{ request()->is('*home*') ? 'active' : '' }}" href="{{ route('admin.home') }}"><i class="app-menu__icon fa fa-home"></i> <span class="app-menu__label">@lang('site.home')</span></a></li>

{{--        roles--}}
        @if (auth()->user()->hasPermission('read_roles'))
            <li><a class="app-menu__item {{ request()->is('*roles*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}"><i class="app-menu__icon fa fa-lock"></i> <span class="app-menu__label">@lang('roles.roles')</span></a></li>
        @endif

{{--        admins--}}
        @if (auth()->user()->hasPermission('read_admins'))
            <li><a class="app-menu__item {{ request()->is('*admins*') ? 'active' : '' }}" href="{{ route('admin.admins.index') }}"><i class="app-menu__icon fa fa-users"></i> <span class="app-menu__label">@lang('admins.admins')</span></a></li>
        @endif

{{--        --}}{{--users--}}
        @if (auth()->user()->hasPermission('read_users'))
            <li><a class="app-menu__item {{ request()->is('*users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"><i class="app-menu__icon fa fa-user"></i> <span class="app-menu__label">@lang('users.users')</span></a></li>
        @endif


        {{--        --}}{{--settings--}}
                @if (auth()->user()->hasPermission('read_settings'))
                    <li class="treeview {{ request()->is('*settings*') ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">@lang('settings.settings')</span><i class="treeview-indicator fa fa-angle-right"></i></a>

                        <ul class="treeview-menu">
                            <li><a class="treeview-item" href="{{ route('admin.settings.general') }}"><i class="icon fa fa-circle-o"></i>@lang('settings.general')</a></li>
                        </ul>
                    </li>
                @endif



        {{--profile--}}
                <li class="treeview {{ request()->is('*profile*') || request()->is('*password*')  ? 'is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-circle"></i><span class="app-menu__label">@lang('users.profile')</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="treeview-item" href="{{ route('admin.profile.edit') }}"><i class="icon fa fa-circle-o"></i>@lang('users.edit_profile')</a></li>
                        <li><a class="treeview-item" href="{{ route('admin.profile.password.edit') }}"><i class="icon fa fa-circle-o"></i>@lang('users.change_password')</a></li>
                    </ul>
                </li>

{{--        --}}{{--genres--}}
{{--        @if (auth()->user()->hasPermission('read_genres'))--}}
{{--            <li><a class="app-menu__item {{ request()->is('*genres*') ? 'active' : '' }}" href="{{ route('admin.genres.index') }}"><i class="app-menu__icon fa fa-list"></i> <span class="app-menu__label">@lang('genres.genres')</span></a></li>--}}
{{--        @endif--}}

{{--        --}}{{--movies--}}
{{--        @if (auth()->user()->hasPermission('read_movies'))--}}
{{--            <li><a class="app-menu__item {{ request()->is('*movies*') ? 'active' : '' }}" href="{{ route('admin.movies.index') }}"><i class="app-menu__icon fa fa-film"></i> <span class="app-menu__label">@lang('movies.movies')</span></a></li>--}}
{{--        @endif--}}

{{--        --}}{{--actors--}}
{{--        @if (auth()->user()->hasPermission('read_actors'))--}}
{{--            <li><a class="app-menu__item {{ request()->is('*actors*') ? 'active' : '' }}" href="{{ route('admin.actors.index') }}"><i class="app-menu__icon fa fa-address-book-o"></i> <span class="app-menu__label">@lang('actors.actors')</span></a></li>--}}
{{--        @endif--}}



    </ul>
</aside>
