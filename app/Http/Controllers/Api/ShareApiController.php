<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ShareApiController extends Controller
{
    private $signedMinutes = 10;

    public function store(Request $request)
    {
        $rules = [
            'fileKey'   => 'required',
            'minutes'   => 'required|integer|min:1',
            'ip'        => 'required',
        ];

        if ($this->runValidation($request, $rules) != 'valid') {
            return $this->runValidation($request, $rules);
        }

        DB::beginTransaction();

        try {
            $file = File::where('secret', $request->fileKey)->first();

            if (!$file) {
                throw new Exception("The fileKey has no file.");
            }

            $this->signedMinutes = $request->minutes;
            
            $signedUrl = URL::temporarySignedRoute('download', now()->addMinutes($this->signedMinutes), [
                'secret' => $file->secret
            ]);

            $file->statistics()->create([
                'signed_minutes'    => $this->signedMinutes,
                'signed_url'        => $signedUrl,
                'ip'                => $request->ip,
            ]);

            DB::commit();
    
            return response()->json([
                'code'      => 200,
                'status'    => 'success',
                'message'   => 'Temporary signed URL successfully generated.',
                'signedUrl' => $signedUrl,
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'code'      => 500,
                'status'    => 'error',
                'message'   => $th->getMessage(),
            ], 500);
        }
    }

    private function runValidation($request, $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $key = "";
            $message = "";

            foreach ($validator->messages()->toArray() as $key => $errors) {
                $key = $key;
                $message = $errors[0];
                break;
            }

            return response()->json([
                'code'      => 400,
                'status'    => 'error',
                'message'   => $message,
                'key'       => $key,
            ], 400);
        }

        return 'valid';
    }
}
