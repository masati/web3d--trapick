    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <p>{{ trans('app.copyright') }}</p>
            </div>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="col-md-2">
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{  LaravelLocalization::getLocalizedUrl($localeCode) }}">
                                {{ $properties['native'] }}
                            </a>
                        </div>
                    @endforeach
            <div class="col-md-3 text-right">
                <a href="http://web3d.co.il" target="_blank" title="*{{ trans('app.copyright_title') }}" class="web3d"></a>
            </div>
        </div>
    </div>
