        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background-color: hsl(230, 83%, 43%) !important; color: white;">
            <div class="app-brand demo" style="background-color: hsl(230, 83%, 43%) !important">
                <a href="{{ route('dashboard') }}" class="app-brand-link m-auto">
                    <span class="app-brand-logo demo">
                        <div class="d-flex flex-column align-items-center">
                            <img src="https://blueraycargo.id/wp-content/uploads/2023/07/Blueray-Cargo-01-768x139.png" alt="Donor Darah Logo" style="height: 40px; width: auto;">
                        </div>
                    </span>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1 mt-3 border-top">
                <!-- Dashboard -->
                <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="menu-link text-white">
                        <i class="menu-icon tf-icons bx bxs-home"></i>
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                </li>
                <!-- Users -->
                <li class="menu-item {{ Route::is('users*') ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="menu-link text-white">
                        <i class="menu-icon tf-icons bx bxs-user"></i>
                        <div data-i18n="Users">Pengguna</div>
                    </a>
                </li>
                <!-- Shipment -->
                <li class="menu-item {{ Route::is('shipment*') ? 'active' : '' }}">
                    <a href="{{ route('shipment.index') }}" class="menu-link text-white">
                        <i class="menu-icon tf-icons bx bxs-box"></i>
                        <div data-i18n="Users">Shipment</div>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- / Menu -->
