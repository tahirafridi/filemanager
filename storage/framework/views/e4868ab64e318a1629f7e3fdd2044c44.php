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
                    <h3 class="card-title"><?php echo e($label); ?></h3>
                    <div class="card-tools">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('folder_create')): ?>
                            <button wire:click="create" type="button" class="btn btn-secondary btn-xs">
                                <i class="fa fa-plus"></i> <?php echo e(__('Add New')); ?>

                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-between mb-3">
                        <div class="col-3 col-sm-2 col-md-2">
                            <select wire:model.live="per_page" class="custom-select" title="Per Page">
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                        <div class="col-9 col-sm-6 col-md-5 col-lg-4">
                            <input wire:model.live.debounce.400ms="search" type="search" class="form-control" placeholder="Search...">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="recordList" class="table table-hover table-sm text-nowrap">
                            <thead>
                                <tr>
                                    <!-- __BLOCK__ --><?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th <?php echo e(setAttributes($column)); ?>>
                                            <!-- __BLOCK__ --><?php if($column['sort']): ?>
                                                <span wire:click.prevent="sort('<?php echo e($column['name']); ?>')" class="pointer">
                                                    <!-- __BLOCK__ --><?php if($order_by == $column['name']): ?>
                                                        <i class="fas fa-arrow-<?php echo e($direction == 'desc' ? 'down' : 'up'); ?>"></i>
                                                    <?php endif; ?> <!-- __ENDBLOCK__ -->
                                                    <?php echo e($column['title']); ?>

                                                </span>
                                            <?php else: ?>
                                                <?php echo e($column['title']); ?>

                                            <?php endif; ?> <!-- __ENDBLOCK__ -->
                                        </th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!-- __ENDBLOCK__ -->
                                </tr>
                            </thead>
                            <tbody>
                                <!-- __BLOCK__ --><?php if($rows->count()): ?>
                                    <!-- __BLOCK__ --><?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($row->id); ?></td>
                                            <td>
                                                <a wire:navigate href="<?php echo e(route('admin.files.index', $row->id)); ?>"><?php echo e($row->name); ?></a>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('folder_edit')): ?>
                                                        <button wire:click="edit(<?php echo e($row->id); ?>)" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit text-success"></i></button>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('folder_delete')): ?>
                                                        <button wire:click="delete(<?php echo e($row->id); ?>)" type="button" class="btn btn-sm btn-default"><i class="fa fa-trash text-danger"></i></button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <!-- __ENDBLOCK__ -->
                                <?php else: ?>
                                    <tr>
                                        <td colspan="<?php echo e(count($columns)); ?>">
                                            <p class="text-secondary text-center">No records found.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?> <!-- __ENDBLOCK__ -->
                            </tbody>
                        </table>
                    </div>

                    <!-- __BLOCK__ --><?php if($rows->count()): ?>
                        <hr>
                        <div class="row justify-content-between mt-3">
                            <div class="col-12 col-md-3">
                                Showing <?php echo e($rows->firstItem()); ?> to <?php echo e($rows->lastItem()); ?> out of <?php echo e($rows->total()); ?> results
                            </div>
                            <div class="col-12 col-md-9">
                                <?php echo e($rows->links()); ?>

                            </div>
                        </div>
                    <?php endif; ?> <!-- __ENDBLOCK__ -->
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('livewire.admin.pages.folders.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH /Users/tahirkhanafridi/Sites/filemanager/resources/views/livewire/admin/pages/folders/index.blade.php ENDPATH**/ ?>