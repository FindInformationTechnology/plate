<?php $__env->startSection('title', __('message.Contact_Us') . ' - ' . config('app.name')); ?>
<?php $__env->startSection('meta_description', __('message.Contact_Meta_Description')); ?>

<?php $__env->startSection('content'); ?>

    <!-- Banner Section -->
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-12 col-12">
                    <h2 class="breadcrumb-title"><?php echo e(__('message.Contact_Us')); ?></h2>
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo e(route('home')); ?>"><?php echo e(__('message.Home')); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?php echo e(__('message.Contact_Us')); ?>

                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <!-- Contact Form + Info -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            <!-- Form -->
            <div>
                <h2 class="text-2xl font-semibold mb-6 text-gray-800"><?php echo e(__('message.Send_Us_Message')); ?></h2>

                <?php if(session('success')): ?>
                    <div class="alert alert-success mb-4">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('contact.send')); ?>" class="space-y-5">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <input type="text" name="name" placeholder="<?php echo e(__('message.Your_Name')); ?>"
                            class="form-control rounded-md <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('name')); ?>"
                            required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <input type="email" name="email" placeholder="<?php echo e(__('message.Your_Email')); ?>"
                            class="form-control rounded-md <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>"
                            required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <textarea name="message" rows="5" placeholder="<?php echo e(__('message.Your_Message')); ?>"
                            class="form-control rounded-md resize-none <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            required><?php echo e(old('message')); ?></textarea>
                        <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit"
                        class="bg-[#ac1e23] text-white px-6 py-2 rounded hover:bg-red-700 transition-colors">
                        <?php echo e(__('message.Send_Message')); ?>

                    </button>
                </form>
            </div>

            <!-- Info -->
            <div class="space-y-6 text-lg text-gray-700">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800"><?php echo e(__('message.Contact_Details')); ?></h2>
                <div class="flex items-start gap-3">
                    <i class='bx bx-map text-2xl text-[#ac1e23]'></i>
                    <div>
                        <p class="font-semibold"><?php echo e(__('message.Address')); ?></p>
                        <p><?php echo e(__('message.Location')); ?></p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <i class='bx bx-phone text-2xl text-[#ac1e23]'></i>
                    <div>
                        <p class="font-semibold"><?php echo e(__('message.Phone')); ?></p>
                        <p style="direction: ltr;">+971 50 551 5131</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <i class='bx bx-envelope text-2xl text-[#ac1e23]'></i>
                    <div>
                        <p class="font-semibold"><?php echo e(__('message.Email')); ?></p>
                        <p>info@plate35.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <!-- <section class="w-full h-[400px]">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3609.729477826438!2d55.270782!3d25.204849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f434c3c36b715%3A0x4b3df2c9c1a1b76a!2sDubai%20Mall!5e0!3m2!1sen!2sae!4v1719777098254"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </section> -->



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/front/contact.blade.php ENDPATH**/ ?>