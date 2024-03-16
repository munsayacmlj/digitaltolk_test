<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use DTApi\Helpers\TeHelper;
use Carbon\Carbon;

class WillExpireAtTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testWillExpireAtLessThan90Hrs()
    {
      $due = Carbon::now()->addHours(89);
      $created_at = Carbon::now();

      $will_expire_at = TeHelper::willExpireAt($due, $created_at);

      $this->assertEquals(
        $due,
        $will_expire_at
      );
    }

    public function testWillExpireAtLessThan24Hrs()
    {
      $due = Carbon::now()->addHours(20);
      $created_at = Carbon::now();

      $will_expire_at = TeHelper::willExpireAt($due, $created_at);

      $this->assertEquals(
        $created_at->addMinutes(90),
        $will_expire_at
      );
    }

    public function testWillExpireAtBetween24And72Hrs()
    {
      $due = Carbon::now()->addHours(50);
      $created_at = Carbon::now();

      $will_expire_at = TeHelper::willExpireAt($due, $created_at);

      $this->assertEquals(
        $created_at->addHours(16),
        $will_expire_at
      );
    }

    public function testWillExpireAtGreaterThan90Hrs()
    {
      $due = Carbon::now()->addHours(100);
      $created_at = Carbon::now();

      $will_expire_at = TeHelper::willExpireAt($due, $created_at);

      $this->assertEquals(
        $due->subHours(48),
        $will_expire_at
      );
    }
}