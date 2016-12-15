{!! BootForm::open(['model' => $member ?: null, 'store' => 'members.store', 'update' => 'members.update']) !!}

{!! BootForm::text('username', 'Nom d\'utilisateur', null) !!}
{!! BootForm::email('email', 'Adresse e-mail', null) !!}
<div class="row">
    <div class="col-sm-6">
        {!! BootForm::text('firstName', 'Prénom') !!}
    </div>
    <div class="col-sm-6">
        {!! BootForm::text('lastName', 'Nom') !!}
    </div>
</div>
{!! BootForm::radios('gender', 'Sexe', ['Homme', 'Femme'], null, true) !!}
{!! BootForm::text('date_of_birth', 'Date de naissance', null, ['help_text' => 'dd/mm/YYYY']) !!}
{!! BootForm::text('address', 'Adresse') !!}
<div class="row">
    <div class="col-sm-4">
        {!! BootForm::text('postcode', 'Code postal') !!}
    </div>
    <div class="col-sm-8">
        {!! BootForm::text('city', 'Ville') !!}
    </div>
</div>
{!! BootForm::text('country', 'Pays', $member ? null : 'Belgium') !!}
{!! BootForm::text('phone', 'Numéro de téléphone') !!}
{!! BootForm::text('member_since', 'Date d\'adhésion', $member ? null : Carbon\Carbon::today()->format('d/m/Y')) !!}
{!! BootForm::radios('roles[]', 'Statut',  [
    '1' => 'Administrateur',
    '2' => 'Membre actif',
    '3' => 'Membre effectif',
    '5' => 'Membre d\'honneur',
    '4' => 'Ancien membre',
], $member ? $member->roles[0]->id : 'member_active', true) !!}
{!! BootForm::checkbox('is_public', 'Profil public', '1', $member ? null : false) !!}
{!! BootForm::checkbox('is_active', 'Compte actif', '1', $member ? null : true) !!}

{!! BootForm::submit($action_label) !!}

{!! BootForm::close() !!}