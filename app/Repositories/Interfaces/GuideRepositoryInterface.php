<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface GuideRepositoryInterface
{
    public function saveGuide(Request $request);

    public function updateGuide(Request $request, $id);

    public function findById($id);
}