<doctype! html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>Registros de Livros</title>
    <link rel="stylesheet" href="{{url('assets/bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
    <main>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                <ul class="navbar-nav text">
                    <li class="nav-brand">
                    <a class="navbar-brand" href="{{url("/")}}"><img src="{{url('storage/logo/books-records.png')}}" alt="Logo" width="50px"></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url("User")}}" class="nav-link">USUARIO</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url("Clientes")}}" class="nav-link">CLIENTES</a>
                    </li>
                    <li class="nav-item">
                    <a href="{{url("Records")}}" class="nav-link">LIVROS</a>
                    </li>
                    <li class="nav-item">
                    <a href="{{url("Books")}}" class="nav-link">VENDAS</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url("/Logout")}}" class="nav-link">SAIR</a>
                    </li>
                </ul>          
                </div>
                <div class="nav-brand nav-item">
                    <a href="{{url("/Cart")}}" class="nav-link d-flex" style="color: white"><i class="fas fa-cart-arrow-down fa-2x"></i></a>
                </div>
                <form name="searchSite" id="searchSite" method="post" action="{{url("Search")}}" class="nav-item d-flex" style="width: 250px; height: 25px" >
                    @csrf
                    <input class="form-control" type="search" name="search" id="search" placeholder="Pesquisar Livros" aria-label="Pesquisar">
                    <button class="btn btn-outline-success" type="submit" style="height: 38px"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </nav>
    </main>
    @yield('content')
    <footer class="text-center modal-footer bg-dark text-white">
    <p>Desenvolvedor Antonio Batista de Oliveira Junior<i class="far fa-copyright"></i></p>
    </footer>
    @stack('scripts')
    <script type="text-javascrit" src="/public/assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/public/assets/js/jsCartPurchase.js"></script>
    <script src="https://kit.fontawesome.com/ff27582da3.js" crossorigin="anonymous"></script>
</body>
</html>