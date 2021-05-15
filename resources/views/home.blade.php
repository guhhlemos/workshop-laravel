<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

    <title>Workshop - Laravel</title>
</head>
<body>
    <div class="container">
        <div class="card text-center mt-4">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a id="ownerships" class="nav-link" href="{{route('ownerships.index')}}">Proprietários</a>
                    </li>
                    <li class="nav-item">
                        <a id="cars" class="nav-link" href="{{route('cars.index')}}">Carros</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                @yield("form-content")
                @yield("table-content")
            </div>
        </div>
    </div>
</body>
</html>
