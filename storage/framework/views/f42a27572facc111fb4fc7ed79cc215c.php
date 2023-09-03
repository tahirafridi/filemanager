<div 
    x-data="{ focused: false  }"
>
    <p>
        <small>Allowed file types: png, svg</small>
    </p>

    <input wire:model="<?php echo e($attributes['name']); ?>" @focus="focused = true" @blur="focused = false" type="file" id="<?php echo e($attributes['name']); ?>" accept=".png,.svg">
</div>
<?php /**PATH /Users/tahirkhanafridi/Sites/filemanager/resources/views/components/fileupload/image.blade.php ENDPATH**/ ?>