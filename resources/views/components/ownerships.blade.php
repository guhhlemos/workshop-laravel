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

    <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

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
                    <th scope="col">Ações</th>
                    <th scope="col">
                        <form action="{{ url('notify_ownerships') }}" method="POST" target="dummyframe">
                            @csrf
                            <button type="submit" class="btn btn-primary">Enviar Multas</button>
                        </form>
                    </th>
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
                    <td>
                        <form method="POST" action="{{route('ownerships.destroy',[$ownership->id])}}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$ownership->id}}">
                            <button class="btn btn-danger" type="submit">Deletar</button>
                        </form>
                    </td>
                    <td>
                        @if ($ownership->traffic_ticket)
                        <form action="{{ url('notify_ownerships', ['id' => $ownership->id]) }}" method="POST" target="dummyframe">
                            @csrf
                            <button type="submit" class="btn btn-primary">Enviar Multa</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection

</div>