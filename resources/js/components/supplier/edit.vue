<template>
  <div>
    <div>
        <router-link to="/supplier">
        <button class="btn btn-primary" type="button">All Supplier</button> 
        </router-link>
    </div>
   <div class="card mb-5 mb-xl-8 mw-550px">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Update Supplier</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<form class="form" @submit.prevent="supplierUpdate" enctype="multipart/form-data">
                 
                <div class="d-flex">
							
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Full Name</label>
									<input class="form-control" type="text" placeholder="Enter full name" 
                   v-model="form.name" />
                 
								</div>
								
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Email Address</label>
									<input class="form-control" type="email" placeholder="Enter email address"
                    v-model="form.email" />
                     
                     
								</div>
							
							</div>
                    <div class="d-flex">
							
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Address</label>
									<input class="form-control" type="text" placeholder="enter address"
                    autocomplete="off" v-model="form.address" />
                     
								</div>
								
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Shop Name</label>
									<input class="form-control" type="text" placeholder="enter shop name"
                   autocomplete="off" v-model="form.shopname"/>
                   
								</div>
								
							</div>
                   
                   
              
							
								
								<div class="fv-row my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Phone Number</label>
									<input class="form-control" type="text" placeholder="enter phone number"
                    autocomplete="off" v-model="form.phone" />
                    
								</div>
                   

                    <div class="d-flex">
								<div class="fv-row my-3 p-4 me-6">
								 <div class="custom-file">
                  <label class="custom-file-label" for="customFile">Upload Photo</label>
                        <input type="file" class="custom-file-input" id="customFile" @change="onFileChange">
                        
                      </div>
								</div>
								<div class="my-3 p-4 me-6">
                                    <img :src="form.photo" height="40px" width="40px"/>
                                </div>
							</div>
                   
                   
                    <div class="fv-row my-3 p-4 me-6">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    
                  </form>
							
								</div>
						
							</div>
            
  </div>
</template>

<script>
export default {
 //This method will first load before all
  created(){
if (!User.loggedIn()) {
  this.$router.push({name:'/'})
}
  },
    data(){
      return {
       form:{
        name:'',
        email:'',
        phone:'',
        address:'',
        photo:'',
        newPhoto:'',
        shopname:'',
       },
       errors:{}
      }
    },
    created(){
    let id = this.$route.params.id
     axios.get('/api/supplier/' +id)
     .then(({data})=>(this.form=data))
     .catch(console.log(this.errors))
    },

    methods:{

        onFileChange(event){
         let file = event.target.files[0];
         if (file.size > 1048770) {
            Notification.image_validation()
         }else{
            let reader = new FileReader();
            reader.onload= event =>{
             this.form.newPhoto=  event.target.result
            };

            reader.readAsDataURL(file);
         }
        },
        supplierUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/supplier/'+id, this.form)
          .then(() => {
            this.$router.push({name:'supplier'})
            Notification.success()
          }).catch(error =>this.errors = error.response.data.errors)
        }
    }
}
</script>

<style>

</style>