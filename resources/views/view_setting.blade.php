@extends('layouts.app', ['activePage' => 'view-setting', 'titlePage' => __('User Panel View Options')])

@section('content')
  @push('styles')
    <link href="{{asset('css/custom/view_settings.css')}}" type="text/css" rel="stylesheet"/>
  @endpush
  
  <div class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">{{ __('User Panel View Option Settings') }}</h4>
              <p class="card-category"> {{ __('Users only can see checked fields') }}</p>
            </div>
            <div class="card-body">
              <div class="row" >
               
                @foreach ($data as $key=>$item)
                    <div class="col-md-4">
                        <div class="row" style="margin-top:15px; margin-bottom:15px">    
                            <div class="col-md-6" style="font-size: 1.2em; text-align: left;">
                                {{ $captions[$key] }}
                            </div>
                            <div class="col-md-6" style="text-align:left">
                                <input type="checkbox" class="js-switch" name="{{ $key }}" id="{{ $key }}" <?php echo $item ? 'checked' : '';?>>
                            </div>
                        </div> 
                    </div>
                @endforeach
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
    <script src="{{asset('js/custom/view_settings.js')}}" type="text/javascript"></script>
  @endpush
@endsection
