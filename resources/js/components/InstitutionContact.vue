<template>
    <div>
        <form>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" class="form-control" v-model="number" required>
            </div>
            <div class="for-group">
                <button class="btn btn-primary" @click.prevent="saveContact()" v-if="addContact">Ajouter</button>
                <button class="btn btn-primary" @click.prevent="updateContact()" v-if="!addContact">Mètre à jour</button>
            </div>
        </form>
        <h6 class="mt-5 mb-3">Contacts de l'école</h6>
        <div class="table-responsive">
            <table class="table table-bordered" id="myDataTable">
                <thead>                                
                    <tr>
                        <th>id</th>
                        <th>Numero</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(contact, index) in contacts" :key="index">
                        <td>{{ contact.id }}</td>
                        <td>{{ contact.number }}</td>
                        <td>
                            <button class="btn btn-icon btn-primary" @click.prevent="editContact(contact)">
                                <i class="far fa-edit fa-fw"></i>
                            </button>
                            <button class="btn btn-icon btn-danger" @click.prevent="deleteContact(contact)">
                                <i class="fas fa-trash fa-fw"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'institution-contact',
        props: ['institutionid'],
        mounted() {
            console.log('Component mounted.')
            this.loadContacts();
        },

        data() {
            return {
                number: '',
                contacts: [],
                addContact: true,
                currentId: '',
                key: '',
            }
        },

        methods: {
            loadContacts() {
                 let institutionId = this.institutionid;
                 let _this = this;
                axios.post('/admin/institutions/get-contacts', {
                    id: institutionId,
                }).then( res => {
                    _this.contacts = res.data;
                }).catch( err => {
                    Vue.toasted.error("Une erreur s'est prouite lors de la récupération des contacts");
                });
            },

            saveContact() {
                if (this.number.trim() === '') {
                    Vue.toasted.error("Le numéro de téléphone est obligatoire");
                } else {
                    let institutionId = this.institutionid;
                    let phoneNumber = this.number;
                    let _this = this;
                    axios.post('/admin/institutions/add-contact', {
                        institution_id: institutionId,
                        number: phoneNumber,
                    }).then( res => {
                        _this.contacts.push(res.data);
                        _this.reset();
                        Vue.toasted.success("Contact ajouté avec succès");
                    }).catch( err => {
                        Vue.toasted.error("Une erreur s'est prouite lors de la création du contact");
                    });
                }
            },

            editContact(contact) {
                this.addContact = false;
                this.number = contact.number;
                this.currentId = contact.id;
                this.key = this.contacts.indexOf(contact);
            },

            updateContact(contact) {
                if (this.number === '') {
                    Vue.toasted.error("Le numéro de téléphone est obligatoire");
                } else {
                    let _this = this;
                    axios.post('/admin/institutions/update-contact', {
                        id: _this.currentId,
                        institution_id: _this.institutionid,
                        number: _this.number,
                    }).then( res => {
                        _this.contacts.splice(_this.key, 1, res.data);
                        _this.reset();
                        Vue.toasted.success("Contact modifié avec succès");
                    }).catch( err => {
                        Vue.toasted.error("Une erreur s'est prouite lors de la modification du contact");
                    });
                }
            },

            deleteContact(contact) {
                this.currentId = contact.id;
                let _this = this;
                axios.post('/admin/institutions/delete-contact', {
                    id: _this.currentId,
                }).then( res => {
                    if (res.data.status === 'success') {
                        _this.contacts.splice(_this.contacts.indexOf(contact), 1);
                        _this.reset()
                        Vue.toasted.success("Contact supprimé avec succès");
                    } else{
                        Vue.toasted.error("Une erreur s'est prouite lors de la suppression du contact");
                    }
                }).catch( err => {
                    Vue.toasted.error("Une erreur s'est prouite lors de la suppression du contact");
                });
            },

            reset() {
                this.addContact = true;
                this.number = '';
            }
        }
    }
</script>
