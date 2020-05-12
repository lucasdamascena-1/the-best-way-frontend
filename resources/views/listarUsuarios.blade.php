@extends('layouts.app',  ["current" => "Lista de Usuários" ])

@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                <button class="btn btn-primary" onClick="novoUsuario()">Novo Usuários</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first" id="tabelaUsuarios">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>CPF</th>
                                <th>Telefone</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- ============================================================== -->
    <!-- basic form -->
    <!-- ============================================================== -->
    <div class="modal" tabindex="-1" role="dialog" id="modalUsuarios" data-backdrop="static" data-keyboard="false">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" style="margin:200px auto;">
            <div class="card">
                <h5 class="card-header">Novo Usuário</h5>
                <div class="card-body">
                    <form action="#" id="formUsuario" data-parsley-validate="">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input id="nome" type="text" name="nome" data-parsley-trigger="change" required=""  autocomplete="off" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input id="email" type="email" name="email" data-parsley-trigger="change" required=""  autocomplete="off" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="cpf">CPF (Somente números)</label>
                            <input id="cpf" type="text"  required="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input id="telefone" type="text"  required="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <input id="status" type="text"  required="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input id="senha" type="password"  required="" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Salvar</button>
                                    <button class="btn btn-space btn-secondary" data-dismiss="modal">Cancelar</button>
                                </p>
                            </div>
                        </div>

                        <input id="usu_id" type="hidden" >
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic form -->
    <!-- ============================================================== -->

@endsection


@section('javascript')

<script type="text/javascript">


    function montarLinha(item) {

        var linha = [
            item.id,
            item.nome,
            item.email,
            item.cpf,
            item.telefone,
            '<span onclick="moveUrl(\'/usuarios/editar/id-' + item.id + '\')" class="fas fa-edit item-icon" title="Alterar" style="font-size: 25px;margin: 10px;cursor: pointer;"></span>'+
            '<span onclick="remover(\'' + item.id + '\')" class="fas fa-trash item-icon" title="Excluir" style="font-size: 25px;margin: 10px;cursor: pointer;"></span>'
        ];


        return linha;
    }

    function criarUsuario() {
        var formData = {
            nome: $("#nome").val(),
            email: $("#email").val(),
            cpf: $("#cpf").val(),
            senha: $("#senha").val(),
            telefone: $("#telefone").val(),
            status: $("#status").val()
        };

        $.ajax({
            type : "POST",
            contentType : "application/json",
            url : "http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/usuarios",
            data : JSON.stringify(formData),
            dataType : 'json',
            success : function(data) {
                alert('Usuario criado com sucesso!');
                moveUrl('/usuarios');
            },
            error : function(e) {
                alert('Erro ao criar o Usuario!');
                console.log("ERROR: ", e);
            }
        });
    }

    function moveUrl(url) {
        location.href = url;
    }

    function remover(id) {
        if (confirm("Você realmente deseja excluir esse registro?")) {
            $.ajax({
                type: "DELETE",
                url: "http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/usuarios/" + id,
                context: this,
                success: function() {
                    alert('Registro excluido com sucesso!')
                    moveUrl('/usuarios');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    }


    function updateUsuario() {

        var formData = {
            id: $("#usu_id").val(),
            nome: $("#nome").val(),
            email: $("#email").val(),
            cpf: $("#cpf").val(),
            senha: $("#senha").val(),
            telefone: $("#telefone").val(),
            status: $("#status").val()
        };

        $.ajax({
            type: "PUT",
            contentType : "application/json",
            url: "http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/usuarios/" + formData.id,
            data : JSON.stringify(formData),
            dataType : 'json',
            success: function() {
                alert('Registro alterado com sucesso!');
                moveUrl('/usuarios');
            },
            error: function(error) {
                alert('Erro ao alterar o registro!');
            }
        });

    }

    function editar() {
        if(location.href.indexOf('editar') != -1) {
            var id = location.href.replace(location.origin+'/', "").split('/')[2];
            id = id.replace('id-','');

            $.getJSON('http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/usuarios/'+id, function(data) {
                console.log(data);
                $('#usu_id').val(data.id);
                $("#nome").val(data.nome);
                $("#email").val(data.email);
                $("#cpf").val(data.cpf);
                $("#senha").val(data.senha);
                $("#telefone").val(data.telefone);
                $("#status").val(data.status);
            });
            $('.card-header').text("Atualizar Usuario");
            $('#modalUsuarios').modal('show');
        }

    }

    function carregarUsuarios() {
        $.getJSON('http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/usuarios', function(items) {
            for(i=0;i<items.length;i++) {
                linha = montarLinha(items[i]);
                var table = $('#tabelaUsuarios').DataTable();
                table.row.add(linha).draw( false );
            }
        });
    }

    function binds() {
        $("#formUsuario").submit( function(event){
            event.preventDefault();
            if ($("#usu_id").val() != ''){
                updateUsuario();
            }else {
                criarUsuario();
            }

            $("#modalUsuarios").modal('hide');
        });
    }

    function novoUsuario() {
        $('#modalUsuarios').modal('show');
    }

    $(function(){
        carregarUsuarios();
        binds();
        editar();
    });

</script>

@endsection
