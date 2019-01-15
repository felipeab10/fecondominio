<template>
    <div class="container">
        <div class="row">
            
                <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                   <img class="profile-user-img img-fluid img-circle " 
                   :src="getProfilePhoto()" alt="User profile picture">
                     </div>

                 <h3 class="profile-username text-center" >{{getName()}}</h3>

                <p class="text-muted text-center">{{getPermission()}}</p>

                

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sobre mim</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-briefcase"></i> Experiência Profissional</strong>

                <p class="text-muted">
                  {{getExp_prof()}}
                </p>

                <hr>

                <strong><i class="fa fa-book mr-1"></i>Lembretes</strong>

                <p class="text-muted">{{getBio()}}</p>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
  
            </div>
            <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
              
                  <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Configurações</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                 

                  <div class="tab-pane active show" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nome</label>

                        <div class="col-sm-10">
                          <input type="text" v-model="form.name" class="form-control"
                          :class="{ 'is-invalid': form.errors.has('nome') }" id="inputName" placeholder="Nome">
                        <has-error :form="form" field="nome"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" v-model="form.email" class="form-control" 
                          :class="{ 'is-invalid': form.errors.has('email') }" id="email" placeholder="Email">
                        <has-error :form="form" field="email"></has-error>
                        </div>
                        </div>
                      <div class="form-group">
                        <label for="inputName2"  class="col-sm-2 control-label">Senha</label>

                        <div class="col-sm-10">
                          <input type="password" v-model="form.password" class="form-control"
                          :class="{ 'is-invalid': form.errors.has('password') }" id="password" placeholder="Password - Deixe em branco se não for alterar">
                         <has-error :form="form" field="password"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Profissional</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" v-model="form.exp_prof" id="inputExperience" placeholder="Cursos,Empregos"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Lembretes</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" v-model="form.bio" id="inputExperience" placeholder="Lembretes"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputSkills" class="col-sm-2 control-label">Foto</label>

                        <div class="col-sm-10">
                          <div class="input-group">
                      <div class="custom-file">
                        <input type="file" @change="updateProfile" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Selecione Uma Foto</label>
                      </div>
                      
                    </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button @click.prevent="updateInfo" type="submit" class="btn btn-danger">Atualizar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
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
        exp_prof: '',
        remember: false
      })
    }
  },
    methods:{
        getBio(){
             return this.form.bio;
        },
        getExp_prof(){
            return this.form.exp_prof;
        },

        getPermission(){
            return this.form.type;

        },
        getName(){
            return this.form.name;
        },


        getProfilePhoto(){
                return "img/profile/"+this.form.photo;
        },
        updateInfo(){
            this.$Progress.start()
            if(this.form.password == ''){
                    this.form.password = undefined;
                }
           this.form.put('api/profile/')
           .then(()=>{
                 swal(
          'Registro Atualizado!',
            'Com Sucesso.'
             )
             
               this.$Progress.finish()
           })
           .catch(()=>{
               this.$Progress.fail()
           });

        },
        updateProfile(e){
           let file = e.target.files[0];
           
           let reader = new FileReader();

          if(file['size'] < 2111775){
                reader.onloadend = (file)=>{
               this.form.photo = reader.result;
           }
                   
            reader.readAsDataURL(file);
        }else{
            swal({
                type:'error',
                title:'Oops....',
                text:'Sua foto Excede o limite permitido de 2mb',
            })
        }
        }

    },
        created() {
           axios.get("api/profile")
           .then(({ data })=>(this.form.fill(data)));
                    
        },
    }
</script>
