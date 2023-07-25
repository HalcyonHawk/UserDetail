<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class PrefixAPIController extends Controller
{
    /**
     * Return prefixes from config as json
     */
    public function index() {
        $prefixes = config('prefixes.options');

        return response()->json(['prefixes' => $prefixes]);
    }
}
