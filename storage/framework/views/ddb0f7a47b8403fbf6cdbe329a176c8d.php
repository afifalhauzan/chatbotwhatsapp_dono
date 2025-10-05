<?php if($errors->any()): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <strong class="font-bold">Oops!</strong>
        <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>- <?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<div class="space-y-6">
    <div>
        <label for="keyword" class="block text-sm font-medium text-gray-700">Keyword</label>
        <input type="text" name="keyword" id="keyword" value="<?php echo e(old('keyword', $botReply->keyword ?? '')); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        <p class="mt-2 text-xs text-gray-500">Angka atau kata kunci yang diketik user. Harus unik.</p>
    </div>

    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="title" id="title" value="<?php echo e(old('title', $botReply->title ?? '')); ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
        <p class="mt-2 text-xs text-gray-500">Judul singkat untuk referensi admin.</p>
    </div>

    <div>
        <label for="response_text" class="block text-sm font-medium text-gray-700">Teks Balasan</label>
        <textarea name="response_text" id="response_text" rows="8" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required><?php echo e(old('response_text', $botReply->response_text ?? '')); ?></textarea>
        <p class="mt-2 text-xs text-gray-500">Isi pesan yang akan dikirim oleh bot. Gunakan Enter untuk baris baru.</p>
    </div>

    <div>
        <label for="type" class="block text-sm font-medium text-gray-700">Tipe Balasan</label>
        <select name="type" id="type" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            <option value="info" <?php echo e(old('type', $botReply->type ?? '') == 'info' ? 'selected' : ''); ?>>Info (Jawaban Akhir)</option>
            <option value="menu" <?php echo e(old('type', $botReply->type ?? '') == 'menu' ? 'selected' : ''); ?>>Menu (Ada Pilihan Lanjutan)</option>
        </select>
        <p class="mt-2 text-xs text-gray-500">'Info' akan otomatis menambahkan menu utama di akhir balasan.</p>
    </div>
</div>
<?php /**PATH C:\laragon\www\laravel_whatsappbot\whatsapptest-stable\resources\views/admin/bot_replies/_form.blade.php ENDPATH**/ ?>