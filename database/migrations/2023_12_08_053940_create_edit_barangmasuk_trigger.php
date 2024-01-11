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
        DB::unprepared('
        CREATE TRIGGER barang_edit_masuk_stok_adjust
        BEFORE UPDATE ON barangmasuk
        FOR EACH ROW
        BEGIN
            DECLARE qty_diff INT;

            SET qty_diff = NEW.qty_masuk - OLD.qty_masuk;

            IF qty_diff > 0 THEN
                UPDATE barang
                SET barang.stok = barang.stok + qty_diff
                WHERE barang.id = NEW.barang_id;
            ELSE
                UPDATE barang
                SET barang.stok = barang.stok + qty_diff
                WHERE barang.id = NEW.barang_id AND barang.stok + qty_diff >= 0;
            END IF;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS barang_edit_masuk_stok_adjust');
    }
};