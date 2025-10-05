<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Balasan Bot</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 sm:p-6 lg:p-8 max-w-2xl">
        <header class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Balasan Bot</h1>
            <p class="text-gray-600">Mengedit balasan untuk keyword: <span class="font-mono bg-gray-200 px-2 py-1 rounded"><?php echo e($botReply->keyword); ?></span></p>
        </header>
        
        <form action="<?php echo e(route('admin.bot_replies.update', $botReply)); ?>" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <?php echo $__env->make('admin.bot_replies._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="mt-8 flex justify-end space-x-3">
                <a href="<?php echo e(route('admin.bot_replies.index')); ?>" class="bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 transition-colors">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-indigo-700 transition-colors">
                    Perbarui
                </button>
            </div>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\laravel_whatsappbot\whatsapptest-stable\resources\views/admin/bot_replies/edit.blade.php ENDPATH**/ ?>