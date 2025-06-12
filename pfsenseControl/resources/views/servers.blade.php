@extends('layouts.admin')

@section('page-title', 'Servers')

@section('content')

<div class="container mt-4">
    <h1>Lista de Servidores</h1>

    <!-- Botão para abrir o modal -->
    <div class="mb-3 text-right">
        <button class="btn btn-primary" onclick="openModal()">+ Adicionar Servidor</button>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>IP</th>
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

<!-- Modal -->
<div id="customModal" class="modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Servidor</h5>
                <button type="button" class="close" onclick="closeModal()">
                    <span>&times;</span>
                </button>
            </div>

            <form method="POST" action="{{ route('servers.insertServer') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="nickname" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="ip">IP</label>
                        <input type="text" name="ip" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="apikey">API Key</label>
                        <input type="text" name="x_api_key" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="usuario">Usuário</label>
                        <input type="text" name="client_id" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" name="client_secret" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS para modal simples -->
<script>
    function openModal() {
        document.getElementById('customModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('customModal').style.display = 'none';
    }

    // Fechar ao clicar fora do modal
    window.onclick = function(event) {
        const modal = document.getElementById('customModal');
        if (event.target === modal) {
            closeModal();
        }
    }
</script>

@endsection
