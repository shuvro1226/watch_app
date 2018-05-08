<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('watches.index')}}"><i class="far fa-clock"></i> Watches</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('watches.create')}}"><i class="fas fa-plus"></i> Add new watch</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="{{route('watches.filter')}}">
            @csrf
            <input type="search" class="form-control mr-sm-2" name="sku" placeholder="Insert SKU" aria-label="Search" />
            <button type="submit" class="btn btn-outline-success my-2 my-sm-0"><i class="fas fa-search"></i> Find Watch</button>
        </form>
    </div>
</nav>