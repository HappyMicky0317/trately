<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class InstallController extends Controller
{
    protected function writeEnvironmentFile($key, $val)
    {
        $path = base_path(".env");
        if (file_exists($path)) {
            $val = '"' . trim($val) . '"';
            file_put_contents(
                $path,
                str_replace(
                    $key . '="' . env($key) . '"',
                    $key . "=" . $val,
                    file_get_contents($path)
                )
            );
        }
    }

    function checkDatabaseConnection(
        $db_host = "",
        $db_name = "",
        $db_user = "",
        $db_pass = ""
    ) {
        if (@mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
            return true;
        }

        return false;
    }

    public function index()
    {
        $this->writeEnvironmentFile("APP_URL", URL::to("/"));
        return \view("install.index");
    }

    public function step1()
    {
        return view("install.step1", [
            "write_permission_env" => is_writable(base_path(".env")),
            "write_permission_route_service_provider" => is_writable(
                base_path("app/Providers/RouteServiceProvider.php")
            ),
        ]);
    }

    public function step2(Request $request)
    {
        $has_error = $request->has_error;
        return view("install.step2", [
            "has_error" => $has_error,
        ]);
    }

    public function dbInstallation(Request $request)
    {
        $request->validate([
            "DB_HOST" => "required|string",
            "DB_DATABASE" => "required|string|max:100",
            "DB_USERNAME" => "required|string|max:100",
        ]);
        if (
            $this->checkDatabaseConnection(
                $request->DB_HOST,
                $request->DB_DATABASE,
                $request->DB_USERNAME,
                $request->DB_PASSWORD
            )
        ) {
            $path = base_path(".env");
            if (file_exists($path)) {
                foreach ($request->types as $type) {
                    $this->writeEnvironmentFile($type, $request[$type]);
                }
                return redirect("step3");
            }

            return redirect()->route("step2");
        }

        return redirect()->route("step2", ["has_error" => true]);
    }

    public function step3()
    {
        return \view("install.step3");
    }

    public function importSql()
    {
        $sql_path = base_path("startupkit.sql");
        DB::unprepared(file_get_contents($sql_path));
        return redirect()->route("step4");
    }

    public function step4()
    {
        return \view("install.step4");
    }

    public function step5()
    {
        return \view("install.step5");
    }

    public function step6()
    {
        $previousRouteServiceProvier = base_path(
            "app/Providers/RouteServiceProvider.php"
        );
        $newRouteServiceProvier = base_path(
            "app/Providers/RouteServiceProvider.txt"
        );
        copy($newRouteServiceProvier, $previousRouteServiceProvier);
        try {
            Artisan::call("storage:link");
        } catch (\Exception $exception) {
        }
        return \view("install.step6");
    }

    public function setAdminProfile(Request $request)
    {
        $request->validate([
            "first_name" => "required|string|max:100",
            "last_name" => "required|string|max:100",
            "email" => "required|email|max:100",
            "password" => "required|min:5|string|confirmed",
        ]);

        $user = User::first();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route("step6");
    }
}
