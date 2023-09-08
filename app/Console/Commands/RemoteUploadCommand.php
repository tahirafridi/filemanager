<?php

namespace App\Console\Commands;

use App\Models\File;
use Illuminate\Support\Str;
use App\Models\RemoteUpload;
use Illuminate\Console\Command;

class RemoteUploadCommand extends Command
{
    protected $signature = 'upload:remote';

    protected $description = 'Upload files remotely.';

    public function handle()
    {
        $urls = RemoteUpload::where('status', 'In-Progress')->get();

        foreach ($urls as $url) {
            try {
                $url->update(['status' => 'Uploading']);
                
                $row = File::create([
                    'folder_id' => $url->folder_id,
                    'name'      => uniqid(),
                    'secret'    => Str::random(60) . $url->folder_id . uniqid(),
                ]);

                $file = $row->addMediaFromUrl($url->url)->toMediaCollection('files');
                
                $row->update(['name' => $file->name]);

                $url->delete();
            } catch (\Throwable $th) {
                \Log::info($th->getMessage());
            }
        }
    }
}