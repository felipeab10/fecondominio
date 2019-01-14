<template>
    <div class="container">
        <div class="row">
            
                <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                   
                  <img class="profile-user-img img-fluid img-circle" src="#" alt="User profile picture">
                </div>

                 <h3 class="profile-username text-center"></h3>

                <p class="text-muted text-center">Software Engineer</p>

                

                
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
                <strong><i class="fa fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fa fa-pencil mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
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
                          <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="Nome">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName2" class="col-sm-2 control-label">Senha</label>

                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="inputName2" placeholder="Password - Deixe em branco se não for alterar">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" v-model="form.bio" id="inputExperience" placeholder="Experience"></textarea>
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
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
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
        remember: false
      })
    }
  },
    methods:{
        updateInfo(){
            this.$Progress.start()
           this.form.put('api/profile/')
           .then(()=>{

               this.$Progress.finish()
           })
           .catch(()=>{
               this.$Progress.fail()
           });

        },
        updateProfile(e){
           let file = e.target.files[0];
           console.log(file);
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
