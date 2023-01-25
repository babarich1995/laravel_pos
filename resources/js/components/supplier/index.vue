<template>
  <div>
<div>
        <router-link to="/store_supplier">
        <button class="btn btn-primary" type="button">Add Supplier</button> 
        </router-link>
    </div>
    <div class="mt-2 mb-3">
      <input type="text" class="form-control" style="width:300px" placeholder="search here" v-model="searchTerm">
    </div>

							<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Supplier List</span>
										
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
													<th>Shopname</th>
													<th class="text-center">Actions</th>
												</tr>
											</thead>
										
											<tbody>
											  <tr v-for="(supplier, index) in filtersearch" :key="supplier.id">
                        <td>{{index+1}}</td>
                        <td>{{supplier.name}}</td>
                        <td>
                          <img :src="'backend/supplier/' +supplier.photo" style="width:40px; height:40px;">
                        </td>
                        <td>{{supplier.phone}}</td>
                        <td>{{supplier.shopname}}</td>
                       
                        
                        <td class="text-end">
                          <router-link :to="{name:'edit_supplier', params:{id:supplier.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a  @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger text-white">
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
       suppliers:[],
       searchTerm:''
      
      }
    },
computed:{
filtersearch(){
  return this.suppliers.filter(supplier =>{
    return supplier.name.match(this.searchTerm)
  })
}
},
    methods:{
        getSuppliers(){
        axios.get('/api/supplier/')
        .then(({data}) => {
          this.suppliers=data
        }).catch((err) => {
          
        });
        },

        deleteSupplier(id){
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
                axios.delete('/api/supplier/'+id)
               .then(() => {
                this.suppliers = this.suppliers.filter(supplier => {
                  return supplier.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'supplier'})
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
      this.getSuppliers();
    }
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>