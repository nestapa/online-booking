<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToUserVouchersTable extends Migration
{
    public function up()
    {
        Schema::table('user_vouchers', function (Blueprint $table) {
            $table->boolean('is_active')->default(true); // Menandai voucher aktif
        });
    }

    public function down()
    {
        Schema::table('user_vouchers', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
}
