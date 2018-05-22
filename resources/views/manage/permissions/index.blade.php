@extends('layouts.manage')

@section('content')
  <div class="flex-container">
    <div class="columns m-t-10">
      <div class="column">
        <h1 class="title">Manage Permissions</h1>
      </div>
      {{-- Check for user's roles --}}
      @foreach(auth()->user()->roles as $role)
        @if($role['role_level'] == 90)
          <div class="column">
            <a href="{{ route('permissions.create') }}" class="button is-primary is-pulled-right"><i class="fa fa-user-plus m-r-10"></i> Create New Permission</a>
          </div>
        @endif
      @endforeach
    </div> {{-- end of .columns --}}

    <hr class="m-t-0">

    <div class="card">
      <div class="field m-l-10 p-t-10">
        {{-- Errors page included --}}
        @include('layouts.errors')
      </div>

      {{-- Permissions table --}}
      <div class="card-content">
        <table class="table is-narrow" style="width: 100%;">
          <thead>
            <tr>
              <th>Name</th>
              <th>Slug</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            @foreach ($permissions as $permission)
              <tr>
                <th>{{ $permission->display_name }}</th>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->description }}</td>
                <td class="has-text-right"><a class="button is-outlined is-small m-r-5" href="{{ route('permissions.show', $permission->id) }}">View</a><a class="button is-outlined is-small" href="{{ route('permissions.edit', $permission->id) }}">Edit</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div> {{-- end of .card content --}}
    </div> {{-- end of .card --}}
  </div>
@endsection
