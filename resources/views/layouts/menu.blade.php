<li class="nav-item">
<<<<<<< HEAD
    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? " active" : null}}">
=======
    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? "active" : null}}">
>>>>>>> 0023d8cc7e91667d0dc8c6f56aa46ab09d9e2e51
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
<<<<<<< HEAD
    <a href="{{ route('leads') }}" class="nav-link {{ request()->routeIs('leads') ? " active" : null}}">
        <i class="nav-icon fas fa-columns"></i>
        <p>Leads</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('sanctioned.report') }}" class="nav-link {{ request()->routeIs('sanctioned.report') ? " active" : null}}">
        <i class="nav-icon fas fa-columns"></i>
        <p>Sanctioned Loan</p>
    </a>
</li>

{{--
<li class="nav-item">
    <a href="{{ route('bankcategory') }}" class="nav-link {{ request()->routeIs('bankcategory') ? " active" : null}}">
        <i class="nav-icon fas fa-columns"></i>
        <p>Bank Category</p>
    </a>
</li> --}}

@can('isAdmin')

{{-- <li class="nav-item">
    <a href="{{ route('bankcategory-upload') }}" class="nav-link {{ request()->routeIs('bankcategory-upload') ? "
        active" : null}}">
        <i class="nav-icon fas fa-columns"></i>
        <p>Bank Category Upload</p>
    </a>
</li> --}}

<li class="nav-item">
    <a href="{{ route('freelancers') }}" class="nav-link {{ request()->routeIs('freelancers') ? " active" : null}}">
        <i class="nav-icon fas fa-columns"></i>
        <p>Freelancers</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('banks') }}" class="nav-link {{ request()->routeIs('banks') ? " active" : null}}">
        <i class="nav-icon fas fa-columns"></i>
        <p>Banks</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('users') }}" class="nav-link {{ request()->routeIs('users') ? " active" : null}}">
        <i class="nav-icon fas fa-table"></i>
        <p>Users</p>
    </a>
</li>
@endcan

<li class="nav-item">
    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
        <i class="nav-icon fas fa-columns"></i>
        <p>Logout</p>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</li>
=======
    <a href="{{ route('articles.index') }}" class="nav-link {{ request()->routeIs('articles.index') ? "active" : null}}">
        <i class="nav-icon fas fa-columns"></i>
        <p>Articles</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.index') ? "active" : null}}">
        <i class="nav-icon fas fa-table"></i>
        <p>Categories</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('tags.index') }}" class="nav-link {{ request()->routeIs('tags.index') ? "active" : null}}">
        <i class="nav-icon fas fa-book"></i>
        <p>Tags</p>
    </a>
</li>

>>>>>>> 0023d8cc7e91667d0dc8c6f56aa46ab09d9e2e51
