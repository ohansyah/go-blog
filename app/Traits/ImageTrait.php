<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageTrait
{
    /**
     * handling file upload
     * @param Request $request
     * @param string $field
     * @param string $path
     * @param string $driver
     * @return string|bool
     */

    function uploadImage(Request $request, $field, $path, $driver = 'public')
    {
        if (!$request->hasFile($field)) {
            return false;
        }

        $userPath = $path . '/' . auth()->user()->id;
        $path = $request->file($field)->store($userPath, $driver);

        return $path;
    }
}
