    <?php $layout->viewContext->mergeIntoNewEnvironment($__env); ?>

    <?php $__env->startComponent($layout->view, $layout->params); ?>
        <?php $__env->slot($layout->slotOrSection); ?>
            <?php echo $content; ?>

        <?php $__env->endSlot(); ?>

        <?php
        // Manually forward slots defined in the Livewire template into the layout component...
        foreach (\Illuminate\Support\Arr::collapse($layout->viewContext->slots) as $name => $slot) {
            $__env->slot($name, attributes: $slot->attributes->getAttributes());
            echo $slot->toHtml();
            $__env->endSlot();
        }
        ?>
    <?php echo $__env->renderComponent(); ?><?php /**PATH /Users/tahirkhanafridi/Sites/filemanager/storage/framework/views/b1d337bd7e1aa0fa66257be27d33215c.blade.php ENDPATH**/ ?>