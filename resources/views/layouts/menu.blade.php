@if (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a href="{{ route('items.index') }}" class="nav-link {{ Request::is('items*') ? 'active' : '' }}">
            <i class="fa fa-cubes"></i>
            <p>Items</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('categories.index') }}" class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
            <i class="fa fa-cogs"></i>
            <p>Categories</p>
        </a>
    </li>
@endif
<li class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownStocks" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-database"></i>
        <p>Stocks</p>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownStocks">
        <a href="{{ route('stocks.index') }}" class="dropdown-item {{ Request::is('stocks*') ? 'active' : '' }}">
            Stock List
        </a>
        @if (Auth::user()->role == 'admin')
            <a href="{{ route('stocks.create') }}"
                class="dropdown-item {{ Request::is('stocks/create') ? 'active' : '' }}">
                Add Stock
            </a>
        @endif

    </div>
</li>
@if (Auth::user()->role =='admin')

<li class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownRestocks" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-cart-plus"></i>
        <p>Restocks</p>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownRestocks">
        <a href="{{ route('restocks.index') }}" class="dropdown-item {{ Request::is('restocks*') ? 'active' : '' }}">
            Restock List
        </a>
        <a href="{{ route('restocks.create') }}"
            class="dropdown-item {{ Request::is('restocks/create') ? 'active' : '' }}">
            Add Restock
        </a>
    </div>
</li>
@endif

<li class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownRequisitions" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-shopping-basket"></i>
        <p>Requisitions</p>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownRequisitions">
        <a href="{{ route('requisitions.index') }}"
            class="dropdown-item {{ Request::is('requisitions*') ? 'active' : '' }}">
            Requisition List
        </a>
        <a href="{{ route('requisitions.create') }}"
            class="dropdown-item {{ Request::is('requisitions/create') ? 'active' : '' }}">
            Place Request
        </a>
    </div>
</li>
@if (Auth::user()->role=='admin')

<li class="nav-item">
    <a href="{{ route('stockHistories.index') }}"
        class="nav-link {{ Request::is('stockHistories*') ? 'active' : '' }}">
        <i class="fa fa-archive "></i>
        <p>Stock Histories</p>
    </a>
</li>
@endif
