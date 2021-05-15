<header>
    <div class="container">
        <div class="row header">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="logo">
                    <a href="{{ route('home_page') }}"><h1>ICW</h1></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-4 header-call clearfix">
                <p>
                    <i class="fa fa-phone pull-left"></i>
                    <span class="phone">123-456-7890</span><br/>
                    <span class="info">info@example.com</span>
                </p>
            </div>
            <div class="col-md-3 col-lg-3 col-sm-4 header-place clearfix">
                <p>
                    <i class="fa fa-home pull-left"></i>
                    <span class="address-title">777 Seventh Avenue</span><br/>
                    <span class="address-desc">Downtown NY 01234</span>
                </p>
            </div>

            <div class="col-md-3 col-lg-3 col-sm-4 header-place clearfix">
                @php
                    $locales = config('laravellocalization.supportedLocales');
                @endphp
                @foreach ($locales as $key => $locale)
                    <a href="{{ LaravelLocalization::setLocale($key) }}">{{ $locale['native'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
</header>
