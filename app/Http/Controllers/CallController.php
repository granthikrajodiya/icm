<?php

namespace App\Http\Controllers;

use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class CallController extends Controller
{
    public function index()
    {
        return redirect()->route('settings', tenant('tenant_id'))->with('task-tab-status', 'calls');
    }

    public function create($batchId)
    {
        App::setLocale(user()->lang);

        return view('call.create', ['batchId' => $batchId]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject'   => 'required',
            'call_type' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first())->with('task-tab-status', 'calls');
        }

        Call::create([
            'batch_id'    => $request->batch_id,
            'subject'     => $request->subject,
            'call_type'   => $request->call_type,
            'duration'    => $request->duration,
            'user_id'     => user()->id,
            'description' => $request->description,
            'call_date'   => $request->call_date,
            'created_by'  => user()->id,
        ]);

        return redirect()->back()->with('success', __('Call successfully added!'))->with('task-tab-status', 'calls');
    }

    public function edit(Call $call)
    {
        \App::setLocale(user()->lang);

        return view('call.edit', compact('call'));
    }

    public function update(Request $request, Call $call)
    {
        $validator = Validator::make($request->all(), [
            'subject'   => 'required',
            'call_type' => 'required',
        ]);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first())->with('task-tab-status', 'calls');
        }

        $call->subject     = $request->subject;
        $call->call_type   = $request->call_type;
        $call->duration    = $request->duration;
        $call->description = $request->description;
        $call->call_date   = $request->call_date;
        $call->save();

        return redirect()->back()->with('success', __('Call successfully updated!'))->with('task-tab-status', 'calls');
    }

    public function destroy(Call $call)
    {
        $call->delete();

        return redirect()->back()->with('success', __('Call successfully deleted!'))->with('task-tab-status', 'calls');
    }
}
