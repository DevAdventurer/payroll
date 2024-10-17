
<?php $__env->startPush('links'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('main'); ?>

<div class="content-header row">

    <div class="content-header-left col-md-6 col-12 mb-2">
      <h5 class="content-header-title mb-0">Create Menu</h5>
    </div>

    <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
        <div class="btn-group" role="group">
            <?php if (\Illuminate\Support\Facades\Blade::check('can', 'add_menu')): ?>
                <a href="<?php echo e(route('admin.menu.create')); ?>" class="btn btn-primary btn-sm">Add Menu</a>
            <?php endif; ?>
       </div>
    </div>
</div>
</div>

<div class="card">
    <div class="card-content">
        <div class="card-body">
           <?php echo Form::open(['route'=>['admin.menu.update', $menu->slug], 'method'=>'put','id'=>'menuForm']); ?>

                <div class="form-group">
                    <?php echo Form::label('name', 'Menu Name', ['class'=>'control-label']); ?>

                <?php echo Form::text('name', $menu->name, ['class'=>'form-control']); ?>

                <b class="text-danger"><?php echo e($errors->first('name')); ?></b>
                </div>


                <div class="form-group">
                    <?php echo Form::label('icon', 'Icon', ['class'=>'control-label']); ?>

                    <?php echo Form::text('icon', $menu->icon, ['class'=>'form-control']); ?>

                    <b class="text-danger"><?php echo e($errors->first('icon')); ?></b>
                </div>

                <div class="form-group">
                    <?php echo Form::label('status', 'Status', ['class'=>'control-label']); ?>

                <?php echo Form::select('status', array(1 => 'Active', '0' => 'Deactive'), $menu->status, array('class' => 'form-control')); ?>

                <b class="text-danger"><?php echo e($errors->first('status')); ?></b>
                </div>                       
                <div class="form-group">
                    <input type="hidden" name="slug" value="<?php echo e($menu->slug); ?>" />
                    <button type="submit" onclick="submitForm()" style=" margin-right: 14px;padding: 7px;width: 71px;background: #dcd7d7;" class="btn btn-success">Update</button>
                    
                </div>
            <?php echo Form::close(); ?>


        </div>
             
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/menu/edit.blade.php ENDPATH**/ ?>