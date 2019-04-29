@extends('layouts.app',['title'=>'Modification du profil de l\'agence. '])
@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Modification du Profile') }}</div>
                    <div class="card-body">
                        <form action=" {{ url('/AgenceProfile_update') }}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" value="{{auth()->guard('agence')->user()->name}}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    <input type="email" name="email" value="{{auth()->guard('agence')->user()->email}}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                <div class="col-md-6">
                                    <input type="description" name="description" value="{{auth()->guard('agence')->user()->description}}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="wilaya" class="col-md-4 col-form-label text-md-right">{{ __('Wilaya') }}</label>
                                <div class="col-md-6">
                                    <input type="wilaya" name="wilaya" placeholder="Wilaya" value="{{auth()->guard('agence')->user()->wilaya}}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="adresse" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>
                                <div class="col-md-6">
                                    <input type="adresse" name="adresse" value="{{auth()->guard('agence')->user()->adresse}}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="web_site" class="col-md-4 col-form-label text-md-right">{{ __('Web Site') }}</label>
                                <div class="col-md-6">
                                    <input type="web_site" name="web_site" value="{{auth()->guard('agence')->user()->web_site}}" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
                                    <img src="/avatar_agence/{{auth()->guard('agence')->user()->avatar}}" alt="" width="80" height="80"/>

                                    <input type="file" name="avatar" />
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="background_img" class="col-md-4 col-form-label text-md-right">{{ __('Background') }}</label>
                                    <img src="/background_agence/{{auth()->guard('agence')->user()->background_img}}" alt="" width="120" height="50"/>

                                    <input type="file" name="background_img" />
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input type="password" name="password" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Password confirmation') }}</label>
                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation" />
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">
                                {{ __('Modifier le profile') }}
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
