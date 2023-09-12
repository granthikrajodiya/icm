<?php

namespace App\Models;

use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestIntegrationController;
use App\Http\Controllers\TaskController;
use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * App\Models\Layout
 *
 * @property int $id
 * @property string $title
 * @property string $single_item
 * @property string $plural_item
 * @property string|null $position
 * @property string $width
 * @property int $max_item
 * @property string $content_type
 * @property string $data_source
 * @property int $order_no
 * @property int $layout_definition_id 0 = customer/client, 1 = internal admin, 2 = internal non-admin, 3 = public, 4 = external admin
 * @property string|null $eform_url
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $createdBy
 * @property-read \App\Models\LayoutDefinition|null $definition
 * @method static \Database\Factories\LayoutFactory factory(...$parameters)
 * @method static Builder|Layout isUnique(string $title)
 * @method static Builder|Layout newModelQuery()
 * @method static Builder|Layout newQuery()
 * @method static Builder|Layout query()
 * @method static Builder|Layout whereContentType($value)
 * @method static Builder|Layout whereCreatedAt($value)
 * @method static Builder|Layout whereCreatedBy($value)
 * @method static Builder|Layout whereDataSource($value)
 * @method static Builder|Layout whereEformUrl($value)
 * @method static Builder|Layout whereId($value)
 * @method static Builder|Layout whereLayoutDefinitionId($value)
 * @method static Builder|Layout whereMaxItem($value)
 * @method static Builder|Layout whereOrderNo($value)
 * @method static Builder|Layout wherePluralItem($value)
 * @method static Builder|Layout wherePosition($value)
 * @method static Builder|Layout whereSingleItem($value)
 * @method static Builder|Layout whereTitle($value)
 * @method static Builder|Layout whereUpdatedAt($value)
 * @method static Builder|Layout whereWidth($value)
 * @mixin \Eloquent
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */

/**
 * @SuppressWarnings(PHPMD)
 */
class Layout extends Model
{
    use CreatedBy, HasFactory;
    protected $fillable = [
        'title',
        'single_item',
        'plural_item',
        'position',
        'width',
        'max_item',
        'content_type',
        'data_source',
        'order_no',
        'eform_url',
        'created_by',
        'layout_definition_id',
        'adv_config'
    ];

    public static $position = [
        'top'    => 'Top',
        'middle' => 'Middle',
        'bottom' => 'Bottom',
    ];

    public static $width = [
        '33%'  => '33%',
        '50%'  => '50%',
        '66%'  => '66%',
        '100%' => '100%',
    ];

    public static $class = [
        '33%'  => 'col-4',
        '50%'  => 'col-6',
        '66%'  => 'col-8',
        '100%' => 'col-12',
    ];

    public static array $homePageCardContentType = [
        'Content view'         => 'Content view',
        'Workflow view'        => 'Workflow view',
        'Horizontal bar Chart' => 'Horizontal bar Chart',
        'Vertical bar Chart'   => 'Vertical bar Chart',
        'Line Chart'           => 'Line Chart',
        'Pie Chart'            => 'Pie Chart',
        'KPI Card'             => 'KPI Card',
        'Calendar'             => 'Calendar',
        'Notifications'        => 'Notifications',
        'Custom HTML'          => 'Custom HTML',
        // 'System message'         => 'System message',
        // 'Integration'            => 'Integration',
        // 'Court Case'             => 'Court Case',
        'Custom Page' => 'Custom Page',
        'News Feed' => 'News Feed',
    ];

    public static array $navigationContentType = [
        "All content views"  => "All content views",
        "All workflow views" => "All workflow views",
        "Forms"              => "Available Forms",
        'Content view'       => 'Content view',
        'Workflow view'      => 'Workflow view',
        'Calendar'           => 'Calendar',
        'Notifications'      => 'Notifications',
        // 'Chat'                   => 'Chat',
        'Help Page'              => 'Help Center Content',
        'Custom HTML'            => 'Custom HTML',
        'Single Form'          => 'Single Form',
        // 'Sign in'                => 'Sign in',
        // 'Integration'            => 'Integration',
        // 'Court Case'             => 'Court Case',
        'Custom Page' => 'Custom Page',
        'News Feed' => 'News Feed',
        'Available Dashboards'   => 'Available Dashboards',
        'Single Dashboard'       => 'Single Dashboard',
    ];

