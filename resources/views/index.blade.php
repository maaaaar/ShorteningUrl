<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>

    <!-- para que vaya bootsrap -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- CSS MIAS -->
    <!-- <link rel="stylesheet" href="{{ asset ('css/miCss.css')}}"> -->
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg bg-primary navbar-fixed-top">
        <a class="navbar-brand" href="">
            <img src="" style="height: 50px">
        </a>
        <ul class="navbar-nav mr-auto">
            <!-- <li class="nav-item ">
                <a class="nav-link text-white" href="/index"> User </a>
            </li> -->
            <!-- <li class="nav-item ">
                <a class="nav-link text-white" href="" role="button"> Analiticas </a>
            </li> -->
        </ul>
    </nav>


    <!-- form enviar url -->
    <h2 class="text-center mx-sm-3 mb-2 m-4">Sólo ingresa tu URL y clickea "Acortar"</h2>
    <form action="{{ route('acortar-url') }}" method="POST">
        <div class="form-group mx-sm-3 mb-2 m-4">
            <label for="exampleInputEmail1">URL: </label>
            <input type="url" class="form-control sm-2" name="url" aria-describedby="url" placeholder="https://www.google.es" required>
            <small id="urlHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group mx-sm-3 mb-2 m-4">
            <label for="exampleInputEmail1">¿Quieres añadir un alias? </label>
            <input type="url" class="form-control sm-2" name="alias" aria-describedby="alias" placeholder="https://www.alias.es">
            <small id="urlHelp" class="form-text text-muted"></small>
        </div>
        <div class="col text-center">
            @csrf
            <button type="submit" class="btn btn-primary mb-2">Acortar</button>
        </div>
    </form>

    <!-- <h2>Tabla con las urls</h2> -->
    <table class="table mx-sm-3 mb-2 m-4">
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>URL Original</th>
                <th>URL Acortada</th>
            </tr>
        </thead>
        <tbody class="table-active border border-dark">
            @if(!empty($urls))
            @foreach($urls as $url)
            <tr>
                <td>{{ $url['codigo'] }}</td>
                <td> <a href="{{ $url['urlOriginal'] }}">{{ $url['urlOriginal']  }}</a>
                </td>
                <td>{{ $url['urlAcortada'] }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>