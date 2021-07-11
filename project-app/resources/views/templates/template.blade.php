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
                    <a href="{{url("Books")}}" class="nav-link">LIVROS</a>
                    </li>
                </ul>          
                </div>
                <div class="nav-item text">
                    <div id="logout-link" class="text-right nav-link">
                        <a href="{{url("/Logout")}}" class="nav-link nav-brand navbar-brand" style="font-size: 15px">SAIR</a>
                    </div>
                </div>
            </div>
        </nav>
    </main>
    @yield('content')
    <footer class="text-center modal-footer bg-dark text-white">
    <p>Desenvolvedor Antonio Batista de Oliveira Junior<i class="far fa-copyright"></i></p>
    </footer>

    <script src="https://kit.fontawesome.com/ff27582da3.js" crossorigin="anonymous"></script>
</body>
</html>