require('./bootstrap');

Vue.component(
  'passport-clients',
  require('./components/passport/Clients.vue')
);

Vue.component(
  'passport-authorized-clients',
  require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
  'passport-personal-access-tokens',
  require('./components/passport/PersonalAccessTokens.vue')
);


$('[confirm]').on('click', function(e) {
  var message = $(this).attr('confirm');
  if(!message) {
    message = 'Certo cabron ?';
  }

  if(!confirm(message)) {
    e.preventDefault();
    return false;
  }
});

const app = new Vue({
  el: '#app'
});