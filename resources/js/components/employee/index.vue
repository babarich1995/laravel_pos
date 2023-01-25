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
													<th>Joining Date</th>
													<th class="text-center">Actions</th>
												</tr>
											</thead>
										
											<tbody>
											  <tr v-for="(employee, index) in filtersearch" :key="employee.id">
                        <td>{{index+1}}</td>
                        <td>{{employee.name}}</td>
                        <td>
                          <img :src="'backend/employee/' + employee.photo" style="width:40px; height:40px;">
                        </td>
                        <td>{{employee.phone_number}}</td>
                        <td>{{employee.salary}}</td>
                        <td>{{employee.amount}}</td>
                        <td>{{employee.joining_date}}</td>
                        
                        <td class="text-end">
                          <router-link :to="{name:'edit_employee', params:{id:employee.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a  @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger text-white">
                            Delete</a>
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
       searchTerm:''
      
      }
    },
computed:{
filtersearch(){
  return this.employees.filter(employee =>{
    return employee.name.match(this.searchTerm)
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

        deleteEmployee(id){
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
                axios.delete('/api/employee/'+id)
               .then(() => {
                this.employees = this.employees.filter(employee => {
                  return employee.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'employee'})
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
      this.getEmployees();
    }
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>