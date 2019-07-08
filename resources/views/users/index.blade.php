@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

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
                <h4 class="card-title ">{{ __('Users') }}</h4>
                <p class="card-category"> {{ __('Here you can manage users') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                  </div>
                </div>
                <div class="table-responsive" style="padding:30px">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Name') }}
                      </th>
                      <th>
                        {{ __('Email') }}
                      </th>
                      <th>
                        {{ __('Creation date') }}
                      </th>
                      <th>
                        {{ __('Status') }}
                      </th>
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                        <tr>
                          <td>
                            {{ $user->name }}
                          </td>
                          <td>
                            {{ $user->email }}
                          </td>
                          <td>
                            {{ $user->created_at->format('Y-m-d') }}
                          </td>
                          <td>
                            {{ $user->status == '1'? 'Active': 'Blocked'}}
                          </td>
                          <td class="td-actions text-right">
                            @if ($user->id != auth()->id())
                              <form action="{{ route('user.destroy', $user) }}" method="post">
                                  @csrf
                                  @method('delete')

                                  @if($user->status == 0)
                                  <a rel="tooltip" id="{{ $user->id }}" class="btn btn-danger btn-link" data-original-title="" title="Unblock User" onclick="changeStatus({{$user->id}}, {{$user->status}})">
                                      <i class="material-icons">block</i>
                                      <div class="ripple-container"></div>
                                  </a>
                                  @else
                                  <a rel="tooltip" id="{{ $user->id }}" class="btn btn-success btn-link" data-original-title="" title="Block User" onclick="changeStatus({{$user->id}}, {{$user->status}})">
                                      <i class="material-icons">check_circle</i>
                                      <div class="ripple-container"></div>
                                  </a>
                                  @endif
                              
                                  <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('user.edit', $user) }}" data-original-title="" title="Edit User">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                  </a>

                                  <input type="hidden" id="updatestatus" name="updatestatus" value="{{ route('update_status')}}" />
                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="Delete User" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                      <i class="material-icons">close</i>
                                      <div class="ripple-container"></div>
                                  </button>
                              </form>
                            @else
                              <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('profile.edit') }}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
<script>
  var _token = $('meta[name="csrf-token"]').attr('content');
  var _url = $('#updatestatus').val();

  function changeStatus(id,status){
      var msg = (status == 0) ?"Are you sure you want to Unblock this user?": "Are you sure you want to Block this user?";
      
      if(confirm(msg)){
          $.post(_url, 
          {
            id: id,
            status: status,
            _token:_token
          })
          .done(function (data) {

            if(data.result = true){
              toastr.success('Account status changed', 'Success');

              setTimeout(function(){
                location.reload();
              }, 1500);
              
            }
           
          });
      }
  }
</script>
@endpush
@endsection