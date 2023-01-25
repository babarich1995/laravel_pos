<template>
  <div>
<div>
        <router-link to="/add_allowance">
        <button class="btn btn-primary" type="button">Add Allowance</button> 
        </router-link>
    </div>
    <div class="mt-2 mb-3">
      <input type="text" class="form-control" style="width:300px" placeholder="search here" v-model="searchTerm">
    </div>

							<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Allowance List</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<div class="table-responsive">
								
										<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
									
											<thead>
												<tr class="fw-bolder text-muted bg-light">
													
													<th>S/N</th>
													<th>Name</th>
													<th>Category</th>
													<th>Percent</th>
													<th>Amount</th>
                                                    <th class="w-200px">Description</th>
									
													<th class="text-center">Actions</th>
												</tr>
											</thead>
										
											<tbody>
											  <tr  v-for="(allowance, index) in filtersearch" :key="allowance.id">
                                                <td>{{index+1}}</td>
                                                <td>{{allowance.allowance_name}}</td>
                                                <td>{{allowance.category === 1 ? 'Fixed Allowance' : 'Monthly Allowance'}}</td>
                                                <td>{{allowance.is_percentage === false ? 'None' : allowance.allowance_percent }}</td>
                                                <td>{{allowance.allowance_amount}}</td>
                                                <td>{{allowance.description}}</td>
                                            
                                                
                                                <td>
                                                <router-link :to="{name:'edit_allowance', params:{id:allowance.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                                <router-link :to="{name:'view_allowance', params:{id:allowance.id}}" class="btn btn-sm btn-primary">View</router-link>
                                                <router-link :to="{name:'add_allowance_member', params:{id:allowance.id}}" class="btn btn-sm btn-warning">Add Members</router-link>
                                                <a  @click="deleteAllowance(allowance.id)" class="btn btn-sm btn-danger text-white">
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
       allowances:[],
       searchTerm:''
      
      }
    },
computed:{
filtersearch(){
  return this.allowances.filter(allowance =>{
    return allowance.allowance_name.match(this.searchTerm)
  })
}
},
    methods:{
        getAllowances(){
        axios.get('/api/allowance/')
        .then(({data}) => {
          this.allowances=data
        }).catch((err) => {
          
        });
        },

        deleteAllowance(id){
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
                axios.delete('/api/allowance/'+id)
               .then(() => {
                this.allowances = this.allowances.filter(allowance => {
                  return allowance.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'allowance'})
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
      this.getAllowances();
    }
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>