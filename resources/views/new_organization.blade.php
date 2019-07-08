@extends('layouts.app', ['activePage' => 'new-organization', 'titlePage' => __('Create New Organization')])

@section('content')
  @push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" rel="stylesheet"/>
  @endpush

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">{{ __('New Organization') }}</h4>
              <p class="card-category"> {{ __('Here you can create organization or database') }}</p>
            </div>
            <div class="card-body">
              <div class="row">
                <form method="POST" id="neworg-form">
                  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="org_name" class="bmd-label-floating">{{ __('Name of Organazation') }}</label>
                        <input type="text" class="form-control" name="org_name" id="org_name" required/>
                      </div> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="root_domain" class="bmd-label-floating">{{ __('Root Domain') }}</label>
                      <input type="text" class="form-control" name="domain" id="root_domain" value="{{ env('DOMAIN', 'informatic.host') }}" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="sub_domain" class="bmd-label-floating">{{ __('New Required Subdomain Name') }}</label>
                        <input type="text" class="form-control" name="subdomain" id="sub_domain" required/>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="super_username" class="bmd-label-floating">{{ __('Super Admin Email address') }}</label>
                        <input type="email" class="form-control" name="super_username" id="super_username" required/>    
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="super_password" class="bmd-label-floating">{{ __('Super Admin Password') }}</label>
                        <input type="password" class="form-control" name="super_password" id="super_password" required/>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="admin_username" class="bmd-label-floating">{{ __('Admin Email address') }}</label>
                        <input type="email" class="form-control" name="admin_username" id="admin_username" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="admin_password" class="bmd-label-floating">{{ __('Admin Password') }}</label>
                        <input type="password" class="form-control" name="admin_password" id="admin_password" required/>
                      </div>
                    </div>    
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="created_by" class="bmd-label-floating">{{ __('Created By') }}</label>
                        <input type="text" class="form-control" name="created_by" id="created_by" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="owner_name" class="bmd-label-floating">{{ __('Owner Name') }}</label>
                        <input type="text" class="form-control" name="owner_name" id="owner_name" required/>
                      </div>
                    </div>    
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="sale_type" class="bmd-label-floating">{{ __('Sale Type') }}</label>
                        <input type="text" class="form-control" name="sale_type" id="sale_type" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email_address" class="bmd-label-floating">{{ __('Email Address') }}</label>
                        <input type="email" class="form-control" name="email_address" id="email_address" required/>
                      </div>
                    </div>    
                  </div>
                  
                  <!--
                  <div class="row">
                    <div class="col-md-12">
                      <div class="radio">
                        <label>
                        <input type="radio" name="create_type" id="cpanel_db" value="cpanel_db" checked >
                          Create Subdomain and Database
                        </label>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="radio">
                        <label>
                          <input type="radio" name="create_type" id="only_db" value="only_db">
                            Create only Database
                        </label>
                      </div>
                    </div>
                  </div>
                  !-->
                  <div class="form-group text-right">
                      <button type="button" class="btn btn-primary create_org">Create Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
    <script src="{{asset('js/custom/new_org.js')}}" type="text/javascript"></script>
  @endpush
@endsection
 