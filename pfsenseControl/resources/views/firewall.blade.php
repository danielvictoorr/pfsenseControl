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
                <th>Ações</th>
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
                <td>
                    <form action="{{route('firewall.deleteRule', $rule['id'])}}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta regra?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>

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

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

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
                    <!-- Tipo -->
                    <div class="form-group">
                        <label for="type">Tipo</label>
                        <select class="form-control" name="type" id="type">
                            <option value="allow">Permitir</option>
                            <option value="deny">Negar</option>
                            <option value="block">Bloquear</option>
                            <option value="pass">Passar</option>
                        </select>
                    </div>

                    <!-- Interface -->
                    <div class="form-group">
                        <label for="interface">Interface</label>
                        <select class="form-control" name="interface[]" id="interface" multiple>
                            <option value="lan">LAN</option>
                            <option value="wan">WAN</option>
                        </select>
                    </div>

                    <!-- IP Protocol -->
                    <div class="form-group">
                        <label for="ipprotocol">IP Protocol</label>
                        <input type="text" class="form-control" name="ipprotocol" id="ipprotocol" value="inet" required>
                    </div>

                    <!-- Protocol -->
                    <div class="form-group">
                        <label for="protocol">Protocolo</label>
                        <input type="text" class="form-control" name="protocol" id="protocol" placeholder="Ex: tcp, udp ou tcp/udp">
                    </div>

                    <!-- ICMP Type -->
                    <div class="form-group">
                        <label for="icmptype">ICMP Type</label>
                        <select class="form-control" name="icmptype[]" id="icmptype" multiple>
                            <option value="any">Any</option>
                        </select>
                    </div>

                    <!-- Origem -->
                    <div class="form-group">
                        <label for="source">Origem</label>
                        <input type="text" class="form-control" name="source" id="source" required>
                    </div>

                    <!-- Porta de Origem -->
                    <div class="form-group">
                        <label for="source_port">Porta de Origem</label>
                        <input type="text" class="form-control" name="source_port" id="source_port">
                    </div>

                    <!-- Destino -->
                    <div class="form-group">
                        <label for="destination">Destino</label>
                        <input type="text" class="form-control" name="destination" id="destination" required>
                    </div>

                    <!-- Porta de Destino -->
                    <div class="form-group">
                        <label for="destination_port">Porta de Destino</label>
                        <input type="text" class="form-control" name="destination_port" id="destination_port">
                    </div>

                    <!-- Descrição -->
                    <div class="form-group">
                        <label for="descr">Descrição</label>
                        <textarea class="form-control" name="descr" id="descr" rows="2"></textarea>
                    </div>

                    <!-- Opções booleanas -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="disabled" id="disabled">
                        <label class="form-check-label" for="disabled">Desabilitado</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="log" id="log" checked>
                        <label class="form-check-label" for="log">Logar esse tráfego</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tcp_flags_any" id="tcp_flags_any">
                        <label class="form-check-label" for="tcp_flags_any">TCP Flags Any</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="floating" id="floating">
                        <label class="form-check-label" for="floating">Floating Rule</label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="quick" id="quick" checked>
                        <label class="form-check-label" for="quick">Quick</label>
                    </div>

                    <!-- State Type -->
                    <div class="form-group">
                        <label for="statetype">State Type</label>
                        <select class="form-control" name="statetype" id="statetype">
                            <option value="keep state">Keep State</option>
                            <option value="modulate state">Modulate State</option>
                            <option value="synproxy state">Synproxy State</option>
                        </select>
                    </div>

                    <!-- TCP Flags Set -->
                    <div class="form-group">
                        <label for="tcp_flags_set">TCP Flags Set (opcional)</label>
                        <input type="text" class="form-control" name="tcp_flags_set[]" id="tcp_flags_set" placeholder="Ex: syn, ack">
                    </div>

                    <!-- TCP Flags Out Of -->
                    <div class="form-group">
                        <label for="tcp_flags_out_of">TCP Flags Out Of (opcional)</label>
                        <input type="text" class="form-control" name="tcp_flags_out_of[]" id="tcp_flags_out_of">
                    </div>

                    <!-- Gateway -->
                    <div class="form-group">
                        <label for="gateway">Gateway</label>
                        <input type="text" class="form-control" name="gateway" id="gateway" value="defaultgw4">
                    </div>

                    <!-- Direction -->
                    <div class="form-group">
                        <label for="direction">Direction</label>
                        <select class="form-control" name="direction" id="direction">
                            <option value="in">Entrada</option>
                            <option value="out">Saída</option>
                        </select>
                    </div>

                    <!-- Campos opcionais adicionais -->
                    <div class="form-group">
                        <label for="sched">Scheduler (opcional)</label>
                        <input type="text" class="form-control" name="sched" id="sched">
                    </div>

                    <div class="form-group">
                        <label for="dnpipe">dnpipe (opcional)</label>
                        <input type="text" class="form-control" name="dnpipe" id="dnpipe">
                    </div>

                    <div class="form-group">
                        <label for="pdnpipe">pdnpipe (opcional)</label>
                        <input type="text" class="form-control" name="pdnpipe" id="pdnpipe">
                    </div>

                    <div class="form-group">
                        <label for="defaultqueue">Default Queue (opcional)</label>
                        <input type="text" class="form-control" name="defaultqueue" id="defaultqueue">
                    </div>

                    <div class="form-group">
                        <label for="ackqueue">ACK Queue (opcional)</label>
                        <input type="text" class="form-control" name="ackqueue" id="ackqueue">
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