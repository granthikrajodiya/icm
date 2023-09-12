<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscussionController extends Controller
{
    public function create($batchId)
    {
        return view('discussion.create', ['batchId' => $batchId]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first())->with('task-tab-status', 'discussion');
        }

        $discussion             = new Discussion();
        $discussion->batch_id   = $request->batch_id;
        $discussion->comment    = $request->comment;
        $discussion->created_by = user()->id;
        $discussion->save();

        return redirect()->back()->with('success', __('Discussion successfully added!'))->with('task-tab-status', 'discussion');
    }
}
