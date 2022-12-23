<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\NotifyMailJob;

class NotifyMailController extends Controller
{
   
    public function store(Request $request)
    {
        $user = (object) $request->all();
              
        try {
          
          NotifyMailJob::dispatch($user)->delay(now()->addSecond('15'));
        //    Mail::queue($content);
        } catch (\Throwable $th) {
            return $th;
        }
    }
   
}
