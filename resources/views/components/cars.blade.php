@extends("home")

@section("form-content")
<div>
    <form id="create-form" method="POST" action="{{route('cars.store')}}">
        @csrf
        <input type="hidden" name="id">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="input-manufacturer">Marca</label>
                <input type="text" class="form-control" id="input-manufacturer" name="manufacturer">
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
                <th class="text-center align-middle" scope="col">Marca</th>
                <th class="text-center align-middle" scope="col">Modelo</th>
                <th class="text-center align-middle" scope="col">Ano</th>
                <th class="text-center align-middle" scope="col">Proprietário</th>
                <th class="text-center align-middle" scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
            <tr>
                <td class="text-center align-middle">{{ $car->manufacturer  }}</td>
                <td class="text-center align-middle">{{ $car->model }}</td>
                <td class="text-center align-middle">{{ $car->model_year }}</td>
                <td class="text-center align-middle">{{ $car->ownership->fullname ?? "-" }}</td>
                <td class="text-center align-middle">
                    <form class="update-form">
                            <input type="hidden" name="id" value="{{$car->id}}">
                            <input type="hidden" name="manufacturer" value="{{$car->manufacturer}}">
                            <input type="hidden" name="model" value="{{$car->model}}">
                            <input type="hidden" name="model_year" value="{{$car->model_year}}">
                            <input type="hidden" name="ownership" value="{{$car->ownership->id ?? "0" }}">
                            <button class="btn btn-warning btn-update" type="submit">Alterar</button>
                        </form>
                    <form method="POST" action="{{route('cars.destroy',[$car->id])}}">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{$car->id}}">
                        <button class="btn btn-danger" type="submit">Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(function() {
        $('.update-form').on('submit', function(e) {
            e.preventDefault();

            var id = $(this).find('input[name=id]').val()
            var manufacturer = $(this).find('input[name=manufacturer]').val()
            var model = $(this).find('input[name=model]').val()
            var model_year = $(this).find('input[name=model_year]').val()
            var ownership = $(this).find('input[name=ownership]').val()

            $("#create-form input[name=id]").val(id)
            $("#create-form input[name=manufacturer]").val(manufacturer)
            $("#create-form input[name=model]").val(model)
            $("#create-form input[name=model_year]").val(model_year)
            $(`#create-form option[value=${ownership}]`).prop('selected', true)

            $('#create-form').attr('action', `{{route("cars.index")}}/${id}`)

            if (!$('#create-form input[name=_method]').length) {
                $('#create-form').append('@method("PUT")')
            }
        })
    });

</script>
@endsection
