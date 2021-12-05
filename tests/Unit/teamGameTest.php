<?php

namespace Tests\Unit;

use Tests\TestCase;

class teamGameTest extends TestCase
{
    public function test_a_team_total_players()
    {
        $this->assertCount(5, array(35, 100, 20, 50, 40));
    }

    public function test_b_team_total_players()
    {
        $this->assertCount(5, array(35, 10, 30, 20, 90));
    }

    public function test_equal_number_of_players_in_each_team()
    {
        $this->assertSame(count(array(35, 100, 20, 50, 40)), count(array(35, 10, 30, 20, 90)));
    }


}
