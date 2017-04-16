
<form role="form" method="POST" action="{{ url('/password/reset') }}">
    {{ csrf_field() }}

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="hide">Adresse e-mail</label>

        <input id="email" type="email" class="form-control" name="email"
               value="{{ $email or old('email') }}" placeholder="Adresse e-mail">

        @if ($errors->has('email'))
            <span class="help-block">
                    {{ $errors->first('email') }}
                </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="hide">Mot de passe</label>
        <input id="password" type="password" class="form-control" name="password" placeholder="Mot de passe">

        @if ($errors->has('password'))
            <span class="help-block">
                    {{ $errors->first('password') }}
                </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password-confirm" class="hide">Confirmez le mot de passe</label>
        <input id="password-confirm" type="password" class="form-control"
               name="password_confirmation" placeholder="Confirmez le mot de passe">

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                {{ $errors->first('password_confirmation') }}
            </span>
        @else
            <span class="help-block">
                {{ trans('validation.secure') }}
            </span>
        @endif
    </div>

    <div class="form-submit">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-{{$submit['icon']}}"></i>
            {{$submit['label']}}
        </button>
    </div>
</form>