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
                            <a href="{{ route('admin.remote-upload.index', $folder->id ?? null) }}" class="btn btn-primary btn-xs">
                                <i class="fas fa-cloud-upload-alt"></i> {{ __('Remote Upload') }}
                            </a>
                        @endcan
                        @can('file_folder_upload')
                            <a href="{{ route('admin.folder-upload.index') }}" class="btn btn-success btn-xs">
                                <i class="fas fa-upload"></i> {{ __('Folder Upload') }}
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <form wire:submit="store">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Folder <i class="text-danger">*</i></label>
                                    <select wire:model="folder_id" class="custom-select" required>
                                        <option value="">-- Select --</option>
                                        @foreach ($folders as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <x-fileupload.filepond wire:model="files" />
                            </div>
                            <div class="col-sm-12 mt-4 text-right">
                                <button type="submit" class="btn btn-dark">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
