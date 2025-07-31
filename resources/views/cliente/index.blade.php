@extends('layouts.app') {{-- Estende o layout principal --}}

@section('title', 'Dashboard - Estoque') {{-- Define o título da página --}}
@section('page_title', 'Dashboard') {{-- Define o título na navbar --}}

@section('content') {{-- Onde o conteúdo do formulário será inserido no layout --}}
    <br />
    <form action="{{ route('clientes.store') }}" method="POST" name="frm_cliente">
        @csrf {{-- Diretiva CSRF obrigatória para formulários Laravel --}}

        <legend class="text-center">Cadastro de Clientes</legend>

        <div class="row p-2">
            <div class="col-auto">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rdb_pessoa" id="rdb_pessoa_pf" value="PF" checked onchange="javascript:pessoa();">
                    <label class="form-check-label" for="rdb_pessoa_pf">PF</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="rdb_pessoa" id="rdb_pessoa_pj" value="PJ" onchange="javascript:pessoa();">
                    <label class="form-check-label" for="rdb_pessoa_pj">PJ</label>
                </div>
            </div>
        </div>

        <div class="row p-2">
            <div class="col-8">
                <input class="form form-control" type="text" title="Nome do Cliente" placeholder="Nome Razão" name="txt_nome">
            </div>
            <div class="col-4">
                <input class="form form-control" type="text" title="CPF Cliente" placeholder="CPF" name="txt_cpf" id="txt_cpf" data-mask="999.999.999-99">
                <input class="form form-control" type="text" title="CNPJ Cliente" placeholder="CNPJ" name="txt_cnpj" id="txt_cnpj" data-mask="999.999.999-99">
            </div>
        </div>

        <div class="row p-2">

            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Carteira de Identidade do Cliente" placeholder="C.I" id="txt_ci" name="txt_ci">
                <input class="form form-control" class="col-4" type="text" title="Inscrição Estadual" placeholder="Inscrição Estadual" id="txt_ie" name="txt_ie">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-4" type="date" title="Data de Nascimento do Cliente" placeholder="Data Nascimento" name="txt_dt_nascimento" id="txt_dt_nascimento" data-mask="99/99/9999">
                <input class="form form-control" class="col-4" type="date" title="Data de Fundação da Empresa" placeholder="Data Fundação" name="txt_fundacao" id="txt_fundacao" data-mask="99/99/9999">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-7" type="text" title="Email do Cliente" placeholder="Email" name="txt_email">
            </div>
        </div>

        <div class="row p-2">
            <div class="col-8">
                <input class="form form-control" class="col-8" type="text" title="Endereço do Cliente" placeholder="Endereço" name="txt_endereco">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Bairro do Cliente" placeholder="Bairro" name="txt_bairro">
            </div>

        </div>

        <div class="row p-2">
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Cidade do Cliente" placeholder="Cidade" name="txt_cidade">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col" type="text" title="Estado do Cliente" placeholder="Estado" name="txt_estado" data-mask="aa">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Cep do Cliente" placeholder="Cep" name="txt_cep" data-mask="99999-999">
            </div>
        </div>
        <div class="row p-2">
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Telefone 1 do Cliente" placeholder="Telefone1" name="txt_tel1" data-mask="(99)9999-9999">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Telefone 2 do Cliente" placeholder="Telefone2" name="txt_tel2" data-mask="(99)9999-9999">
            </div>
            <div class="col-4">
                <input class="form form-control" class="col-4" type="text" title="Telefone 3 do Cliente" placeholder="Telefone3" name="txt_tel3" data-mask="(99)9999-9999">
            </div>
        </div>
        <div class="row p-2">
            <div class="col">
                <input class="form form-control" class="col-6" type="text" title="Responsável Pela Empresa" placeholder="Responsável" name="txt_responsavel" id="txt_id_responsavel">
            </div>
        </div>
        <div class="row p-2">
            <div class="col">
                <button type="submit" class="btn" name="btn_cad_cliente">Cadastrar</button>
            </div>
        </div>
    </form>
    {{-- A variável $totalClientes deve ser passada do Controller para a view --}}
    <div class="row p-2">
        <div class="col">
            <p class="text-right">Total Registros :{{ $totalClientes ?? 'N/A' }}</p>
        </div>
    </div>
@endsection

@push('js')
    {{-- Coloca este script no final do <body> do layout principal --}}
    <script type="text/javascript">
        function pessoa() {
            /* pessoa fisica marcada */
            if ($("#rdb_pessoa_pf").is(":checked")) {
                $("#txt_cnpj").hide();
                $("#txt_ie").hide();
                //$("#txt_id_responsavel").hide();
                $("#txt_fundacao").hide();
                $("#txt_ci").show();
                $("#txt_cpf").show();
                $("#txt_dt_nascimento").show();
            }
            /* Pessoa Juridica marcada */
            else if ($("#rdb_pessoa_pj").is(":checked")) {
                $("#txt_cpf").hide();
                $("#txt_cnpj").show();
                $("#txt_ie").show();
                $("#txt_ci").hide();
                $("#txt_dt_nascimento").hide();
                $("#txt_fundacao").show();
                //$("#txt_id_responsavel").show();
            }
        }

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
