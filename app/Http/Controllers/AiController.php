<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AiController extends BaseController
{
    //
    public function ai(Request $request)
    {

        $content='';
        $client = \OpenAI::client($this->super_settings['openai_api_key']);
        $action = $request->action;

        $messages = [];

        if($action == 'key_partners'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate key partners of a Business Model Canvas',
                ],
            ];
        }
        if($action == 'key_activities'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'What key activities do the value propositions of a business model canvas require?',
                ],
            ];
        }
        if($action == 'key_resources'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'What key resources do the value propositions of a business model canvas require?',
                ],
            ];
        }
        if($action == 'value_propositions'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate value proposition of a Business Model Canvas',
                ],
            ];
        }
        if($action == 'customer_relationships'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate customer_relationships of a Business Model Canvas',
                ],
            ];
        }
        if($action == 'channels'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the Channels to get customers of a Business Model Canvas',
                ],
            ];
        }

        if($action == 'customer_segments'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the customer segments of a Business Model Canvas',
                ],
            ];
        }
        if($action == 'cost_structure'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the cost structure segments of a Business Model Canvas',
                ],
            ];
        }
        if($action == 'revenue_stream'){
            $messages = [
                [
                    'role' => 'system',
                    'content' => 'My business name is '.($request->company_name ?? 'Business'),

                ],
                [
                    'role' => 'user',
                    'content' => 'Generate the revenue_streams segments of a Business Model Canvas',
                ],
            ];
        }

        $response = $client->chat()->create([
            'model'=>'gpt-3.5-turbo',
            'messages'=> $messages,
        ]);

        foreach ($response->choices as $result) {
            $content .= $result->message->content;
        }

       $content = Str::markdown($content);

        return response()->json([
            'message' => $content,
            'status' => 'success',

        ], 200);


    }
}
