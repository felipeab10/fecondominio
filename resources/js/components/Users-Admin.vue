<template>
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Gerenciamento de Usuários</h3>

                <div class="card-tools">
                 <!-- Button trigger modal -->
<button type="button" class="btn btn-success" @click="NewModal">Novo <i class="fas fa-user-plus "></i>
</button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Tipo</th>
                    <th>Dt Created</th>
                    <th>Modificar</th>
                  </tr>

                  <tr v-for="user in users" :key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.name | UpText}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.type | UpText}}</td>
                    <td>{{user.created_at | dateDisplay}}</td>
                    <td>
                    <a href="#" @click="editModal(user)">
                    <i class="fa fa-edit"></i>
                    </a>/
                    <a href="#" @click="deleteUser(user.id)">
                   <i class="fas fa-trash-alt red"></i>
                    </a>
                    </td>
                  </tr>
                 
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 v-show="!editmode" class="modal-title" id="eaddNewLabel">Novo Usuário</h5>
        <h5 v-show="editmode" class="modal-title" id="eaddNewLabel">Editar Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form @submit.prevent="editmode ? updateUser() : CreateUser()">
      <div class="modal-body">
    
        <div class="form-group">
        <input placeholder="Nome" v-model="form.name" type="text" name="name"
        class="form-control date" id="phone" :class="{ 'is-invalid': form.errors.has('name') }">
      <has-error :form="form" field="name"></has-error>
        </div>
     

      <div class="form-group">
        <input placeholder="E-mail" v-model="form.email" type="email" name="email"
        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
      <has-error :form="form" field="email"></has-error>
        </div>

        <div class="form-group">
        <input placeholder="Senha" v-model="form.password" type="password" name="password"
        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
      <has-error :form="form" field="password"></has-error>
        </div>

        <div class="form-group">
        <textarea v-model="form.bio" name="bio" placeholder="Breve Comentário" 
      class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }" rows="3"></textarea>
      <has-error :form="form" field="bio"></has-error>
         </div>

        <div class="form-group">
         <select v-model="form.type" name="type" placeholder="Permisssão" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
         <option value="">Permissão de Usuário</option>
         <option value="admin">Admin</option>
          <option value="user">Condômino</option>
          <option value="sindico">Síndico</option>
          <option value="tesoureiro">Tesoureiro</option>
             </select>
             <has-error :form="form" field="type"></has-error>
         </div>
        </div>
     
    
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        <button v-show="!editmode"  type="submit" class="btn btn-success">Salvar</button>
        <button v-show="editmode" type="submit" class="btn btn-primary">Editar</button>
      </div>
      </form>
    </div>
  </div>
</div>
    </div>
    
</template>
<script>
    export default {
         data () {
    return {
      editmode: false,
      users: {},
      // Create a new form instance
      form: new Form({
        id: '',
        name: '',
        email: '',
        password: '',
        type: '',
        bio: '',
        photo: '',
        remember: false
      })
    }
  },
  
  methods:{
    updateUser(){
        this.$Progress.start()
        this.form.put('api/user/'+this.form.id)
        
        .then(( ) => {
          //success
         
          swal(
          'Registro Atualizado!',
            'Com Sucesso.'
             )

          this.form.reset();
           $('#addNew').modal('hide')
           Fire.$emit('AfterCreate');
           this.$Progress.finish()
        })
        .catch(( )=> {

        });
    },
    editModal(user){
     
      this.editmode = true;
      this.form.reset();
      $('#addNew').modal('show');
      this.form.fill(user);
      
    },
       NewModal(){
         
         this.editmode = false;
      this.form.reset();
      $('#addNew').modal('show');
      
    },

    deleteUser(id){
                swal({
                    title: 'Tem Certeza?',
                    text: "Você perderá esse usuário!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, Deletar!'
                    }).then((result) => {
                       this.$Progress.start()
                        // Send request to the server
                         if (result.value) {
                                this.form.delete('api/user/'+id).then(()=>{
                                  
                                        swal(
                                        'Usuário Deletado!',
                                        'Item Deletado.',
                                        'Com Sucesso!'
                                        )
                                         this.$Progress.finish()
                                    Fire.$emit('AfterCreate');
                                }).catch(()=> {
                                    swal("Failed!", "Tem alguma coisa errada.", "warning");
                                });
                         }
                    })
            },
    loadUsers(){
      axios.get("api/user").then(({ data })=>(this.users = data.data));
    },
      CreateUser(){
          this.$Progress.start()
         this.form.post('api/user')
       
          .then(()=>{
         Fire.$emit('AfterCreate')
         $('#addNew').modal('hide')
         
         toast({
                        type: 'success',
                        title: 'Usuário Criado com Sucesso!!'
              })
              this.$Progress.finish()
          })
          .catch(()=>{
                })
      }
  },
        created() {
            this.loadUsers();
            Fire.$on('AfterCreate',() => {
              this.loadUsers();
            }); 
        },
        
    }
</script>
