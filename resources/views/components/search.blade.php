<form class="form-inline" method="get" action="{{ route('search') }}">
    <div class="input-group">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="q" required>
        <div class="input-group-append">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </div>
    </div>
</form>
