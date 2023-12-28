<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                    <li>
                        <a href="{{ route('dashboard'); }}" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('clientes.index'); }}" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                            <span>Clientes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cargas.index'); }}" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">3</span>
                            <span>Cargas</span>
                        </a>
                    </li>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
