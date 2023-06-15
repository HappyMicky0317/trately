<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public static function updateSettings($workspace_id,$key,$value)
    {

        $setting = self::where('key',$key)->first();

        if($setting)
        {
            $setting->value = $value;
            $setting->save();
        }
        else{
            $setting = new Setting();

            $setting->workspace_id = $workspace_id;
            $setting->key = $key;
            $setting->value = $value;

            $setting->save();
        }


    }


    public static function getSuperAdminSettings()
    {
        $settings_data = Setting::where('workspace_id',1)->get();
        $settings = [];

        foreach($settings_data as $setting){
            $settings[$setting->key] = $setting->value;
        }
        return $settings;
    }

    public static function removeSettings($workspace_id,$key)
    {
        $setting = self::where('workspace_id',$workspace_id)
            ->where('key',$key)
            ->first();
        if($setting)
        {
            $setting->delete();
        }
    }
}
