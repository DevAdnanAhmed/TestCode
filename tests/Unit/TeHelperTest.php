<?php

namespace tests\Unit;

use Tests\TestCase;
use App\Helpers\TeHelper;
use Carbon\Carbon;

class TeHelperTest extends TestCase
{
    /**
     * Test willExpireAt function with various scenarios
     *
     * @return void
     */
    public function testWillExpireAt()
    {
        // Test case 1: Difference <= 90
        $due_time = Carbon::now()->addHours(50);
        $created_at = Carbon::now()->subHours(40);
        $expected = $due_time->format('Y-m-d H:i:s');
        $this->assertEquals($expected, TeHelper::willExpireAt($due_time, $created_at));

        // Test case 2: Difference <= 24
        $due_time = Carbon::now()->addHours(10);
        $created_at = Carbon::now()->subHours(10);
        $expected = $created_at->addMinutes(90)->format('Y-m-d H:i:s');
        $this->assertEquals($expected, TeHelper::willExpireAt($due_time, $created_at));

        // Test case 3: 24 < Difference <= 72
        $due_time = Carbon::now()->addHours(30);
        $created_at = Carbon::now()->subHours(50);
        $expected = $created_at->addHours(16)->format('Y-m-d H:i:s');
        $this->assertEquals($expected, TeHelper::willExpireAt($due_time, $created_at));

        // Test case 4: Difference > 72
        $due_time = Carbon::now()->addHours(100);
        $created_at = Carbon::now()->subHours(200);
        $expected = $due_time->subHours(48)->format('Y-m-d H:i:s');
        $this->assertEquals($expected, TeHelper::willExpireAt($due_time, $created_at));
    }
}
