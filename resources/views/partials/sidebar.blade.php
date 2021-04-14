@php
    $mainChannels = \App\Models\MainChannel::all();
@endphp
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="#" style="line-height: 25px;">
                <div class="d-table m-auto">
                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;"
                         src="{{asset('assets/images/shards-dashboards-logo.svg')}}" alt="Shards Dashboard">
                    <span class="d-none d-md-inline ml-1">Админ панель</span>
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    <div class="nav-wrapper">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{(request()->is('users') || request()->is('users/*'))?'active':''}}"
                   href="{{route('users.index')}}">
                    <i class="material-icons">person</i>
                    <span>Пользователи админки</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{(request()->is('main_channels') || request()->is('main_channels/*'))?'active':''}}"
                   href="{{route('main_channels.index')}}">
                    <i class="material-icons">person</i>
                    <span>Мои каналы</span>
                </a>
            </li>
            <li class="sidebar-dropdown nav-item">
                <a href="#" class="nav-link link-icon
                    {{(request()->is('advertisings') || request()->is('advertisings/*'))
                        || (request()->is('stats') || request()->is('stats/*'))?'active':''

                    }}"
                >
                    <i class="fas fa-bullseye"></i>
                    <span>Отслеживаемые каналы</span>
                </a>
                <div class="sidebar-submenu d-none {{(request()->is('advertisings') || request()->is('advertisings/*'))
                    || (request()->is('stats') || request()->is('stats/*')) ?'d-block':''}}">
                    <ul>
                        <li class="nav-item"><a
                                class="nav-link {{(request()->is('advertisings') || request()->is('advertisings/*'))?'active':''}}"
                                href="{{route('advertisings.index')}}">Реклама </a></li>
                        <li class="sidebar-dropdown  nav-item">
                            <a class="nav-link link-icon {{(request()->is('stats') || request()->is('stats/*'))?'active':''}}"
                               href="{{route('stats.index')}}">Статистика
                            </a>
                            <div class="sidebar-submenu d-none {{(request()->is('advertisings') || request()->is('advertisings/*'))
                                || (request()->is('stats') || request()->is('stats/*')) ?'d-block':''}}">
                                <ul>
                                    @foreach($mainChannels as $channel)
                                        <li class="nav-item"><a
                                                class="nav-link {{(request()->is('stats') || request()->is('stats/*')) && request()->get('channel') == $channel->id?'active':''}}"
                                                href="{{route('stats.index','channel='.$channel->id)}}">{{$channel->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link {{(request()->is('channels') || request()->is('channels/*'))?'active':''}}"--}}
{{--                   href="{{route('channels.create')}}">--}}
{{--                    <i class="fas fa-plus"></i>--}}
{{--                    <span>Добавить канал</span>--}}
{{--                </a>--}}
{{--            </li>--}}

        </ul>
    </div>
</aside>
