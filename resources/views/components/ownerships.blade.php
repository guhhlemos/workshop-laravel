<div>
    @extends("home")

    @section("form-content")
    <div>
        <form method="POST" action="{{route('ownerships.store')}}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="input-firstname">Primeiro nome</label>
                    <input type="text" class="form-control" id="input-firstname" name="firstname" placeholder="Nome">
                </div>
                <div class="form-group col-md-6">
                    <label for="input-lastname">Sobrenome</label>
                    <input type="text" class="form-control" id="input-lastname" name="lastname" placeholder="Sobrenome">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="input-cpf">CPF</label>
                    <input type="text" class="form-control" id="input-cpf" name="cpf" placeholder="111.222.333-44">
                </div>
                <div class="form-group col-md-4">
                    <label for="input-cnh">CNH</label>
                    <input type="text" class="form-control" id="input-cnh" name="cnh" placeholder="01234567890">
                </div>
                <div class="form-group col-md-4">
                    <label for="input-issuedate">Data de Emissão</label>
                    <input type="date" class="form-control" id="input-issuedate" name="issue_date">
                </div>
            </div>
            <button type="submit" class="btn btn-primary align-right">Cadastrar</button>
        </form>
    </div>
    @endsection

    @section('table-content')
    <div class="m-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Sobrenome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">CNH</th>
                    <th scope="col">Data de Emissão (CNH)</th>
                    <th scope="col">Data de Validade (CNH)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ownerships as $ownership)
                <tr>
                    <td>{{ $ownership->firstname }}</td>
                    <td>{{ $ownership->lastname }}</td>
                    <td>{{ $ownership->cpf }}</td>
                    <td>{{ $ownership->drivers_license->cnh ?? "-" }}</td>
                    <td>{{ $ownership->drivers_license->issue_date  ?? "-" }}</td>
                    <td>{{ $ownership->drivers_license->expiration_date  ?? "-" }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection

</div>
