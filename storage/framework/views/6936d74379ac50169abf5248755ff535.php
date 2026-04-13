<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Manager</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

    
</head>

<body class="min-h-screen p-6 md:p-10">

    <span class="deco-heart" style="top: -2rem; right: -2rem;"></span>
    <span class="deco-heart" style="bottom: 5rem; left: -2rem; font-size:8rem;"></span>

    <div class="max-w-4xl mx-auto relative z-10">

        <div class="text-center mb-10">
            <p class="text-pink-400 text-sm font-semibold tracking-widest uppercase mb-1"></p>
            <h1 class="text-4xl md:text-5xl font-bold text-pink-700 display">Profile Manager</h1>
            <p class="text-pink-400 mt-2 text-sm"></p>
        </div>

        <div class="card rounded-3xl shadow-lg p-8 mb-10">
            <h2 class="text-2xl font-bold mb-1 text-pink-600 section-title display">Create Profile</h2>
            <p class="text-pink-300 text-sm mb-7"></p>

            <form action="/profile" method="post" class="space-y-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('POST'); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="block text-sm font-bold mb-1.5 text-pink-500">Name</label>
                        <input type="text" name="name" id="name"
                            class="w-full border rounded-2xl p-3 outline-none text-pink-900 placeholder-pink-200"
                            placeholder="Your name...">
                    </div>

                    <div>
                        <label for="age" class="block text-sm font-bold mb-1.5 text-pink-500">Age</label>
                        <input type="number" name="age" id="age"
                            class="w-full border rounded-2xl p-3 outline-none text-pink-900 placeholder-pink-200"
                            placeholder="How old are you?">
                    </div>

                    <div>
                        <label for="program" class="block text-sm font-bold mb-1.5 text-pink-500">Program</label>
                        <input type="text" name="program" id="program"
                            class="w-full border rounded-2xl p-3 outline-none text-pink-900 placeholder-pink-200"
                            placeholder="Your program...">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold mb-1.5 text-pink-500">Email</label>
                        <input type="email" name="email" id="email"
                            class="w-full border rounded-2xl p-3 outline-none text-pink-900 placeholder-pink-200"
                            placeholder="your@email.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="bg-pink-50 rounded-2xl p-4 border border-pink-100">
                        <p class="text-sm font-bold mb-3 text-pink-500">Gender</p>
                        <div class="flex items-center space-x-6">
                            <label class="radio-label inline-flex items-center cursor-pointer group">
                                <input type="radio" name="gender" value="male" class="accent-pink-500">
                                <span class="ml-2 text-sm text-pink-700">Male</span>
                            </label>
                            <label class="radio-label inline-flex items-center cursor-pointer group">
                                <input type="radio" name="gender" value="female" class="accent-pink-500">
                                <span class="ml-2 text-sm text-pink-700">Female</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-pink-50 rounded-2xl p-4 border border-pink-100">
                        <p class="text-sm font-bold mb-3 text-pink-500">Hobbies</p>
                        <div class="flex flex-wrap gap-2">
                            <?php $__currentLoopData = ['Reading', 'Gaming', 'Coding', 'Sports', 'Music']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hobby): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="inline-flex items-center cursor-pointer group">
                                    <input type="checkbox" name="hobbies[]" value="<?php echo e(strtolower($hobby)); ?>"
                                        class="accent-pink-500 rounded">
                                    <span class="ml-1.5 text-xs font-semibold text-pink-700"><?php echo e($hobby); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="bio" class="block text-sm font-bold mb-1.5 text-pink-500">Short Biography</label>
                    <textarea name="bio" id="bio" rows="3"
                        class="w-full border rounded-2xl p-3 outline-none text-pink-900 placeholder-pink-200 resize-none"
                        placeholder="Write a little something about yourself..."></textarea>
                </div>

                <button type="submit" class="btn-primary w-full md:w-auto px-10 py-3.5 text-white font-bold rounded-2xl text-sm tracking-wide">
                    Submit Profile
                </button>
            </form>
        </div>

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-pink-700 section-title display">Registered Profiles</h2>
                <p class="text-pink-300 text-xs mt-2"></p>
            </div>

            <?php if(session()->has('profile')): ?>
                <form action="/delete-profile" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit"
                        class="px-5 py-2.5 border-2 border-pink-200 text-pink-400 rounded-2xl hover:bg-pink-50 hover:border-pink-300 transition text-xs font-bold tracking-wide">
                        Delete All
                    </button>
                </form>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <?php if(session()->has('profile')): ?>

                <?php $__currentLoopData = session('profile'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="profile-card p-6 rounded-3xl">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-pink-600 display"><?php echo e($user['name'] ?? 'Anonymous'); ?></h3>
                                <p class="text-xs text-pink-300 uppercase tracking-widest font-semibold mt-0.5">
                                    <?php echo e($user['program'] ?? 'No Program'); ?>

                                </p>
                            </div>
                            <span class="badge-gender px-3 py-1 text-xs font-bold rounded-full uppercase">
                                <?php echo e($user['gender'] ?? 'N/A'); ?>

                            </span>
                        </div>

                        <div class="border-t border-pink-100 mb-4"></div>

                        <div class="space-y-2 text-sm">
                            <p>
                                <span class="font-semibold text-pink-400">Age:</span>
                                <span class="text-pink-700"><?php echo e($user['age'] ?? 'N/A'); ?></span>
                            </p>
                            <p>
                                <span class="font-semibold text-pink-400">Email:</span>
                                <span class="text-pink-700"><?php echo e($user['email'] ?? 'N/A'); ?></span>
                            </p>

                            <?php if(isset($user['hobbies']) && count($user['hobbies']) > 0): ?>
                                <div class="flex flex-wrap gap-1.5 mt-2">
                                    <?php $__currentLoopData = $user['hobbies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hobby): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="hobby-tag"><?php echo e(ucfirst($hobby)); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty($user['bio'])): ?>
                                <p class="italic text-pink-500 mt-3 border-l-2 border-pink-200 pl-3 text-xs leading-relaxed">
                                    "<?php echo e($user['bio']); ?>"
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php else: ?>
                <div class="col-span-full empty-state rounded-3xl p-14 text-center">
                    <p class="text-pink-400 font-semibold text-sm">No profiles yet</p>
                    <p class="text-pink-300 text-xs mt-1"></p>
                </div>
            <?php endif; ?>
        </div>

        <p class="text-center text-pink-300 text-xs mt-12 mb-4"></p>
    </div>

</body>
</html><?php /**PATH C:\Users\Administrator\BalioProject\resources\views/profile.blade.php ENDPATH**/ ?>