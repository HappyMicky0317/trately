<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css" rel="stylesheet"/>
</head>
<body class="bg-pink-light">

<main class="main-content main-content-bg mt-0">
    <section class="min-vh-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0 mt-sm-12 mt-9 mb-4">
                        <div class="card-header text-center pt-4 pb-1">
                            <h4 class="font-weight-bolder mb-1">{{__('Reset password')}}</h4>
                            <p class="mb-0">{{__('Set a new password')}}</p>
                        </div>
                        <div class="card-body">
                            <form role="form " action="/post-new-password" method="post">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="list-unstyled">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <label class="form-label mb-3">{{__('New password')}}</label>
                                <div class="form-group">
                                    <input class="form-control" name="password" type="password">
                                </div>
                                <label class="form-label mb-3">{{__('Confirm new password')}}</label>
                                <div class="form-group">
                                    <input class="form-control" name="password_confirmation" type="password"
                                           placeholder="Confirm password">
                                </div>
                                @csrf
                                <div class="text-center">

                                    <input type="hidden" name="id" value="{{$id}}">
                                    <input type="hidden" name="password_reset_key" value="{{$password_reset_key}}">

                                    <button type="submit"
                                            class="btn bg-gradient-dark btn-lg w-100 my-4 mb-2">{{__('Send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
</body>
</html>
