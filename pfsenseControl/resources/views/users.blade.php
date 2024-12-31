@extends('layouts.admin')

@section('page-title', 'Users')

@section('content')

    <!-- Main Content -->
    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Nenhum usuário encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- <div class="card-footer">
                <a href="#" class="btn btn-success"><i class="fas fa-plus"></i> Adicionar Usuário</a>
            </div> -->
        </div>
    </section>

@endsection

