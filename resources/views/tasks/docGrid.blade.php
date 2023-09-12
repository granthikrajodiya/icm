@if (count($documentData) > 0)
    @foreach ($documentData as $key => $doc)
        <div class="col-xl-3 col-lg-4 col-sm-6 grid_record">
            <div class="card hover-shadow-lg">
                <div class="card-header border-0 pb-0 pt-2 px-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div></div>
                        <div class="text-right">
                            <div class="actions">
                                <div class="dropdown action-item" data-toggle="dropdown">
                                    <a href="#" class="action-item" data-toggle="dropdown"><i
                                            class="fas fa-ellipsis-h"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" data-docid="{{ $doc->DocID }}"
                                           class="dropdown-item doc_detail">{{__('Open')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body text-center pt-0">
                    <h5 class="h6 mt-4">
                        <a href="#" data-docid="{{ $doc->DocID }}" class="doc_detail">
                            {{ Utility::GetDocProp($doc,$tableHeader[0]) }}
                        </a>
                    </h5>
                    <p class="mb-0">{{ Utility::GetDocProp($doc,$tableHeader[1]) }}</p>
                    @if (isset($tableHeader[2]) && !empty(Utility::GetDocProp($doc,$tableHeader[2])))
                        <p class="text text-xs">{{ Utility::GetDocProp($doc,$tableHeader[2]) }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@else
    <li class="media">
        <div class="media-body">
            <h6 class="text-center">{{__('No data found.')}}</h6>
        </div>
    </li>
@endif
