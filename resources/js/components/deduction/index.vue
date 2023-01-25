<template>
  <div>
<div>
        <router-link to="/add_deduction">
        <button class="btn btn-primary" type="button">Add Deduction</button> 
        </router-link>
    </div>
    <div class="mt-2 mb-3">
      <input type="text" class="form-control" style="width:300px" placeholder="search here" v-model="searchTerm">
    </div>

							<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Deduction List</span>
										
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
											  <tr v-for="(deduction, index) in filtersearch" :key="deduction.id">
                                <td>{{index+1}}</td>
                                <td>{{deduction.deduction_name}}</td>
                                <td>{{deduction.category === 1 ? 'Fixed Deduction' : 'Monthly Deduction'}}</td>
                                <td>{{deduction.is_percentage === false ? 'None' : deduction.deduction_percent }}</td>
                                <td>{{deduction.is_percentage === true ? 'None' : deduction.deduction_amount }}</td>
                                <td>{{deduction.description}}</td>
                            
                                
                                <td>
                                <router-link :to="{name:'edit_deduction', params:{id:deduction.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                <router-link :to="{name:'view_deduction', params:{id:deduction.id}}" class="btn btn-sm btn-primary">Members</router-link>
                                <a  @click="deleteDeduction(deduction.id)" class="btn btn-sm btn-danger text-white">
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
       deductions:[],
       searchTerm:''
      
      }
    },
computed:{
filtersearch(){
  return this.deductions.filter(deduction =>{
    return deduction.deduction_name.match(this.searchTerm)
  })
}
},
    methods:{
        getDeductions(){
        axios.get('/api/deduction/')
        .then(({data}) => {
          this.deductions=data
        }).catch((err) => {
          
        });
        },

        deleteDeduction(id){
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
                axios.delete('/api/deduction/'+id)
               .then(() => {
                this.deductions = this.deductions.filter(deduction => {
                  return deduction.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'deduction'})
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
      this.getDeductions();
    }
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>