<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Util;

class SalaryPaymentDateTool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ee:salarydates {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It determines the dates they need to pay salaries to their sales department.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $content = $this->addColumns();

        $content .= $this->getRowsContent();

        Storage::disk('public')->put($this->arguments('filename')['filename'] . '.csv', $content);
    }

    protected function addColumns()
    {
        return "'Month Name','Payment Date','Bonus Payment Date'\n";
    }

    protected function getRowsContent()
    {
        $utility = new Utility();
        
        $period = CarbonPeriod::create(Carbon::today(), '1 month', Carbon::parse(date('Y-01-01'))->addYear());
        
        $content = '';
        
        foreach ($period as $date) {
            $content .= $utility->getRow($date) . "\n";
        }
        
        return $content;
    }
}
