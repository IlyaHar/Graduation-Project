<div class="container">
    <header class="d-flex flex-wrap justify-content-center align-items-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="/storage/images/cat.png" alt="logo">
            <span class="fs-4 mx-3">Уберем все <br>лишнее из ссылки!</span>
        </a>
        <ul class="nav nav-pills fs-6">
            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link text-secondary">Главная</a></li>
            <li class="nav-item"><a href="{{ route('about') }}" class="nav-link text-secondary">Про нас</a></li>
            <li class="nav-item"><a href="{{ route('contacts.index') }}" class="nav-link text-secondary">Контакты</a></li>
            @guest()
            <li class="nav-item"><a href="{{ route('auth.index') }}" class="nav-link text-secondary">Войти</a></li>
            @endguest
            @auth()
                <li class="nav-item"><a href="{{ route('auth.user') }}" class="nav-link text-secondary">Личный кабинет</a></li>
            @endauth
        </ul>
    </header>
</div>
