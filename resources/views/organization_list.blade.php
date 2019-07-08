@extends('layouts.app', ['activePage' => 'organization-list', 'titlePage' => __('List of all Organizations')])

@section('content')
    @push('styles')
      <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" rel="stylesheet"/>
      <link href="{{asset('css/custom/org_lists.css')}}" type="text/css" rel="stylesheet"/>
    @endpush
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">{{ __('Organization List') }}</h4>
              <p class="card-category"> {{ __('List of All registered organizations') }}</p>
            </div>
            <div class="card-body">
                <table id="org_lists_table" class="table table-striped table-bordered" style="width:100%">
                @if (Auth::user()->role == 2)
                    <thead>
                        <tr>
                            <th width="20">No</th>
                            <th>Name</th>
                            <th>Domain</th>
                            <th>Subdomain</td>
                            <th>Super User</th>
                            <th>Super Pass</th>
                            <th>Admin User</th>
                            <th>Admin Pass</th>
                            <th>Database Name</th>
                            <th>DB User</th>
                            <th>DB Pass</th>
                            <th>Created By</th>
                            <th>Owner Name</th>
                            <th>Sale type</th>
                            <th>Email</th>
                            <th>Creation Date</th>
                            @if (Auth::user()->role == 2)
                            <th style="width: 80px !important;">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    <?php $index = 0 ;?>
                    @foreach($Organizations as $org_list)
                        <?php $index++ ;?>
                        <tr>
                            <td class="text-center">{{$index}}</td>
                            <td><a href="http://{{$org_list['subdomain']}}">{{$org_list['org_name']}}</a></td>
                            <td>{{$org_list['domain']}}</td>
                            <td>{{$org_list['subdomain']}}</td>
                            <td>{{$org_list['super_user']}}</td>
                            <td>{{$org_list['super_password']}}</td>
                            <td>{{$org_list['admin_user']}}</td>
                            <td>{{$org_list['admin_password']}}</td>
                            <td>{{$org_list['db_name']}}</td>
                            <td>{{$org_list['db_user']}}</td>
                            <td>{{$org_list['db_password']}}</td>
                            <td>{{$org_list['created_by']}}</td>
                            <td>{{$org_list['owner_name']}}</td>
                            <td>{{$org_list['sale_type']}}</td>
                            <td>{{$org_list['email']}}</td>
                            <td>{{$org_list['created_at']}}</td>
                            @if (Auth::user()->role == 2)
                            <td class="text-center" style="width: 180px;">
                                <div class="btn-group">
                                    <input type="hidden" value="{{$org_list['subdomain']}}" name="domain"/>
                                    <button class="btn btn-primary btn-sm btn-badge{{$org_list['status'] == 1 ? ' permission-active' : ''}}" permission="1">UNBLOCK</button>
                                    <button class="btn btn-warning btn-sm btn-badge{{$org_list['status'] == 0 ? ' permission-active' : ''}}" permission="0">BLOCK</button>
                                    <button button="button" class="btn btn-danger btn-sm btn-badge" permission="-1">DELETE</button>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Domain</th>
                            <th>Subdomain</th>
                            <th>Super User</th>
                            <th>Super Pass</th>
                            <th>Admin User</th>
                            <th>Admin Pass</th>
                            <th>Database Name</th>
                            <th>DB User</th>
                            <th>DB Pass</th>
                            <th>Created By</th>
                            <th>Owner Name</th>
                            <th>Sale type</th>
                            <th>Email</th>
                            <th>Creation Date</th>
                            @if (Auth::user()->role == 2)
                            <th style="width: 80px">Actions</th>
                            @endif
                        </tr>
                    </tfoot> --}}
                @else
                    <thead>
                        <tr>
                            <th width="20">No</th>
                            @if ($Column['org_name'])                            
                            <th>Name</th>
                            @endif
                            @if ($Column['domain'])
                            <th>Domain</th>
                            @endif 
                            @if ($Column['subdomain'])
                            <th>Subdomain</td>
                            @endif 
                            @if ($Column['super_user'])
                            <th>Super User</th>
                            @endif 
                            @if ($Column['super_password'])
                            <th>Super Pass</th>
                            @endif 
                            @if ($Column['super_user'])
                            <th>Admin User</th>
                            @endif 
                            @if ($Column['admin_password'])
                            <th>Admin Pass</th>
                            @endif
                            @if ($Column['db_name'])
                            <th>Database</th>
                            @endif 
                            @if ($Column['db_user'])
                            <th>DB User</th>
                            @endif 
                            @if ($Column['db_password'])
                            <th>DB Pass</th>
                            @endif
                            @if ($Column['created_by'])
                            <th>DB Pass</th>
                            @endif
                            @if ($Column['owner_name'])
                            <th>DB Pass</th>
                            @endif
                            @if ($Column['sale_type'])
                            <th>DB Pass</th>
                            @endif
                            @if ($Column['email'])
                            <th>DB Pass</th>
                            @endif
                            @if ($Column['created_at'])
                            <th>Created Date</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    <?php $index = 0 ;?>
                    @foreach($Organizations as $org_list)
                        <?php $index++ ;?>
                        <tr>
                            <td class="text-center">{{$index}}</td>
                            @if ($Column['org_name'])
                            <td>{{$org_list['org_name']}}</td>
                            @endif
                            @if ($Column['domain'])
                            <td>{{$org_list['domain']}}</td>
                            @endif
                            @if ($Column['subdomain'])
                            <td>{{$org_list['subdomain']}}</td>
                            @endif
                            @if ($Column['super_user'])
                            <td>{{$org_list['super_user']}}</td>
                            @endif
                            @if ($Column['super_password'])
                            <td>{{$org_list['super_password']}}</td>
                            @endif
                            @if ($Column['admin_user'])
                            <td>{{$org_list['admin_user']}}</td>
                            @endif
                            @if ($Column['admin_password'])
                            <td>{{$org_list['admin_password']}}</td>
                            @endif
                            @if ($Column['db_name'])
                            <td>{{$org_list['db_name']}}</td>
                            @endif
                            @if ($Column['db_user'])
                            <td>{{$org_list['db_user']}}</td>
                            @endif
                            @if ($Column['db_password'])
                            <td>{{$org_list['db_password']}}</td>
                            @endif
                            @if ($Column['created_by'])
                            <td>{{$org_list['created_by']}}</td>
                            @endif
                            @if ($Column['owner_name'])
                            <td>{{$org_list['ownere_name']}}</td>
                            @endif
                            @if ($Column['sale_type'])
                            <td>{{$org_list['sale_type']}}</td>
                            @endif
                            @if ($Column['email'])
                            <td>{{$org_list['email']}}</td>
                            @endif
                            @if ($Column['created_at'])
                            <td>{{$org_list['created_at']}}</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                    <!-- 
                    <tfoot>
                        <tr>
                            <th width="20">No</th>
                            @if ($Column['org_name'])                            
                            <th>Name</th>
                            @endif
                            @if ($Column['domain'])
                            <th>Domain</th>
                            @endif 
                            @if ($Column['subdomain'])
                            <th>Subdomain</td>
                            @endif 
                            @if ($Column['super_user'])
                            <th>Super User</th>
                            @endif 
                            @if ($Column['super_password'])
                            <th>Super Pass</th>
                            @endif 
                            @if ($Column['admin_user'])
                            <th>Admin User</th>
                            @endif 
                            @if ($Column['admin_password'])
                            <th>Admin Pass</th>
                            @endif
                            @if ($Column['db_name'])
                            <th>Database</th>
                            @endif 
                            @if ($Column['db_user'])
                            <th>DB User</th>
                            @endif 
                            @if ($Column['db_password'])
                            <th>DB Pass</th>
                            @endif
                            @if ($Column['created_at'])
                            <th>Created Date</th>
                            @endif
                        </tr>
                    </tfoot>
                     !-->
                @endif
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('styles')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
  @endpush
  @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
    <script src="{{asset('js/custom/org_lists.js')}}" type="text/javascript"></script>
  @endpush

@endsection