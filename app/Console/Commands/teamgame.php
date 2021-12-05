<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PHPUnit\Framework\Test;

class teamgame extends Command
{
    protected $signature = 'team:game';

    protected $description = 'Team Game Handler';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $aTeam = explode(',', $this->ask('Enter A Team Players'));
        $bTeam = explode(',', $this->ask('Enter B Team Players'));

        if(count($aTeam) == 0)
        {
            $this->error('A Team required');
            return Command::FAILURE;
        }

        if(count($bTeam) == 0)
        {
            $this->error('B Team required');
            return Command::FAILURE;
        }

        /* Validation 1: Checking total number of players in each team */
        if(count($aTeam) !== count($bTeam))
        {
            $this->error('Players Count Mis-match, Retry Again.');
            return Command::FAILURE;
        }

        /* Validation 2: Checking total number of players in a team exceeds system limit */
        if(count($aTeam) > 5 || count($bTeam) > 5) {
            $this->error('Max limit allowed is only 5 players');
            return Command::FAILURE;
        }

        /* Validation 3: Checking for A Team valid scores */
        if(!array_reduce($aTeam, function($c, $v){return $c & (int)is_numeric($v);}, 1)) {
            $this->error('Numbers only, Retry Again.');
            return Command::FAILURE;
        }

        /* Validation 4: Checking for B Team valid scores */
        if(!array_reduce($bTeam, function($c, $v){return $c & (int)is_numeric($v);}, 1)) {
            $this->error('Numbers only, Retry Again.');
            return Command::FAILURE;
        }

        $isATeamWinner = true;

        for($i = 0; $i < count($aTeam); $i++) {
            if($aTeam[$i] < $bTeam[$i]) {
                $isATeamWinner = false;
            }
        }

        if($isATeamWinner) {
            $this->info( 'Win');
        }
        else {
            $this->error('Lose');
        }

        return Command::SUCCESS;
    }
}
