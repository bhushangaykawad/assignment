<?php

namespace Tests\Feature;

use App\Console\Commands\Utility;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UtilitiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_gives_last_weekday_of_month_for_payment()
    {
        $utility = new Utility();

        $date = Carbon::createFromDate(2020, 5, 1);

        $this->assertEquals("29-May-2020", $utility->getPaymentDate($date));
    }

    /** @test */
    public function it_gives_last_date_of_month_for_payment_if_it_is_weekday()
    {
        $utility = new Utility();
   
        $date = Carbon::createFromDate(2020, 3, 1);
   
        $this->assertEquals("31-Mar-2020", $utility->getPaymentDate($date));
    }

    /** @test */
    public function it_gives_last_weekday_before_fifteenth_for_bonus_payment()
    {
        $utility = new Utility();

        $date = Carbon::createFromDate(2020, 2, 1);

        $this->assertEquals("19-Feb-2020", $utility->getBonusPaymentDate($date));
    }

    /** @test */
    public function it_gives_fifteenth_for_bonus_payment_if_it_is_weekday()
    {
        $utility = new Utility();
    
        $date = Carbon::createFromDate(2020, 4, 1);
    
        $this->assertEquals("15-Apr-2020", $utility->getBonusPaymentDate($date));
    }

    /** @test */
    public function it_generates_month_payment_date_and_bonus_payment_date()
    {
        $utility = new Utility();
 
        $date = Carbon::createFromDate(2020, 2, 1);
 
        $payment_date = $utility->getPaymentDate($date);
        $bonus_payment_date = $utility->getBonusPaymentDate($date);
 
        $this->assertEquals(
            "'" . $date->format("F") . "','" . $payment_date . "','" . $bonus_payment_date . "'",
            $utility->getRow($date)
        );
    }
}
