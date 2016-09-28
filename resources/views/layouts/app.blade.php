<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <aside class="left-menu-aside">
        <div class="menu_dropdown">
            <dl id="menu-article">
                <dt><i class="fa fa-briefcase menu_dropdown-text" aria-hidden="true"></i> 资讯管理<i class="fa fa-caret-down menu_dropdown-arrow" aria-hidden="true"></i></dt>
                <dd>
                    <ul>
                        <li><a _href="article-list.html" data-title="资讯管理" href="javascript:void(0)">资讯管理</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-picture">
                <dt><i class="fa fa-picture-o menu_dropdown-text" aria-hidden="true"></i> 图片管理<i class="fa fa-caret-down menu_dropdown-arrow" aria-hidden="true"></i></dt>
                <dd>
                    <ul>
                        <li><a _href="picture-list.html" data-title="图片管理" href="javascript:void(0)">图片管理</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-product">
                <dt><i class="fa fa-product-hunt menu_dropdown-text" aria-hidden="true"></i> 产品管理<i class="fa fa-caret-down menu_dropdown-arrow" aria-hidden="true"></i></dt>
                <dd>
                    <ul>
                        <li><a _href="product-brand.html" data-title="品牌管理" href="javascript:void(0)">品牌管理</a></li>
                        <li><a _href="product-category.html" data-title="分类管理" href="javascript:void(0)">分类管理</a></li>
                        <li><a _href="product-list.html" data-title="产品管理" href="javascript:void(0)">产品管理</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-comments">
                <dt><i class="fa fa-comment menu_dropdown-text" aria-hidden="true"></i> 评论管理<i class="fa fa-caret-down menu_dropdown-arrow" aria-hidden="true"></i></dt>
                <dd>
                    <ul>
                        <li><a _href="http://h-ui.duoshuo.com/admin/" data-title="评论列表" href="javascript:;">评论列表</a></li>
                        <li><a _href="feedback-list.html" data-title="意见反馈" href="javascript:void(0)">意见反馈</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-member">
                <dt><i class="fa fa-users menu_dropdown-text" aria-hidden="true"></i> 会员管理<i class="fa fa-caret-down menu_dropdown-arrow" aria-hidden="true"></i></dt>
                <dd>
                    <ul>
                        <li><a _href="member-list.html" data-title="会员列表" href="javascript:;">会员列表</a></li>
                        <li><a _href="member-del.html" data-title="删除的会员" href="javascript:;">删除的会员</a></li>
                        <li><a _href="member-level.html" data-title="等级管理" href="javascript:;">等级管理</a></li>
                        <li><a _href="member-scoreoperation.html" data-title="积分管理" href="javascript:;">积分管理</a></li>
                        <li><a _href="member-record-browse.html" data-title="浏览记录" href="javascript:void(0)">浏览记录</a></li>
                        <li><a _href="member-record-download.html" data-title="下载记录" href="javascript:void(0)">下载记录</a></li>
                        <li><a _href="member-record-share.html" data-title="分享记录" href="javascript:void(0)">分享记录</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-admin">
                <dt><i class="fa fa-user menu_dropdown-text" aria-hidden="true"></i> 管理员管理<i class="fa fa-caret-down menu_dropdown-arrow" aria-hidden="true"></i></dt>
                <dd>
                    <ul>
                        <li><a _href="admin-role.html" data-title="角色管理" href="javascript:void(0)">角色管理</a></li>
                        <li><a _href="admin-permission.html" data-title="权限管理" href="javascript:void(0)">权限管理</a></li>
                        <li><a _href="admin-list.html" data-title="管理员列表" href="javascript:void(0)">管理员列表</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-tongji">
                <dt><i class="fa fa-bar-chart menu_dropdown-text" aria-hidden="true"></i> 系统统计<i class="fa fa-caret-down menu_dropdown-arrow" aria-hidden="true"></i></dt>
                <dd>
                    <ul>
                        <li><a _href="charts-1.html" data-title="折线图" href="javascript:void(0)">折线图</a></li>
                        <li><a _href="charts-2.html" data-title="时间轴折线图" href="javascript:void(0)">时间轴折线图</a></li>
                        <li><a _href="charts-3.html" data-title="区域图" href="javascript:void(0)">区域图</a></li>
                        <li><a _href="charts-4.html" data-title="柱状图" href="javascript:void(0)">柱状图</a></li>
                        <li><a _href="charts-5.html" data-title="饼状图" href="javascript:void(0)">饼状图</a></li>
                        <li><a _href="charts-6.html" data-title="3D柱状图" href="javascript:void(0)">3D柱状图</a></li>
                        <li><a _href="charts-7.html" data-title="3D饼状图" href="javascript:void(0)">3D饼状图</a></li>
                    </ul>
                </dd>
            </dl>
            <dl id="menu-system">
                <dt><i class="fa fa-tasks menu_dropdown-text" aria-hidden="true"></i> 系统管理<i class="fa fa-caret-down menu_dropdown-arrow" aria-hidden="true"></i></dt>
                <dd>
                    <ul>
                        <li><a _href="system-base.html" data-title="系统设置" href="javascript:void(0)">系统设置</a></li>
                        <li><a _href="system-category.html" data-title="栏目管理" href="javascript:void(0)">栏目管理</a></li>
                        <li><a _href="system-data.html" data-title="数据字典" href="javascript:void(0)">数据字典</a></li>
                        <li><a _href="system-shielding.html" data-title="屏蔽词" href="javascript:void(0)">屏蔽词</a></li>
                        <li><a _href="system-log.html" data-title="系统日志" href="javascript:void(0)">系统日志</a></li>
                    </ul>
                </dd>
            </dl>
        </div>
    </aside>
    <div class="dislpayArrow"><a href="javascript:void(0);" onclick="displaynavbar(this)"></a></div>
    <div class="right-content-box">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
