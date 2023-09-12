<div id='layout-navigation-loader' class="min-h-500 d-none">
    <img src="{{ asset('assets/img/loading.gif') }}" height="50px" width="50px" class="loading" alt="">
</div>
<div id="layout-navigation-content">
    <x-form :action="route('layout.navigation.update', [tenant('tenant_id'), $layoutDefinition])" id="frm_navigation_store">
        <div id="load_navigation_view">

        </div>
    </x-form>
</div>
