<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.index') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.files.index') }}">{{ __('Files') }}</a></li>
                        <li class="breadcrumb-item active">{{ $label }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">{{ $label }}</h3>
                    <div class="card-tools">
                        @can('file_remote_upload')
                            <a wire:navigate href="{{ route('admin.remote-upload.index', $folder->id ?? null) }}" class="btn btn-primary btn-xs">
                                <i class="fas fa-cloud-upload-alt"></i> {{ __('Remote Upload') }}
                            </a>
                        @endcan
                        @can('file_upload')
                            <a href="{{ route('admin.upload.index', $folder->id ?? null) }}" class="btn btn-secondary btn-xs">
                                <i class="fas fa-file-upload"></i> {{ __('File(s) Upload') }}
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <form wire:submit="getFiles">
                        <div class="row">
                            <div class="col-12">
                                <label for="folder_path">Folder Path <i class="text-danger">*</i></label>
                                <div class="input-group mt-1">
                                    <input wire:model="folder_path" id="folder_path" type="text" class="form-control" required>
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Get Files</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive mt-5">
                        <form wire:submit="store">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="input-group mb-2">
                                        <select wire:model="folder_id" class="custom-select" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($folders as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-dark">Move Selected Files</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                        <table id="recordList" class="table table-bordered table-hover table-sm text-nowrap">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($localFiles))
                                    @foreach ($localFiles as $localFile)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input wire:model="selectedFiles" type="checkbox" class="form-check-input" value="{{ json_encode($localFile) }}" id="{{ $localFile['name'] }}">
                                                    <label class="mb-0 font-weight-normal" for="{{ $localFile['name'] }}">{{ $localFile['name'] }}</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="">
                                            <p class="text-secondary text-center">No records found.</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
