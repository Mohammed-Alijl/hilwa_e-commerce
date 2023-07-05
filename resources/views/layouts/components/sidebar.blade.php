<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="#">
            <img src="https://hwdolive.hilwawater.sa/images/hilwa-water-logo.svg" alt="" height="80px" width="180px">
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5"
                 stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF" style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
        </a>

        <div class="sidebar-user">
            <div class="d-flex justify-content-center">
                <div class="flex-shrink-0">
                    <img src="{{URL::asset('img/avatars/avatar.png')}}" class="avatar img-fluid rounded me-1" alt="Administrator" />
                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        Administrator
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
                        <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="settings"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="align-middle me-2" data-feather="log-out"></i> Log out</a>
                    </div>

                    <div class="sidebar-user-subtitle">Administrator</div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header"></li>
            <li class="sidebar-item active">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboards</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar">
                    <li class="sidebar-item active"><a class="sidebar-link" href="#">Dashboard 1</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Dashboard 2</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2" data-feather="shopping-bag"></i> <span class="align-middle">Orders</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2" data-feather="users"></i> <span class="align-middle">Customers</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2" data-feather="truck"></i> <span class="align-middle">Drivers</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#multi" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="file-text"></i> <span class="align-middle">Reports</span>
                </a>
                <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a data-bs-target="#customers" data-bs-toggle="collapse" class="sidebar-link collapsed">Customers</a>
                        <ul id="customers" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Customer Location</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#driver" data-bs-toggle="collapse" class="sidebar-link collapsed">Driver Report</a>
                        <ul id="driver" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Active Driver</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Drivers Status</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Assign Driver Order</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#finance" data-bs-toggle="collapse" class="sidebar-link collapsed">Finance</a>
                        <ul id="finance" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Cash on hand</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#marketing" data-bs-toggle="collapse" class="sidebar-link collapsed">Marketing</a>
                        <ul id="marketing" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Abandoned Cart</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Campaings Summary</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Coupon Report</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Points Report</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Featured</a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#sales" data-bs-toggle="collapse" class="sidebar-link collapsed">Sales</a>
                        <ul id="sales" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Sales Report</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Driver Daily Summary</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Purchased Products</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Sales By Hour</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Sales Return</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Top Customer Sales</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">One Time Customer</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Products Stock Level</a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#others" data-bs-toggle="collapse" class="sidebar-link collapsed">Others</a>
                        <ul id="others" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Gift card usage</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Timeslot</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2 fas fa-fw fa-address-card"></i> <span class="align-middle">Contact Request</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2" data-feather="star"></i> <span class="align-middle">Driver Rating</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2 fas fa-fw fa-list"></i> <span class="align-middle">Categories</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2 fab fa-fw fa-product-hunt"></i> <span class="align-middle">Products</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2 fas fa-fw fa-align-center"></i> <span class="align-middle">Attribute</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2 fas fa-fw fa-comments"></i> <span class="align-middle">Comments</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="target"></i> <span class="align-middle">Pre Sales</span>
                </a>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Customers</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#marketing" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="target"></i> <span class="align-middle">Marketing</span>
                </a>
                <ul id="marketing" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Advertisement</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Marketing</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Gift Vouchers</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Coupons</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Rewards</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Notification</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#definitions" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="check-square"></i> <span class="align-middle">Definitions</span>
                </a>
                <ul id="definitions" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Users</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Roles</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Time Slots</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Units</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Stores</a></li>
                    <li class="sidebar-item">
                        <a data-bs-target="#location" data-bs-toggle="collapse" class="sidebar-link collapsed">Location Management</a>
                        <ul id="location" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">Zone</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#system" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="hard-drive"></i> <span class="align-middle">System</span>
                </a>
                <ul id="system" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Settings</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Logs</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Pages</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#system" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="plus-square"></i> <span class="align-middle">Others</span>
                </a>
                <ul id="system" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Payment Services</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Return Products</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">Holidays</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
