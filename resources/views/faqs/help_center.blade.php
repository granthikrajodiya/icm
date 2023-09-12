<x-layouts.app title="{{ __('Help Center') }}" header="{{ __('Help Center') }}">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="scrollbar-inner">
                    <div class="min-h-690">
                        <div class="card-body">
                            @if (!empty(Utility::getValByName('help_center_text')))
                                <p>{!! Utility::getValByName('help_center_text') !!}</p>
                            @endif
                            @if ($faqs->count() > 0)
                                <h5 class="h5 py-3">{{ __('FAQ') }}</h5>
                                <div id="accordion-1" class="accordion accordion-stacked">
                                    @foreach ($faqs as $faq)
                                        <div class="card">
                                            <div class="card-header py-4" id="heading-{{ $faq->id }}"
                                                data-toggle="collapse" role="button"
                                                data-target="#collapse-{{ $faq->id }}" aria-expanded="false"
                                                aria-controls="collapse-{{ $faq->id }}">
                                                <h6 class="mb-0">{{ $faq->title }}</h6>
                                            </div>
                                            <div id="collapse-{{ $faq->id }}" class="collapse"
                                                aria-labelledby="heading-1-1" data-parent="#accordion-1">
                                                <div class="card-body">
                                                    <p>{!! $faq->detail !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
