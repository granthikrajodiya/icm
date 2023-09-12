<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;

class NoteApiController extends Controller
{
    public function index($batchId)
    {
        $userNotes = Note::where('batch_id', 'LIKE', $batchId)->with('createdBy')->get();

        return response()->json($userNotes);
    }
}
