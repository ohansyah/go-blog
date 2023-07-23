<div class="mt-6">
    <button type="submit" class="btn btn-outline">
        {{__('general.submit')}}
        <div wire:loading.delay><span class="loading loading-spinner text-primary"></span></div>
    </button>
    <a href="{{ route($route) }}" class="btn btn-ghost">
        {{__('general.back')}}
    </a>
</div>