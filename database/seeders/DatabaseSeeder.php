<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $workspace = new Workspace();
        $workspace->name = 'CloudOnex';
        $workspace->save();

        $user = User::first();
        if(!$user)
        {
            $user = new User();
            $user->workspace_id = $workspace->id;
            $user->first_name = 'Jason';
            $user->last_name = 'M';
            $user->email = 'demo@cloudonex.com';
            $user->password = Hash::make('123456');
            $user->super_admin = 1;
            $user->save();

        }

        $data = [
            'company_name'=> 'CloudOnex'
        ];

        foreach($data as $key=>$value){

            $setting =  new Setting();

            $setting->key = $key;
            $setting->workspace_id = $workspace->id;
            $setting->value = $value;
            $setting->save();
        }
    }
}
