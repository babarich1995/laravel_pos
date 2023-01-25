<template>
  <div>
   <div class="row g-6 g-xl-9">
 <div class="col-xl-8">
<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1" >
											Member Deductions</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<div class="table-responsive">
								
										<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
									
											<thead>
												<tr class="fw-bolder text-muted bg-light">
													
													<th>S/N</th>
													<th>Employee Name</th>
													<th>Basic Pay</th>
													<th>Deduction</th>
													<th>Percent</th>
													<th>Action</th>
												
												</tr>
											</thead>
										
											<tbody>
											  <tr v-for="(userdeduction, index) in userdeductions" :key="userdeduction.id">
                                                <td>{{index+1}}</td>
                                                <td>{{userdeduction.name}}</td>
                                                <td>{{userdeduction.salary}}</td>
                                                <td>{{userdeduction.is_percentage === true ? userdeduction.deduction_percent/ 100 * userdeduction.salary : userdeduction.deduction_amount}}</td>
                                                <td>{{userdeduction.is_percentage === false ? 'None' : userdeduction.deduction_percent }}</td>   
                                                   <td class="text-end">
                        
												<a  @click="deleteMember(userdeduction.id)" class="btn btn-sm btn-danger text-white">
													Delete</a>
												</td>     
                                                </tr>
											</tbody>
					
										</table>
										
									</div>
							
								</div>
						
							</div>
 </div>
<div class="col-xl-4">
    	<div class="card">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Add Deduction</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<form class="form" @submit.prevent="addMember" >
                 
                
							                   <div class="row mb-8">
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Employee Name</div>
												</div>
												
												<div class="col-xl-8">
													 <select class="form-select" aria-label="Select example" v-model="form.employee_id">
                                                        <option v-for="employee in employees"   :key="employee.id" :value="employee.id">{{employee.name}}</option>
                                                        
                                                    </select>
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
												
												<div class="col-xl-4">
													<input class="form-control" type="text" placeholder="Enter fixed amount" 
                                                    v-model="form.deduction_amount" />
                                                
												</div>
											
											</div>               
                                           
					
							
                   
                   
                    <div class="fv-row my-3 p-4 me-6 offset-xl-4">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    
                  </form>
							
								</div>
						
							</div>
						
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
        
        is_percentage:true,
        deduction_percent:'',
        deduction_amount:'',
        employee_id:''
       
       },
        employees:{},
		userdeductions:[]
      }
    },
 
    methods:{
        getUserDeductions(){
			let id = this.$route.params.id
           axios.get('/api/deductions/view/'+id)
          .then(({data}) => {
           this.userdeductions = data
          }).catch(error =>this.errors = error.response.data.errors)
    },
	addMember(){
             let id = this.$route.params.id
			
          axios.post('/api/deductions/member/' +id, this.form)
          .then(() => {
            Notification.success()
          }).catch(error =>this.errors = error.response.data.errors)
        },
		 deleteMember(id){
         Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                axios.get('/api/delete/member/'+id)
               .then(() => {
                this.userdeductions = this.userdeductions.filter(userdeduction => {
                  return userdeduction.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'view_deduction'})
               })
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })

        }
		
		},
  created(){
	      this.getUserDeductions();
		   this.addMember();
	     
          axios.get('/api/employee/')
          .then(({data})=>(this.employees = data))
            let id = this.$route.params.id
           axios.get('/api/deduction/' +id)
          .then(({data})=>this.form = data)
        }

		

  
}
</script>

<style>

</style>