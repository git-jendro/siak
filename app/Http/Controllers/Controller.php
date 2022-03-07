<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function slug($param)
    {
        return Str::slug($param);
    }

    public function storage($param1, $param2)
    {
        return Storage::put($param1, $param2);
    }

    public function deleteFile($param)
    {
        if (Storage::exists($param)) {
            return Storage::delete($param);
        }
    }

    function generateUUID($prefix, $length)
    {
        $random = $prefix;
        for ($i = 0; $i < $length; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : rand(0, 9);
        }
        return $random;
    }
}
