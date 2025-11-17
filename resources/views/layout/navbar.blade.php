<nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky-dark" id="navbar-sticky">
    <div class="container">
        <!-- LOGO -->
        <a class="logo text-uppercase" href="/">
            <img src="{{ asset('assets/images/Logo3.jpg') }}" alt="" width="80" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto navbar-center" id="mySidenav">
                <li class="nav-item">
                    <a href="{{ route('owners.index') }}" class="nav-link">Owners</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pets.index') }}" class="nav-link">Pets</a>
                </li>


            </ul>
        </div>
    </div>
</nav>