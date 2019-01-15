<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Gerenciamento de Condomínios</h3>

                <div class="card-tools">
                 <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#Condominio">Novo <i class="fas fa-building"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Inaugurado</th>
                    <th>Status</th>
                    <th>Modificar</th>
                  </tr>

                  <tr v-for="condo in condos" key="condo.cd_adm_condo">
                   <td >{{condo.cd_adm_condo}}</td>
                    <td>{{condo.nome}}</td>
                    <td>{{condo.cnpj}}</td>
                    <td>{{condo.dt_inauguracao |dateDisplay }}</td>
                    <td>{{condo.status}}</td>
                     <td>
                      <a href="#" @click="views()"><i class="fas fa-eye"></i></a>/
                     <a href="#"><i class="fa fa-edit"></i></a>/
                     <a href="#" ><i class="fas fa-trash-alt red"></i></a>
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
<div class="modal fade" id="Condominio" tabindex="-1" role="dialog" aria-labelledby="CondominioCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CondominioCenterTitle">Adicionar Condomínio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    
       <form @submit.prevent="CriarCondominio">
    
       <div class="modal-body">
       <div class="container-fluid">
    
      <div class="row">
     <div class="col-md-8"> 
      <div class="form-group form-control-sm">
         <input v-model="form.nome" type="text" class="form-control" placeholder="Nome do Condomínio" 
         :class="{ 'is-invalid': form.errors.has('nome') }">
         <has-error :form="form" field="nome"></has-error>
        </div>  
       </div>
       
     </div>

    <div class="row">
     <div class="col-md-4"> 
      <div class="form-group form-control-sm">
         <input v-model="form.cnpj" type="text" class="form-control" placeholder="CNPJ"
         :class="{ 'is-invalid': form.errors.has('cnpj') }">
      <has-error :form="form" field="cnpj"></has-error>
         </div>  
       </div>
<div class="row">
</div>


     </div>

    <div class="row">
     <div class="col-md-6"> 
      <div class="form-group form-control-sm">
         <input v-model="form.email" type="email" class="form-control" placeholder="E-mail" id="recipient-name">
         </div>  
       </div>
       </div>


     <div class="row">
     <div class="col-md-4"> 
      <div class="form-group form-control-sm">
         <input v-model="form.cep" type="text" class="form-control" placeholder="CEP" id="recipient-name">
         </div>  
       </div>
     </div>

        <div class="row">
     <div class="col-md-6"> 
      <div class="form-group form-control-sm">
         <input v-model="form.endereco" type="text" class="form-control" placeholder="Endereço" id="recipient-name">
         </div>  
       </div>

       <div class="col-md-2">
       <div class="form-group form-control-sm">
         <input v-model="form.numero" type="text" class="form-control" placeholder="Número" id="recipient-name">
         </div> 
          </div>
     </div>

    

      <div class="row">
     <div class="col-md-6"> 
      <div class="form-group form-control-sm">
         <input v-model="form.bairro" type="text" class="form-control" placeholder="Bairro" id="recipient-name">
         </div>  
       </div>

        <div class="col-md-6"> 
      <div class="form-group form-control-sm">
         <input v-model="form.complemento" type="text" class="form-control" placeholder="Complemento" id="recipient-name">
         </div>  
       </div>

     </div>

      <div class="row">
     <div class="col-md-6"> 
      <div class="form-group form-control-sm">
         <input v-model="form.cidade" type="text" class="form-control" placeholder="Cidade" id="recipient-name">
         </div>  
       </div>

        <div class="col-md-6"> 
      <div class="form-group form-control-sm">
         <input v-model="form.estado" type="text" class="form-control" placeholder="Estado" id="recipient-name">
         </div>  
       </div>
     </div>

        <div class="row">
        <div class="col-md-4"> 
        <div class="form-group form-control-sm ">
               <select v-model="form.status" class="form-control" placeholder="Status" id="exampleFormControlSelect1">
               <option value="">Status</option>
               <option value="Ativo">Ativo</option>
               <option value="Desativado">Desativado</option>
          </select>
          </div>
          </div>
  </div>

              


        </div>
      </div>
    
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-success">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>

    </div>
</template>

<script>
    export default {
        data(){
            return{
                condos: {},
                 // Create a new form instance
             form: new Form({
                cd_adm_condo: '',
                 nome: '',
                 cnpj: '',
                 dt_inauguracao: '',
                 cep: '',
                 endereco: '',
                 numero: '',
                 bairro: '',
                 complemento: '',
                 cidade: '',
                 estado: '',
                 status: '',
                 email: '',
                 remember:false
              })    
            }
        },
        methods:{
          views(){
            this.form.get('api/adm-condominio/'+this.form.cd_adm_condo)
          },
            loadCondos(){
      axios.get("api/adm-condominio").then(({ data })=>(this.condos = data.data));
    },
            CriarCondominio(){
                this.$Progress.start()
                this.form.post('api/adm-condominio')
               .then(()=>{
                Fire.$emit('PosCriado');
                $('#Condominio').modal('hide');
                toast({
                    type: 'success',
                    title: 'Adicionado com Sucesso!',
                })
                this.$Progress.finish()
                this.form.reset();
               })
               .cath(()=>{

               })
         
      }
  },
 

        created() {

            this.loadCondos();
             Fire.$on('PosCriado',() => {
              this.loadCondos();
            }); 
        },
    }
</script>
