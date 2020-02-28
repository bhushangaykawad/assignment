<?php

namespace Tests\Feature;

use App\Console\Commands\utility;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class SalaryPaymentDateToolTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function command_generates_csv_file()
    {
        $this->artisan('ee:salarydates FileName');

        Storage::disk('public')->assertExists('FileName.csv');
    }
}
