<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // Equivalente a `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY

            $table->string('nome', 70)->comment('Nome do Cliente');
            $table->string('tipo', 2)->comment('Tipo do Cliente');
            $table->string('cpf', 20)->comment('CPF do Cliente');
            $table->string('ci', 15)->nullable()->comment('CI do Cliente');
            $table->string('endereco', 15)->nullable()->comment('Endereço do Cliente'); // Verifique o tamanho de 'endereco', 15 parece curto
            $table->string('Bairro', 70)->nullable()->comment('Bairro do Cliente'); // Laravel convention: 'bairro' (lowercase)
            $table->string('cidade', 70)->nullable()->comment('Cidade do Cliente');
            $table->string('estado', 2)->nullable()->comment('Estado do Cliente');
            $table->string('cep', 12)->nullable()->comment('CEP do Cliente');
            $table->string('referencia', 15)->nullable()->comment('Ponto Referência do Cliente');
            $table->string('tel1', 15)->nullable()->comment('Telefone do Cliente');
            $table->string('tel2', 15)->nullable()->comment('Telefone2 do Cliente');
            $table->string('obs', 255)->nullable()->comment('Observação');

            // Chave estrangeira para a tabela 'empresas'
            // Assumindo que a tabela 'empresas' já existe e tem uma coluna 'id'
            $table->foreignId('empresa_id')
                  ->constrained('empresas') // Nome da tabela referenciada
                  ->onUpdate('restrict')   // ON UPDATE RESTRICT
                  ->onDelete('no action'); // ON DELETE NO ACTION (equivalente a RESTRICT para InnoDB)

            $table->timestamps(); // Equivalente a `created_at` e `updated_at` TIMESTAMP NULL DEFAULT NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};