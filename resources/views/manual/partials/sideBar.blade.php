@aware(['baseRoute' => ''])

<!-- Start Page Vertical Header -->
<header id="header">
    <div class="vertical-nav" id="sidebar">
        <div class="position-relative">
            <!-- Toggle button -->
            <button id="sidebarCollapse" class="btn rounded-start-0 rounded-end-pill opened position-absolute top-0 start-100 ps-3" style="background-color: var(--first-color);" onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))" aria-label="sidebar">
                <svg width="30" height="30" viewBox="0 0 100 100">
                    <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                    <path class="line line2" d="M 20,50 H 80" />
                    <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                </svg>
            </button>

        </div>
        <div class="py-4 px-3 mb-2 mt-2">
            <div id="half">
                <a class="navbar-brand" href="">
                    <img src="{{ asset('assets/logo/ELeiloes-simbolo-cor.png') }}" alt="Ecléctica Logo" height="50px">
                </a>
                <h5 class="text-light fw-bold mt-3">Manual do Utilizador</h5>
                <div class="bg-secondary" style="height: 2px;"></div>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="/manual" class="nav-link ps-4 d-flex justify-content-between {{ $baseRoute == '/manual' ? 'active' : '' }}">
                    <div><i class="bi bi-info-circle-fill me-1"></i> Overview</div>

                </a>
            </li>
            <li class="nav-item">
                <a href="/manual/clientes" class="nav-link ps-4 d-flex justify-content-between {{ $baseRoute == '/manual/clientes' ? 'active' : '' }}">
                    <div><i class="fa-solid fa-circle-user me-1"></i> Clientes</div>
                </a>
            </li>
            <li class="nav-item">
                <a href="/manual/leiloes" class="nav-link ps-4 d-flex justify-content-between {{ $baseRoute == '/manual/leiloes' ? 'active' : '' }}">
                    <div><i class="fa-solid fa-gavel me-1"></i> Leilões</div>
                </a>
            </li>
            <li class="nav-item">
                <a href="/manual/lotes" class="nav-link ps-4 d-flex justify-content-between {{ $baseRoute == '/manual/lotes' ? 'active' : '' }}">
                    <div><i class="fa-solid fa-book me-1"></i> Lotes</div>
                </a>
            </li>
            <li class="nav-item">
                <a href="/manual/contratos" class="nav-link ps-4 d-flex justify-content-between {{ $baseRoute == '/manual/contratos' ? 'active' : '' }}">
                    <div><i class="fa-solid fa-file-contract me-1"></i> Contratos</div>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="#" class="nav-link ps-4 d-flex justify-content-between ">
                    <div><i class="fa-solid fa-money-bill me-1"></i> Pagamentos</div>
                </a>
            </li> -->
            <li class="nav-item">
                <a href="/manual/verbetes" class="nav-link ps-4 d-flex justify-content-between {{ $baseRoute == '/manual/verbetes' ? 'active' : '' }}">
                    <div><i class="fa-solid fa-spell-check me-1"></i> Verbetes</div>
                </a>
            </li>
        </ul>
        <div class="dropdown dropup position-absolute bottom-0 p-3 w-100">

            <div class="bg-secondary" style="height: 2px;"></div>
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle p-3" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="fs-6"><i class="bi bi-person-fill-gear"></i>
                    <strong>{{ ucwords(auth()->user()->username) }}</strong></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li>
                    <button type="submit" class="dropdown-item ps-4" form="form_logout"><i class="bi bi-box-arrow-right me-1"></i>Log out</button>
                </li>
            </ul>
        </div>
        <form method="POST" action="/logout" id="form_logout">
            @csrf
            @method('DELETE')
        </form>

    </div>
</header> <!-- End Page Vertical Header -->