@extends('layouts.app',  ["current" => "Documentação" ])

@section('content')
    <div class="ecommerce-widget">
        <iframe name="interno" width="100%" height="800" src="http://ec2-34-238-124-201.compute-1.amazonaws.com:8081/swagger-ui.html"></iframe>
    </div>
@endsection
