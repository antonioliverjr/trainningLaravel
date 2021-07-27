<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="stylesheet" href="{{url('assets/bootstrap/css/bootstrap.min.css')}}">
    <script src=".public/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <section>
    <div id="cadastro">
        <h3 class="text-center text-blue pt-5">@if(isset($user)) Editar usuário @else Cadastrar Usuário @endif</h3>
        <div class="container">
            <div id="cadastro-row" class="row justify-content-center align-items-center">
                <div id="cadastro-column" class="col-md-6">
                    <div id="cadastro-box" class="col-md-12">
                        @if(isset($user))
                            <form id="editar-form" class="form" action="{{url("User/$user->id")}}" method="post">
                            @method('PUT')
                        @else
                            <form id="cadastro-form" class="form" action="{{url("User/")}}" method="post">
                        @endif    
                            @csrf
                            <h3 class="text-center text-info">Cadastro</h3>
                            @if(isset($errors) && count($errors)>0)
                                <div class="text-center mt-4 mb-4 p-2 alert-danger">
                                    @foreach($errors->all() as $erro)
                                        {{$erro}}<br>
                                    @endforeach
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="name" class="text-info">Nome:</label><br>
                                <input type="text" name="name" id="name" class="form-control" value="{{$user->name ?? ''}}">
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">E-mail:</label><br>
                                <input type="email" name="email" id="email" class="form-control" value="{{$user->email ?? ''}}">
                            </div>
                            <div class="form-group">
                                <label for="id_roles" class="text-info">Nível de Permissão</label>
                                <select class="custom-select" name="id_roles">
                                    <option value="{{$user->relRoles->id ?? ''}}">{{$user->relRoles->function ?? 'Permissão'}}</option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->function}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">@if(isset($user)) Nova senha: @else Senha: @endif</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md text-center" value="@if(isset($user)) Atualizar @else Cadastrar @endif">
                            </div>
                            <div id="return-link" class="text-right">
                                <a href="{{url("User")}}" class="text-info">Voltar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
</body>
</html>