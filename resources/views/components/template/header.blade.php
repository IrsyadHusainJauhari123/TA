<div class="header">
    <div class="logo logo-dark">
        <a href="#">
            <img src="{{ url('public') }}/KPPN.png" alt="Logo" width="190" height="50" class="mt-2">

        </a>
    </div>

    <div class="nav-wrap">
        <ul class="nav-left">
            <li class="desktop-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            <li class="mobile-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            <div class="sidebar-header font-weight-bold"
                style="display: block;background-color: #fff;color: #2A2A2A;width: 100%;padding: 0 20px;padding-left: 20px;clear: both;z-index: 10;position: relative;text-align:center;font-size: 16px;">
                SIJAGA
            </div>
        </ul>
        <ul class="nav-right">
            <li class="dropdown dropdown-animated scale-left" style="padding-left: 20px;">
                <div class="pointer" data-toggle="dropdown">
                    <div class="pull-left p-r-10 fs-14 font-heading d-lg-block d-none">
                        <span class="semi-bold" style="font-weight: 500 ;">
                            @if (auth()->check())
                                Hallo, {{ auth()->user()->nama }}
                            @endif
                            <a href="{{ url('profile') }}">
                                {{-- <img src="{{ url('public') }}/logokppn.png" alt="User Avatar"
                                    style="width: 60px; height: 60px; padding: 10px; margin: 0px; border-radius: 60%;"
                                    class="img-circle">
                                </img> --}}

                            </a>




                        </span>
                    </div>
                </div>
                <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                    <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                        <div class="d-flex m-r-25">
                            <div class="m-l-10">
                                <p class="m-b-0 text-dark font-weight-semibold">
                                    @if (Auth::check())
                                        @if (Auth::user()->level === 'admin')
                                            {{ Auth::user()->nama }}
                                        @else
                                            {{ Auth::user()->nama }}
                                        @endif
                                    @else
                                        Silahkan Masuk
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @if (Auth::check() && (Auth::user()->level === 'satker' || Auth::user()->level === 'admin'))
                        <a href="{{ url('profile') }}" class="dropdown-item d-block p-h-15 p-v-10">
                    @endif
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <i class="anticon opacity-04 font-size-16 anticon-user"></i>
                            <span class="m-l-10">Edit Profile</span>
                        </div>
                        <i class="anticon font-size-10 anticon-right"></i>
                    </div>
                    </a>
                    <a href="{{ url('logout') }}" class="dropdown-item d-block p-h-15 p-v-10">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                <span class="m-l-10">Logout</span>
                            </div>
                            <i class="anticon font-size-10 anticon-right"></i>
                        </div>
                    </a>

                </div>

            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="anticon anticon-user"></i><span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ url('profile') }}">
                            <i class="anticon anticon-user"></i> | View Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('login') }}">
                            <i class="anticon anticon-logout"></i> | Log Out
                        </a>
                    </li>

                </ul>
            </li>



        </ul>
    </div>
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('.dropdown-toggle').on('click', function() {
            $(this).next('.dropdown-menu').toggle();
        });
    });
</script>
