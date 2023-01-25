<template>
  <div>
    <div class="mb-3">
        <router-link to="/allowance">
        <button class="btn btn-primary" type="button">All Allowance</button> 
        </router-link>
    </div>

    		<div class="card mb-5 mb-xl-8 mw-550px">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Edit Allowance</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<form class="form" @submit.prevent="allowanceUpdate" >
                 
                
							                   <div class="row mb-8">
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Allowance Name</div>
												</div>
												
												<div class="col-xl-8">
													<input class="form-control" type="text" placeholder="Enter allowance name" 
                                                    v-model="form.allowance_name" />
                                                    <small class="text-danger" v-if="errors.allowance_name">{{errors.allowance_name[0]}}</small>
												</div>
											
											</div>
							                   <div class="row mb-8">
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Category</div>
												</div>
												
												<div class="col-xl-8">
													 <select class="form-select" aria-label="Select example" v-model="form.category">
                                                        <option value="1">Fixed Allowance</option>
                                                        <option value="2">Monthly Allowance</option>
                        
                                                        </select>
                                                    <small class="text-danger" v-if="errors.category">{{errors.category[0]}}</small>
                                            
												</div>
											
											</div>
							                   <div class="row mb-8">
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Charge Type</div>
												</div>
												
												<div class="col-xl-8 d-flex">
													<div class="form-check form-check-custom form-check-solid">
                                                    <label class="form-check-label me-5" for="percentage">
                                                        Percentage
                                                    </label>
                                                    
                                                    <input class="form-check-input me-6" type="radio" value="true" id="percentage"  v-model="form.is_percentage"/>
                                                    </div>
                                                    <div class="form-check form-check-custom form-check-solid">
                                                    <label class="form-check-label me-5" for="fixed_amount">
                                                        Fixed Amount
                                                    </label>
                                                    <input class="form-check-input" type="radio" value="false" id="fixed_amount" v-model="form.is_percentage"/>
                                                    
                                                </div> 
												</div>
											
											</div>
                                            <div class="row mb-8" v-if="form.is_percentage === true">
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Percent</div>
												</div>
												
												<div class="col-xl-8">
													<input class="form-control" type="text" placeholder="Enter percentage" 
                                                    v-model="form.allowance_percent" />
                                                    
												</div>
											
											</div>
                                            <div class="row mb-8" v-else>
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Fixed Amount</div>
												</div>
												
												<div class="col-xl-8">
													<input class="form-control" type="text" placeholder="Enter fixed amount" 
                                                    v-model="form.allowance_amount" />
                                                
												</div>
											
											</div>
                                            <div class="row mb-8">
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Description</div>
												</div>
												
												<div class="col-xl-8">
													<textarea class="form-control" type="text" placeholder="Enter details" 
                                                    v-model="form.description" />
                                                    
												</div>
											
											</div>
					
							
                   
                   
                    <div class="fv-row my-3 p-4 me-6 offset-xl-4">
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
        allowance_name:'',
        category:'',
        is_percentage:true,
        allowance_percent:'',
        allowance_amount:'',
        description:''
       
       },
       errors:{}
      }
    },

    created(){
     let id = this.$route.params.id
     axios.get('/api/allowance/' +id)
     .then(({data})=>(this.form=data))
     .catch(console.log(this.errors))
    },

    methods:{

   
        allowanceAdd(){
          axios.post('/api/allowance', this.form)
          .then(() => {
            this.$router.push({name:'allowance'})
            Notification.success()
          }).catch(error =>this.errors = error.response.data.errors)
        }
    }
}
</script>

<style>

</style>