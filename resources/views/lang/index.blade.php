<x-layouts.app title="{{ __('Manage Languages') }}">
    <x-slot name="actionButton">
        <x-button sm white circle class="btn-icon-only ml-2"
                data-url="{{ route('lang.create') }}"
                data-ajax-popup="true"
                data-size="md"
                data-title="{{ __('Create Language') }}">
        <span class="btn-inner--icon">
            <i class="fas fa-plus"></i>
        </span>
        </x-button>

        @if ($currantLang != user()->lang)
        <x-button sm white circle class="btn-icon-only"
                    data-toggle="tooltip"
                    data-original-title="{{ __('Delete this language') }}"
                    data-confirm="{{ __('Are You Sure? | Do you want to continue?') }}"
                    data-confirm-yes="document.getElementById('delete-form-{{ $currantLang }}').submit();">
            <i class="fas fa-trash"></i>
        </x-button>
        <x-form :action="route('lang.destroy', $currantLang)" id="delete-form-{{ $currantLang }}" delete></x-form>
        @endif
    </x-slot>

    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#labels" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                <span class="d-none d-lg-block">{{ __('Labels') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#messages" data-toggle="tab" aria-expanded="true" class="nav-link">
                                <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                <span class="d-none d-lg-block">{{ __('Messages') }}</span>
                            </a>
                        </li>
                    </ul>
                    <form method="post" action="{{ route('lang.store.data', $currantLang) }}">
                        @csrf
                        <div class="tab-content">
                            <div class="tab-pane active" id="labels">
                                <div class="row">
                                    @foreach ($arrLabel as $label => $value)
                                        <div class="col-lg-6">
                                            <div class="form-group mb-3">
                                                <label class="form-control-label">{{ $label }}</label>
                                                <input type="text" class="form-control"
                                                    name="label[{{ $label }}]" value="{{ $value }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane show" id="messages">
                                @foreach ($arrMessage as $fileName => $fileValue)
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3>{{ ucfirst($fileName) }}</h3>
                                        </div>
                                        @foreach ($fileValue as $label => $value)
                                            @if (is_array($value))
                                                @foreach ($value as $label2 => $value2)
                                                    @if (is_array($value2))
                                                        @foreach ($value2 as $label3 => $value3)
                                                            @if (is_array($value3))
                                                                @foreach ($value3 as $label4 => $value4)
                                                                    @if (is_array($value4))
                                                                        @foreach ($value4 as $label5 => $value5)
                                                                            <x-input.text
                                                                                name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}][{{ $label4 }}][{{ $label5 }}]"
                                                                                label="{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}.{{ $label4 }}.{{ $label5 }}"
                                                                                :value="$value5"
                                                                                class="mb-3"
                                                                                container-class="col-lg-6"/>
                                                                        @endforeach
                                                                    @else
                                                                        <x-input.text
                                                                            name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}][{{ $label4 }}]"
                                                                            label="{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}.{{ $label4 }}"
                                                                            :value="$value4"
                                                                            class="mb-3"
                                                                            container-class="col-lg-6"/>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <x-input.text
                                                                    name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}]"
                                                                    label="{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}"
                                                                    :value="$value3"
                                                                    class="mb-3"
                                                                    container-class="col-lg-6"/>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <x-input.text
                                                            name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}]"
                                                            label="{{ $fileName }}.{{ $label }}.{{ $label2 }}"
                                                            :value="$value2"
                                                            class="mb-3"
                                                            container-class="col-lg-6"/>
                                                    @endif
                                                @endforeach
                                            @else
                                                <x-input.text
                                                    name="message[{{ $fileName }}][{{ $label }}]"
                                                    label="{{ $fileName }}.{{ $label }}"
                                                    :value="$value"
                                                    class="mb-3"
                                                    container-class="col-lg-6"/>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </x-tabs.tab>
                        </x-tabs>

                        <hr>
                        <div class="text-right">
                            <x-button sm primary pill type="submit">{{ __('Save') }}</x-button>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach (Utility::languages() as $lang)
                            <a href="{{ route('lang', $lang) }}" class="nav-link @if ($currantLang == $lang) active @endif">
                                <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                <span class="d-none d-lg-block">{{ Str::upper($lang) }}</span>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
