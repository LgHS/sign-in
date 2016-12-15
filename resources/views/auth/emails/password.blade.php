@if(isset($register))
    <h2>Bienvenue sur account.lghs.be, {{$user->firstName}} !</h2>
<p>
    Nous t'avons créé un compte qui te permettra de te connecter à nos différents services.
    Tu trouveras plus d'informations sur le wiki :
    <a href="http://wiki.lghs.be/infra:serveurs:service">
        http://wiki.lghs.be/infra:serveurs:service
    </a>
</p>
<p>
    Pour compléter ton inscription, clique sur le lien ci-dessous afin de choisir un mot de passe
    (Attention ce lien expire dans 24 heures) :
</p>
<p>
    <a href="{{ $link = url('password/init', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">
        {{ $link }}
    </a>
</p>
@else
    Cliquez ici pour réinitialiser votre mot de passe:
    <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
@endif
