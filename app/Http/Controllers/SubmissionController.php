<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessSubmission;
use Illuminate\Support\Facades\Validator;

class SubmissionController extends Controller
{
   public function submit (Request $request){


     // Validate input
     $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

     // Dispatch job to process submission
     ProcessSubmission::dispatch($request->all());

     return response()->json(['message' => 'Submission received, processing...'], 200);

   }
}
