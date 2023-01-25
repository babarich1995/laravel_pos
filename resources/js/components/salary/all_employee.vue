<template>
  <div>
<div>
        <router-link to="/store_employee">
        <button class="btn btn-primary" type="button">Add Employee</button> 
        </router-link>
    </div>
    <div class="mt-2 mb-3">
      <input type="text" class="form-control" style="width:300px" placeholder="search here" v-model="searchTerm">
    </div>

							<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Employee List</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<div class="table-responsive">
								
										<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
									
											<thead>
												<tr class="fw-bolder text-muted bg-light">
													
													<th>S/N</th>
													<th>Full Name</th>
													<th>Photo</th>
													<th>Phone Number</th>
													<th>Salary</th>
                          <th>Allowance</th>
                          <!-- <th>Deduction</th> -->
													<th>Joining Date</th>
													<th class="text-center">Actions</th>
												</tr>
											</thead>
										
											<tbody>
                      
                         
                       <!-- <tr  v-for="(employee, index) in filtersearch" :key="employee.id">
                        <td>{{index+1}}</td>
                        <td>{{employee.name}}</td>
                        <td>
                          <img :src="'backend/employee/' +employee.photo" style="width:40px; height:40px;">
                        </td>
                        <td>{{employee.phone_number}}</td>
                         <td>{{employee.salary}}</td>
                        <td>
                          {{employee.allowance_amount}}
                          </td>
                       
                        <td>{{employee.joining_date}}</td>
                        
                        <td class="text-end">
                          <router-link :to="{name:'pay_salary', params:{id:employee.id}}" class="btn btn-sm btn-primary">Pay Salary</router-link>
                          
                          </td>
                      </tr>
                         -->
           
                          <tr v-for="(employee, index) in employees"  :key="employee.id">
                         <td>{{index+1}}</td>
                        <td>{{employee.name}}</td>
                        <td>
                          <img :src="'backend/employee/' +employee.photo" style="width:40px; height:40px;">
                        </td>
                        <td>{{employee.phone_number}}</td>
                         <td>{{employee.salary}}</td>

                        

     
                         <td v-for="allowance in employeeAllowances" :key="allowance.id"> 
                         
                            {{allowance.employee_id === employee.id ? allowance.allowance_amount : 'none'}} 
                          
                         
                          </td>
                       

                     
                      

                       
                       
                         
                        <!-- <td v-for="deduction in payrolls" :key="deduction.id">
                          {{deduction.id === employee.id ? deduction.deduction_amount  || deduction.deduction_percent / 100 * employee.salary : 'None'}}
                          </td> -->
                       
                        <td>{{employee.joining_date}}</td>
                        
                        <td class="text-end">
                          <router-link :to="{name:'pay_salary', params:{id:employee.id}}" class="btn btn-sm btn-primary">Pay Salary</router-link>
                          
                          </td>
                          </tr>
                         
                 
											</tbody>
					
										</table>
										
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
       employees:[],
       payrolls:[],
       payrollId:[],
       employeeAllowances:[],
       demoAll:[],
       others:[],
       searchTerm:''
      
      }
    },
computed:{
filterAllowance(){
  return this.employeeAllowances.filter(employeeAllowance =>{
    return employeeAllowance.employee_id === this.employees.id

  })
}
},
    methods:{
        getEmployees(){
           
        axios.get('/api/employee/')
        .then(({data}) => {
          this.employees=data
        
        
        

       
        }).catch((err) => {
          
        });
        },
        getUserAllowances(){
			
           axios.get('/api/user_allowance')
          .then(({data}) => {
           this.userallowances = data
          let summedAges = this.userallowances.reduce((a, c) => {
	             let filtered = a.filter(el => el.employee_id === c.employee_id);
	            if(filtered.length > 0){
		        a[a.indexOf(filtered[0])].allowance_amount += +c.allowance_amount;
	           }else{
                    a.push(c);
                    }
            return a;
          }, []);
          this.employeeAllowances = summedAges
       

          }).catch(error =>this.errors = error.response.data.errors)
    },
        getPayroll(){
        
          axios.get('/api/payroll/')
        .then(({data}) => {
          this.payrolls=data

           for (let index = 0; index < this.payrolls.length; index++) {
             this.payrollId.push(this.payrolls[index].id);
            
           }
      
    
         
        }).catch((err) => {
          
        });
        }

       
    },

    created(){
      this.getEmployees();
      this.getPayroll();
      this.getUserAllowances();

    }
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>