<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('assets/img/logo-small.png') }}">
            </div>
            </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
            Estoque
            </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            
            <li class="nav-item dropdown {{ Request::routeIs('dashboard.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}" ><i class="nc-icon nc-bank"></i><p>Dashboard</p></a>
            </li>

            <li class="nav-item dropdown {{ Request::routeIs('cliente.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('clientes.index') }}" ><i class="nc-icon nc-bank"></i><p>Clientes</p></a>
            </li>

            <li class="nav-item dropdown {{ Request::routeIs('categorias.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('categorias.index') }}" ><i class="nc-icon nc-bank"></i><p>Categoria</p></a>
            </li>

            {{-- Links de navegação com uso de `route()` para rotas nomeadas --}}
            <li class="{{ Request::routeIs('clientes.*') ? 'active' : '' }}">
                <a href="{{ route('clientes.index') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>Clientes</p>
                </a>
            </li>
            <li class="{{ Request::routeIs('vendedores.*') ? 'active' : '' }}">
                <a href="{{ route('vendedores.index') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Vendedores</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/notifications') }}"> {{-- Exemplo de URL direta --}}
                    <i class="nc-icon nc-bell-55"></i>
                    <p>Notifications</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/user') }}">
                    <i class="nc-icon nc-single-02"></i>
                    <p>User Profile</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/tables') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Table List</p>
                </a>
            </li>
            <li>
                <a href="{{ url('/typography') }}">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>Typography</p>
                </a>
            </li>
            <li class="active-pro">
                <a href="{{ url('/upgrade') }}">
                    <i class="nc-icon nc-spaceship"></i>
                    <p>Upgrade to PRO</p>
                </a>
            </li>
        </ul>
    </div>
</div>