    public const LAYOUT_DEFINITION_CUSTOMER       = 0;
    public const LAYOUT_DEFINITION_INTERNAL_ADMIN = 1;
    public const LAYOUT_DEFINITION_PUBLIC         = 2;
    public const LAYOUT_DEFINITION_EXTERNAL_ADMIN = 3;

    public const LAYOUT_DEFINITIONS = [
        self::LAYOUT_DEFINITION_CUSTOMER       => 1,
        self::LAYOUT_DEFINITION_INTERNAL_ADMIN => 2,
        self::LAYOUT_DEFINITION_PUBLIC         => 3,
        self::LAYOUT_DEFINITION_EXTERNAL_ADMIN => 4,
    ];

    public const REQUIRED_PARTIAL_DATA = [
        'Content view',
        'Workflow view'
    ];

    public const REQUIRED_MAX_ITEMS = [
        'Content view',
        'Workflow view',
        'Horizontal bar Chart',
        'Vertical bar Chart',
        'Line Chart',
        'Pie Chart',
        'Notifications'
    ];

    // End Home page & Navigation Page

    public function returnClass()
    {
        if ($this->width == '33%') {
            $class = 'col-md-4';
        } elseif ($this->width == '50%') {
            $class = 'col-md-6';
        } elseif ($this->width == '66%') {
            $class = 'col-md-8';
        } else {
            $class = 'col-md-12';
        }

        return $class;
    }

    public function definition(): BelongsTo
    {
        return $this->belongsTo(LayoutDefinition::class, 'layout_definition_id', 'id');
    }

