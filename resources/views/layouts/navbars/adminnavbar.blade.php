@auth()
    @include('layouts.navbars.navs.adminnav')
@endauth
    
@guest()
    @include('layouts.navbars.navs.guest')
@endguest