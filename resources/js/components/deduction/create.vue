<template>
  <div>
    <div class="mb-3">
        <router-link to="/deduction">
        <button class="btn btn-primary" type="button">All Deductions</button> 
        </router-link>
    </div>

    		<div class="card mb-5 mb-xl-8 mw-550px">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Add Deduction</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<form class="form" @submit.prevent="deductionAdd" >
                 
                
							                   <div class="row mb-8">
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Deduction Name</div>
												</div>
												
												<div class="col-xl-8">
													<input class="form-control" type="text" placeholder="Enter deduction name" 
                            v-model="form.deduction_name" />
                            <small class="text-danger" v-if="errors.deduction_name">{{errors.deduction_name[0]}}</small>
												</div>
											
											</div>
							                   <div class="row mb-8">
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Category</div>
												</div>
												
												<div class="col-xl-8">
													 <select class="form-select" aria-label="Select example" v-model="form.category">
                            <option value="1">Fixed Deduction</option>
                            <option value="2">Monthly Deduction</option>

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
                          v-model="form.deduction_percent" />
                          
												</div>
											
											</div>
                    <div class="row mb-8" v-else>

												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Fixed Amount</div>
												</div>
												
												<div class="col-xl-8">
													<input class="form-control" type="text" placeholder="Enter fixed amount" 
                        v-model="form.deduction_amount" />
                    
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
        deduction_name:null,
        category:null,
        is_percentage:true,
        deduction_percent:null,
        deduction_amount:null,
        description:null
       
       },
       errors:{}
      }
    },

    methods:{

   
        deductionAdd(){
          axios.post('/api/deduction', this.form)
          .then(() => {
            this.$router.push({name:'deduction'})
            Notification.success()
          }).catch(error =>this.errors = error.response.data.errors)
        }
    }
}
</script>

<style>

</style>