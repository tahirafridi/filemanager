<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a wire:navigate href="<?php echo e(route('admin.index')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e($label); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title"><?php echo e(__('API Token')); ?></h3>
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
                    <h3 class="card-title"><?php echo e(__('Minutes for Signed URL Expiry')); ?></h3>
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
                    <h3 class="card-title"><?php echo e(__('Logo')); ?></h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bg-light border-1 p-2 shadow-sm mb-3">
                                <!-- __BLOCK__ --><?php if($logo): ?>
                                    <div class="mr-2 text-center">
                                        <img src="<?php echo e($logo->temporaryUrl()); ?>" style="max-height: 50px;">
                                    </div>
                                <?php else: ?>
                                    <div class="mr-2 text-center">
                                        <img src="<?php echo e(getLogo()); ?>" style="max-height: 50px;">
                                    </div>
                                <?php endif; ?> <!-- __ENDBLOCK__ -->
                                <div>
                                    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.fileupload.image','data' => ['name' => 'logo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('fileupload.image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'logo']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
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
<?php /**PATH /Users/tahirkhanafridi/Sites/filemanager/resources/views/livewire/admin/pages/settings/index.blade.php ENDPATH**/ ?>