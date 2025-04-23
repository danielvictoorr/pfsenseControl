@extends('layouts.admin')

@section('page-title', 'Servers')

@section('content')

 <!-- Main Content -->
 <div class="container">
    <h1 class="mt-4">Lista de Servidores</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>IP</th>
                <!-- Adicione os campos que sua tabela tiver -->
            </tr>
        </thead>
        <tbody>
            @foreach ($servers as $server)
                <tr>
                    <td>{{ $server->nickname }}</td>
                    <td>{{ $server->ip }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection