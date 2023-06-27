<?php

namespace App\Traits;

trait SessionTrait
{
    // Set a success banner
    public function flashSuccess($request)
    {
        $request->session()->flash('flash.bannerStyle', 'success');
        $request->session()->flash('flash.banner', 'Success!');
    }

    // Set a danger banner
    public function flashError($request, $message)
    {
        $request->session()->flash('flash.bannerStyle', 'danger');
        $request->session()->flash('flash.banner', $message);
    }
}
