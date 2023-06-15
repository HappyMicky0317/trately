{{__('Follow this link to reset your password-')}} {{config('app.url')}}/password-reset?id={{$user->id}}&token={{$user->password_reset_key}}
