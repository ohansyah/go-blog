<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Inspiring;
use Livewire\Component;

class Welcome extends Component
{
    private $inspiringQuote;
    public $quote;

    public function __construct()
    {
        $this->inspiringQuote = Inspiring::quote();
        $this->splitQuote();
    }

    public function getQuote()
    {
        $this->inspiringQuote = Inspiring::quote();
        $this->splitQuote();
    }

    public function render()
    {
        return view('livewire.welcome');
    }

    private function splitQuote()
    {
        $quoteArray = explode('</>', $this->inspiringQuote);
        $this->quote = [
            'message' => $quoteArray[0].'</>',
            'author' => $quoteArray[1],
        ];
    }
}
