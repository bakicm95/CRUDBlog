@extends('layouts.manage')

@section('content')
  <div class="flex-container">
    <div class="columns m-t-10">
      <div class="column">
        <h1 class="title">View Permission Details</h1>
      </div> <!-- end of column -->
      
      {{-- Check for user's roles --}}
      @foreach(auth()->user()->roles as $role) 
        @if($role['role_level'] == 90) {{-- Check if user is superadministrator  --}}
          <div class="columns m-t-5 m-r-10">

            {{-- Edit Btn  --}}
            <div class="column">
              <a href="{{ route('permissions.edit', $permission->id) }}" class="button is-primary is-pulled-right"><i class="fa fa-edit m-r-10"></i> Edit Permission</a>
            </div>

            {{-- Delete Btn --}}
            <div class="column">
              <form action="{{ route('destroy_permission', $permission->id) }}" method="post">
                {{ csrf_field() }}
                <button class="button is-danger is-pulled-right"></i>Delete Permission</button>
              </form>
            </div>
          </div> {{-- end of .columns --}}
        @endif
      @endforeach
    </div>

    <hr class="m-t-0" style="background-color: silver; height: 0.5px;">

    <div class="columns">
      <div class="column">
        <div class="box">
          <article class="media">
            <div class="media-content">
              <div class="content">
                <p>
                  <strong>{{ $permission->display_name }}</strong> <small>{{ $permission->name }}</small>
                  <br>
                  {{ $permission->description }}
                </p>
              </div>
            </div>
          </article>
        </div> {{-- end of .box --}}
      </div>
    </div> {{-- end of .columns --}}
  </div>
@endsection
