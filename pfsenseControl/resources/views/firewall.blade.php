@extends('layouts.admin')

@section('page-title', 'Firewall')

@section('content')
<!-- Main Content -->
<div class="container">
    <h1 class="mt-3">Regras de Firewall</h1>
<div>

    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#addRuleModal">
    Adicionar Regra
    </button>

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

<div class="modal fade" id="addRuleModal" tabindex="-1" role="dialog" aria-labelledby="addRuleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('firewall.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRuleModalLabel">Adicionar Regra de Firewall</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Campos do formulário -->
                    <div class="form-group">
                        <label for="type">Tipo</label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>

                    <div class="form-group">
                        <label for="ipprotocol">Protocolo</label>
                        <input type="text" class="form-control" id="ipprotocol" name="ipprotocol" required>
                    </div>

                    <div class="form-group">
                        <label for="interface">Interface</label>
                        <input type="text" class="form-control" id="interface" name="interface[]" required>
                    </div>

                    <div class="form-group">
                        <label for="source">Origem</label>
                        <input type="text" class="form-control" id="source" name="source" required>
                    </div>

                    <div class="form-group">
                        <label for="destination">Destino</label>
                        <input type="text" class="form-control" id="destination" name="destination" required>
                    </div>

                    <div class="form-group">
                        <label for="descr">Descrição</label>
                        <textarea class="form-control" id="descr" name="descr" rows="2"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Salvar Regra</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

@endsection