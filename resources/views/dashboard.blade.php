@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">school</i>
              </div>
              <p class="card-category">Organizations</p>
              <h3 class="card-title">
                {{ $organizations }}
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">input</i>
                <a href="{{ route('organizationlist') }}">Details...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">add_to_photos</i>
              </div>
              <p class="card-category"></p>
              <h3 class="card-title">Add New Organizations</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">input</i>
                <a href="{{ route('neworganization') }}">Details...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">people</i>
              </div>
              <p class="card-category">Registered Users</p>
              <h3 class="card-title">{{ $users }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">input</i>
                <a href="{{ route('user.index') }}">Details...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                 <i class="material-icons">settings</i>
              </div>
              <p class="card-category">View Settings</p>
              <h3 class="card-title">{{ $columns }}</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">input</i>
                <a href="{{ route('view_setting') }}">Details...</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      // md.initDashboardPageCharts();
    });
  </script>
@endpush
