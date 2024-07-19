<?php

namespace App\Console\Commands;

use App\Models\AllModel;
use App\Models\CarBrandMake;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteDuplicateModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'distnict:models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $idsToKeep = AllModel::select(DB::raw('MIN(id) as id'))
        ->groupBy('value')
        ->pluck('id')
        ->toArray();

        $distnictModels = AllModel::whereNotIn('id',$idsToKeep)->delete();

        // $idsToKeep = CarBrandMake::select(DB::raw('MIN(id) as id'))
        // ->groupBy('makes')
        // ->pluck('id')
        // ->toArray();

        // $distnictModels = CarBrandMake::whereNotIn('id',$idsToKeep)->delete();
    }
}
