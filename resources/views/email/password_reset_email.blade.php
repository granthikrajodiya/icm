@component('mail::layout')

@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {!! env('APP_NAME') !!}
    @endcomponent
    <style>
        #reset_button{
            padding:10px;
            width:300px;
            display:block;
            text-decoration:none;
            text-align:center;
            font-weight: 700;
            font-size: 14px;
            color: #fff;
            border-radius: 5px;
            line-height: 17px;
            margin: 0 auto;
            color: #FFFFFF;
            background-color: #306EFF;
            border-color: #306EFF;
            box-shadow: inset 0 1px 0 rgba(18, 38, 63, 0.15);
            box-sizing: border-box;
            font-family: -apple-system,'Open Sans', sans-serif, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
            position: relative;
            font-size: 19px;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/css/'.Utility::getSiteContent('default_theme').'.css') }}">
@endslot



{{-- Body --}}
We have received your request to reset your password. Please click the link below to complete the reset:
        <!--[if mso]>
        <v:roundrect href="{{ $link }}" style="width:273px;height:40px;v-text-anchor:middle;padding-top: 10px;" arcsize="50%" stroke="f" fillcolor="#306EFF" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word">
            <w:anchorlock/>
            <v:textbox inset="0,0,0,0">
            <center>
        <![endif]-->
<a role="button" id="reset_button" href="{{ $link }}" target="_blank" data-saferedirecturl="{{ $link }}">Reset My Password</a>
        <!--[if mso]>
            </center>
            </v:textbox>
        </v:roundrect>
        <![endif]-->
		
If you need additional assistance, or you did not make this change, please contact your administrator.

Thanks,
The {{ config('app.name') }} team.



@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} {!! env('APP_NAME') !!}. @lang('All rights reserved.')
    @endcomponent
@endslot
@endcomponent
