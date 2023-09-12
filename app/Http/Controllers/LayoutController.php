<?php

namespace App\Http\Controllers;

use App\Models\ChartDatasource;
use App\Models\CustomPage;
use App\Models\Layout;
use App\Models\RestIntegration;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;
use Str;

/**
 * @SuppressWarnings(PHPMD)
 */
class LayoutController extends Controller
{
    public function index(): RedirectResponse | JsonResponse
    {
        if (user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            return redirect()->route('settings', tenant('tenant_id'));
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('Permission Denied.'),
        ]);
    }

    public function create(): Renderable
    {
        return view('page_layout.create');
    }

    public function store(Request $request): JsonResponse
    {
        $validator = $this->validateStoreRequest($request);
        if ($validator->fails()) {
            return response()->json([
                'is_success' => false,
                'message'    => $validator->getMessageBag()->first(),
            ]);
        }

        if (user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $layout = Layout::where('layout_definition_id', '=', 0)
                ->orderBy('order_no', 'DESC')
                ->first();

            $post = $request->all() + [
                "order_no"  => !empty($layout) ? $layout->order_no + 1 : 0,
                "eform_url" => in_array($request->get("content_type"), ["Content view", "Workflow view"])
                    ? $request->get("eform_url")
                    : null,
                "data_source" => $request->get("content_type") === "Custom HTML"
                    ? $request->get("custom_url")
                    : $request->get("data_source"),
                "created_by" => user()->id,
                "adv_config"  => !empty($request->get("adv_config")) ? $request->get("adv_config") : ""
            ];

            Layout::create($post);

            return response()->json([
                'is_success' => true,
                'message'    => __('Card Successfully Created!'),
            ]);
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('Permission Denied.'),
        ]);
    }

    public function edit(Layout $layout): Renderable | JsonResponse
    {
        if (user()->account_type != User::INTERNAL_TENANT_ADMIN) {
            return response()->json([
                "is_success" => false,
                'error'      => __('Permission Denied.'),
            ]);
        }
        $tenant = tenant();
        $adv_config = json_decode($layout->adv_config);
        $color_table = [];
        if(!is_array($adv_config) && isset($adv_config) && property_exists($adv_config, 'chart_dimensions')){
            $chart_dimensions = $adv_config->chart_dimensions[0];
            $color_table = $adv_config->color_table;

        }else{
            $chart_dimensions =(object) [
                'width' => 0,
                'height' => 0
            ];
        }
        if($color_table == []){
            $color_table = '';
        }

        if (!is_array($adv_config) && isset($adv_config) && property_exists($adv_config, 'list_mode_settings')) {
            $list_mode_settings = $adv_config->list_mode_settings[0];
        } else {
            $list_mode_settings =(object) [
                'list_mode' => "off",
                'max_column' => 0
            ];
        }


        return view('page_layout.edit', compact('layout', 'tenant', 'chart_dimensions', 'color_table', 'list_mode_settings'));
    }

    public function update(Request $request, Layout $layout): JsonResponse
    {
        $validator = $this->validateUpdateRequest($request, $layout);
        if ($validator->fails()) {
            return response()->json([
                'is_success' => false,
                'message'    => $validator->getMessageBag()->first(),
            ]);
        }

        if (user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $layout->update([
                "title"        => $request->get("title"),
                "single_item"  => $request->get("single_item"),
                "plural_item"  => $request->get("plural_item"),
                "position"     => $request->get("position"),
                "width"        => $request->get("width"),
                "max_item"     => $request->get("max_item"),
                "content_type" => $request->get("content_type"),
                "data_source"  => $request->get("content_type") == "Custom HTML"
                    ? $request->get("custom_url")
                    : $request->get("data_source"),
                "eform_url" => in_array($request->get("content_type"), ["Content view", "Workflow view"])
                    ? $request->get("eform_url")
                    : null,
                "adv_config"  => !empty($request->get("adv_config")) ? $request->get("adv_config") : ""
            ]);

            return response()->json([
                'is_success' => true,
                'message'    => __('Card Successfully Updated!'),
            ]);
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('Permission Denied.'),
        ]);
    }

    public function destroy(Layout $layout): JsonResponse
    {
        if (user()->account_type == User::INTERNAL_TENANT_ADMIN) {
            $layout->delete();

            return response()->json([
                'is_success' => true,
                'message'    => __('Card Successfully Deleted!'),
            ]);
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('Permission Denied.'),
        ]);
    }

    public function order(Request $request): JsonResponse
    {
        if (isset($request->ids) && !empty($request->ids)) {
            foreach ($request->ids as $key => $val) {
                Layout::where('id', '=', $val)->update(['order_no' => $key]);
            }

            return response()->json([
                'is_success' => true,
                'message'    => __('Updated.!'),
            ]);
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'),
        ]);
    }

    public function getSource(Request $request): JsonResponse
    {
        if (isset($request->content_type) && !empty($request->content_type)) {
            $response = '';

            if (str_contains($request->content_type, '[package_layout]')) {
                $packageLayout = config('package-layout');
                if ($packageLayout) {
                    $contentTypeArr = explode('.', $request->content_type);
                    $packageId = $contentTypeArr[1];
                    $packageIdArr = explode('_', $packageId);
                    $packageClassNameSpace = implode('\\', array_map('ucfirst', $packageIdArr));
                    $packageClassName = '\\'.$packageClassNameSpace.'\\Utility';
                    if (class_exists($packageClassName) && method_exists($packageClassName, 'getDataSource')) {
                        $response = call_user_func( array( $packageClassName, 'getDataSource' ) );
                    }
                }
            } else {
                if ($request->content_type == 'Documents' || $request->content_type == 'Child Workflows') {
                    $dataBatch = HomeController::getMenu();
                    if ($request->content_type == 'Documents') {
                        $docs = [];
                        foreach ($dataBatch->Docs as $doc) {
                            $docs[] = $doc->DocTypeName;
                        }

                        $response = array_unique($docs);
                    }

                    if ($request->content_type == 'Child Workflows') {
                        $tbls = [];
                        foreach ($dataBatch->IndexValues as $tbl) {
                            if ($tbl->DataType == '_table') {
                                $tbls[] = $tbl->IndexName;
                            }
                        }

                        $response = $tbls;
                    }
                }

                if ($request->content_type == 'Workflow view' || $request->content_type == 'Court Case') {
                    $workflow = TaskController::fetchTaskList();

                    $arrFlow = [];

                    foreach ($workflow->Data as $flow) {
                        $arrFlow[] = $flow->ViewName;
                    }

                    $response = $arrFlow;
                } elseif ($request->content_type == 'Content view') {
                    $contentView = FolderController::fetchFolderList();

                    $arrContent = [];

                    if (!empty($contentView)) {
                        foreach ($contentView->Data as $view) {
                            $arrContent[] = $view->ViewName;
                        }
                    }

                    $response = $arrContent;
                } elseif ($request->content_type == 'Notifications') {
                    $response = [__('Standard Notifications')];
                } elseif ($request->content_type == 'Calendar') {
                    $response = [__('Standard Calendar')];
                } elseif ($request->content_type == 'System message') {
                    $response = [__('System Welcome Message')];
                } elseif ($request->content_type == 'Help Page') {
                    $response = [__('Help Center Content')];
                } elseif ($request->content_type == 'Chat') {
                    $response = [__('Standard Chat')];
                } elseif ($request->content_type == 'All content views') {
                    $response = [__('List all Content views')];
                } elseif ($request->content_type == 'All workflow views') {
                    $response = [__('List all Workflow views')];
                } elseif ($request->content_type == 'Forms') {
                    $response = [__('Available Forms')];
                } elseif ($request->content_type == 'Sign in') {
                    $response = [__('Sign in page')];
                } elseif (in_array($request->content_type, [
                    'KPI Card',
                    'Pie Chart',
                    'Line Chart',
                    'Vertical bar Chart',
                    'Horizontal bar Chart',
                ])) {
                    $response = ChartDatasource::all()->pluck('datasource_name')->toArray();
                } elseif ($request->content_type == 'Secured') {
                    $response = [__('Secured')];
                } elseif ($request->content_type == 'Custom HTML') {
                    $response = true;
                } elseif ($request->content_type == 'Integration') {
                    $response = RestIntegration::fetchIntegration();
                } elseif ($request->content_type == 'Custom Page') {
                    $response = CustomPage::fetchCustomPage();
                } elseif ($request->content_type == 'News Feed') {
                    $response = ['Standard Feed' => 'Standard Feed'];
                } elseif ($request->content_type == 'Single Form') {
                    $response = UserController::fetchSingleFormContentTypes();
                    if (!$response->Success) {
                        return response()->json([
                            'is_success' => false,
                            'data' => [],
                            'message'    => __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'),
                        ]);
                    }
                    $response = $response->Data;
                } elseif ($request->content_type == 'Available Dashboards') {
                    $response = ['Available Dashboards' => 'Available Dashboards'];
                } elseif ($request->content_type == 'Single Dashboard') {
                    $response = DashboardController::getDashboardList();
                    if (!$response->Success) {
                        return response()->json([
                            'is_success' => false,
                            'data' => $response,
                            'message'    => __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'),
                        ]);
                    }
                    $response = $response->Data;
                }
            }

            return response()->json([
                'is_success' => true,
                'data'       => $response,
                'message'    => __('Success'),
            ]);
        }

        return response()->json([
            'is_success' => false,
            'message'    => __('An error occurred. Please try the operation again. If the issue persists, please contact your system administrator.'),
        ]);
    }

    private function validateStoreRequest($request)
    {
        $rules = [
            'title' => [
                "string",
                "required",
                Rule::unique('layouts')->where(function (Builder $query) use ($request): Builder {
                    return $query->where('layout_definition_id', $request?->layout_definition_id);
                })
            ],
            'single_item'          => ["string", new RequiredIf($this->verifyRequiredField('single_item', $request->content_type))],
            'plural_item'          => ["string", new RequiredIf($this->verifyRequiredField('single_item', $request->content_type))],
            'position'             => ["string", "required", Rule::in(array_keys(Layout::$position))],
            'width'                => ["string", "required", Rule::in(array_keys(Layout::$width))],
            'max_item'             => ["numeric", new RequiredIf($this->verifyRequiredField('max_item', $request->content_type))],
            'content_type'         => ["string", "required", Rule::in(array_keys(Layout::gethomePageCardContentType()))],
            "data_source"          => ["string"],
            "layout_definition_id" => ["numeric", "nullable"],
            "eform_url"            => ["string", "nullable"],
            "custom_url"           => ["string", "required_if:content_type,==,Custom HTML"],
        ];

        return Validator::make($request->all(), $rules);
    }

    private function validateUpdateRequest($request, Layout $layout)
    {
        $rules = [
            'title' => ["string", "required",
                Rule::unique('layouts')->ignore($layout->title, 'title')->where(function (Builder $query) use ($request): Builder {
                    return $query->where('layout_definition_id', $request?->layout_definition_id);
                })
            ],
            'single_item'          => ["string", new RequiredIf($this->verifyRequiredField('single_item', $request->content_type))],
            'plural_item'          => ["string", new RequiredIf($this->verifyRequiredField('single_item', $request->content_type))],
            'position'             => ["string", "required", Rule::in(array_keys(Layout::$position))],
            'width'                => ["string", "required", Rule::in(array_keys(Layout::$width))],
            'max_item'             => ["numeric", new RequiredIf($this->verifyRequiredField('max_item', $request->content_type))],
            'content_type'         => ["string", "required", Rule::in(array_keys(Layout::gethomePageCardContentType()))],
            "data_source"          => ["string"],
            "layout_definition_id" => ["numeric", "nullable"],
            "eform_url"            => ["string", "nullable"],
            "custom_url"          => ["string", "required_if:content_type,==,Custom HTML"],
        ];

        return Validator::make($request->all(), $rules);
    }

    public function pluralize(Request $request): JsonResponse
    {
        $word = $request->query('word');

        return response()->json([
            'plural_item' => Str::plural($word),
        ]);
    }

    private function verifyRequiredField(string $field, string $contentType): bool
    {
        if ($field === 'single_item' || $field === 'plural_item') {
            if (in_array($contentType, Layout::REQUIRED_PARTIAL_DATA)) {
                return true;
            }
        }

        if ($field === 'max_item') {
            if (in_array($contentType, Layout::REQUIRED_MAX_ITEMS)) {
                return true;
            }
        }

        return false;
    }
}
