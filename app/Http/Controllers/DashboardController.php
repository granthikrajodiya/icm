<?php

namespace App\Http\Controllers;

use App\Facades\ILINX;
use App\Models\Utility;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function index($view = '', $order = '') {
        $dashboards = ILINX::form()->dashboards();
        $orderBy = $order; // For List View
        $viewBy  = $view; // For Grid View

        if ($dashboards->Success == true) {
            if ($view == 'list') {
                return view('dashboards.index', compact('dashboards', 'orderBy'));
            } else {
                return view('dashboards.indexGrid', compact('dashboards', 'view'));
            }

            return view('dashboards.indexGrid', compact('dashboards'));
        }

        return redirect()->back()->with('error', __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'));
    }

    public function detail($param) {
        $usrData  = Session::get('userInfo');
        $dashboards = ILINX::form()->dashboards();
        $height   = 720;
        $dashboardData = [];

        if ($dashboards->Success == true) {
            foreach ($dashboards->Data as $dashboard) {
                $dashboard_param = explode('param=', $dashboard->ViewUrl);

                if ($dashboard_param[1] == $param) {
                    $dashboardData = $dashboard;
                    $dashboardData->height = $height;
                }
            }

             // Make sure we found the eForm being requested
            if (empty($dashboardData)) {
                return redirect()->back()->with('error', __('You do not have permission to access this form. Please contact your system administrator'));
            }

            return view('dashboards.detail', compact('dashboardData', 'usrData'));
        }

        return redirect()->back()->with('error', __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'));
    }


    /**
     *  returns array of Dashboard names on the response->Data
     *  Made of the datasource selection of single dashboards
     */
    public static function getDashboardList(){
        $response = ILINX::form()->dashboards();
        if (!$response->Success) {
            $err               = new \stdClass();
            $err->Success      = false;
            return $err;
        }

        $data          = new \stdClass();
        $data->Success = $response->Success;
        $data->Data    = [];
        foreach ($response->Data as $index => $datum) {
            $dashboard_param = explode('param=', $datum->ViewUrl);

            $data->Data[$dashboard_param[1]] = $datum->Name;
        }

        return $data;
    }


}
