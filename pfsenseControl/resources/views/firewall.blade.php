@extends('layouts.admin')

@section('page-title', 'Regras de Firewall')

@section('content')
<div class="content-wrapper">
    <!-- Cabeçalho -->
    <section class="content-header">
        <div class="container-fluid">
            <h1>Regras de Firewall</h1>
        </div>
    </section>

    <!-- Conteúdo Principal -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Regras</h3>
            </div>

            <div class="card-body">
                <!-- Mensagem de erro -->
                @if(isset($error))
                    <div class="alert alert-danger">{{ $error }}</div>
                @endif

                <!-- Tabela -->
                @if(count($firewallRules) > 0)
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Origem</th>
                                <th>Destino</th>
                                <th>Porta</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($firewallRules as $rule)
                                <tr>
                                    <td>{{ $rule['id'] }}</td>
                                    <!-- <td>{{ $rule['source'] }}</td>
                                    <td>{{ $rule['destination'] }}</td>
                                    <td>{{ $rule['port'] }}</td>
                                    <td>{{ $rule['action'] }}</td> -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">Nenhuma regra encontrada.</p>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection

