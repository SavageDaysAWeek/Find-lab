<nav class="navbar navbar-horizontal navbar-expand-lg navbar-dark bg-default py-2">
    <div class="container my-0">
        <a class="navbar-brand text-white d-flex align-items-center" href="/">
            <i class="ni ni-compass-04 ni-2x mr-2"></i>
            <span>Find lab</span> 
        </a>
        
        <a class="nav-link text-white ml-md-5" href="/docs">
            <i class="ni ni-zoom-split-in mr-1"></i>
            Найти <span class="d-none d-md-inline">документ</span>
        </a>
        <a class="nav-link text-white mr-sm-auto mr-md-5" href="/orders">
            <i class="ni ni-support-16 mr-1"></i>
            Помочь <span class="d-none d-md-inline">другим</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-default">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="javascript:void(0)">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            
            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-icon" @if (Auth::check()) href="#" id="navbar-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @else href="/login" @endif>
                        @if (Auth::guest())
                        <i class="ni ni-single-02 mr-1"></i>
                        Войти
                        @else
                        <img src="{{ Auth::user()->photo_rec }}" class="mr-2 rounded" alt="...">
                        {{ Auth::user()->last_name }} {{ Auth::user()->first_name }}
                        @endif
                    </a>
                    @if (Auth::check())
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-dropdown">
                        <a class="dropdown-item" href="/profile">
                            <i class="ni ni-circle-08 mr-1"></i>
                            Профиль
                        </a>
                        <a class="dropdown-item" href="/add">
                            <i class="ni ni-cloud-upload-96 mr-1"></i>
                            Добавить работу
                        </a>
                        <a class="dropdown-item" href="/order">
                            <i class="ni ni-hat-3 mr-1"></i>
                            Заказать работу
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="ni ni-button-power mr-1"></i>
                            Выйти
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>