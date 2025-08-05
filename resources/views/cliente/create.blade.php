@extends('layouts.app') {{-- Estende o layout principal --}}

@section('title', 'Dashboard - Estoque') {{-- Define o título da página --}}
@section('page_title', 'Dashboard') {{-- Define o título na navbar --}}

@section('content') {{-- Onde o conteúdo do formulário será inserido no layout --}}
    <br />
    <form action="{{ route('clientes.store') }}" method="POST" name="frm_cliente">
        @csrf {{-- Diretiva CSRF obrigatória para formulários Laravel --}}

        <legend class="text-center">Cadastro de Clientes</legend>

        <div class="p-2 row">
            <div class="col-auto">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="PF" value="PF" checked onchange="javascript:pessoa();">
                    <label class="form-check-label" for="rdb_pessoa_pf">PF</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo" id="PJ" value="PJ" onchange="javascript:pessoa();">
                    <label class="form-check-label" for="rdb_pessoa_pj">PJ</label>
                </div>
            </div>
        </div>

        <div class="p-2 row">
            <div class="col-8">
                <input class="form form-control" type="text" title="Nome do Cliente" placeholder="Nome Razão" name="nome">
            </div>
            <div class="col-4">
                <input class="form form-control" type="text" title="CPF Cliente" placeholder="CPF" name="cpf_cnpj" id="cpf_cnpj">
            </div>
        </div>

        <div class="p-2 row">

            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Carteira de Identidade do Cliente" placeholder="C.I" id="ci" name="ci">
                <input class="form form-control" class="col-4" type="text" title="Inscrição Estadual" placeholder="Inscrição Estadual" id="ie" name="ie">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-4" type="date" title="Data de Nascimento do Cliente" placeholder="Data Nascimento" name="dt_nascimento" id="dt_nascimento" data-mask="99/99/9999">
                <input class="form form-control" class="col-4" type="date" title="Data de Fundação da Empresa" placeholder="Data Fundação" name="fundacao" id="fundacao" data-mask="99/99/9999">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-7" type="text" title="Email do Cliente" placeholder="Email" name="email">
            </div>
        </div>

        <div class="p-2 row">
            <div class="col-8">
                <input class="form form-control" class="col-8" type="text" title="Endereço do Cliente" placeholder="Endereço" name="endereco">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Bairro do Cliente" placeholder="Bairro" name="bairro">
            </div>

        </div>

        <div class="p-2 row">
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Cidade do Cliente" placeholder="Cidade" name="cidade">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col" type="text" title="Estado do Cliente" placeholder="Estado" name="estado" data-mask="aa">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Cep do Cliente" placeholder="Cep" name="cep" data-mask="99999-999">
            </div>
        </div>
        <div class="p-2 row">
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Telefone 1 do Cliente" placeholder="Telefone1" name="tel1" data-mask="(99)9999-9999">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Telefone 2 do Cliente" placeholder="Telefone2" name="tel2" data-mask="(99)9999-9999">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Telefone 3 do Cliente" placeholder="Telefone3" name="tel3" data-mask="(99)9999-9999">
            </div>
        </div>
        <div class="p-2 row">
            <div class="col">
                <input class="form form-control" class="col-6" type="text" title="Responsável Pela Empresa" placeholder="Responsável" name="responsavel" id="id_responsavel">
            </div>
        </div>
        <div class="p-2 row">
            <div class="col">
                <button type="submit" class="btn" name="btn_cad_cliente">Cadastrar</button>
            </div>
        </div>
    </form>
    {{-- A variável $totalClientes deve ser passada do Controller para a view --}}
    <div class="p-2 row">
        <div class="col">
            <p class="text-right">Total Registros :{{ $totalClientes ?? 'N/A' }}</p>
        </div>
    </div>
@endsection

@push('js')
    {{-- Coloca este script no final do <body> do layout principal --}}
    <script type="text/javascript">
        $("#cpf_cnpj").keypress(function() {
            $("#cpf_cnpj").unmask();
            var tamanho = $("#cpf_cnpj").val().length;

            if (tamanho == 11) {
                $("#cpf_cnpj").inputmask("999.999.999-99");
            } else if (tamanho == 14) {
                $("#cpf_cnpj").mask("99.999.999/9999-99");
            }
        });

        // É uma boa prática executar funções JS que dependem do DOM
        // após o DOM estar completamente carregado.
        $(document).ready(function() {
            pessoa(); // Chama a função assim que o DOM estiver pronto
        });
    </script>
@endpush
{{-- Exemplo de como adicionar JS específico da página usando @push --}}
@push('js')
    <script>
        // Você pode adicionar scripts específicos do dashboard aqui
        //console.log('Dashboard scripts carregados.');
    </script>
@endpush
