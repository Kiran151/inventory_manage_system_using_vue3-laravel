<div class="left-side-menu d-none" id="sidebar"
    v-show="$route.path === '/login' ||$route.path === '/register'||$route.path ==='/forgot' ? false : true ">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a class="links">
                        <router-link to="/">
                            <div class="d-flex align-items-center">
                                <div class="app-box bg-gradient-lush text-white me-2">
                                    <i class="mdi mdi-view-dashboard-outline fs-3"></i>

                                </div>
                                <span>Home</span>
                            </div>
                        </router-link>

                    </a>
                </li>
                <li>
                    <a>
                        <router-link to="/all_employee">
                            <div class="d-flex align-items-center">
                                <div class="app-box bg-gradient-cosmic text-white me-2">
                                    <i class="mdi mdi-account-tie-outline fs-3"></i>

                                </div>
                                <span>Employee</span>
                            </div>
                        </router-link>

                    </a>
                </li>

                <li>
                    <a >
                        <router-link to="/all_supplier">
                        <div class="d-flex align-items-center">

                            <div class="app-box bg-gradient-kyoto text-white me-2">
                                <i class="mdi mdi-account-convert-outline fs-3"></i>
                             </div>
                            <span> Suppliers </span>
                        </div>
                    </router-link>
                    </a>
                </li>
                <li>
                    <a>
                        <router-link to="/all_category">
                            <div class="d-flex align-items-center">
                                <div class="app-box bg-gradient-burning text-white me-2">
                                    <i class="mdi mdi-arrange-send-backward fs-3"></i>

                                </div>
                                <span>Category</span>
                            </div>
                        </router-link>

                    </a>
                </li>
                 <li>
                    <a>
                        <router-link to="/all_products">
                            <div class="d-flex align-items-center">
                                <div class="app-box bg-gradient-cosmic text-white me-2">
                                    <i class="mdi mdi-package-variant fs-3"></i>
                                </div>
                                <span>Products</span>
                            </div>
                        </router-link>

                    </a>
                </li>

                <li>
                    <a>
                        <router-link to="/all_salary">
                            <div class="d-flex align-items-center">
                                <div class="app-box bg-gradient-blues text-white me-2">
                                    <i class="mdi mdi-account-cash-outline fs-3"></i>
                                </div>
                                <span>Salary</span>
                            </div>
                        </router-link>

                    </a>
                </li>
                <li>
                    <a>
                        <router-link to="/">
                            <div class="d-flex align-items-center">
                                <div class="app-box bg-gradient-blues text-white me-2">
                                    <i class="mdi mdi-account-multiple-outline fs-3"></i>

                                </div>
                                <span>Customers</span>
                            </div>
                        </router-link>

                    </a>
                </li>
                <li>
                    <a>
                        <router-link to="/">
                            <div class="d-flex align-items-center">
                                <div class="app-box bg-gradient-cosmic text-white me-2">
                                    <i class="mdi mdi-wrench-outline fs-3"></i>

                                </div>
                                <span>Settings</span>
                            </div>
                        </router-link>

                    </a>
                </li>

                {{-- <li>
                    <a href="#sidebarEmail" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline fs-3"></i>
                        <span> Email </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmail">
                        <ul class="nav-second-level">
                            <li>
                                <a href="email-inbox.html">Inbox</a>
                            </li>
                            <li>
                                <a href="email-read.html">Read Email</a>
                            </li>
                            <li>
                                <a href="email-compose.html">Compose Email</a>
                            </li>
                            <li>
                                <a href="email-templates.html">Email Templates</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
            </ul>
        </div>
        </li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
