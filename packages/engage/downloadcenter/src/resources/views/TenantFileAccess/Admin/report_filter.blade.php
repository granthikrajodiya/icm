@if(count($data)>0)
    <div class="dt-buttons actions actions-dark align-items-center text-right" id="export_btn">
        <button type="button" class="btn buttons-csv btncsv export_btn"><i class='fa fa-file-csv'></i>
        </button>
        <button type="button" class="btn buttons-pdf btnprn export_btn"><i class='fa fa-print'></i>
        </button>
    </div>
@endif
<div class="table-responsive">
    <table class="table align-items-center dataTable filtertable">
        @if($type == 'product')
            <thead>
            <tr>
                <th class="pointer text-dark">{{ __('Tenant') }}</th>
                <th class="pointer text-dark">{{ __('Tenant ID') }}</th>
            </tr>
            </thead>
            <tbody id="tbl_record">
                @if(count($data)>0)
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{$value['Tenant']}}</td>
                        <td>{{$value['Tenant ID']}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        @elseif($type == 'tenant')
            <thead>
                <tr>
                    <th class="pointer text-dark">{{ __('Release') }}</th>
                    <th class="pointer text-dark">{{ __('Product') }}</th>
                    <th class="pointer text-dark">{{ __('Last Download') }}</th>
                </tr>
            </thead>
            <tbody id="tbl_record">
                @if(count($data)>0)
                    @foreach($data as $key => $value)
                    @php $value = (array)$value; @endphp
                    <tr>
                        <td>{{$value['Release']}}</td>
                        <td>{{$value['Product']}}</td>
                        @php $date=date_create($value['Last Download']);@endphp
                        <td>{{date_format($date,"m/d/Y")}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        @elseif($type == 'date')
            <thead>
                <tr>
                    <th class="pointer text-dark">{{ __('Tenant') }}</th>
                    <th class="pointer text-dark">{{ __('Release') }}</th>
                    <th class="pointer text-dark">{{ __('Product') }}</th>
                    <th class="pointer text-dark">{{ __('File name') }}</th>
                    <th class="pointer text-dark">{{ __('Last Download') }}</th>
                </tr>
            </thead>
            <tbody id="tbl_record">
                @if(count($data)>0)
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{$value['Tenant']}}</td>
                        <td>{{$value['Release']}}</td>
                        <td>{{$value['Product']}}</td>
                        <td>{{$value['File name']}}</td>
                        @php $date=date_create($value['Last Download']);@endphp
                        <td>{{date_format($date,"m/d/Y")}}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        @endif
    </table>
</div>

<script type="text/javascript">
    @if(count($data)>0)
        var printData = jQuery.parseJSON(`{!! $printData !!}`);
        var printGridTitle = jQuery.parseJSON('{!! $printGridTitle !!}');

        $('.btnprn').on('click',function () {
            var header = "{{__('ILINX Product Downloads')}} - {{__('Reports')}} - "+$('.nav-link.active').find('span').text();
            generatePrint(printData,printGridTitle,header);
        });

        $('.btncsv').on('click',function () {
            var header = "{{__('ILINX Product Downloads')}} - {{__('Reports')}} - "+$('.nav-link.active').find('span').text();
            exportCSVFile(printGridTitle,printData,header);
        });
    @endif
</script>

