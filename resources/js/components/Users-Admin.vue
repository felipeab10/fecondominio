<template>
    <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Gerenciamento de Usuários</h3>

                <div class="card-tools">
                 <!-- Button trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addNew">
  Novo <i class="fas fa-user-plus "></i>
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
                    <th>Modificar</th>
                  </tr>
                  <tr>
                    <td>183</td>
                    <td>John Doe</td>
                    <td>11-7-2014</td>
                    <td><span class="tag tag-success">Approved</span></td>
                    <td>
                    <a href="#">
                    <i class="fa fa-edit"></i>
                    </a>/
                    <a href="#">
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
        <h5 class="modal-title" id="eaddNewLabel">Novo Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
        <div class="form-group">
        <input placeholder="Nome" v-model="form.name" type="text" name="name"
        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
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
         <select v-model="form.type" name="type" placeholder="Permisssão" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }"">
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
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Criar</button>
      </div>
    </div>
  </div>
</div>

    </div>

    
</template>

<script>
    export default {
         data () {
    return {
      // Create a new form instance
      form: new Form({
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

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
