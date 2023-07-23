<div>
    <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
        <x-application-logo class="block h-12 w-auto" />

        <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
            {!! $quote['message'] !!}
        </h1>

        <p class="mt-3 text-gray-500 dark:text-gray-400 leading-relaxed">
            {!! $quote['author'] !!}
        </p>

        <div style="display: flex; flex-direction: column; justify-content: flex-end;">
            <button style="align-self: flex-end; margin: 1rem;" wire:click="getQuote" class="btn btn-circle btn-outline btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
            </button>
        </div>
    </div>
</div>
