@extends('layouts.app',  ["current" => "Lista de Carros" ])

@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">

            <div class="card-header col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                <button class="btn btn-primary" onClick="novoCarro()">Novo Veículo</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first" id="tabelaCarros">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Placa</th>
                                <th>Nota</th>
                                <th>Quantidade De Corridas</th>
                                <th>Disponibilidade</th>
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
    <div class="modal" tabindex="-1" role="dialog" id="modalCarros" data-backdrop="static" data-keyboard="false">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12" style="margin:200px auto;">
            <div class="card">
                <h5 class="card-header">Novo Veiculo</h5>
                <div class="card-body">
                    <form action="#" id="formCarro" data-parsley-validate="">
                        <div class="form-group">
                            <label for="marca">Marca</label>
                            <input id="marca" type="text" name="marca" data-parsley-trigger="change" required=""  autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo</label>
                            <input id="modelo" type="text" name="modelo" data-parsley-trigger="change" required=""  autocomplete="off" class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="placa">Placa</label>
                            <input id="placa" type="text"  required="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="notaMediaDeViagem">Nota</label>
                            <input id="notaMediaDeViagem" type="text"  required="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="quantidadeDeCorridas">Quantidade De Corridas</label>
                            <input id="quantidadeDeCorridas" type="text"  required="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="disponibilidade">Disponibilidade</label>
                            <input id="disponibilidade" type="text"  required="" class="form-control">
                        </div>




                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Salvar</button>
                                    <button class="btn btn-space btn-secondary" data-dismiss="modal">Cancelar</button>
                                </p>
                            </div>
                        </div>



                        <input id="car_id" type="hidden" >
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
            item.marca,
            item.modelo,
            item.placa,
            item.notaMediaDeViagem,
            item.quantidadeDeCorridas,
            item.disponibilidade,
            '<span onclick="moveUrl(\'/carros/editar/id-' + item.id + '\')" class="fas fa-edit item-icon" title="Alterar" style="font-size: 25px;margin: 10px;cursor: pointer;"></span>'+
            '<span onclick="remover(\'' + item.id + '\')" class="fas fa-trash item-icon" title="Excluir" style="font-size: 25px;margin: 10px;cursor: pointer;"></span>'
        ];


        return linha;
    }

    function criarCarro() {
        var formData = {
            marca: $("#marca").val(),
            modelo: $("#modelo").val(),
            placa: $("#placa").val()
        };

        $.ajax({
            type : "POST",
            contentType : "application/json",
            url : "http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/carros",
            data : JSON.stringify(formData),
            dataType : 'json',
            success : function(data) {


                alert('Carro criado com sucesso!');

                moveUrl('/carros')

            },
            error : function(e) {
                alert('Erro ao criar o carro!');
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
                url: "http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/carros/" + id,
                context: this,
                success: function() {
                    alert('Registro excluido com sucesso!')
                    moveUrl('/carros');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    }


    function updateCarro() {

        var formData = {
            id: $("#car_id").val(),
            marca: $("#marca").val(),
            modelo: $("#modelo").val(),
            placa: $("#placa").val(),
            notaMediaDeViagem: $("#notaMediaDeViagem").val(),
            quantidadeDeCorridas: $("#quantidadeDeCorridas").val(),
            disponibilidade: $("#disponibilidade").val()
        };

        $.ajax({
            type: "PUT",
            contentType : "application/json",
            url: "http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/carros/" + formData.id,
            data : JSON.stringify(formData),
            dataType : 'json',
            success: function() {
                alert('Registro alterado com sucesso!');
                moveUrl('/carros');
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

            $.getJSON('http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/carros/'+id, function(data) {
                console.log(data);
                $('#car_id').val(data.id);
                $('#marca').val(data.marca);
                $('#modelo').val(data.modelo);
                $('#placa').val(data.placa);
                $("#notaMediaDeViagem").val(data.notaMediaDeViagem);
                $("#quantidadeDeCorridas").val(data.quantidadeDeCorridas);
                $("#disponibilidade").val(data.disponibilidade);
            });
            $('.card-header').text("Atualizar Carro");
            $('#modalCarros').modal('show');
        }

    }

    function carregarCarros() {
        $.getJSON('http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/carros', function(items) {
            for(i=0;i<items.length;i++) {
                linha = montarLinha(items[i]);
                var table = $('#tabelaCarros').DataTable();
                table.row.add(linha).draw( false );
            }
        });
    }

    function binds() {
        $("#formCarro").submit( function(event){
            event.preventDefault();
            if ($("#car_id").val() != ''){
                updateCarro();
            }else {
                criarCarro();
            }

            $("#modalCarros").modal('hide');
        });
    }

    function novoCarro() {
        $('#modalCarros').modal('show');
    }

    $(function(){
        carregarCarros();
        binds();
        editar();
    });

</script>

@endsection
