<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'attachment' => ['required', 'file'],
        ]);

        dd($request);
        $path = $request->file('attachment')->store('public/trix-attachments');

        return [
            'image_url' => Storage::url($path),
        ];
    }
}
