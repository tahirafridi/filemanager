<div
    wire:ignore
    x-data
    x-init="
        filePondObj = FilePond.setOptions({
            allowMultiple: true,
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, (event) => {
                        progress(event.detail.progress, event.detail.progress, 100);
                    })
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                }
            }
        });
        filePondObj = FilePond.create($refs.input);

        this.addEventListener('FilePondReset', e => {
            filePondObj.removeFiles();
        });
    "
>
    <input type="file" x-ref="input">
</div>
