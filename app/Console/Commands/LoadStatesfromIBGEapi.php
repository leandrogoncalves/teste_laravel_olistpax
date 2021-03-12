<?php

namespace App\Console\Commands;

use App\Services\LoadStatesIBGEService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LoadStatesfromIBGEapi extends Command
{
    protected $loadStatesService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:load-states-ibge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load states from ibge api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LoadStatesIBGEService $IBGEService)
    {
        parent::__construct();
        $this->loadStatesService = $IBGEService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $this->line('Load states from ibge started at '.Carbon::now()->toDateTimeString());
            $this->loadStatesService->loadStates();
            $this->line('Load states from ibge finished at '.Carbon::now()->toDateTimeString());
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }
    }
}
