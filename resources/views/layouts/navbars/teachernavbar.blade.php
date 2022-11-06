@auth()
    @include('layouts.navbars.navs.teachernav')
@endauth
    
@guest()
    @include('layouts.navbars.navs.guest')
@endguest