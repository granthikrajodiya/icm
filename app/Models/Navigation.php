<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

/**
 * App\Models\Navigation
 *
 * @property int $id
 * @property int $order_no
 * @property string $title
 * @property string $content_type
 * @property string $data_source
 * @property int $show_top_menu
 * @property int $show_nav_menu
 * @property int $layout_definition_id
 * @property string $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $eform_url
 * @method static \Database\Factories\NavigationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereContentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereDataSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereEformUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereLayoutDefinitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereOrderNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereShowNavMenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereShowTopMenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Navigation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
/**
 * @SuppressWarnings(PHPMD)
 */
class Navigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'layout_definition_id',
        'order_no',
        'title',
        'content_type',
        'data_source',
        'show_top_menu',
        'show_nav_menu',
        'icon',
        'eform_url',
        'layout_definition_id',
        'adv_config'
    ];

    public const ALL_CONTENT_VIEW     = "All content views";
    public const ALL_WORK_FLOW_VIEW   = "All workflow views";
    public const CALENDAR_VIEW        = "Calendar";
    public const CHAT_VIEW            = "Chat";
    public const CHILD_WORKFLOW_VIEW  = "Child Workflows";
    public const CONTENT_VIEW         = "Content view";
    public const DOCUMENTS_VIEW       = "Documents";
    public const FORMS_VIEW           = "Forms";
    public const HELP_PAGE_VIEW       = "Help Page";
    public const NOTIFICATION_VIEW    = "Notifications";
    public const WORKFLOW_VIEW        = "Workflow view";
    public const CUSTOM_HTML_VIEW     = "Custom HTML";
    public const SIGN_IN_VIEW         = "Sign in";
    public const COURT_CASE_VIEW      = "Court Case";
    public const INTEGRATION_VIEW     = "Integration";
    public const CUSTOM_PAGE_VIEW     = "Custom Page";
    public const NEWS_FEED            = "News Feed";
    public const SINGLE_FORM          = "Single Form";
    public const AVAILABLE_DASHBOARDS = "Available Dashboards";
    public const SINGLE_DASHBOARD     = "Single Dashboard";
    public const FILE_DOWNLOADS       = "File downloads";


    public const VIEW_SLUG = [
        self::ALL_CONTENT_VIEW     => 'folder.index',
        self::ALL_WORK_FLOW_VIEW   => 'tasks.index',
        self::CALENDAR_VIEW        => 'calendar.index',
        self::CHAT_VIEW            => 'chat',
        self::CHILD_WORKFLOW_VIEW  => 'batch.detail',
        self::CONTENT_VIEW         => 'folder.filter',
        self::DOCUMENTS_VIEW       => 'docs.index',
        self::FORMS_VIEW           => 'forms.index',
        self::HELP_PAGE_VIEW       => 'help.center',
        self::NOTIFICATION_VIEW    => 'notification.index',
        self::WORKFLOW_VIEW        => 'tasks.view',
        self::CUSTOM_HTML_VIEW     => 'custom.page',
        self::SIGN_IN_VIEW         => 'make-logout',
        self::INTEGRATION_VIEW     => 'integration.list',
        self::COURT_CASE_VIEW      => 'courtcase.list',
        self::CUSTOM_PAGE_VIEW     => 'CustomPages.show',
        self::NEWS_FEED            => 'newsfeed.page',
        self::SINGLE_FORM          => 'forms.view',
        self::AVAILABLE_DASHBOARDS => 'dashboards.index',
        self::SINGLE_DASHBOARD     => 'dashboards.detail',
        self::FILE_DOWNLOADS       => 'fileaccess.index',

    ];
    private static function getNavigationLink($contentType, $navigation)
    {
        $integration = null;

        if ($contentType == self::INTEGRATION_VIEW) {
            $integration = RestIntegration::where('id', $navigation->data_source)->first();
        }

        $navigationLinks = [
            self::ALL_CONTENT_VIEW     => route('folder.index', tenant('tenant_id')),
            self::ALL_WORK_FLOW_VIEW   => route('tasks.index', tenant('tenant_id')),
            self::CALENDAR_VIEW        => route('calendar.index', tenant('tenant_id')),
            self::CHAT_VIEW            => url(tenant('tenant_id') . '/chat'),
            self::CHILD_WORKFLOW_VIEW  => route('batch.detail', [
                tenant('tenant_id'),
                $navigation->data_source,
            ]),
            self::CONTENT_VIEW         => route('folder.filter', [
                tenant('tenant_id'),
                $navigation->data_source
            ]),
            self::FORMS_VIEW           => route('forms.index', [tenant('tenant_id')]),
            self::HELP_PAGE_VIEW       => route('help.center', tenant('tenant_id')),
            self::NOTIFICATION_VIEW    => route('notification.index', tenant('tenant_id')),
            self::WORKFLOW_VIEW        => route('tasks.view', [
                tenant('tenant_id'),
                $navigation->data_source,
                $navigation->id,
            ]),
            self::CUSTOM_HTML_VIEW     => route('custom.page', [
                tenant('tenant_id'),
                $navigation,
            ]),
            self::SIGN_IN_VIEW         => route('logout', tenant('tenant_id')),
            self::INTEGRATION_VIEW     => route('integration.list', [
                tenant('tenant_id'),
                !is_null($integration) ? $integration->name : '',
                "restIntegration" => $navigation,
            ]),
            self::COURT_CASE_VIEW      => route('courtcase.list', [
                tenant('tenant_id'),
                $navigation->data_source,
            ]),
            self::CUSTOM_PAGE_VIEW => route('CustomPages.show', [
                tenant('tenant_id'),
                $navigation->data_source,
            ]),
            self::NEWS_FEED            => route('newsfeed.page', [
                tenant('tenant_id'),
                $navigation,
            ]),
            self::SINGLE_FORM          => route('forms.view', [
                tenant('tenant_id'),
                $navigation->data_source,
            ]),
            self::AVAILABLE_DASHBOARDS => route('dashboards.index', tenant('tenant_id')),
            self::SINGLE_DASHBOARD     => route('dashboards.detail', [
                tenant('tenant_id'),
                $navigation->data_source,
            ]),
            self::FILE_DOWNLOADS => route('fileaccess.index', [
                tenant('tenant_id')
            ])
        ];

        // Add package navigation links
        $packageLayout = config('package-layout');

        if ($packageLayout) {
            foreach ($packageLayout as $pk => $data) {
                if (isset($data['navigation']) && !empty($data['navigation'])) {
                    $contentKey = '[package_layout].' . $pk . '.navigation';
                    if (Route::has($data['navigation']['route'])) {
                        $navigationLinkArr = [
                            $contentKey => route($data['navigation']['route'], [
                                tenant('tenant_id'),
                                $navigation->data_source
                            ])
                        ];
                        $navigationLinks = array_merge($navigationLinks, $navigationLinkArr);
                    }
                }
            }
        }

        return empty($navigationLinks[$contentType]) ? '#' : $navigationLinks[$contentType];
    }

    public static function getNavigationViewSlug()
    {
        $defaults = self::VIEW_SLUG;
        // Add package navigation links
        $packageLayout = config('package-layout');
        if ($packageLayout) {
            foreach ($packageLayout as $pk => $data) {
                if (isset($data['navigation']) && !empty($data['navigation'])) {
                    $contentKey = '[package_layout].' . $pk . '.navigation';
                    $navigationLinkArr = [$contentKey => $data['navigation']['route']];
                    $defaults = array_merge($defaults, $navigationLinkArr);
                }
            }
        }

        return $defaults;
    }

    public static function navigationResult($display = 'top')
    {
        $navigations = self::getLayoutDefinition(user());
        $arrResponse = [];

        if ($navigations->count() === 0) {
            return [];
        }

        foreach ($navigations as $navigation) {
            $contentType = $navigation->content_type;
            $slug        = !empty($contentType) && in_array($contentType, self::getNavigationViewSlug()) ? self::getNavigationViewSlug()[$contentType] : '';
            $link        = self::getNavigationLink($contentType, $navigation);


            if ($display == 'top') {
                if ($navigation->show_top_menu == 1) {
                    $arrResponse[] = [
                        'title' => $navigation->title,
                        'link'  => $link,
                        'slug'  => $slug,
                        'contentType' => $contentType,
                        'advConfig' => $navigation->adv_config,
                        'datasource' => $navigation->data_source
                    ];
                }
            } else {
                if ($navigation->show_nav_menu == 1) {
                    $icon = $navigation->icon;

                    if ($contentType == 'Forms' && empty($icon)) {
                        $icon = 'fa fa-file-invoice';
                    }

                    $arrResponse[] = [
                        'title' => $navigation->title,
                        'link'  => $link,
                        'icon'  => $icon,
                        'slug'  => $slug,
                        'contentType' => $contentType,
                        'advConfig' => $navigation->adv_config,
                        'datasource' => $navigation->data_source
                    ];
                }
            }
        }

        return $arrResponse;
    }

    private static function getLayoutDefinition(User $user): Collection
    {
        $layoutDefinitionId = 0;
        $arrLayouts         = LayoutDefinition::layoutDefinitions()->toArray();

        if (count($arrLayouts) > 0) {
            if (in_array($user->layout_definition, array_keys($arrLayouts))) {
                $layoutDefinition = LayoutDefinition::find($user->layout_definition);
            } else {
                $layoutDefinition = LayoutDefinition::find(array_keys($arrLayouts)[0]);
            }

            $layoutDefinitionId = $layoutDefinition->id;
        }

        $navigation = Navigation::where('layout_definition_id', '=', $layoutDefinitionId);

        return $navigation->orderBy('order_no', 'ASC')->get();
    }
}
