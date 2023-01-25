<template>
  <div>
    <div class="mb-3">
        <router-link to="/employee">
        <button class="btn btn-primary" type="button">All Employee</button> 
        </router-link>
    </div>

    		<div class="card mb-5 mb-xl-8 mw-550px">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Add Employee</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<form class="form" @submit.prevent="employeeAdd" enctype="multipart/form-data">
                 
                <div class="d-flex">
							
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Full Name</label>
									<input class="form-control" type="text" placeholder="Enter full name" 
                   v-model="form.name" />
                   <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                 
								</div>
								
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Email Address</label>
									<input class="form-control" type="email" placeholder="Enter email address"
                    v-model="form.email" />
                      <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                     
								</div>
							
							</div>
                    <div class="d-flex">
							
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Address</label>
									<input class="form-control" type="text" placeholder="enter address"
                    autocomplete="off" v-model="form.address" />
                     
								</div>
								
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Salary</label>
									<input class="form-control" type="text" placeholder="enter salary"
                   autocomplete="off" v-model="form.salary"/>
                   
								</div>
								
							</div>
                   
                   
              
								<div class="fv-row my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Joining Date</label>
									<input class="form-control" type="date" placeholder="enter joining date"
                    autocomplete="off" v-model="form.joining_date" />
                    
                     
								</div>
								
                
                  <div class="fv-row my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Roll Id</label>
									<input class="form-control" type="text" placeholder="enter roll id"
                   autocomplete="off" v-model="form.rollId"/>
                   
								</div>
                   
						
							
								
								<div class="fv-row my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Phone Number</label>
									<input class="form-control" type="text" placeholder="enter phone number"
                    autocomplete="off" v-model="form.phone_number" />
                     <small class="text-danger" v-if="errors.phone_number">{{errors.phone_number[0]}}</small>
                    
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
        name:null,
        email:null,
        phone_number:null,
        address:null,
        joining_date:null,
        rollId:null,
        photo:null,
        salary:null,
        
       },
       errors:{},
     
      }
    },

    methods:{

        onFileChange(event){
         let file = event.target.files[0];
         if (file.size > 1048770) {
            Notification.image_validation()
         }else{
            let reader = new FileReader();
            reader.onload= event =>{
             this.form.photo=  event.target.result
            };

            reader.readAsDataURL(file);
         }
        },
        employeeAdd(){
          axios.post('/api/employee', this.form)
          .then(() => {
            this.$router.push({name:'employee'})
            Notification.success()
          }).catch(error =>this.errors = error.response.data.errors)
        }
    },
   
}
</script>

<style>

</style>