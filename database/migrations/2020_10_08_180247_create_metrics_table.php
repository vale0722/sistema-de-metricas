<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->unsignedInteger('primary_id');
            $table->enum('status', \App\Constants\Statuses::toArray());
            $table->integer('total')->default(0);
            $table->timestamps();
        });

        $sql = <<<'EOT'
CREATE PROCEDURE `metrics_generate` (p_from date, p_until date)
BEGIN
    START TRANSACTION;
    DELETE FROM `metrics` WHERE `date` BETWEEN p_from AND DATE_ADD(p_until, INTERVAL 1 DAY);
    INSERT INTO `metrics` (`date`, `primary_id`, `status`, `total`)
    SELECT DATE(`created_at`) AS date, `seller_id` as primary_id, `status`,
         COUNT(*) as total
         FROM invoices
    WHERE `created_at` BETWEEN p_from AND DATE_ADD(p_until, INTERVAL 1 DAY)
    GROUP BY `date`, `primary_id`, `status`;
    COMMIT;
END
EOT;
        DB::unprepared('DROP PROCEDURE IF EXISTS metrics_generate');
        DB::unprepared($sql);

        $dateFrom = now()->subYear()->format('Y-m-d');
        $dateTo = now()->format('Y-m-d');

        DB::unprepared("call metrics_generate('$dateFrom', '$dateTo')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metrics');
    }
}
