@extends("home")

@section("form-content")
<div>
    <form method="POST" action="{{route('cars.store')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="input-name">Nome</label>
                <input type="text" class="form-control" id="input-name" name="name">
            </div>
            <div class="form-group col-md-6">
                <label for="input-model">Modelo</label>
                <input type="text" class="form-control" id="input-model" name="model">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="input-year">Ano</label>
                <input type="text" class="form-control" id="input-year" name="model_year">
            </div>
            <div class="form-group col-md-6">
                <label for="input-ownership">Proprietário</label>
                <select id="input-ownership" name="ownership_id" class="form-control">
                    <option value="0" selected>Selecione...</option>
                    @foreach ($ownerships as $ownership)
                    <option value="{{$ownership->id}}"> {{$ownership->fullname}} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
@endsection

@section('table-content')
<div class="m-4">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Modelo</th>
                <th scope="col">Ano</th>
                <th scope="col">Proprietário</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
            <tr>
                <td>{{ $car->manufacturer  }}</td>
                <td>{{ $car->model }}</td>
                <td>{{ $car->model_year }}</td>
                <td>{{ $car->ownership->fullname ?? "-" }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
