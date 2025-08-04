@extends('layouts.app') {{-- Estende o layout principal --}}

@section('title', 'Dashboard - Estoque') {{-- Define o título da página --}}
@section('page_title', 'Dashboard') {{-- Define o título na navbar --}}

@section('content') {{-- Onde o conteúdo do formulário será inserido no layout --}}
    <br />
    <form action="{{ route('clientes.store') }}" method="POST" name="frm_cliente">
        @csrf {{-- Diretiva CSRF obrigatória para formulários Laravel --}}

        <legend class="text-center">Cadastro de Clientes</legend>

        <div class="row p-2">
            
        </div>
    
    {{-- A variável $totalClientes deve ser passada do Controller para a view --}}
    <div class="row p-2">
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
