<template>
  <div>
<div>
        <router-link to="/store_customer">
        <button class="btn btn-primary" type="button">Add Customer</button> 
        </router-link>
    </div>
    <div class="mt-2 mb-3">
      <input type="text" class="form-control" style="width:300px" placeholder="search here" v-model="searchTerm">
    </div>

							<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Customer List</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<div class="table-responsive">
								
										<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
									
											<thead>
												<tr class="fw-bolder text-muted bg-light">
													
													<th>S/N</th>
													<th>Customer Name</th>
													<th>Photo</th>
													<th>Phone Number</th>
													<th>Address</th>
									
													<th class="text-center">Actions</th>
												</tr>
											</thead>
										
											<tbody>
											  <tr v-for="(customer, index) in filtersearch" :key="customer.id">
                        <td>{{index+1}}</td>
                        <td>{{customer.name}}</td>
                        <td>
                          <img :src="'backend/customer/' +customer.photo" style="width:40px; height:40px;">
                        </td>
                        <td>{{customer.phone}}</td>
                        <td>{{customer.address}}</td>
                       
                        
                        <td class="text-end">
                          <router-link :to="{name:'edit_customer', params:{id:customer.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a  @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger text-white">
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
       customers:[],
       searchTerm:''
      
      }
    },
computed:{
filtersearch(){
  return this.customers.filter(customer =>{
    return customer.name.match(this.searchTerm)
  })
}
},
    methods:{
        getCustomers(){
        axios.get('/api/customer/')
        .then(({data}) => {
          this.customers=data
        }).catch((err) => {
          
        });
        },

        deleteCustomer(id){
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
                axios.delete('/api/customer/'+id)
               .then(() => {
                this.customers = this.customers.filter(customer => {
                  return customer.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'customer'})
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
      this.getCustomers();
    }
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>