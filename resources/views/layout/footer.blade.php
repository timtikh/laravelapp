<footer class="py-3 my-4">

    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Главная</a></li>

        @auth
            <li class="nav-item"><a href="{{route('products.index')}}" class="nav-link px-2 text-muted">Товары</a></li>
        @endauth

    </ul>

    <p class="text-center text-muted">© 2023 Laravel App, Inc</p>
</footer>
