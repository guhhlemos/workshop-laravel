<div>
    @extends("home")

    @section("form-content")
    <div>
        <form id="create-form" method="POST" action="{{route('ownerships.store')}}">
            @csrf
            <input type="hidden" name="id">
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
                    <th class="text-center align-middle" scope="col">Nome</th>
                    <th class="text-center align-middle" scope="col">Sobrenome</th>
                    <th class="text-center align-middle" scope="col">CPF</th>
                    <th class="text-center align-middle" scope="col">CNH</th>
                    <th class="text-center align-middle" scope="col">Data de Emissão (CNH)</th>
                    <th class="text-center align-middle" scope="col">Data de Validade (CNH)</th>
                    <th class="text-center align-middle" scope="col">Ações</th>
                    <th class="text-center align-middle" scope="col">
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
                    <td class="text-center align-middle">{{ $ownership->firstname }}</td>
                    <td class="text-center align-middle">{{ $ownership->lastname }}</td>
                    <td class="text-center align-middle">{{ $ownership->cpf }}</td>
                    <td class="text-center align-middle">{{ $ownership->drivers_license->cnh ?? "-" }}</td>
                    <td class="text-center align-middle">{{ $ownership->drivers_license->issue_date  ?? "-" }}</td>
                    <td class="text-center align-middle">{{ $ownership->drivers_license->expiration_date  ?? "-" }}</td>
                    <td class="text-center align-middle">
                        <form class="update-form">
                            <input type="hidden" name="id" value="{{$ownership->id}}">
                            <input type="hidden" name="firstname" value="{{$ownership->firstname}}">
                            <input type="hidden" name="lastname" value="{{$ownership->lastname}}">
                            <input type="hidden" name="cpf" value="{{$ownership->cpf}}">
                            <input type="hidden" name="cnh" value="{{$ownership->drivers_license->cnh ?? "-" }}">
                            <input type="hidden" name="issue_date" value="{{$ownership->drivers_license->issue_date ?? "-" }}">
                            <input type="hidden" name="expiration_date" value="{{$ownership->drivers_license->expiration_date ?? "-" }}">
                            <button class="btn btn-warning btn-update" type="submit">Alterar</button>
                        </form>
                        <form method="POST" action="{{route('ownerships.destroy',[$ownership->id])}}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$ownership->id}}">
                            <button class="btn btn-danger btn-delete" type="submit">Deletar</button>
                        </form>
                    </td>
                    <td class="text-center align-middle">
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

    <script>
        $(function() {
            $('.update-form').on('submit', function(e) {
                e.preventDefault();

                var id = $(this).find('input[name=id]').val()
                var firstname = $(this).find('input[name=firstname]').val()
                var lastname = $(this).find('input[name=lastname]').val()
                var cpf = $(this).find('input[name=cpf]').val()
                var cnh = $(this).find('input[name=cnh]').val()
                var issue_date = $(this).find('input[name=issue_date]').val()
                var expiration_date = $(this).find('input[name=expiration_date]').val()

                $("#create-form input[name=id]").val(id)
                $("#create-form input[name=firstname]").val(firstname)
                $("#create-form input[name=lastname]").val(lastname)
                $("#create-form input[name=cpf]").val(cpf)
                $("#create-form input[name=cnh]").val(cnh)
                $("#create-form input[name=issue_date]").val(issue_date.substring(6, 10) + '-' + issue_date.substring(3, 5) + '-' + issue_date.substring(0, 2))

                $('#create-form').attr('action', `{{route("ownerships.index")}}/${id}`)
                
                if(!$('#create-form input[name=_method]').length){
                    $('#create-form').append('@method("PUT")')
                }
            })
        });

    </script>

    @endsection
</div>
