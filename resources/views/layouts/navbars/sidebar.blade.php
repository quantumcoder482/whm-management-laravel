<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('InfomatsAu') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      @if (Auth::user()->role == 2)
      <li class="nav-item {{ $activePage == 'new-organization' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('neworganization') }}">
          <i class="material-icons">public</i>
            <p>{{ __('New Organization') }}</p>
        </a>
      </li>
      @endif

      <li class="nav-item {{ $activePage == 'organization-list' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('organizationlist') }}">
          <i class="material-icons">view_list</i>
            <p>{{ __('Organization List') }}</p>
        </a>
      </li>

      @if (Auth::user()->role == 2)
      <li class="nav-item {{ $activePage == 'expired-list' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('expiredlist') }}">
          <i class="material-icons">view_list</i>
            <p>{{ __('Expired SubDomain List') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'view-setting' || $activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="true">
          <i class="material-icons">settings</i>
          <p>{{ __('Settings') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ ($activePage == 'view-setting' || $activePage == 'profile' || $activePage == 'user-management') ? 'show' : 'hide' }}" id="settings">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'view-setting' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('view_setting') }}">
                {{-- <span class="sidebar-mini"> VS </span> --}}
                <i class="material-icons">list_alt</i>
                <span class="sidebar-normal"> {{ __('View Setting') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                {{-- <span class="sidebar-mini"> UP </span> --}}
                <i class="material-icons">person</i>
                <span class="sidebar-normal">{{ __('User Profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                {{-- <span class="sidebar-mini"> UM </span> --}}
                <i class="material-icons">group_add</i>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
             
          </ul>
        </div>
      </li>
      @endif

      @if (Auth::user()->role == 1)
        <li class="nav-item {{ $activePage == 'profile' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="material-icons">person</i>
              <p>{{ __('User Profile') }}</p>
          </a>
        </li>
      @endif
     
     <!--
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Table List') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('typography') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Typography') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('language') }}">
          <i class="material-icons">language</i>
          <p>{{ __('RTL Support') }}</p>
        </a>
      </li>
      !-->
      <!--
      <li class="nav-item active-pro{{ $activePage == 'upgrade' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('upgrade') }}">
          <i class="material-icons">unarchive</i>
          <p>{{ __('Upgrade to PRO') }}</p>
        </a>
      </li> 
      !-->


    </ul>
  </div>
</div>