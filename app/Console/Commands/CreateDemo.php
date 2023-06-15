<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\Todo;
use App\Models\Workspace;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $data = [
            'company_name'=> 'CloudOnex'
        ];

        $workspace = Workspace::first();

        foreach($data as $key=>$value){

            $setting = Setting::where('key',$key)->first();

            if(!$setting)
            {
                $setting =  new Setting();
                $setting->key = $key;
                $setting->workspace_id = $workspace->id;
            }

            $setting->value = $value;
            $setting->workspace_id = $workspace->id;
            $setting->save();

        }

        $today = date('Y-m-d');

        $todos = [
            [
                'title' => 'Write a Blog Post',
                'date' => $today,
            ],
            [
                'title' => 'Test 2',
                'date' => $today,
            ]
        ];

        DB::table('todos')->truncate();



        return 0;
    }
}
