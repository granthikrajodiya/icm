<?php

namespace Engage\Ilinxengage_qapp\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Engage\Ilinxengage_qapp\Models\QappDefinition;
use Illuminate\Support\Facades\DB;
use App\Facades\ILINX;
use Illuminate\Support\Facades\Schema;

class QappController extends Controller
{

    public function index() {

        return view('engage_ilinxengage_qapp::index', compact('qapps'));
    }


    public function create() {
        return view('engage_ilinxengage_qapp::create');
    }


    public function storeQapp(Request $request ) {

        $qapp = new QappDefinition;
        $qapp->tenant_id = \Auth::user()->tenant_id;
        $qapp->name = $request->title;
        $qapp->description = $request->description;
        $qapp->save();

        return redirect()->back()->with('success', __('Qapp Add Successfully!'))->with('tab-status', 'tabs-qapp-configuration');
    }


    public function edit($id) {
        $qapp = QappDefinition::where('tenant_id', \Auth::user()->tenant_id)->where('id', $id)->first();

        $response = ILINX::repositories()->setBaseUrl(config('ilinx.ics_url'))->index();
        $repositories = $response->Data;

        return view('engage_ilinxengage_qapp::edit', compact('qapp','repositories'));
    }


    public function updateQapp(Request $request, $id) {
        return view('engage_ilinxengage_qapp::edit');
    }


    public function storeProperties(Request $request, $id) {

        $qapp = QappDefinition::where('tenant_id', \Auth::user()->tenant_id)->where('id', $id)->first();
        $qapp->tenant_id = \Auth::user()->tenant_id;
        $qapp->name = $request->name;
        $qapp->description = $request->description;
        $qapp->online = $request->online ?? 0;
        $qapp->allow_upload = $request->allow_upload ?? 0;
        $qapp->allow_download = $request->allow_download ?? 0;
        $qapp->allow_print = $request->allow_print ?? 0;
        $qapp->ics_appname = $request->ics_appname;
        $qapp->save();

        return response()->json(
            [
                'is_success' => true,
                'message'    => __('Properties update successfully'),
            ],
            200
        );
    }


    public function storeDesigner(Request $request) {

        $tableName = 'qapp_data_'.$request->qappId;

        if (Schema::hasTable($tableName)) {
            foreach (json_decode($request->json, true) as $key => $value) {

                if($value['type'] == 'number'){
                    $type = 'DECIMAL(18,2)';
                }
                elseif($value['type'] == 'text'){
                    $type = 'VARCHAR(255)';
                }
                elseif($value['type'] == 'date'){
                    $type = 'DATETIME';
                }
                elseif($value['type'] == 'textarea'){
                    $type = 'TEXT';
                }
                else{
                    $type = 'VARCHAR(255)';
                }


                if (!Schema::hasColumn($tableName, $value['name'])) {
                    $qurie = "ALTER TABLE ".$tableName." ADD ".$value["name"]." VARCHAR(255)";
                    DB::statement($qurie);
                }
            }
        } else {
            $quries='';
            foreach (json_decode($request->json, true) as $key => $value) {
                if($value['type'] == 'number'){
                    $type = 'DECIMAL(18,2)';
                }
                elseif($value['type'] == 'text'){
                    $type = 'VARCHAR(255)';
                }
                elseif($value['type'] == 'date'){
                    $type = 'DATETIME';
                }
                elseif($value['type'] == 'textarea'){
                    $type = 'TEXT';
                }
                else{
                    $type = 'VARCHAR(255)';
                }
                    $quries .= $value['name'].' '.$type.',';
            }
            $qurry = DB::statement("CREATE TABLE $tableName (id INT AUTO_INCREMENT PRIMARY KEY,".$quries."created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)");
        }



        $qapp = QappDefinition::where('tenant_id', \Auth::user()->tenant_id)->where('id', $request->qappId)->first();
        $qapp->form_json = $request->json;
        $qapp->save();

        return response()->json(
            [
                'is_success' => true,
                'message'    => __('Form update successfully'),
            ],
            200
        );
        return redirect()->back()->with('success', __('Qapp Add Successfully!'));
    }


    public function storePresentation(Request $request, $id) {

        $qapp = QappDefinition::where('tenant_id', \Auth::user()->tenant_id)->where('id', $id)->first();
        $qapp->card_mode = $request->card_mode;
        $qapp->navigation_mode = $request->navigation_mode;
        $qapp->save();

        return response()->json(
            [
                'is_success' => true,
                'message'    => __('Presentation update successfully'),
            ],
            200
        );
    }

    public function destroyQapp($id){
        $qapp = QappDefinition::find($id);
        return view('engage_ilinxengage_qapp::delete', compact('qapp'));
    }

    public function deleteQapp(Request $request, $id){

        if($request->data_delete == 1){
            $tableName = 'qapp_data_'.$id;
            $qurie = "DROP TABLE $tableName";
            DB::statement($qurie);
        }

        $qapp = QappDefinition::find($id);
        $qapp->delete();

        return redirect()->back()->with('success', __('Qapp app successfully deleted!'))->with('tab-status', 'tabs-qapp-configuration');
    }
}