    public function contentTypeIsDocumentOrChild()
    {
        $dataBatch = HomeController::getMenu();

        if (empty($dataBatch)) {
            return [];
        }

        if ($this->content_type == 'Documents') {
            return $this->getContentTypeDocuments($dataBatch);
        }

        if ($this->content_type == 'Child Workflows') {
            return $this->getContentTypeChildWorkflow($dataBatch);
        }

        return [];
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
    */
    public function getResult()
    {
        try {
            if ($this->content_type == 'Documents' || $this->content_type == 'Child Workflows') {
                return $this->contentTypeIsDocumentOrChild();
            }

            if (in_array($this->content_type, ['Workflow view', 'Court Case'])) {
                return $this->getFormattedTaskDetail();
            } elseif ($this->content_type == 'Content view') {
                $response     = FolderController::fetchFolderDetail($this->data_source);
                $folderDetail = [];
                $titles       = [];
                $isSuccess    = false;
                $errorMessage = '';
                if ($response->Success == true) {
                    if (count($response->Data) > 0) {
                        $folderDetail = json_decode(json_encode($response->Data), true);
                        $titles       = (array)$response->Data[0];
                        unset($titles['Ident'], $titles['ICS_DocumentID'], $titles['ICS_AppName']);
                        $titles = array_keys($titles);
                    }
                    $isSuccess = true;
                } else {
                    $errorMessage = $response->ErrorMessage;
                }

                return [
                    'titles'     	=> $titles,
                    'details'    	=> $folderDetail,
                    'is_success' 	=> $isSuccess,
                    'error_message' => $errorMessage,
                ];
            } elseif ($this->content_type == 'KPI Card') {
                $chartDataSource = ChartDatasource::where('datasource_name', 'LIKE', $this->data_source)->first();

                // Stored procedures MUST be defined with two parameters: (@user_id int, @tenant_id VARCHAR(100))
                $arrData = DB::select('EXEC ' . $chartDataSource->sp_name . ' ?, ? ', [user()->id, tenant('tenant_id')]);

                $data = array_values((array)$arrData[0]);

                return [
                    'title' => $this->title,
                    'data'  => $data,
                ];
            } elseif ($this->content_type == 'Pie Chart' || $this->content_type == 'Line Chart' || $this->content_type == 'Vertical bar Chart' || $this->content_type == 'Horizontal bar Chart') {
                $chartDataSource = ChartDatasource::where('datasource_name', 'LIKE', $this->data_source)->first();

                // Stored procedures MUST be defined with two parameters: (@user_id int, @tenant_id VARCHAR(100))
                $arrData = DB::select('EXEC ' . $chartDataSource->sp_name . ' ?, ? ', [user()->id, tenant('tenant_id')]);

                $maxArray  = array_slice($arrData, 0, $this->max_item);
                $dataArray = [];

                // Make Array For separate Label & Data
                foreach ($maxArray as $v) {
                    $dummy                 = array_values((array)$v);
                    $dataArray['labels'][] = $dummy[0];
                    $dataArray['data'][]   = $dummy[1];
                }
                // End

                //setting defaults for the charts
                $adv_config       = [];
                $chart_dimensions = (object) [
                    'width'  => 0,
                    'height' => 0,
                ];

                // Assigning colors according to its datavalues
                // adv_config colors are only for charts that aren't Line chart
                if ($this->adv_config !== "" && $this->content_type != 'Line Chart') {
                    //ensures that proper json is passed to adv_config
                    if (json_decode($this->adv_config)) {
                        $adv_config_full = json_decode($this->adv_config);

                        //identify if its the old implementation
                        if (is_array($adv_config_full)) {
                            $adv_config = $adv_config_full;
                        } else {
                            //implementing the current version
                            if (property_exists($adv_config_full, 'chart_dimensions')) {
                                $chart_dimensions = $adv_config_full->chart_dimensions[0];
                            }

                            //grab the color table specifics
                            if (json_decode($adv_config_full->color_table)) {
                                $adv_config = json_decode($adv_config_full->color_table);
                            } else {
                                $adv_config = [];
                            }
                        }

                    }
                } else if ($this->adv_config !== "" && $this->content_type == 'Line Chart') {

                    //ensures that proper json is passed to adv_config
                    if (json_decode($this->adv_config)) {
                        $adv_config_full = json_decode($this->adv_config);
                        //identify if its the old implementation
                        if (!is_array($adv_config_full)) {
                            if (property_exists($adv_config_full, 'chart_dimensions')) {
                                $chart_dimensions = $adv_config_full->chart_dimensions[0];
                            }
                        }
                    }
                }

                //setting the default color
                $default_color = '#FF0000';
                $default_color_range = 0; //darkest equivalent of the color
                if (env('DEFAULT_CHART_COLOR_BASE') != '' && preg_match('/^#[a-f0-9]{6}$/i', env('DEFAULT_CHART_COLOR_BASE'))) {
                    $default_color = env('DEFAULT_CHART_COLOR_BASE');
                }

                //End

                // Make Color Array
                $arrColors = [];
                // Provide a hard-coded set of chart colors here. An example is shown below.
                $colorRange = [-0.1, -0.3, -0.5, -0.7, -0.9, -0.2, -0.4, -0.6, -0.8, 0.1, 0.3, 0.5, 0.7, 0.9, 0.2, 0.4, 0.6, 0.8];

                $colorIndex = 0;

                if (!empty($dataArray) && empty($arrColors)) {
                    for ($i = 0; $i < count($dataArray['labels']); $i++) {
                        //if content type is bar charts and pie charts
                        if($this->content_type != 'Line Chart'){

                            //setting up colors for empty data values
                            $def_color_value = $this->adjustBrightness($default_color, $default_color_range);

                            if(is_array($adv_config) && count($adv_config) > 0){
                                $existing_values = array_column($adv_config, 'value');
                                if(in_array($dataArray['labels'][$i], $existing_values)){
                                    $key = array_search($dataArray['labels'][$i], $existing_values);
                                    $arrColors[] = $adv_config[$key]->color;
                                }else{
                                    $arrColors[] = $def_color_value; //need to set the default value
                                }
                            }else{
                                $arrColors[] = $def_color_value; //if empty
                            }


                            //incase of large datavalue sets, color brightness should go back to its darkest
                            if($colorIndex  == count($colorRange) - 1){
                                $colorIndex = 0;
                                $default_color_range =  0;
                            }else{
                                $default_color_range = $colorRange[$colorIndex];
                                $colorIndex++;
                            }

                        }else{
                            $arrColors[] = randomColorPart();
                        }

                    }
                }
                // End

                $chartArray = [];
                if ($this->content_type == 'Pie Chart') {
                    $type = 'doughnut';
                } elseif ($this->content_type == 'Line Chart') {
                    $type               = 'line';
                    $chartArray['fill'] = false;
                } elseif ($this->content_type == 'Horizontal bar Chart') {
                    $type = 'horizontalBar';
                } else {
                    $type = 'bar';
                }

                $chartArray['data']            = $dataArray['data'] ?? [];
                $chartArray['backgroundColor'] = $arrColors ?? [];

                return [
                    'is_success' => true,
                    'type'   => $type,
                    'labels' => $dataArray['labels'] ?? "",
                    'data'   => $chartArray,
                    'plural' => $this->plural_item,
                    'single' => $this->single_item,
                    'width'      => $chart_dimensions->width,
                    'height'     => $chart_dimensions->height,
                    'adv_config'    => count($colorRange) - 1,
                ];
            }
            if ($this->content_type == 'Integration') {
                $isSuccess       = false;
                $details         = [];
                $titles          = [];
                $restIntegration = RestIntegration::where(['id' => $this->data_source])->first();
                $detailsType     = 0;
                $basicDetails    = [];
                $name            = '';
                if (!is_null($restIntegration)) {
                    $name            = $restIntegration->name;
                    $authIntegration = $restIntegration->child_Rest_call()->where('integration_type', 0)->first();
                    $authResponse    = "";

                    if (!is_null($authIntegration)) {
                        $authResponse = RestIntegrationController::fetchRestInegartionResp($authIntegration->id, 0, '');
                    }

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
                                if (gettype($searchListResponse) == 'object') {
                                    $titles = (array)$searchListResponse;
                                } else {
                                    if (gettype($searchListResponse) == 'array') {
                                        $titles = (array)$searchListResponse[0];
                                    }
                                }

                                $titles = count($titles) > 0 ? array_keys($titles) : $titles;

                                $detail   = json_decode(json_encode($searchListResponse), true);
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

                                $titles = array_intersect($objTitle, json_decode($restIntegration->result_list));

                                $titles = array_values($titles);

                                $details   = json_decode(json_encode($searchListResponse), true);
                                $isSuccess = true;
                            }
                        }

                        if ($restIntegration->details_type == 2) {
                            $result = [];

                            $openDocument = $restIntegration->child_Rest_call()->where('integration_type', '=', 2)->first();

                            if (!is_null($openDocument)) {
                                $detailsType = 2;
                                foreach ($details as $detailsValue) {
                                    $detailsValue['url'] = RestIntegrationController::openDocumentUrl($openDocument->rest_endpoint_url, $detailsValue);
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

                return [
                    'titles'        => $titles,
                    'details'       => $details,
                    'is_success'    => $isSuccess,
                    'name'          => $name,
                    'id'            => $this->data_source,
                    'details_type'  => $detailsType,
                    'basic_details' => $basicDetails,
                ];
            }
            if ($this->content_type == 'Custom Page') {
                return CustomPage::where(['id' => $this->data_source])->first();
            }
            if ($this->content_type == 'News Feed') {
                return Newsfeeds::getAllNewsfeedWithLimit($this->max_item);
                //return Newsfeeds::limit($this->max_item)->orderBy('id','DESC')->get();
            }
        }catch (\Exception $e){
            Log::error('Layout request Error: ' . $e->getMessage());
            Log::error('Layout request Error Data: ' . json_encode($this->getAttributes()));
            return [
                'is_success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Increases or decreases the brightness of a color by a percentage of the current brightness.
     *
     * @param   string  $hexCode        Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
     * @param   float   $adjustPercent  A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
     *
     * @return  string
     *
     * @author  maliayas
     */
    public function adjustBrightness($hexCode, $adjustPercent) : string
    {
        $hexCode = ltrim($hexCode, '#');

        if (strlen($hexCode) == 3) {
            $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
        }

        $hexCode = array_map('hexdec', str_split($hexCode, 2));

        foreach ($hexCode as & $color) {
            $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
            $adjustAmount = ceil($adjustableLimit * $adjustPercent);

            $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
        }

        return '#' . implode($hexCode);
    }

    public function getFormattedTaskDetail(): array
    {
        $response   = TaskController::fetchTaskDetail($this->data_source);
        $taskDetail = [];
        $titles     = [];
        $isSuccess  = false;

        if ($response->Success == true) {
            if (count($response->Data) > 0) {
                $titles     = (array)$response->Data[0];
                $titles     = array_keys($titles);
                $taskDetail = json_decode(json_encode($response->Data), true);
            }

            $isSuccess = true;
        }

        return [
            'titles'     => $titles,
            'details'    => $taskDetail,
            'is_success' => $isSuccess,
        ];
    }

    public function scopeIsUnique(Builder $query, string $title): bool
    {
        return $query->where("title", "LIKE", "%" . $title . "%")
            ->where("layout_definition_id", '=', 0)
            ->where("created_by", '=', user()->id)
            ->exists();
    }

    public function scopePosition(Builder $query, string $position): Builder
    {
        return $query->where('position', 'like', $position)
            ->orderBy('order_no', 'ASC');
    }

    public function getContentTypeDocuments(mixed $dataBatch)
    {
        $objBatch = HomeController::getBatchDocs($dataBatch->BatchID);

        $dataDoc = [];
        foreach ($objBatch->Data as $d) {
            $dataDoc[$d->DocTypeName][] = $d;
        }

        if (isset($dataDoc[$this->data_source]) && !empty($dataDoc[$this->data_source])) {
            return $dataDoc[$this->data_source];
        }

        return [];
    }

    private function getContentTypeChildWorkflow(mixed $dataBatch): mixed
    {
        $dataTbl = [];

        foreach ($dataBatch->IndexValues as $tbl) {
            if ($tbl->DataType == '_table') {
                $dataTbl[$tbl->IndexName] = $tbl;
            }
        }

        if (isset($dataTbl[$this->data_source]) && !empty($dataTbl[$this->data_source])) {
            return $dataTbl[$this->data_source]->TableValue->RowValues;
        }

        return [];
    }

    public static function getNavigationContentType()
    {
        $defaults = self::$navigationContentType;
        $packageLayout = config('package-layout');
        if ($packageLayout) {
            foreach ($packageLayout as $pk => $data) {
                if (isset($data['navigation']) && !empty($data['navigation'])) {
                    $contentKey = '[package_layout].' . $pk . '.navigation';
                    $navigationLinkArr = [$contentKey => $data['navigation']['content_type']];
                    $defaults = array_merge($defaults, $navigationLinkArr);
                }
            }
        }

        return $defaults;
    }

    public static function gethomePageCardContentType()
    {
        $defaults = self::$homePageCardContentType;
        $packageLayout = config('package-layout');
        if ($packageLayout) {
            foreach ($packageLayout as $pk => $data) {
                if (isset($data['card']) && !empty($data['card'])) {
                    $contentKey = '[package_layout].' . $pk . '.card';
                    $navigationLinkArr = [$contentKey => $data['card']['content_type']];
                    $defaults = array_merge($defaults, $navigationLinkArr);
                }
            }
        }

        return $defaults;
    }
}
