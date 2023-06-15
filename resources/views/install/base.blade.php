<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{__('CloudOnex Installer')}}
    </title>
    <link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css" rel="stylesheet"/>
</head>
<body class="g-sidenav-show   bg-white">
<section>
    <div class="page-header section-height-75">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-6 d-flex flex-column mx-auto">
                    <div class="card">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
</body>
</html>
