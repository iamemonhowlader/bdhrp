<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

if (!Schema::hasColumn('about_sections', 'show_on_about_page')) {
    Schema::table('about_sections', function (Blueprint $table) {
        $table->boolean('show_on_about_page')->default(true)->after('show_in_menu');
    });
    echo "Column added successfully\n";
} else {
    echo "Column already exists\n";
}
