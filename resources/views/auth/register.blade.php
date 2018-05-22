@extends('layouts.app')


@section('content')

<div class="columns">
 <div class="column is-one-third is-offset-one-third m-t-100">
     <div class="card">
         <div class="card-content">
             <h1 class="title">Join The Community</h1>

             <form action="{{ route('register') }}" method="post" role="Register Form">
                {{ csrf_field() }}
                
                <div class="field">
                    <label for="name" class="label">Name</label>
                    <p class="controll">
                        <input type="text" name="name" id="name" class="input {{ $errors->has('name') ? 'is-danger' : '' }}" value="{{ old('name') }}">
                    </p>

                    @if($errors->has('name'))
                    <p class="help is-danger">{{ $errors->first('name') }}</p>
                    @endif

                </div>
                

                <div class="field">
                    <label for="email" class="label">Email adress</label>
                    <p class="controll">
                        <input type="email" name="email" id="email" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" value="{{ old('email') }}">
                    </p>

                    @if($errors->has('email'))
                    <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif

                </div>

                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label for="password" class="label">Password</label>
                            <p class="controll">
                                <input type="password" name="password" id="password" class="input {{ $errors->has('password') ? 'is-danger' : '' }}">
                            </p>

                            @if($errors->has('password'))
                            <p class="help is-danger">{{ $errors->first('password') }}</p>
                            @endif

                        </div>
                    </div>


                    <div class="column">
                        <div class="field">
                            <label for="password_confirmation" class="label">Confirm Password</label>
                            <p class="controll">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="input {{ $errors->has('password_confirmation') ? 'is-danger' : '' }}">
                            </p>

                            @if($errors->has('password_confirmation'))
                            <p class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                            @endif

                        </div>
                    </div>
                </div>

                <button class="button is-primary is-outlined is-fullwidth m-t-30">Register</button>
            </form>

        </div> {{-- end of .card-content --}}
    </div>  {{-- end of .card --}}
    <h5 class="has-text-centered m-t-20"><a href="{{ route('login') }}" class="is-muted">Allready have an Account?</a></h5>
</div>
</div>

@endsection