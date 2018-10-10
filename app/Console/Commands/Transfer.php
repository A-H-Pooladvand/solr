<?php

namespace App\Console\Commands;

use App\Console\Commands\Handlers\Transfer\Transfer as TransferHandler;
use Illuminate\Console\Command;

class Transfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer from mysql database to solr database.';

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
        $transfer = new TransferHandler();

        $transfer->handle();
    }
}
