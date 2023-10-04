@component('mail::message')
    welcome to ProShop
    @component('mail::button', ['url' => url('/')])
        Go to WebSite
    @endcomponent

@endcomponent
