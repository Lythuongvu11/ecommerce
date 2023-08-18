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
        if(!Schema::hasColumn('cart_products', 'cart_id'))
            Schema::table('cart_products', function (Blueprint $table) {
                $table->foreignIdFor(\App\Models\Cart::class, 'cart_id')->constrained()->onDelete('cascade');
            });
        if(Schema::hasColumn('cart_products', 'user_id'))
            Schema::table('cart_products', function (Blueprint $table) {
                $table->dropForeignIdFor(\App\Models\User::class);
                $table->dropColumn('user_id');
            });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('cart_products', 'cart_id'))
            Schema::table('cart_products', function (Blueprint $table) {
                $table->dropColumn('cart_id');
            });

        if(!Schema::hasColumn('cart_products', 'user_id'))
            Schema::table('cart_products', function (Blueprint $table) {
                $table->foreignIdFor(\App\Models\Cart::class);
            });

    }
};
