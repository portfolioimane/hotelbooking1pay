<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.hotels.*') ? 'active' : '' }}" href="#" id="hotelsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-hotel"></i> Hotels
                </a>
                <div class="dropdown-menu" aria-labelledby="hotelsDropdown">
                    <a class="dropdown-item" href="{{ route('admin.hotels.index') }}">All Hotels</a>
                    <a class="dropdown-item" href="{{ route('admin.hotels.create') }}">Add New Hotel</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}" href="#" id="roomsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bed"></i> Rooms
                </a>
                <div class="dropdown-menu" aria-labelledby="roomsDropdown">
                    <a class="dropdown-item" href="{{ route('admin.rooms.index') }}">All Rooms</a>
                    <a class="dropdown-item" href="{{ route('admin.rooms.create') }}">Add New Room</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}" href="#" id="bookingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-calendar-check"></i> Bookings
                </a>
                <div class="dropdown-menu" aria-labelledby="bookingsDropdown">
                    <a class="dropdown-item" href="{{ route('admin.bookings.index') }}">All Bookings</a>
                    <a class="dropdown-item" href="{{ route('admin.bookings.create') }}">Add New Booking</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="#" id="usersDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-users"></i> Users
                </a>
                <div class="dropdown-menu" aria-labelledby="usersDropdown">
                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">All Users</a>
                    <a class="dropdown-item" href="{{ route('admin.users.create') }}">Add New User</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="#" id="settingsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cogs"></i> Settings
                </a>
                <div class="dropdown-menu" aria-labelledby="settingsDropdown">
                    <a class="dropdown-item" href="{{ route('admin.settings.edit') }}">Edit Settings</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>
