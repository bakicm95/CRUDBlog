@extends('layouts.manage')

@section('content')
  <div class="flex-container">
    <div class="columns m-t-10">
      <div class="column">
        <h1 class="title">View Permission Details</h1>
      </div> <!-- end of column -->
      
      {{-- Edit Permission Button --}}
      <div class="column">
        <a href="{{ route('permissions.edit', $permission->id) }}" class="button is-primary is-pulled-right"><i class="fa fa-edit m-r-10"></i> Edit Permission</a>
      </div>
    </div>

    <hr class="m-t-0">
    
    {{-- Editing form --}}
    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
      {{ csrf_field() }}
      {{ method_field('PUT') }}
      
      {{-- Display name --}}
      <div class="field">
        <label for="display_name" class="label">Name (Display Name)</label>
        <p class="control">
          <input type="text" class="input" name="display_name" id="display_name" value="{{ $permission->display_name }}">
        </p>
      </div>
      
      {{-- Slug --}}
      <div class="field">
        <label for="name" class="label">Slug <small>(Cannot be changed)</small></label>
        <p class="control">
          <input type="text" class="input" name="name" id="name" value="{{ $permission->name }}" disabled>
        </p>
      </div>
      
      {{-- Description --}}
      <div class="field">
        <label for="description" class="label">Description</label>
        <p class="control">
          <input type="text" class="input" name="description" id="description" placeholder="Describe what this permission does" value="{{ $permission->description }}">
        </p>
      </div>

      <button class="button is-primary">Save Changes</button>
    </form>
  </div>
@endsection
