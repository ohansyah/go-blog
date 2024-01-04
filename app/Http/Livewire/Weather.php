<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Weather extends Component
{
    private $city = [
        'Jakarta' => ['lng' => '106.8223', 'lat' => '-6.1818'],
    ];

    public $weather;

    public function __construct()
    {
        $this->getWeather();
    }

    public function getWeather()
    {
        $selectedCity = 'Jakarta';
        $this->weather = Cache::remember('weather-' . $selectedCity, 60, function () use ($selectedCity) {
            $url = env('OPENMETEO_URL') . "?latitude=" . $this->city['Jakarta']['lat'] . "&longitude=" . $this->city['Jakarta']['lng'] . "&current=temperature_2m&timezone=Asia%2FBangkok";
            $response = Http::get($url);

            $data = [
                'city' => $selectedCity,
            ];

            if ($response->successful()) {
                $data = array_merge($data, $response->json());
            }

            return $data;
        });
    }

    public function render()
    {
        return view('livewire.weather');
    }
}
