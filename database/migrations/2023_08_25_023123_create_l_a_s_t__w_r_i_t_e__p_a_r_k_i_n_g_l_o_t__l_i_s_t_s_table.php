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
        Schema::create('l_a_s_t__w_r_i_t_e__p_a_r_k_i_n_g_l_o_t__l_i_s_t_s', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('l_a_s_t__w_r_i_t_e__p_a_r_k_i_n_g_l_o_t__l_i_s_t_s');
    }
};
