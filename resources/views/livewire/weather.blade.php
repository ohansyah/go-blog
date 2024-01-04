<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">

        <div class="flex items-center">
            <div class="flex-shrink-0">
                <!-- Adjusted SVG size to be twice as big -->
                <x-svg.weather-icon />
            </div>
            <div class="ml-4">
                <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ $weather['city'] }}</h1>
                <p class="text-gray-600 dark:text-gray-300">{{ $weather['current']['temperature_2m'] }} {{ $weather['current_units']['temperature_2m'] }}</p>
            </div>
        </div>

    </div>
</div>
