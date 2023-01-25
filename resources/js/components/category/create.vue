<template>
  <div>
    <div class="mb-3">
        <router-link to="/category">
        <button class="btn btn-primary" type="button">All Catogories</button> 
        </router-link>
    </div>

    		<div class="card mb-5 mb-xl-8 mw-550px">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Add Category</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<form class="form" @submit.prevent="categoryAdd">
                 
             
							
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Category Name</label>
									<input class="form-control" type="text" placeholder="Enter category name" 
                   v-model="form.category_name" />
                 
								</div>
								
								
                   
                    <div class="fv-row my-3 p-4 me-6">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
        category_name:null,
       },
       errors:{}
      }
    },

    methods:{

        categoryAdd(){
          axios.post('/api/category', this.form)
          .then(() => {
            this.$router.push({name:'category'})
            Notification.success()
          }).catch(error =>this.errors = error.response.data.errors)
        }
    }
}
</script>

<style>

</style>