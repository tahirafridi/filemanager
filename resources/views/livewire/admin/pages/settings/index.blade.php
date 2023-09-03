@section('style')
@endsection

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('admin.index') }}">{{ __('Dashboard') }}</a></li>
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
                    <h3 class="card-title">{{ __('API Token') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input wire:model="apiToken" type="text" disabled class="form-control" placeholder="Please generate new token by clicking 'Generate New' button.">
                                <p><small class="text-info">Generating new token will revoke all previous api tokens.</small></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button wire:click="createApiToken()" type="button" class="btn btn-dark">Generate New</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Minutes for Signed URL Expiry') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="number" wire:model="minutes" min="1" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button wire:click="saveMinutes()" type="button" class="btn btn-dark">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Logo') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bg-light border-1 p-2 shadow-sm mb-3">
                                @if ($logo)
                                    <div class="mr-2 text-center">
                                        <img src="{{ $logo->temporaryUrl() }}" style="max-height: 50px;">
                                    </div>
                                @else
                                    <div class="mr-2 text-center">
                                        <img src="{{ getLogo() }}" style="max-height: 50px;">
                                    </div>
                                @endif
                                <div>
                                    <x-fileupload.image name="logo" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button wire:click="saveLogo()" type="button" class="btn btn-dark">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
