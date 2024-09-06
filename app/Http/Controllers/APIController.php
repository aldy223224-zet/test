<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\Production;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIController extends Controller
{

  public function Production(Production $production){  
    return ApiFormatter::createApi(200,"Success",$production);
  }
  public function User(User $user){  
    return ApiFormatter::createApi(200,"Success",$user);
  }

}
