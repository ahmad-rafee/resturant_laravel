<?php

namespace App\Http\Controllers;

use App\Models\Master\Tenant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $user, $tenant;
    public $except = [];
    public $resource;
    public function __construct(Request $request)
    {
    }
}
