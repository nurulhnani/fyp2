@auth()
    @include('layouts.navbars.navs.studentnav')
@endauth
    
@guest()
    @include('layouts.navbars.navs.guest')
@endguest