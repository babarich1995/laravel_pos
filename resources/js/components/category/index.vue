<template>
  <div>
<div>
        <router-link to="/store_category">
        <button class="btn btn-primary" type="button">Add Category</button> 
        </router-link>
    </div>
    <div class="mt-2 mb-3">
      <input type="text" class="form-control" style="width:300px" placeholder="search here" v-model="searchTerm">
    </div>

							<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Category List</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<div class="table-responsive">
								
										<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
									
											<thead>
												<tr class="fw-bolder text-muted bg-light">
													
													<th>S/N</th>
													<th>Category Name</th>
													<th>Actions</th>
												</tr>
											</thead>
										
											<tbody>
											  <tr v-for="(category, index) in filtersearch" :key="category.id">
                        <td>{{index+1}}</td>
                        <td>{{category.category_name}}</td>
                        
                        <td>
                          <router-link :to="{name:'edit_category', params:{id:category.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a  @click="deleteCategory(category.id)" class="btn btn-sm btn-danger text-white">
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
       categories:[],
       searchTerm:''
      
      }
    },
computed:{
filtersearch(){
  return this.categories.filter(category =>{
    return category.category_name.match(this.searchTerm)
  })
}
},
    methods:{
        getCategories(){
        axios.get('/api/category/')
        .then(({data}) => {
          this.categories=data
        }).catch((err) => {
          
        });
        },

        deleteCategory(id){
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
                axios.delete('/api/category/'+id)
               .then(() => {
                this.categories = this.categories.filter(category => {
                  return category.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'category'})
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
      this.getCategories();
    }
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>