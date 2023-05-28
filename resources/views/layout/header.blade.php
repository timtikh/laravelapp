<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

                <li><a href="#" class="nav-link px-2 link-secondary">Главная</a></li>
                <li><a href="{{route('products.index')}}" class="nav-link px-2 link-dark">Товары</a></li>

                @auth
                    <li><a href="{{route('cart.index')}}" class="nav-link px-2 link-dark">Корзина</a></li>
                    <li><a href="{{route('orders.index')}}" class="nav-link px-2 link-dark">Заказы</a></li>
                    @can('product.destroy')
                        <li><a href="{{route('user.index')}}" class="nav-link px-2 link-dark">Пользователи</a></li>
                    @endcan
                @endauth

            </ul>

            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" class="rounded-circle" width="32" height="32">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    @guest
                        <li><a class="dropdown-item" href="{{ route('login') }}">Войти</a></li>
                    @else
                        <li><a class="dropdown-item" href="#">Профиль</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit">Выйти</button>
                            </form>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </div>
</header>
