<template>
  <div>
    <div>
        <router-link to="/employee">
        <button class="btn btn-primary" type="button">All Employee</button> 
        </router-link>
    </div>
   <div class="card mb-5 mb-xl-8 mw-550px">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Pay Salary</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<form class="form" @submit.prevent="salaryPaid">
                 
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
               <div class="fv-row col-6 my-3 p-4 me-6">
									
                      <label class="fs-6 fw-bold form-label mb-2">Month</label>
                <select class="form-select" aria-label="Select example" v-model="form.salary_month">
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="Octber">Octber</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                    
                </select>
								</div>
                <div class="fv-row  my-3 p-4 me-6">
                  <label class="fs-6 fw-bold form-label mb-2">Allowance</label>
                <input class="form-control" type="text" placeholder="enter salary"
                   autocomplete="off" v-model="form.amount"/>
                     
								</div>
              </div>
								
								<div class="d-flex">
                  <div class="fv-row col-6 my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Basic Salary</label>
									<input class="form-control" type="text" placeholder="enter salary"
                   autocomplete="off" v-model="form.salary"/>
                   
								</div>
                  <!-- <div class="fv-row col-6 my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Gross Salary</label>
									<strong>Tsh </strong>
                   
								</div> -->
                </div>
								
								
							
                    <div class="fv-row my-3 p-4 me-6">
                      <button type="submit" class="btn btn-primary btn-block">Pay Now</button>
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
        amount:'',
        salary_month:'',
        salary:'',
       },
       errors:{},
       
      }
    },
    created(){
    let id = this.$route.params.id
     axios.get('/api/employee/' +id)
     .then(({data})=>(this.form=data))
     .catch(console.log(this.errors))
    },

    methods:{

        salaryPaid(){
          let id = this.$route.params.id
          axios.post('/api/salary/paid/'+id, this.form)
          .then(() => {
            this.$router.push({name:'issue_salary'})
            Notification.success()
          }).catch(error =>this.errors = error.response.data.errors)
        },

        // getGrossSalary(){
        //   let amount = 0;
        //   amount += (parseFloat(this.allowances.amount) + (this.form.salary))
        //   console.log(amount);
        // }
    },
   
}
</script>

<style>

</style>