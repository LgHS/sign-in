<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="">
          <div class="panel-heading">
            <button @click="initAddRfidCard()" class="btn btn-xs btn-primary pull-right">
              + Ajouter une carte
            </button>
            Mes cartes RFID
          </div>

          <div class="panel-body">
            <table class="table table-bordered table-striped table-responsive" v-if="rfid_cards.length > 0">
              <tbody>
              <tr>
                <th>
                  UID
                </th>
                <th>
                  Name
                </th>
                <th>
                  Action
                </th>
              </tr>
              <tr v-for="(rfid_card, index) in rfid_cards">
                <td>
                  {{ rfid_card.uid }}
                </td>
                <td>
                  {{ rfid_card.name }}
                </td>
                <td>
                  <button @click="initUpdate(index)" class="btn btn-success btn-xs">Modifier</button>
                  <button @click="deleteRfidCard(index)" class="btn btn-danger btn-xs">Supprimer</button>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="add_rfid_card_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ajouter une carte</h4>
          </div>
          <div class="modal-body">

            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                <li v-for="error in errors">{{ error }}</li>
              </ul>
            </div>

            <div class="form-group">
              <div class="form-group">
                <label for="name">Nom: (optionnel)</label>
                <input name="name" id="name" type="text" class="form-control"
                       placeholder="Badge porte-clé" v-model="rfid_card.name">
              </div>
              <label for="uid">UID:</label>
              <input type="text" name="uid" id="uid" class="form-control"
                     v-model="rfid_card.uid">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="button" @click="createRfidCard" class="btn btn-primary">Créer</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" tabindex="-1" role="dialog" id="update_rfid_card_model">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Fermer"><span
                aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Mettre à jour la carte RFID</h4>
          </div>
          <div class="modal-body">

            <div class="alert alert-danger" v-if="errors.length > 0">
              <ul>
                <li v-for="error in errors">{{ error }}</li>
              </ul>
            </div>

            <div class="form-group">
              <label for="name">Nom:</label>
              <input id="name" class="form-control" v-model="update_rfid_card.name">
            </div>

            <div class="form-group">
              <label>UID:</label>
              <input type="text" placeholder="" class="form-control"
                     v-model="update_rfid_card.uid">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            <button type="button" @click="updateRfidCard" class="btn btn-primary">Modifier</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    data() {
      return {
        rfid_card: {
          name: '',
          uid: ''
        },
        errors: [],
        rfid_cards: [],
        update_rfid_card: {}
      }
    },
    mounted() {
      this.readRfidCards();
    },
    methods: {
      initAddRfidCard() {
        this.errors = [];
        $("#add_rfid_card_model").modal("show");
      },
      createRfidCard() {
        axios.post('/rfid_cards', {
          uid: this.rfid_card.uid,
          name: this.rfid_card.name,
        })
            .then(response => {

              this.reset();

              this.rfid_cards.push(response.data.rfid_card);

              $("#add_rfid_card_model").modal("hide");

            })
            .catch(error => {
              this.errors = [];
              if (error.response.data.errors.uid) {
                this.errors.push(error.response.data.errors.uid[0]);
              }

              if (error.response.data.errors.name) {
                this.errors.push(error.response.data.errors.name[0]);
              }
            });
      },
      reset() {
        this.rfid_card.uid = '';
        this.rfid_card.name = '';
      },

      readRfidCards() {
        axios.get('/rfid_cards')
            .then(response => {
              this.rfid_cards = response.data.rfid_cards;
            });
      },

      initUpdate(index) {
        this.errors = [];
        $("#update_rfid_card_model").modal("show");
        this.update_rfid_card = this.rfid_cards[index];
      },


      updateRfidCard() {
        axios.patch('/rfid_cards/' + this.update_rfid_card.id, {
          uid: this.update_rfid_card.uid,
          name: this.update_rfid_card.name,
        })
            .then(response => {
              $("#update_rfid_card_model").modal("hide");
            })
            .catch(error => {
              this.errors = [];
              if (error.response.data.errors.uid) {
                this.errors.push(error.response.data.errors.uid[0]);
              }

              if (error.response.data.errors.name) {
                this.errors.push(error.response.data.errors.name[0]);
              }
            });
      },

      deleteRfidCard(index) {
        let conf = confirm("Vous voulez vraiment supprimer cette carte ?");
        if (conf === true) {

          axios.delete('/rfid_cards/' + this.rfid_cards[index].id)
              .then(() => {
                this.rfid_cards.splice(index, 1);
              })
              .catch(error => {
                alert('Il y a eu une erreur, la carte n\'a pas été supprimée');
              });
        }
      }
    }
  }
</script>
