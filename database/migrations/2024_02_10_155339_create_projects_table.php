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
        Schema::create('projects', function (Blueprint $table) {
            $table->id('id')->comment('ID');
            $table->string('code')->nullable()->comment('案件コード');
            $table->string('name')->nullable()->comment('案件名');
            $table->integer('partner_id')->nullable()->comment('外部委託先ID');
            $table->string('dates')->nullable()->comment('対応期間');
            $table->integer('status')->nullable()->comment('ステータス');
            $table->text('step')->nullable()->comment('ステップテキスト');
            $table->text('agreement_path')->nullable()->comment('個別契約書のパス');
            $table->text('estimate_path')->nullable()->comment('見積書のパス');
            $table->integer('price')->nullable()->default(0)->comment('契約単価');
            $table->integer('money')->nullable()->default(0)->comment('契約金額');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
