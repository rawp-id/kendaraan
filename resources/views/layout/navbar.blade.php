<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            @if ($title == 'login' || $title == 'register')
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 @if ($title == 'login') active @endif"
                            aria-current="page" href="/login">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 @if ($title == 'register') active @endif"
                            aria-current="page" href="/register">
                            Register
                        </a>
                    </li>
                </ul>
            @else
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 @if ($title == 'dashboard') active @endif"
                            aria-current="page" href="/dashboard">
                            <i class="bi bi-house-fill"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 @if ($title == 'drivers') active @endif"
                            aria-current="page" href="/drivers">
                            <i class="bi bi-person-standing"></i>
                            Driver
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 @if ($title == 'vehicles') active @endif"
                            aria-current="page" href="/vehicles">
                            <i class="bi bi-car-front"></i>
                            Vehicle
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 @if ($title == 'bookings') active @endif"
                            aria-current="page" href="/bookings">
                            <i class="bi bi-card-text"></i>
                            Booking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 @if ($title == 'approvals') active @endif"
                            aria-current="page" href="/approvals">
                            <i class="bi bi-bar-chart-fill"></i>
                            Approval
                        </a>
                    </li>
                    @if (Auth::user()->role->role == 'superadmin')
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 @if ($title == 'check') active @endif"
                                aria-current="page" href="/check">
                                <i class="bi bi-check-circle"></i>
                                Check
                            </a>
                        </li>
                    @endif
                </ul>

                <hr class="my-3">

                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="/logout">
                            <svg class="bi">
                                <use xlink:href="#door-closed" />
                            </svg>
                            Sign out
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</div>
