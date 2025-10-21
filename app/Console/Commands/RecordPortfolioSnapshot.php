<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\PortfolioHistory;
use App\Traits\CalculatesPortfolioValue;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RecordPortfolioSnapshot extends Command
{
    use CalculatesPortfolioValue;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:record-portfolio-snapshot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Records a daily snapshot of each user\'s portfolio value.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $totalValue = $this->getTotalValue($user);

            PortfolioHistory::create([
                'user_id' => $user->id,
                'value' => $totalValue,
                'date' => Carbon::today(),
            ]);
        }

        $this->info('Portfolio snapshots recorded successfully!');
    }
}
