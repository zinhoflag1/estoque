@extends('layouts.app') {{-- Estende o layout principal --}}

@section('title', 'Dashboard - Estoque') {{-- Define o título da página --}}
@section('page_title', 'Dashboard') {{-- Define o título na navbar --}}

@section('content') {{-- Onde o conteúdo do formulário será inserido no layout --}}
    <br />
    <form action="{{ route('clientes.store') }}" method="POST" name="frm_cliente">
        @csrf {{-- Diretiva CSRF obrigatória para formulários Laravel --}}

        <div class="p-2 row">
            <div class="col">
                <legend class="text-center">Cadastro de Clientes</legend>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a  class="btn" href="{{ route('clientes.create') }}" title="Cadastrar no Cliente">Novo</a>
            </div>
        </div>

        <div class="p-2 row">
            <table class="table table-light">
                <tbody>
                    <tr>
                        <td>#</td>
                        <td>Nome</td>
                        <td>CPF</td>
                        <td>Endereço</td>
                        <td>Opções</td>
                    </tr>
                    @foreach ($clientes as $key=>$cliente )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->cpf_cpnj }}</td>
                        <td>{{ $cliente->endereco }}</td>
                        <td><a href="#"><img src="/imagens/delete.png"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    
    {{-- A variável $totalClientes deve ser passada do Controller para a view --}}
    <div class="p-2 row">
        <div class="col">
            <p class="text-right">Total Registros :{{ $totalClientes ?? 'N/A' }}</p>
        </div>
    </div>
@endsection

@push('js')
    
    <script type="text/javascript">
        
    </script>
@endpush

@push('js')
    <script>
       
    </script>
@endpush
