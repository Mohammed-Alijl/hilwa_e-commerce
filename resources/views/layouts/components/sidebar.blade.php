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
                    <img src="{{URL::asset('img/users/' . auth()->user()->image)}}" class="avatar img-fluid rounded me-1" alt="Administrator" />
                </div>
                <div class="flex-grow-1 ps-2">
                    <a class="sidebar-user-title dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        {{auth()->user()->first_name . auth()->user()->last_name}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-start">
                        <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i>
                            {{__('Front-end/sidebar.profile')}}</a>
                        <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="settings"></i> {{__('Front-end/sidebar.settings')}}</a>
                        <div class="dropdown-divider"></div>
                        <form  method="post" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                            <i class="align-middle me-2" data-feather="log-out"></i>
                            {{__('Front-end/sidebar.logout')}}
                            </button>
                        </form>
                    </div>

                    <div class="sidebar-user-subtitle">{{auth()->user()->roles->pluck('name','name')->first()}}</div>
                </div>
            </div>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header"></li>
            <li class="sidebar-item active">
                <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">{{__('Front-end/sidebar.dashboards')}}</span>
                </a>
                <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar">
                    <li class="sidebar-item active"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.dashboard.1')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.dashboard.2')}}</a></li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2" data-feather="shopping-bag"></i> <span class="align-middle">{{__('Front-end/sidebar.orders')}}</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2" data-feather="users"></i> <span class="align-middle">{{__('Front-end/sidebar.customers')}}</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2" data-feather="truck"></i> <span class="align-middle">{{__('Front-end/sidebar.drivers')}}</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a data-bs-target="#multi" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="file-text"></i> <span class="align-middle">{{__('Front-end/sidebar.reports')}}</span>
                </a>
                <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a data-bs-target="#customers" data-bs-toggle="collapse" class="sidebar-link collapsed">{{__('Front-end/sidebar.customers')}}</a>
                        <ul id="customers" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.customers.location')}}</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#driver" data-bs-toggle="collapse" class="sidebar-link collapsed">{{__('Front-end/sidebar.driver.reports')}}</a>
                        <ul id="driver" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.active.drivers')}}</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.drivers.status')}}</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.assign.driver.order')}}</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#finance" data-bs-toggle="collapse" class="sidebar-link collapsed">{{__('Front-end/sidebar.finance')}}</a>
                        <ul id="finance" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.cash.on.hand')}}</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#marketing-reports" data-bs-toggle="collapse" class="sidebar-link collapsed">{{__('Front-end/sidebar.marketing')}}</a>
                        <ul id="marketing-reports" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.abandoned.cart')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.campaigns.summary')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.coupon.report')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.points.report')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.featured')}}</a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#sales" data-bs-toggle="collapse" class="sidebar-link collapsed">{{__('Front-end/sidebar.sales')}}</a>
                        <ul id="sales" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.sales.report')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.driver.daily.summary')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.purchased.products')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.sales.by.hour')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.sales.return')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.top.customer.sales')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.one.time.customer')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.products.stock.level')}}</a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#others" data-bs-toggle="collapse" class="sidebar-link collapsed">{{__('Front-end/sidebar.others')}}</a>
                        <ul id="others" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.gift.card.usage')}}</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.timeslots')}}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2 fas fa-fw fa-address-card"></i> <span class="align-middle">{{__('Front-end/sidebar.contact.request')}}</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2" data-feather="star"></i> <span class="align-middle">{{__('Front-end/sidebar.driver.rating')}}</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2 fas fa-fw fa-list"></i> <span class="align-middle">{{__('Front-end/sidebar.categories')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2 fab fa-fw fa-product-hunt"></i> <span class="align-middle">{{__('Front-end/sidebar.products')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2 fas fa-fw fa-align-center"></i> <span class="align-middle">{{__('Front-end/sidebar.attribute')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle me-2 fas fa-fw fa-comments"></i> <span class="align-middle">{{__('Front-end/sidebar.comments')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#ui" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="target"></i> <span class="align-middle">{{__('Front-end/sidebar.pre.sales')}}</span>
                </a>
                <ul id="ui" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.customers')}}</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#marketing" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="target"></i> <span class="align-middle">{{__('Front-end/sidebar.marketing')}}</span>
                </a>
                <ul id="marketing" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.advertisement')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.marketing')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.gift.vouchers')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.coupons')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.rewards')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.notification')}}</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#definitions" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="check-square"></i> <span class="align-middle">{{__('Front-end/sidebar.definitions')}}</span>
                </a>
                <ul id="definitions" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('users.index')}}">{{__('Front-end/sidebar.users')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.roles')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.timeslots')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.units')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.stores')}}</a></li>
                    <li class="sidebar-item">
                        <a data-bs-target="#location" data-bs-toggle="collapse" class="sidebar-link collapsed">{{__('Front-end/sidebar.location.management')}}</a>
                        <ul id="location" class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" href="#">{{__('Front-end/sidebar.zone')}}</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#system" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="hard-drive"></i> <span class="align-middle">{{__('Front-end/sidebar.system')}}</span>
                </a>
                <ul id="system" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.settings')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.logs')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.pages')}}</a></li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a data-bs-target="#other" data-bs-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle me-2" data-feather="plus-square"></i> <span class="align-middle">{{__('Front-end/sidebar.others')}}</span>
                </a>
                <ul id="other" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.payment.services')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.return.products')}}</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="#">{{__('Front-end/sidebar.holidays')}}</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
