<div 
    x-data="{ focused: false  }"
>
    <p>
        Choose <strong>{{ ucwords($attributes['name']) }}</strong> to upload <br>
        <small>Allowed file types: mp3</small>
    </p>

    <label for="{{ $attributes['name'] }}" class="btn btn-sm btn-dark">Choose</label>
    

    <div 
        x-data="{ uploading: false, progress: 2 }"
        x-on:livewire-upload-start="uploading = true"
        x-on:livewire-upload-finish="uploading = false; progress = 2"
        x-on:livewire-upload-error="uploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >
        <div x-show.transition="uploading" class="progress mt-2 rounded">
            <input wire:model="{{ $attributes['name'] }}" @focus="focused = true" @blur="focused = false" type="file" id="{{ $attributes['name'] }}" class="d-none" accept="audio/mp3" multiple>
            <div class="progress-bar bg-primary text-center px-1" x-bind:style="`width: ${progress}%`">
                <span x-text="`${progress}% Uploaded`"></span>
            </div>
        </div>
    </div>
</div>
