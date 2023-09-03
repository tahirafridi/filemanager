<div 
    x-data="{ focused: false  }"
>
    <p>
        <small>Allowed file types: png, svg</small>
    </p>

    <input wire:model="{{ $attributes['name'] }}" @focus="focused = true" @blur="focused = false" type="file" id="{{ $attributes['name'] }}" accept=".png,.svg">
</div>
