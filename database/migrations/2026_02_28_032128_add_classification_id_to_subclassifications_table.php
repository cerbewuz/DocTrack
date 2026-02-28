<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('subclassifications', function (Blueprint $table) {
            $table->unsignedBigInteger('classification_id')->nullable()->after('id');
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
        });

        // Map subclassifications to classifications
        // 1: Indorsement/Transmittal
        // 2: Letter
        // 3: Memorandum

        $mapping = [
            1 => [
                "Acknowledgement Receipt for Equipment(ARE)",
                "Allotment Files",
                "Bonding Files",
                "Certifications of Funds Availability"
            ],
            2 => [
                "Administrative Cases",
                "Advice",
                "Affidavits",
                "Applications(Employment, Leave, Relief, Retirements/Resignation)",
                "Authorizations",
                "Certifications",
                "Complaints/Protest",
                "Contracts",
                "Deeds"
            ],
            3 => [
                "Accomplished Reports",
                "Action plan/Work Plan/Financial Plan",
                "Annual Budgets",
                "Annual Statement of Accounts Payable",
                "Attendance Monitoring Sheets",
                "Budget Estimates",
                "Budget Sheet Analysis"
            ]
        ];

        foreach ($mapping as $classificationId => $subNames) {
            foreach ($subNames as $name) {
                DB::table('subclassifications')
                    ->where('name', $name)
                    ->update(['classification_id' => $classificationId]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subclassifications', function (Blueprint $table) {
            $table->dropForeign(['classification_id']);
            $table->dropColumn('classification_id');
        });
    }
};
