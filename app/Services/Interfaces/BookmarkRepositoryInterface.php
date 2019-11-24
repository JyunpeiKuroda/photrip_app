<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface BookmarkRepositoryInterface
{
    public function compose(Request $request);
}