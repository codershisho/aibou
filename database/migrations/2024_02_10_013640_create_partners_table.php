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
        Schema::create('partners', function (Blueprint $table) {
            $table->id(); // ユニークなID
            $table->string('name')->comment('名称'); // 名称を格納する文字列カラム
            $table->tinyInteger('organization_type')->comment('組織区分'); // 組織区分を格納するTinyIntegerカラム
            $table->tinyInteger('basic_contract_flag')->comment('基本契約フラグ'); // 基本契約の有無を示すTinyIntegerカラム
            $table->string('contact_person')->comment('担当者名'); // 担当者名を格納する文字列カラム
            $table->string('contact')->comment('連絡先'); // 連絡先を格納する文字列カラム
            $table->integer('rating')->comment('レーティング'); // レーティングを格納する整数カラム
            $table->text('specialty')->comment('得意分野'); // 得意分野を格納するテキストカラム
            $table->text('memo')->nullable()->comment('メモ'); // メモを格納するテキストカラム（空値を許可）
            $table->timestamps(); // 作成日時と更新日時を格納するカラム
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
