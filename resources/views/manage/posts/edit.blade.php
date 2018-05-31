@extends('layouts.manage')


  @if(auth()->user()->can(['create-post']))
    @section('content')
      <div class="flex-container">
        <div class="columns m-t-10 m-b-0">
          <div class="column">
            <h1 class="title is-admin is-4">Edit Post</h1>
          </div>
        </div>

       <hr style="background-color: silver; height: 0.5px;">
       {{-- Errors page included --}}
       @include('layouts.errors')
        
        {{-- Post editing form --}}
        <form action="{{route('posts.update', $post->id)}}" method="post">
          {{method_field('PUT')}}
          {{ csrf_field() }}

          <div class="columns">
            {{-- Post Title --}}
            <div class="column is-three-quarters-desktop is-three-quarters-tablet">
              <b-field>
                <b-input type="text" name="title" placeholder="Post Title" size="is-large" v-model="title">
                </b-input>
              </b-field>
              
              {{-- Slug --}}
              <slug-widget url="{{url('/')}}" subdirectory="blog" :title="title" @copied="slugCopied" @slug-changed="updateSlug"></slug-widget>
              <input type="hidden" v-model="slug" name="slug" />
              
              {{-- Post Content --}}
              <b-field class="m-t-40">
                <b-input type="textarea" name="content" value="{{ $post->content }}"
                    placeholder="Compose your masterpiece..." rows="20">
                </b-input>
              </b-field>
            </div> <!-- end of .column.is-three-quarters -->
        
           

            <div class="column is-one-quarter-desktop is-narrow-tablet">
              <div class="card card-widget">
                <div class="author-widget widget-area">
                  <div class="selected-author">
                    <img src="https://placehold.it/50x50"/>
                    <div class="author">
                      <h4>{{ auth()->user()->name }}</h4>
                      <p class="subtitle">
                        ({{ auth()->user()->email }})
                      </p>
                    </div>
                  </div> 
                </div>{{-- end of .author-widget --}}

                <div class="post-status-widget widget-area">
                  <div class="status">
                    <div class="status-icon">
                       <b-icon icon="account" size="is-small">
                </b-icon>
                    </div>
                    <div class="status-details">
                      <h4><span class="status-emphasis">Draft</span> Saved</h4>
                      <p>A Few Minutes Ago</p>
                    </div>
                  </div>
                </div> {{-- end of .post-status-widget --}}

                <div class="publish-buttons-widget widget-area">
                  <div class="primary-action-button">
                    <button class="button is-primary is-fullwidth">Publish</button>
                  </div>
                </div> {{-- end of .publush-buttons --}}

              </div>
            </div> {{-- end of .column.is-one-quarter --}}
          </div> {{-- end of .columns --}}
        </form>
      </div> <!-- end of .flex-container -->
    @endsection
  @endif



{{-- Scripts section --}}
@section('scripts')
  <script>
    var app = new Vue({
      el: '#app',
      data: {
        title: '{{ $post->title }}',
        slug: '{{ $post->slug }}',
        api_token: '{{Auth::user()->api_token}}'
      },
      methods: {
        updateSlug: function(val) {
          this.slug = val;
        },
        slugCopied: function(type, msg, val) {
          notifications.toast(msg, {type: `is-${type}`});
        }
      }
    });
  </script>
@endsection
