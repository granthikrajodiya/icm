<?php

namespace App\Http\Controllers;

use App\Models\RestIntegration;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;

/**
 * @SuppressWarnings(PHPMD)
 */
class RestIntegrationController extends Controller
{
    public function index()
    {
        if (user()->account_type == 1) {
            return redirect()->route('settings', tenant('tenant_id'));
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('Permission Denied.'),
        ]);
    }

    public function create()
    {
        if (user()->account_type == 1) {
            $configuration = RestIntegration::where(['created_by' => user()->id])->get()->pluck('name', 'id');

            return view('integrations.create', compact('configuration'));
        }

        return redirect()->back()->with('error', __('Permission Denied.'))->with('tab-status', 'integrations');
    }

    public function configureTest(Request $request)
    {
        if (user()->account_type == 1) {
            $requestType = $request->Requesttype;

            $inputs = $request->input($requestType);

            $valid = [];

            if ($requestType == 'first') {
                $valid['name'] = 'required';
            } else {
                if ($requestType != 'first') {
                    if (empty($inputs['rest_endpoint_url'])) {
                        $valid['rest_endpoint_url'] = 'required';
                    }

                    if (empty($inputs['http_method'])) {
                        $valid['http_method'] = 'required';
                    }

                    if (!isset($inputs['data_format'])) {
                        $valid['data_format'] = 'required';
                    }

                    if (isset($inputs['http_authentication'])) {
                        if (empty($inputs['http_username'])) {
                            $valid['http_username'] = 'required';
                        }
                        if (empty($inputs['http_password'])) {
                            $valid['http_password'] = 'required';
                        }
                    }

                    if (isset($inputs['custom_http_headers'])) {
                        if (empty($inputs['http_headers'])) {
                            $valid['http_headers'] = 'required';
                        }
                    }
                }
            }

            $validator = Validator::make($request->all(), $valid);

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return response()->json([
                    'is_success' => false,
                    'message'    => $messages->first(),
                ]);
            }

            $titles = [];
            $detail = [];

            if (($requestType == 'first' && !empty($inputs['rest_endpoint_url'])) || $requestType != 'first') {
                $restEndpointUrl = $inputs['rest_endpoint_url'];
                $httpUsername    = $inputs['http_username'];
                $httpPassword    = $inputs['http_password'];
                $httpHeaders     = !empty($inputs['http_headers']) ? json_decode($inputs['http_headers']) : [];
                $dataFormat      = $inputs['data_format'];
                $dataParameter   = !empty($dataParameter) ? $dataParameter : [];
                $httpMethod      = $inputs['http_method'];

                $dataString = '';

                if ($dataFormat == 0) {
                    $dataParameter = json_encode(!empty($inputs['parameter']) ? $inputs['parameter'] : '');
                    if ($requestType == 'second' && isset($request->auth_result) && !is_null($request->auth_result)) {
                        $dataParameter = $this->getAuthenticationData($dataParameter, json_decode($request->auth_result));
                    }
                    $dataParameter = json_decode($dataParameter);
                    if ($dataParameter != "" && $dataParameter != null) {
                        if (count($dataParameter) > 0) {
                            $dataString = [];
                            foreach ($dataParameter as $v) {
                                $key   = $v->key;
                                $value = $v->value;
                                if (!empty($key) && !empty($value)) {
                                    $dataString[$key] = $value;
                                }
                            }
                            $dataString = json_encode($dataString);
                        }
                    }
                } else {
                    $dataString = !empty($inputs['raw_data']) ? $inputs['raw_data'] : '';
                    $dataString = $this->getAuthenticationData($dataString, json_decode($request->auth_result));
                }

                $parsed = [];
                if (gettype($httpHeaders) == 'array' || gettype($httpHeaders) == 'object') {
                    foreach ($httpHeaders as $key => $value) {
                        $parsed[] = "$key: $value";
                    }
                }

                if (!empty($httpUsername) && !empty($httpPassword)) {
                    $parsed[] = "Authorization: Basic " . base64_encode($httpUsername . ':' . $httpPassword);
                }

                $curl = curl_init();

                curl_setopt($curl, CURLOPT_URL, $restEndpointUrl);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($httpMethod));
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);
                curl_setopt($curl, CURLOPT_HTTPHEADER, $parsed);
                $result = curl_exec($curl);

                if (curl_errno($curl)) {
                    $errorMsg = curl_error($curl);
                    curl_close($curl);

                    return response()->json([
                        'is_success' => false,
                        'message'    => $errorMsg,
                    ]);
                }

                curl_close($curl);

                $json = json_decode($result);
            } else {
                return response()->json([
                    'is_success' => true,
                    'message'    => __('Configuration details is not filled.'),
                    'titles'     => $titles,
                    'data'       => $detail,
                ]);
            }

            if (!empty($json)) {
                if (!empty($json->Data)) {
                    if (gettype($json->Data) == 'object') {
                        $titles = (array)$json->Data;
                        $titles = array_keys($titles);
                        $detail = json_decode(json_encode($json), true);
                    } else {
                        if (gettype($json->Data) == 'array') {
                            if (count($json->Data) > 0) {
                                $titles = (array)$json->Data[0];
                                $titles = array_keys($titles);
                                $detail = json_decode(json_encode($json), true);
                            }
                        }
                    }
                } else {
                    if (gettype($json) == 'object') {
                        $titles = (array)$json;
                    } else {
                        if (gettype($json) == 'array') {
                            $titles = (array)$json[0];
                        }
                    }

                    $titles = count($titles) > 0 ? array_keys($titles) : $titles;

                    $detail   = json_decode(json_encode($json), true);
                    $objTitle = [];
                    foreach ($titles as $tVal) {
                        if (gettype($detail[$tVal]) == 'object') {
                            $objTitle = (array)$detail[$tVal];
                            $objTitle = count($objTitle) > 0 ? array_keys($objTitle) : $objTitle;
                        } elseif (gettype($detail[$tVal]) == 'array') {
                            $objTitle = $detail[$tVal][0];
                            $objTitle = count($objTitle) > 0 ? array_keys($objTitle) : $objTitle;
                        }
                    }

                    $titles = $objTitle;
                }
            }

            return response()->json([
                'is_success' => true,
                'message'    => __('Configuration Test Successfully!'),
                'titles'     => $titles,
                'data'       => $detail,
            ]);
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('Permission Denied.'),
        ]);
    }

    public function store(Request $request)
    {
        if (user()->account_type == 1) {
            $secondRestIntegration = false;

            $detailsType = $request->details_type;

            $firstRestCallInputs = $request->input('first');

            $secondRestCallInputs = $request->input('second');

            $valid = [];

            $valid['name'] = 'required';

            if (!empty($firstRestCallInputs)) {
                $firstRestCallInputs['request_type'] = 'first';

                $secondRestCallInputs['request_type'] = 'second';

                $allInputs = [$secondRestCallInputs, $firstRestCallInputs];

                if ($detailsType == 2) {
                    $openDocumentInputs = $request->input('third');
                    if (empty($openDocumentInputs)) {
                        return redirect()->back()->with('error', __('Please fill all details for open document configuration.'))->with('tab-status', 'integrations');
                    }
                    $openDocumentInputs['request_type'] = 'third';
                    $allInputs[]                        = $openDocumentInputs;
                }

                foreach ($allInputs as $key => $inputs) {
                    $httpAuthentication = 1;
                    $customHttpHeaders  = 1;
                    if (($key == 2 && $detailsType == 2) && $key != 1) {
                        if (empty($inputs['rest_endpoint_url'])) {
                            $valid['rest_endpoint_url'] = 'required';
                        }

                        if (empty($inputs['http_method'])) {
                            $valid['http_method'] = 'required';
                        }

                        if (!isset($inputs['data_format'])) {
                            $valid['data_format'] = 'required';
                        }

                        if (isset($inputs['http_authentication'])) {
                            if (empty($inputs['http_username'])) {
                                $valid['http_username'] = 'required';
                            }
                            if (empty($inputs['http_password'])) {
                                $valid['http_password'] = 'required';
                            }
                            $httpAuthentication = 0;
                        }
                        if (isset($inputs['custom_http_headers'])) {
                            if (empty($inputs['http_headers'])) {
                                $valid['http_headers'] = 'required';
                            }
                            $customHttpHeaders = 0;
                        }
                    }

                    if (isset($inputs['http_authentication'])) {
                        $httpAuthentication = 0;
                    }
                    if (isset($inputs['custom_http_headers'])) {
                        $customHttpHeaders = 0;
                    }

                    $validator = Validator::make($request->all(), $valid);

                    if ($validator->fails()) {
                        $messages = $validator->getMessageBag();

                        return redirect()->back()->with('error', $messages->first())->with('tab-status', 'integrations');
                    }

                    if ($inputs['data_format'] == 0) {
                        $dataParameter = $inputs['parameter'] ?? '';
                        $dataParameter = !empty($dataParameter) ? json_encode($dataParameter) : null;
                    } else {
                        $dataParameter = $inputs['raw_data'] ?? '';
                    }

                    $data = [
                        'name'                => $request->name,
                        'rest_endpoint_url'   => $inputs['rest_endpoint_url'],
                        'http_method'         => $inputs['http_method'],
                        'http_authentication' => $httpAuthentication,
                        'http_username'       => $inputs['http_username'],
                        'http_password'       => $inputs['http_password'],
                        'custom_http_headers' => $customHttpHeaders,
                        'http_headers'        => $inputs['http_headers'],
                        'data_format'         => $inputs['data_format'],
                        'data_parameter'      => !empty($dataParameter) ? json_encode($dataParameter) : null,
                        'created_by'          => user()->id,
                    ];

                    if ($inputs['request_type'] == 'second') {
                        if ($detailsType == 1) {
                            $data['basic_details'] = !empty($request->input('basic_details')) ? json_encode($request->input('basic_details')) : null;
                        }
                        $data['result_list']      = json_encode($request->input('result_list'));
                        $data['integration_type'] = 1;
                        $data['parent_id']        = 0;
                        $data['details_type']     = $request->details_type;
                        $secondRestIntegration    = RestIntegration::create($data);
                    }

                    if ($secondRestIntegration) {
                        if ($inputs['request_type'] == 'first' && !empty($inputs)) {
                            if (!empty($inputs['rest_endpoint_url'])) {
                                $data['parent_id'] = $secondRestIntegration->id;
                            }
                        }
                    } else {
                        return redirect()->back()->with('error', __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'))->with('tab-status', 'integrations');
                    }

                    if ($inputs['request_type'] == 'third') {
                        if ($secondRestIntegration) {
                            $data['integration_type'] = 2;
                            $data['parent_id']        = $secondRestIntegration->id;
                        }
                    }
                }

                return redirect()->back()->with('success', __('Configuration Created Successfully!'))->with(['tab-status' => 'integrations']);
            }

            return redirect()->back()->with('error', __('Please fill all details for Configure Integration Authentication.'))->with('tab-status', 'integrations');
        }

        return redirect()->back()->with('error', __('Permission Denied.'))->with('tab-status', 'integrations');
    }

    public function edit($id)
    {
        if (user()->account_type == 1) {
            $searchListIntegration = RestIntegration::where('id', $id)->first();

            $searchListId          = 0;
            $searchResultList      = '';
            $searchBasicDetails    = '';
            $searchListDetailsType = 0;
            $openDocumentId        = 0;

            if (!is_null($searchListIntegration)) {
                $searchListId          = $searchListIntegration->id;
                $searchResultList      = $searchListIntegration->result_list;
                $searchBasicDetails    = $searchListIntegration->basic_details;
                $searchListDetailsType = $searchListIntegration->details_type;

                $openDocument = $searchListIntegration->child_Rest_call()->where(['integration_type' => 2])->first();

                if (!is_null($openDocument)) {
                    $openDocumentId = $openDocument->id;
                }

                $restIntegration = $searchListIntegration->child_Rest_call()->where(['integration_type' => 0])->first();

                if (is_null($restIntegration)) {
                    $restIntegration = new \stdClass();
                }

                $restIntegration->id                      = $searchListIntegration->id;
                $restIntegration->name                    = $searchListIntegration->name;
                $restIntegration->search_list             = $searchListId;
                $restIntegration->search_result_list      = $searchResultList;
                $restIntegration->search_basic_details    = $searchBasicDetails;
                $restIntegration->searchlist_details_type = $searchListDetailsType;
                $restIntegration->open_document_id        = $openDocumentId;

                return view('integrations.edit', compact('restIntegration'));
            }

            return response()->json(['error' => __('Data Not Found.')]);
        }

        return response()->json(['error' => __('Permission Denied.')]);
    }

    public function update(Request $request, RestIntegration $restIntegration)
    {
        if (user()->account_type == 1) {
            if ($restIntegration?->integration_type == 1 && $restIntegration?->parent_id == 0) {
                $detailsType = $request->details_type;

                $firstRestCallInputs = $request->input('first');

                $secondRestCallInputs = $request->input('second');

                $valid = [];

                $valid['name'] = 'required';

                if (!empty($secondRestCallInputs)) {
                    $firstRestCallInputs['request_type'] = 'first';

                    $secondRestCallInputs['request_type'] = 'second';

                    $allInputs = [$secondRestCallInputs, $firstRestCallInputs];

                    if ($detailsType == 2) {
                        $openDocumentInputs = $request->input('third');
                        if (empty($openDocumentInputs)) {
                            return redirect()->back()->with('error', __('Please fill all details for open document configuration.'))->with('tab-status', 'integrations');
                        }
                        $openDocumentInputs['request_type'] = 'third';
                        $allInputs[]                        = $openDocumentInputs;
                    }

                    foreach ($allInputs as $key => $inputs) {
                        $httpAuthentication = 1;
                        $customHttpHeaders  = 1;
                        if (($key == 2 && $detailsType == 2) && $key != 1) {
                            if (empty($inputs['rest_endpoint_url'])) {
                                $valid['rest_endpoint_url'] = 'required';
                            }

                            if (empty($inputs['http_method'])) {
                                $valid['http_method'] = 'required';
                            }

                            if (!isset($inputs['data_format'])) {
                                $valid['data_format'] = 'required';
                            }

                            if (isset($inputs['http_authentication'])) {
                                if (empty($inputs['http_username'])) {
                                    $valid['http_username'] = 'required';
                                }
                                if (empty($inputs['http_password'])) {
                                    $valid['http_password'] = 'required';
                                }
                                $httpAuthentication = 0;
                            }
                            if (isset($inputs['custom_http_headers'])) {
                                if (empty($inputs['http_headers'])) {
                                    $valid['http_headers'] = 'required';
                                }
                                $customHttpHeaders = 0;
                            }
                        }

                        if (isset($inputs['http_authentication'])) {
                            $httpAuthentication = 0;
                        }
                        if (isset($inputs['custom_http_headers'])) {
                            $customHttpHeaders = 0;
                        }

                        $validator = Validator::make($request->all(), $valid);

                        if ($validator->fails()) {
                            $messages = $validator->getMessageBag();

                            return redirect()->back()->with('error', $messages->first())->with('tab-status', 'integrations');
                        }

                        if ($inputs['data_format'] == 0) {
                            $dataParameter = json_encode($inputs['parameter'] ?? '');
                        } else {
                            $dataParameter = $inputs['raw_data'] ?? '';
                        }

                        $data = [
                            'name'                => $request->name,
                            'rest_endpoint_url'   => $inputs['rest_endpoint_url'],
                            'http_method'         => $inputs['http_method'],
                            'http_authentication' => $httpAuthentication,
                            'http_username'       => $inputs['http_username'],
                            'http_password'       => $inputs['http_password'],
                            'custom_http_headers' => $customHttpHeaders,
                            'http_headers'        => $inputs['http_headers'],
                            'data_format'         => $inputs['data_format'],
                            'data_parameter'      => !empty($dataParameter) ? json_encode($dataParameter) : null,
                            'created_by'          => user()->id,

                        ];

                        if ($inputs['request_type'] == 'second') {
                            if ($detailsType == 1) {
                                $data['basic_details'] = !empty($request->input('basic_details')) ? json_encode($request->input('basic_details')) : null;
                            }
                            $data['result_list']  = json_encode($request->input('result_list'));
                            $data['details_type'] = $detailsType;

                            $restIntegration->update($data);

                            $thirdRestIntegration = $restIntegration->child_Rest_call()->where(['integration_type' => 2])->first();

                            $authIntegration = $restIntegration->child_Rest_call()->where(['integration_type' => 0])->first();
                        }

                        if ($inputs['request_type'] == 'first') {
                            if (!is_null($authIntegration)) {
                                $authIntegration->update($data);
                            } else {
                                if (!empty($inputs['rest_endpoint_url'])) {
                                    $data['parent_id'] = $restIntegration->id;
                                    $authIntegration   = RestIntegration::create($data);
                                }
                            }
                        }

                        if ($inputs['request_type'] == 'third') {
                            if ($thirdRestIntegration) {
                                $thirdRestIntegration = $thirdRestIntegration->update($data);
                            } else {
                                $data['integration_type'] = 2;
                                $data['parent_id']        = $restIntegration->id;
                                $thirdRestIntegration     = RestIntegration::create($data);
                            }
                        }
                    }

                    return redirect()->back()->with('success', __('Configuration Updated Successfully!'))->with(['tab-status' => 'integrations']);
                }

                return redirect()->back()->with('error', __('Please fill all details for Configure Search/List Integration.'))->with('tab-status', 'integrations');
            }

            return redirect()->back()->with('error', __('Integration details not found!'))->with('tab-status', 'integrations');
        }

        return redirect()->back()->with('error', __('Permission Denied.'))->with('tab-status', 'integrations');
    }

    public function destroy($id)
    {
        if (user()->account_type == 1) {
            $integration = RestIntegration::where('id', $id)->first();
            if (!is_null($integration)) {
                $searchlist = $integration->child_Rest_call()->where('integration_type', 0)->delete();
                $open_doc   = $integration->child_Rest_call()->where('integration_type', 2)->delete();
            }
            $integration = RestIntegration::where('id', $id)->delete();

            return redirect()->back()->with('success', __('Configuration Successfully Deleted!'))->with('tab-status', 'integrations');
        }

        return redirect()->back()->with('error', __('Permission Denied.'))->with('tab-status', 'integrations');
    }

    public function configuration_load_view(Request $request)
    {
        $restIntegration  = RestIntegration::where('id', $request->id)->first();
        $request_type     = $request->request_type;
        $integration_type = 0;

        if (!is_null($restIntegration)) {
            if ($request_type == 'first') {
                $integration_type = 0;
                $restIntegration  = $restIntegration->child_Rest_call()->where(['integration_type' => $integration_type])->first();
            }
        }

        $returnHTML = view('integrations.load_configuration', compact('restIntegration', 'request_type'))->render();
        //dd($restIntegration,$request_type);
        if (user()->account_type == 1) {
            return redirect()->back()->with('success', __('Configuration Successfully Deleted!'))->with('tab-status', 'integrations');
        }

        return redirect()->back()->with('error', __('Permission Denied.'))->with('tab-status', 'integrations');
    }

    public function configurationLoadView(Request $request)
    {
        $restIntegration = RestIntegration::where('id', $request->id)->first();
        $requestType     = $request->request_type;
        $integrationType = 0;

        if (!is_null($restIntegration)) {
            if ($requestType == 'first') {
                $restIntegration = $restIntegration->child_Rest_call()->where(['integration_type' => $integrationType])->first();
            }
        }

        $returnHTML = view('integrations.load_configuration', compact('restIntegration', 'requestType'))->render();

        $response = [
            'is_success' => true,
            'html'       => $returnHTML,
        ];

        return response()->json($response);
    }

    public static function fetchRestInegartionResp($id = 0, $integrationType = 0, $respData = '', $url = '')
    {
        $restIntegration = RestIntegration::where(['id' => $id, 'integration_type' => $integrationType])->first();

        if (!is_null($restIntegration)) {
            $dataString = [];

            if ($restIntegration->data_format == 0) {
                if (!empty($restIntegration->data_parameter)) {
                    foreach ($restIntegration->data_parameter as $v) {
                        $key   = $v['key'];
                        $value = $v['value'];
                        if (!empty($key) && !empty($value)) {
                            $dataString[$key] = $value;
                        }
                    }
                    $dataString = json_encode($dataString);
                }
            } else {
                $dataString = json_decode($restIntegration->data_parameter);
            }

            $parsed      = [];
            $httpHeaders = !empty($restIntegration->http_headers) ? json_decode($restIntegration->http_headers) : [];
            foreach ($httpHeaders as $key => $value) {
                $parsed[] = "$key: $value";
            }

            $httpUsername = $restIntegration->http_username;
            $httpPassword = $restIntegration->http_password;

            if (!empty($httpUsername) && !empty($httpPassword)) {
                $parsed[] = "Authorization: Basic " . base64_encode($httpUsername . ':' . $httpPassword);
            }

            if (empty($url)) {
                $url = $restIntegration->rest_endpoint_url;
            } else {
                $url = \Crypt::decrypt($url);
            }

            if ($restIntegration->integration_type == 1 || $restIntegration->integration_type == 2) {
                if (!empty($dataString)) {
                    $dataString = self::getAuthenticationData($dataString, $respData);
                }
                if (count($parsed) > 0) {
                    $parsed = self::getAuthenticationData(json_encode($parsed), $respData);
                    $parsed = json_decode($parsed);
                }
            }

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($restIntegration->http_method));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $parsed);
            $result = curl_exec($curl);

            $err = new \stdClass();
            if (curl_errno($curl)) {
                $errorMsg = curl_error($curl);
                curl_close($curl);
                Utility::ILINXLog('ILINX execute-view for fetch taskDetail curl_errno: ' . $errorMsg);

                $err->Success      = false;
                $err->ErrorMessage = $errorMsg;

                return $err;
            }

            $json = $result;

            if ($restIntegration->integration_type != 2) {
                $json = json_decode($result);
            }

            curl_close($curl);

            if (empty($json)) {
                // Return some appropriate error to user here
                Utility::ILINXLog('ERROR RestIntegration-' . $restIntegration . ' execute: EMPTY json results: ' . $result);

                $err->Success      = false;
                $err->ErrorMessage = __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.');

                return $err;
            }
            $json->Success = true;

            Utility::ILINXLog('DEBUG RestIntegration-' . $restIntegration . ' execute success');

            return $json;
        }
    }

    public function restIntegartionSearchlist($viewName = '', RestIntegration $restIntegration)
    {
        $isSuccess    = false;
        $details      = [];
        $titles       = [];
        $listId       = 0;
        $detailsType  = 0;
        $basicDetails = [];
        if (!is_null($restIntegration)) {
            $authIntegration = $restIntegration->child_Rest_call()->where('integration_type', 0)->first();
            $authResponse    = "";

            if (!is_null($authIntegration)) {
                $authResponse = RestIntegrationController::fetchRestInegartionResp($authIntegration->id, 0, '');
            }

            $listId = $restIntegration->id;

            $searchListResponse = RestIntegrationController::fetchRestInegartionResp($restIntegration->id, 1, $authResponse);

            $titles  = [];
            $details = [];

            if (!empty($searchListResponse)) {
                if ($searchListResponse->Success) {
                    if (!empty($searchListResponse->Data)) {
                        if (count($searchListResponse->Data) > 0) {
                            $titles    = (array)$searchListResponse->Data[0];
                            $titles    = array_keys($titles);
                            $titles    = array_intersect($titles, json_decode($restIntegration->result_list));
                            $titles    = array_values($titles);
                            $details   = json_decode(json_encode($searchListResponse->Data), true);
                            $isSuccess = true;
                        }
                    } else {
                        $titles    = (array)$searchListResponse[0];
                        $titles    = array_keys($titles);
                        $titles    = array_intersect($titles, json_decode($restIntegration->result_list));
                        $titles    = array_values($titles);
                        $details   = json_decode(json_encode($searchListResponse), true);
                        $isSuccess = true;
                    }
                }

                if ($restIntegration->details_type == 2) {
                    $result = [];

                    $openDcument = $restIntegration->child_Rest_call()->where('integration_type', '=', 2)->first();

                    if (!is_null($openDcument)) {
                        $detailsType = 2;
                        foreach ($details as $detailsValue) {
                            $detailsValue['url'] = $this->openDocumentUrl($openDcument->rest_endpoint_url, $detailsValue);
                            $result[]            = $detailsValue;
                        }

                        if (count($result) > 0) {
                            $details = $result;
                        }
                    }
                } elseif ($restIntegration->details_type == 1) {
                    $detailsType = 1;
                    if (!empty($restIntegration->basic_details)) {
                        $basicDetails = json_decode($restIntegration->basic_details);
                    }
                }
            }
        }

        return view('integrations.searchlist', compact('restIntegration', 'details', 'titles', 'isSuccess', 'listId', 'detailsType', 'basicDetails'));
    }

    public function restIntegartionDetail(Request $request, RestIntegration $restIntegration)
    {
        $url = $request->url;

        $dataString = '';
        $parsed     = [];
        $method     = '';
        $openDoc    = [];
        $name       = '';

        if ($restIntegration?->integration_type == 1) {
            $authIntegration = $restIntegration->child_Rest_call()->where('integration_type', '=', 0)->first();

            $authResponse = "";
            if (!is_null($authIntegration)) {
                $authResponseData = RestIntegrationController::fetchRestInegartionResp($authIntegration->id, 0, '');

                if (!empty($authResponseData)) {
                    if ($authResponseData->Success) {
                        $authResponse = $authResponseData;
                    }
                }
            }

            $openDoc = $restIntegration->child_Rest_call()->where('integration_type', '=', 2)->first();

            if (!is_null($openDoc)) {
                $dataString = json_decode($openDoc->data_parameter);
                if (!empty($dataString)) {
                    $dataString = self::getAuthenticationData($dataString, $authResponse);
                }
                $parsed      = [];
                $httpHeaders = !empty($openDoc->http_headers) ? json_decode($openDoc->http_headers) : '';
                $parsed      = self::getAuthenticationData(json_encode($httpHeaders), $authResponse);
                $method      = strtoupper($openDoc->http_method);
            }

            $name = $restIntegration->name;
        }

        $url = \Crypt::decrypt($url);

        return view('integrations.detail', compact('url', 'parsed', 'dataString', 'openDoc', 'method', 'name'));
    }

    public function restIntegartionBasicDetail(Request $request)
    {
        $details = json_decode($request->basic_details);

        return view('integrations.basic_details', compact('details'));
    }

    public function restIntegartionOpenDoc($url, $id)
    {
        $searchListIntegration = RestIntegration::where(['id' => $id, 'integration_type' => 1])->first();

        if (!is_null($searchListIntegration)) {
            $authIntegration = $searchListIntegration->parent_Rest_call()->where('integration_type', '=', 0)->first();

            if (!is_null($authIntegration)) {
                $authResponse = "";

                $authResponseData = RestIntegrationController::fetchRestInegartionResp($authIntegration->id, 0, '');

                if (!empty($authResponseData)) {
                    if ($authResponseData->Success) {
                        $authResponse = $authResponseData;
                    }
                }

                $openDoc = $searchListIntegration->child_Rest_call()->where('integration_type', '=', 2)->first();

                if (!is_null($openDoc)) {
                    $openDocResponse = RestIntegrationController::fetchRestInegartionResp($openDoc->id, 2, $authResponse, $url);

                    return Response::make($openDocResponse, 200, [
                        'Content-Type'        => 'application/pdf',
                        'Content-Disposition' => 'inline; filename="a87f8ffa-9f3f-4a66-97c0-214925394e90.pdf"',
                    ]);
                }
            }
        }
    }

    public static function openDocumentUrl($dataString, $respData)
    {
        if (!empty($dataString) && !empty($respData)) {
            preg_match_all('/(?<={Search.).*?(?=})/', $dataString, $matches, PREG_SET_ORDER, 0);
            foreach ($matches as $value) {
                foreach ($value as $v) {
                    $patterns     = '/{Search.' . $v . '*}/';
                    $str          = explode('.', $v);
                    $replacements = $respData;
                    if (gettype($replacements) == 'array') {
                        $replacements = (object)$replacements;
                    }
                    foreach ($str as $strKey => $strValue) {
                        if ($strKey == 0) {
                            if (in_array($strValue, array_keys($respData))) {
                                $replacements = $respData->$strValue;
                            }
                        }
                        if ($strKey > 0) {
                            $replacements = $replacements->$strValue;
                        }
                    }
                    $dataString = preg_replace($patterns, $replacements, $dataString);
                }
            }
        }

        return $dataString;
    }

    public static function getAuthenticationData($dataString, $respData)
    {
        if (!empty($dataString) && !empty($respData)) {
            preg_match_all('/(?<={Authentication.).*?(?=})/', $dataString, $matches, PREG_SET_ORDER, 0);
            foreach ($matches as $value) {
                foreach ($value as $v) {
                    $patterns     = '/{Authentication.' . $v . '*}/';
                    $str          = explode('.', $v);
                    $replacements = [];

                    foreach ($str as $strKey => $strValue) {
                        if ($strKey == 0) {
                            $replacements = $respData->$strValue;
                        }
                        if ($strKey > 0) {
                            $replacements = $replacements->$strValue;
                        }
                    }
                    $dataString = preg_replace($patterns, $replacements, $dataString);
                }
            }
        }

        return $dataString;
    }
}
