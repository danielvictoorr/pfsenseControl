@extends('layouts.admin')

@section('page-title', 'Firewall')

@section('content')
<!-- Main Content -->
<div class="container">
    <h1 class="mt-3">Regras de Firewall</h1>
<div>
    <a href="#" class="btn btn-primary mb-4">Adicionar Regra</a>
</div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Protocolo</th>
                <th>Interface</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($firewallRules) && is_array($firewallRules))
            @foreach ($firewallRules as $rule)
            <tr>
                <td>{{ $rule['id'] ?? 'N/A' }}</td>
                <td>{{ $rule['type'] ?? 'N/A' }}</td>
                <td>{{ $rule['ipprotocol'] ?? 'N/A' }}</td>
                <td>{{ implode(', ', $rule['interface'] ?? []) }}</td>
                <td>{{ $rule['source'] ?? 'N/A' }}</td>
                <td>{{ $rule['destination'] ?? 'N/A' }}</td>
                <td>{{ $rule['descr'] ?? 'N/A' }}</td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="7">Nenhuma regra encontrada.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

@endsection