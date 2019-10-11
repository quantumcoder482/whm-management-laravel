@extends('layouts.app', ['activePage' => 'expired-list', 'titlePage' => __('List of all Expired Sub Domains')])

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
              <h4 class="card-title ">{{ __('Expired SubDomain List') }}</h4>
              <p class="card-category"> {{ __('List of All expired SubDomains') }}</p>
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
                            <th>Expired Date</th>
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
                            <td>{{$expired_dates[$org_list['id']]}}</td>
                            @if (Auth::user()->role == 2)
                            <td class="text-center" style="width: 180px;">
                                <div class="btn-group">
                                    <input type="hidden" value="{{$org_list['subdomain']}}" name="domain" id="domain"/>
                                    <button class="btn btn-primary btn-sm btn-badge{{$org_list['status'] == 1 ? ' permission-active' : ''}} action_button" permission="1" onclick="changeStatus(1, '{{$org_list['subdomain']}}');">UNBLOCK</button>
                                    <button class="btn btn-warning btn-sm btn-badge{{$org_list['status'] == 0 ? ' permission-active' : ''}} action_button" permission="0" onclick="changeStatus(0, '{{$org_list['subdomain']}}');">BLOCK</button>
                                    <button button="button" class="btn btn-success btn-sm btn-badge action_button" onclick="changeLimited( {{$org_list['id']}} );">UnLimited</button>
                                    <button button="button" class="btn btn-danger btn-sm btn-badge action_button" permission="-1" onclick="changeStatus(-1, '{{$org_list['subdomain']}}');">DELETE</button>
                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                @endif
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('styles')
    {{-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/> --}}
    <link href="https://nightly.datatables.net/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
  @endpush
  @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
    <script src="{{asset('js/custom/expired_list.js')}}" type="text/javascript"></script>
  @endpush

@endsection