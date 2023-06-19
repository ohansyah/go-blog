<div class="mt-6">
    <label for="image" class="block text-gray-700 dark:text-gray-300 font-medium">Image</label>
    <div x-data="{ image: null }">
        <input type="file" name="image" class="file-input file-input-bordered w-full max-w-xs" accept="image/*" @change="image = URL.createObjectURL($event.target.files[0])">
        <div x-show="image">
            <img :src="image" alt="Preview" class="mt-2 max-h-60 object-cover rounded-md">
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js"></script>
@endpush