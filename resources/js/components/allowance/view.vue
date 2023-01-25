<template>
  <div>
   
	 
<div class="col-xl-8">
	<div class="mt-2 mb-3">
      <input type="text" class="form-control" style="width:300px" placeholder="search here" v-model="searchTerm">
    </div>
<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1" >
											Member Allowances</span>
										
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
													<th>Allowance</th>
													<th>Percent</th>
													<th>Action</th>
												
												</tr>
											</thead>
										
											<tbody>
											  <tr v-for="(userallowance, index) in userallowances" :key="userallowance.id">
                                                <td>{{index+1}}</td>
                                                <td>{{userallowance.name}}</td>
                                                <td>{{userallowance.salary}}</td>
                                                <td>{{userallowance.allowance_amount}}</td>
                                                <td>{{userallowance.is_percentage === false ? 'None' : userallowance.allowance_percent }}</td>   
                                                   <td class="text-end">
                        
												<a  @click="deleteUserAllowance(userallowance.id)" class="btn btn-sm btn-danger text-white">
													Delete</a>
												</td>     
                                                </tr>
											</tbody>
					
										</table>
										
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
      
       errors:{},
	
	   userallowances:[],
	   searchTerm:''
      }
    },

computed:{
filtersearch(){
  return this.userallowances.filter(userallowance =>{
    return userallowance.name.match(this.searchTerm)
  })
}
},
    methods:{
         getUserAllowances(){
			let id = this.$route.params.id
           axios.get('/api/allowances/view/'+id)
          .then(({data}) => {
           this.userallowances = data
          }).catch(error =>this.errors = error.response.data.errors)
    },
    deleteUserAllowance(id){
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
                axios.get('/api/userallowance/delete/'+id)
               .then(() => {
                this.userallowances = this.userallowances.filter(userallowance => {
                  return userallowance.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'view_allowance'})
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
      this.getUserAllowances();
    }
}
</script>

<style>

</style>