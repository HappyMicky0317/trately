<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    public static function availableModules()
    {
        return [
            'projects' => __('Product Planning'),
            'to_dos' => __('Tasks'),
            'brainstorm' => __('Ideation Canvas'),
            'investors' => __('Investors'),
            'business_model' => __('Business Model'),
            'startup_canvas' => __('Startup Canvas'),
            'swot' => __('SWOT Analysis'),
            'pest' => __('PEST Analysis'),
            'pestle' => __('PESTLE Analysis'),
            'business_plan' => __('Business Plan'),
            'marketing_plan' => __('Marketing Plan'),
            'calendar' => __('Calendar'),
            'notes' => __('Note Book'),
            'documents' => __('Documents'),
            'mckinsey' => __('McKinsey 7-S Model'),
            'porter' => __('Porter\'s Five Forces Model'),
        ];
    }
}
