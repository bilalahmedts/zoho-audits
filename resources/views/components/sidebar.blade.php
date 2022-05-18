<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-header">ZOHO AUDITS</li>
        
        <li class="nav-item">
            <a href="{{ route('audits.create') }}" class="nav-link {{ request()->is('audits/create') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                    Create Zoho Audit
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('audits.index') }}" class="nav-link {{ request()->is('audits') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    View Zoho Audits
                </p>
            </a>
        </li>
        @if (in_array(Auth::user()->roles[0]->name, ['Super Admin','Director','Manager', 'Team Lead']))
        <li class="nav-item">
            <a href="{{ route('audits.audit-report') }}" class="nav-link {{ request()->is('audits/audit-report') ? 'active' : '' }}">
                <i class="far fa-file nav-icon"></i>
                <p>View Report</p>
            </a>
        </li>
        @endif
        @if (in_array(Auth::user()->roles[0]->name, ['Super Admin']))
        <li class="nav-item {{ request()->is('users','roles') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->is('users','roles') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Users Management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('roles') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>
                @endif
            </ul>
</nav>