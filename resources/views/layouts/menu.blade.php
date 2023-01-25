
<li class="nav-item">
    <a href="{{ route('items.index') }}"
       class="nav-link {{ Request::is('items*') ? 'active' : '' }}">
       <i class="fa fa-cubes"></i>
        <p>Items</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('categories.index') }}"
       class="nav-link {{ Request::is('categories*') ? 'active' : '' }}">
       <i class="fa fa-cogs"></i>
        <p>Categories</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('stocks.index') }}"
       class="nav-link {{ Request::is('stocks*') ? 'active' : '' }}">
       <i class="fa fa-database"></i>
        <p>Stocks</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('restocks.index') }}"
       class="nav-link {{ Request::is('restocks*') ? 'active' : '' }}">
       <i class="fa fa-cart-plus"></i>
        <p>Restocks</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('stockHistories.index') }}"
       class="nav-link {{ Request::is('stockHistories*') ? 'active' : '' }}">
       <i class="fa fa-archive "></i>
        <p>Stock Histories</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('requisitions.index') }}"
       class="nav-link {{ Request::is('requisitions*') ? 'active' : '' }}">
       <i class="fa fa-shopping-basket"></i>
        <p>Requisitions</p>
    </a>
</li>





