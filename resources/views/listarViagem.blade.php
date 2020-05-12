@extends('layouts.app',  ["current" => "Últimas Viagens" ])

@section('content')
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 400px;

      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

    </style>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                <button class="btn btn-primary" onClick="moveUrl('/viagem/nova')">Novo Viagem</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first" id="tabelaViagem">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuário</th>
                                <th>Veículo</th>
                                <th>Placa</th>
                                <!--th>Valor Total</th-->
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('javascript')

<script type="text/javascript">

    function montarLinha(item) {

        var linha = [
            item.id,
            item.usuario.nome,
            item.corrida[0].carro.modelo,
            item.corrida[0].carro.placa,
            'R$ '+item.valorTotal
        ];


        return linha;
    }

    function moveUrl(url) {
        location.href = url;
    }

    function carregarViagem() {
        $.getJSON('http://ec2-34-238-124-201.compute-1.amazonaws.com:8080/pedidos', function(items) {
            for(i=0;i<items.length;i++) {
                linha = montarLinha(items[i]);
                var table = $('#tabelaViagem').DataTable();
                table.row.add(linha).draw( false );
            }
        });
    }

    $(function(){
        carregarViagem();
    });

</script>
@endsection
