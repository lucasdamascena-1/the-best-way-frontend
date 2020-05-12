@extends('layouts.app',  ["current" => "Nova Viagem" ])

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

    <!-- ============================================================== -->
    <!-- basic form -->
    <!-- ============================================================== -->
    <div class="form-content" tabindex="-1" role="dialog" id="modalViagem" data-backdrop="static" data-keyboard="false">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="margin:10px auto;">
            <div class="card">
                <div class="card-body">
                    <form action="#" id="formUsuario" data-parsley-validate="">
                        <div class="form-group">
                            <label for="select-usuario">Usuários</label>
                            <select class="form-control" id="select-usuario">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="select-carro">Veículo</label>
                            <select class="form-control" id="select-carro">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="origem">Origem</label>
                            <input id="origin-input" class="form-control controls" type="text" placeholder="Origem" required>
                        </div>

                        <div class="form-group">
                            <label for="destino">Destino</label>
                            <input id="destination-input" class="form-control controls" type="text" placeholder="Destino" required>
                        </div>

                        <div class="form-group">
                            <label for="destino">Trajeto</label>
                            <div id="map"></div>
                        </div>

                        <div class="form-group">
                            <label for="extras">Taxas</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">R$</span></div>
                                    <input id="extras" type="text"  required="" class="form-control disabled" disabled value="7.5">
                                <div class="input-group-append"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="preco">Preço</label>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">R$</span></div>
                                    <input id="preco" type="text"  required="" class="form-control disabled" disabled>
                                <div class="input-group-append"></div>
                            </div>
                        </div>

                        <h5 class="card-header" style="margin-bottom: 35px;">Pagamento</h5>

                        <div class="form-group">
                            <label for="pay-mod">Froma de Pagamento</label>
                            <select class="form-control" id="pay-mod">
                                <option value="pagamentoComCartao">Cartão - Credito/Débito</option>
                                <option value="pagamentoComBoleto">Boleto</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="card-type">Tipo do Cartão</label>
                            <select class="form-control" id="card-type">
                                <option value="1">Crédito</option>
                                <option value="0">Débito</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="card-number">Número do Cartão</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text fas fa-key"></span></div>
                                <input id="card-number" type="text"   class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="parcelas">Número de Parcelas</label>
                            <select class="form-control" id="parcelas">
                                <option value="1">1x sem juros</option>
                                <option value="2">2x sem juros</option>
                                <option value="3">3x sem juros</option>
                                <option value="4">4x sem juros</option>
                                <option value="5">5x sem juros</option>
                                <option value="6">6x sem juros</option>
                                <option value="7">7x sem juros</option>
                                <option value="8">8x sem juros</option>
                                <option value="9">9x sem juros</option>
                                <option value="10">10x sem juros</option>
                                <option value="11">11x sem juros</option>
                                <option value="12">12x sem juros</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Iniciar Viagem</button>
                                </p>
                            </div>
                        </div>
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

    function criarViagem() {

        var formData = {};

        if($("#pay-mod").val() == 'pagamentoComBoleto') {
            formData = {
                usuario: {
                    id: $("#select-usuario").val()
                },
                origem: $("#origin-input").val(),
                destino: $("#destination-input").val(),
                corrida:[{
                    desconto: 0.0,
                    custoFixo: 0.0,
                    extras: $("#extras").val(),
                    preco: $("#preco").val(),
                    carro: {
                        id: $("#select-carro").val()
                    }
                }],
                pagamento: {
                    '@type': $("#pay-mod").val()
                }
            };
        }else {
            formData = {
                usuario: {
                    id: $("#select-usuario").val()
                },
                origem: $("#origin-input").val(),
                destino: $("#destination-input").val(),
                corrida:[{
                    desconto: 0.0,
                    custoFixo: 0.0,
                    extras: $("#extras").val(),
                    preco: $("#preco").val(),
                    carro: {
                        id: $("#select-carro").val()
                    }
                }],
                pagamento: {
                    '@type': $("#pay-mod").val(),
                    numeroCartao: $("#card-number").val(),
                    numeroDeParcelas: $("#card-type").val() == '1'? $("#card-type").val() : '0',
                    tipoCartao: $("#card-type").val()
                }
            };
        }

        $.ajax({
            type : "POST",
            contentType : "application/json",
            url : "http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/pedidos",
            data : JSON.stringify(formData),
            dataType : 'json',
            success : function(data) {
                alert('Boa viagem!');
                moveUrl('/viagem');
            },
            error : function(e) {
                alert('Erro ao iniciar a viagem!');
                console.log("ERROR: ", e);
            }
        });
    }

    function moveUrl(url) {
        location.href = url;
    }

    function loadUsers() {
        $.getJSON('http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/usuarios', function(items) {
            var str = '';

            for(i=0;i<items.length;i++) {
                str += '<option value="'+items[i].id+'">'+items[i].nome+'</option>';
            }

            $("#select-usuario").append(str);
        });
    }

    function loadCars() {
        $.getJSON('http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/carros', function(items) {
            var str = '';

            for(i=0;i<items.length;i++) {
                if(items[i].disponibilidade == 1) {
                    str += '<option value="'+items[i].id+'">'+items[i].modelo+' - '+items[i].placa+'</option>';
                }
            }

            $("#select-carro").append(str);
        });
    }

    function getLocation()
    {
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(showPosition);
        }
        else{
            //O seu navegador não suporta Geolocalização. Default FIAP"
            window.objPosition =  {lat: -23.5741047, lng: -46.6254214};
        }
    }

    function showPosition(position)
    {
        window.objPosition = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
        }
    }

    function binds() {
        $("#formUsuario").submit( function(event){
            event.preventDefault();
            criarViagem();
        });

        $( "#pay-mod" ).change(function(item) {
            var valor = $(this).val();

            if(valor == 'pagamentoComBoleto') {
                $('#card-type').parents('.form-group').hide();
                $('#card-number').parents('.form-group').hide();
                $('#parcelas').parents('.form-group').hide();
            }else {
                $('#card-type').parents('.form-group').show();
                $('#card-type').val('1');
                $('#card-number').parents('.form-group').show();
                $('#parcelas').parents('.form-group').show();
            }
        });

        $( "#card-type" ).change(function(item) {
            var valor = $(this).val();

            if(valor == '0') {
                $('#parcelas').parents('.form-group').hide();
            }else {
                $('#parcelas').parents('.form-group').show();
            }
        });
    }

    function initMap() {
        //getLocation();
        console.log('LOCAL', window.objPosition);
        var map = new google.maps.Map(document.getElementById('map'), {
            mapTypeControl: false,
            center:{lat: -23.5741047, lng: -46.6254214},
            zoom: 15
        });

        new AutocompleteDirectionsHandler(map);
    }

    /**
    * @constructor
    */
    function AutocompleteDirectionsHandler(map) {
        this.map = map;
        this.originPlaceId = null;
        this.destinationPlaceId = null;
        this.travelMode = 'DRIVING';
        this.directionsService = new google.maps.DirectionsService;
        this.directionsRenderer = new google.maps.DirectionsRenderer;
        this.directionsRenderer.setMap(map);

        var originInput = document.getElementById('origin-input');
        var destinationInput = document.getElementById('destination-input');

        var originAutocomplete = new google.maps.places.Autocomplete(originInput);
        // Specify just the place data fields that you need.
        originAutocomplete.setFields(['place_id']);

        var destinationAutocomplete =
            new google.maps.places.Autocomplete(destinationInput);
        // Specify just the place data fields that you need.
        destinationAutocomplete.setFields(['place_id']);

        this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
    }

    AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
        var me = this;
        autocomplete.bindTo('bounds', this.map);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();

            if (!place.place_id) {
                window.alert('Selecione uma opção na listagem');
                return;
            }
            if (mode === 'ORIG') {
                me.originPlaceId = place.place_id;
            } else {
                me.destinationPlaceId = place.place_id;
            }
                me.route();
        });
    };

    AutocompleteDirectionsHandler.prototype.route = function() {
        if (!this.originPlaceId || !this.destinationPlaceId) {
            return;
        }
        var me = this;

        this.directionsService.route({
            origin: {
                'placeId': this.originPlaceId
            },
            destination: {
                'placeId': this.destinationPlaceId
            },
            travelMode: this.travelMode
            },
            function(response, status) {
                if (status === 'OK') {
                    me.directionsRenderer.setDirections(response);

                    var routes = response.routes[0];
                    var legs = routes.legs[0];

                    var valor = legs.distance.text.replace('km','').replace(',','.').trim();

                    $('#preco').val(valor);

                } else {
                    window.alert('A solicitação de rotas falhou devido a ' + status);
                }
            });
    };

    $(function(){
        binds();
        loadUsers();
        loadCars();
    });

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBW3AuxTsloSkvBR2sFHwq9hBSDv8uX-Fk&libraries=places&callback=initMap" async defer></script>
@endsection
