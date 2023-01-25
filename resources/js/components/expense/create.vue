<template>
  <div>
    <div class="mb-3">
        <router-link to="/expense">
        <button class="btn btn-primary" type="button">All Expenses</button> 
        </router-link>
    </div>

    		<div class="card mb-5 mb-xl-8 mw-550px">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Add Expense</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<form class="form" @submit.prevent="expenseAdd" enctype="multipart/form-data">
                 
               
							
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Expense Details</label>
									<textarea class="form-control" type="text" placeholder="Enter details" 
                   v-model="form.details" />
                   <small class="text-danger" v-if="errors.details">{{errors.details[0]}}</small>
                 
								</div>
								
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Amount</label>
									<input class="form-control" type="text" placeholder="Enter amount"
                    v-model="form.amount" />
                      <small class="text-danger" v-if="errors.anount">{{errors.amount[0]}}</small>
                     
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
        details:null,
        amount:null,
        
       },
       errors:{}
      }
    },

    methods:{

      
        expenseAdd(){
          axios.post('/api/expense', this.form)
          .then(() => {
            this.$router.push({name:'expense'})
            Notification.success()
          }).catch(error =>this.errors = error.response.data.errors)
        }
    }
}
</script>

<style>

</style>