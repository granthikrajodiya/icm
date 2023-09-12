<div class="col-12">
    @if (count($documentData) > 0)
        <div class="table-responsive">
            <table class="table align-items-center">
                <thead class="list">
                <tr>
                    @foreach($tableHeader as $header)
                        <th>{{ Str::replace('ICM_','',$header) }}</th>
                    @endforeach
                    <th></th>
                </tr>
                </thead>
                <tbody class="list" id="doc_tbl">
                    @foreach ($documentData as $key => $doc)
                        <tr>
                            @if (count($tableHeader) > 0)
                                @foreach ($tableHeader as $field)
                                    @if ($loop->iteration == 1)
                                        <td>
                                            <div class="media align-items-center">
                                                <div>
                                                    <a href="#" data-docid="{{ $doc->DocID }}" class="doc_detail"><i
                                                            class="fas fa-file fa-2x"></i></a>
                                                </div>
                                                <div class="media-body ml-4">
                                                    <a href="#" data-docid="{{ $doc->DocID }}"
                                                       class="font-weight-700 text text-muted doc_detail">{{ Utility::GetDocProp($doc,$field) }}</a>
                                                </div>
                                            </div>
                                        </td>
                                    @else
                                        <td>{{ Utility::GetDocProp($doc,$field) }}</td>
                                    @endif
                                @endforeach
                            @endif
                            <td class="text-right">
                                <div class="dropdown">
                                    <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" data-docid="{{ $doc->DocID }}"
                                           class="dropdown-item doc_detail">{{__('Open')}}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <li class="media">
            <div class="media-body">
                <h6 class="text-center">{{__('No data found.')}}</h6>
            </div>
        </li>
    @endif
</div>
