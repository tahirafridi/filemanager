<?php

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/download/{secret}', function (Request $request, $secret) {
    if (! $request->hasValidSignature()) {
        abort(401);
    }
    
    $row = File::where('secret', $secret)->first();

    $mediaItem = $row->getMedia('files')[0];

    return response()->download($mediaItem->getPath(), $row->name);
})->name('download');

//  Auth routes
Route::namespace('\App\Livewire\Auth\Pages')->group(function() {
    Route::group(['middleware' => ['guest']], function () {
        Route::get('/login', Login::class)->name('login');
        Route::get('/forgot-password', ForgotPassword::class)->name('forgot.password');
        Route::get('/reset-password/{token}', ResetPassword::class)->name('reset.password');
    });
});

//  Admin panel routes
Route::namespace('\App\Livewire\Admin\Pages')->prefix('admin')->name('admin.')->middleware(['auth', 'auth.admin'])->group(function() {
    Route::get('/', DashboardLivewire::class)->name('index');
    Route::get('/folders', FolderLivewire::class)->name('folders.index');
    Route::get('/files/{file_id}/statistics', StatisticLivewire::class)->name('statistics.index');
    Route::get('/files/folder-upload', FolderUploadLivewire::class)->name('folder-upload.index');
    Route::get('/files/upload/{folder_id?}', UploadLivewire::class)->name('upload.index');
    Route::get('/files/remote-upload/{folder_id?}', RemoteUploadLivewire::class)->name('remote-upload.index');
    Route::get('/files/{folder_id?}', FileLivewire::class)->name('files.index');
    Route::get('/users', UserLivewire::class)->name('users.index');
    Route::get('/users/roles', RoleLivewire::class)->name('roles.index');
    Route::get('/settings', SettingLivewire::class)->name('settings.index');
});
