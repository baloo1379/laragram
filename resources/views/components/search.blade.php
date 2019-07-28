<form class="form-inline" method="get" action="{{ route('search') }}">
    <div class="input-group">
        <input class="form-control form" type="search" placeholder="Search" aria-label="Search" name="q" required>
        <div class="input-group-append">
            <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
