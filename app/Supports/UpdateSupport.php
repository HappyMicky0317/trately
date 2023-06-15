<?php
namespace App\Supports;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class UpdateSupport
{
    public static function updateSchema()
    {

//        $has_super_admin = User::where('id',1)->first();
//        if(!$has_super_admin) {
//            $user = new User();
//            $user->id = 1;
//            $user->workspace_id = 1;
//            $user->first_name = 'Sales';
//            $user->last_name = 'premiereja';
//            $user->email = 'mchristie@premiereja.com';
//            $user->password = Hash::make('88dRtCMQ49bRmgzF');
//            $user->super_admin = 1;
//            $user->save();
//        }



        try {
            if(!Schema::hasColumn('workspaces','owner_id'))
            {
                Schema::table('workspaces', function (Blueprint $table)
                {
                    $table->unsignedInteger('owner_id')->default(0);
                });
                Schema::table('business_plans', function (Blueprint $table)
                {
                    $table->string('logo')->nullable();
                });
                Schema::table('subscription_plans', function (Blueprint $table)
                {
                    $table->unsignedInteger('maximum_allowed_users')->default(0);
                });
            }


            if (!Schema::hasColumn('users', 'timezone'))
            {
                Schema::table('users', function (Blueprint $table)
                {
                    $table->string('timezone',150)->nullable();
                });
            }


            if(!Schema::hasTable('brain_storms')){
                Schema::create('brain_storms', function (Blueprint $table) {
                    $table->id();
                    $table->uuid('uuid');
                    $table->unsignedInteger('workspace_id');
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->string('title')->nullable();
                    $table->string('image')->nullable();
                    $table->longText('src')->nullable();
                    $table->text('description')->nullable();
                    $table->string('shareable_key')->nullable();
                    $table->boolean('is_public')->default(0);
                    $table->unsignedInteger('sort_order')->default(0);
                    $table->unsignedInteger('group_id')->default(0);
                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('pest_analyses')){
                Schema::create('pest_analyses', function (Blueprint $table) {
                    $table->id();
                    $table->uuid('uuid');
                    $table->unsignedInteger('workspace_id');
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->string('company_name')->nullable();
                    $table->text('political')->nullable();
                    $table->text('economic')->nullable();
                    $table->text('social')->nullable();
                    $table->text('technological')->nullable();
                    $table->timestamps();
                });
            }

            if(!Schema::hasTable('privacy_policies'))
            {
                Schema::create('privacy_policies', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->string('title')->nullable();
                    $table->date('date')->nullable();
                    $table->text('description')->nullable();
                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('terms'))
            {
                Schema::create('terms', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->string('title')->nullable();
                    $table->date('date')->nullable();
                    $table->text('description')->nullable();
                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('contact_sections'))
            {
                Schema::create('contact_sections', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->string('title')->nullable();
                    $table->string('subtitle')->nullable();
                    $table->string('email')->nullable()->unique();
                    $table->string('phone_number')->nullable()->unique();
                    $table->string('twitter')->nullable()->unique();
                    $table->string('facebook')->nullable()->unique();
                    $table->string('linkedin')->nullable()->unique();
                    $table->string('youtube')->nullable()->unique();
                    $table->string('address_1')->nullable()->unique();
                    $table->string('address_2')->nullable()->unique();
                    $table->string('zip')->nullable()->unique();
                    $table->string('city')->nullable()->unique();
                    $table->string('state')->nullable()->unique();
                    $table->string('country')->nullable()->unique();
                    $table->timestamps();
                });
            }


            if(!Schema::hasTable('landing_pages'))
            {

                Schema::create('landing_pages', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->string('hero_title')->nullable();
                    $table->string('hero_subtitle')->nullable();
                    $table->string('background_image')->nullable();
                    $table->text('hero_paragraph')->nullable();


                    $table->string('feature1_title')->nullable();
                    $table->string('feature1_subtitle')->nullable();

                    $table->string('feature1_one')->nullable();
                    $table->text('feature1_one_paragraph')->nullable();

                    $table->string('feature1_two')->nullable();
                    $table->text('feature1_two_paragraph')->nullable();

                    $table->string('feature1_three')->nullable();
                    $table->text('feature1_three_paragraph')->nullable();

                    $table->string('feature1_four')->nullable();
                    $table->text('feature1_four_paragraph')->nullable();

                    $table->string('feature1_five')->nullable();
                    $table->text('feature1_five_paragraph')->nullable();

                    $table->string('feature1_six')->nullable();
                    $table->text('feature1_six_paragraph')->nullable();

                    $table->string('feature1_image')->nullable();
                    $table->string('feature1_image_title')->nullable();
                    $table->string('feature1_image_subtitle')->nullable();


                    $table->string('feature2_title')->nullable();
                    $table->string('feature2_subtitle')->nullable();


                    $table->string('feature2_one')->nullable();
                    $table->text('feature2_one_paragraph')->nullable();

                    $table->string('feature2_two')->nullable();
                    $table->text('feature2_two_paragraph')->nullable();

                    $table->string('feature2_three')->nullable();
                    $table->text('feature2_three_paragraph')->nullable();

                    $table->string('feature2_four')->nullable();
                    $table->text('feature2_four_paragraph')->nullable();

                    $table->string('feature2_five')->nullable();
                    $table->text('feature2_five_paragraph')->nullable();

                    $table->string('feature2_six')->nullable();
                    $table->text('feature2_six_paragraph')->nullable();

                    $table->string('feature2_seven')->nullable();
                    $table->text('feature2_seven_paragraph')->nullable();

                    $table->string('feature2_eight')->nullable();
                    $table->text('feature2_eight_paragraph')->nullable();

                    $table->string('partners_title')->nullable();
                    $table->string('partners_subtitle')->nullable();
                    $table->text('partners_paragraph')->nullable();
                    $table->string('calltoaction_title')->nullable();
                    $table->string('calltoaction_subtitle')->nullable();

                    $table->string('story1_title')->nullable();
                    $table->text('story1_paragrapgh')->nullable();
                    $table->string('story1_image')->nullable();

                    $table->string('story2_title')->nullable();
                    $table->text('story2_paragrapgh')->nullable();
                    $table->string('story2_image')->nullable();

                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('pestel_analyses'))
            {
                Schema::create('pestel_analyses', function (Blueprint $table) {
                    $table->id();
                    $table->uuid('uuid');
                    $table->unsignedInteger('workspace_id');
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->string('company_name')->nullable();
                    $table->text('political')->nullable();
                    $table->text('economic')->nullable();
                    $table->text('social')->nullable();
                    $table->text('technological')->nullable();
                    $table->text('environmental')->nullable();
                    $table->text('legal')->nullable();
                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('mckinsey_models'))
            {
                Schema::create('mckinsey_models', function (Blueprint $table) {
                    $table->id();
                    $table->uuid('uuid');
                    $table->unsignedInteger('workspace_id');
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->string('company_name')->nullable();
                    $table->text('structure')->nullable();
                    $table->text('strategy')->nullable();
                    $table->text('system')->nullable();
                    $table->text('shared_values')->nullable();
                    $table->text('skill')->nullable();
                    $table->text('style')->nullable();
                    $table->text('staff')->nullable();
                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('startup_canvases'))
            {
                Schema::create('startup_canvases', function (Blueprint $table) {
                    $table->id();
                    $table->uuid('uuid');
                    $table->unsignedInteger('workspace_id');
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->unsignedInteger('product_id')->default(0);
                    $table->string('company_name')->nullable();
                    $table->string('name')->nullable();
                    $table->string('email')->nullable();
                    $table->string('phone')->nullable();
                    $table->text('problems')->nullable();
                    $table->text('solutions')->nullable();
                    $table->text('value_propositions')->nullable();
                    $table->text('unfair_advantage')->nullable();
                    $table->text('channels')->nullable();
                    $table->text('key_matrices')->nullable();
                    $table->text('customer_segments')->nullable();
                    $table->text('revenue_stream')->nullable();
                    $table->text('cost_structure')->nullable();
                    $table->text('team')->nullable();
                    $table->text('market')->nullable();
                    $table->text('risks')->nullable();
                    $table->text('performance')->nullable();
                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('investors'))
            {
                Schema::create('investors', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedInteger('workspace_id');
                    $table->unsignedInteger('product_id')->nullable();
                    $table->string('first_name');
                    $table->string('last_name');
                    $table->string('email')->unique();
                    $table->string('phone_number')->nullable()->unique();
                    $table->string('password_reset_key')->nullable()->unique();
                    $table->string('mobile_number')->nullable()->unique();
                    $table->string('twitter')->nullable()->unique();
                    $table->string('facebook')->nullable();

                    $table->string('linkedin')->nullable();
                    $table->string('address_1')->nullable()->unique();
                    $table->string('address_2')->nullable()->unique();
                    $table->string('zip')->nullable()->unique();
                    $table->string('city')->nullable()->unique();
                    $table->string('state')->nullable()->unique();
                    $table->string('country')->nullable()->unique();
                    $table->timestamp('email_verified_at')->nullable();
                    $table->string('password')->nullable();
                    $table->decimal('amount')->nullable();
                    $table->string('language')->nullable();
                    $table->string('source')->nullable();
                    $table->string('status')->nullable();
                    $table->text('notes')->nullable();
                    $table->string('photo')->nullable();
                    $table->string('cover_photo')->nullable();
                    $table->boolean('super_admin')->default(0);
                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('porter_models'))
            {
                Schema::create('porter_models', function (Blueprint $table) {
                    $table->id();
                    $table->uuid('uuid');
                    $table->unsignedInteger('workspace_id');
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->string('company_name')->nullable();
                    $table->text('rivals')->nullable();
                    $table->text('entrants')->nullable();
                    $table->text('suppliers')->nullable();
                    $table->text('customers')->nullable();
                    $table->text('substitute')->nullable();
                    $table->timestamps();
                });
            }

            if(!Schema::hasColumn('subscription_plans','paypal_plan_id'))
            {
                Schema::table('subscription_plans', function (Blueprint $table) {
                    $table->string('paypal_plan_id')->nullable();
                    $table->string('stripe_plan_id')->nullable();
                });

            }

            if(!Schema::hasColumn('subscription_plans','max_file_upload_size'))
            {
                Schema::table('subscription_plans', function (Blueprint $table) {
                    $table->unsignedInteger('max_file_upload_size')->default(0);
                    $table->unsignedInteger('file_space_limit')->default(0);
                });

                Schema::table('documents', function (Blueprint $table) {
                    $table->unsignedInteger('size')->default(0);
                });
            }
            if(!Schema::hasColumn('business_plans','file'))
            {
                Schema::table('business_plans', function (Blueprint $table) {
                    $table->unsignedInteger('file')->default(0);

                });

            }
            if(!Schema::hasTable('marketing_plans'))
            {
                Schema::create('marketing_plans', function (Blueprint $table) {
                    $table->id();
                    $table->uuid('uuid');
                    $table->unsignedInteger('workspace_id');
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->unsignedInteger('product_id')->default(0);
                    $table->string('company_name')->nullable();
                    $table->text('summary')->nullable();
                    $table->text('description')->nullable();
                    $table->text('business_initiatives')->nullable();
                    $table->text('team')->nullable();
                    $table->text('target_market')->nullable();
                    $table->text('budget')->nullable();
                    $table->text('marketing_channels')->nullable();
                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('cookie_policies'))
            {
                Schema::create('cookie_policies', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->string('title')->nullable();
                    $table->date('date')->nullable();
                    $table->text('description')->nullable();
                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('blogs'))
            {
                Schema::create('blogs', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedInteger("workspace_id");
                    $table->uuid("uuid");
                    $table->unsignedInteger("admin_id")->default(0);
                    $table->string("title")->nullable();
                    $table->string("topic")->nullable();
                    $table->string("slug")->nullable();
                    $table->text("notes")->nullable();
                    $table->string("cover_photo")->nullable();
                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('notice_boards'))
            {
                Schema::create('notice_boards', function (Blueprint $table) {
                    $table->id();
                    $table->unsignedInteger("workspace_id");
                    $table->uuid("uuid");
                    $table->unsignedInteger("admin_id")->default(0);
                    $table->string("title")->nullable();
                    $table->string("topic")->nullable();
                    $table->string("slug")->nullable();
                    $table
                        ->enum("status", ["Draft", "Published", "Unpublished"])
                        ->default("Draft");

                    $table->text("notes")->nullable();
                    $table->string("cover_photo")->nullable();
                    $table->timestamps();
                });
            }
            if(!Schema::hasTable('reports'))
            {
                Schema::create('reports', function (Blueprint $table) {
                    $table->id();
                    $table->uuid('uuid');
                    $table->unsignedInteger('workspace_id');
                    $table->unsignedInteger('admin_id')->default(0);
                    $table->unsignedInteger('product_id')->default(0);
                    $table->string('name')->nullable();
                    $table->date('date')->nullable();
                    $table->string('email')->nullable();
                    $table->string('phone')->nullable();
                    $table->text('executive_summary')->nullable();
                    $table->text('administrative_analysis')->nullable();
                    $table->text('technical_analysis')->nullable();
                    $table->text('financial_analysis')->nullable();
                    $table->text('improvement_activities')->nullable();
                    $table->text('recommendations')->nullable();
                    $table->string("status")->nullable();
                    $table->string("uncertainty_level")->nullable();
                    $table->string("feasibility_level")->nullable();
                    $table->timestamps();
                });
            }
            if(!Schema::hasColumn('business_models','product_id'))
            {
                Schema::table('business_models', function (Blueprint $table) {
                    $table->unsignedInteger('product_id')->default(0);
                });
            }



        } catch (\Exception $e) {
            Log::error($e->getMessage());

            dd($e->getMessage());

            return false;
        }

    }
}
