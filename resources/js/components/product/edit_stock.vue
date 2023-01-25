<template>
  <div>
    <div>
        <router-link to="/stock">
        <button class="btn btn-primary" type="button">Back</button> 
        </router-link>
    </div>
   <div class="card mb-5 mb-xl-8 mw-550px mt-4">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Update Stock</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
								<form class="form" @submit.prevent="stockUpdate">
                 
              
							
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Product Stock</label>
									<input class="form-control" type="text" placeholder="Enter product quantity" 
                   v-model="form.product_quantity" />
                  
                 
								</div>
								
                  
                    <div class="fv-row my-3 p-4 me-6">
                      <button type="submit" class="btn btn-primary btn-block">Update</button>
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
       
        product_quantity:'',
      
        
       },
       errors:{},
      
      }
    },
    created(){
    let id = this.$route.params.id
     axios.get('/api/product/' +id)
     .then(({data})=>(this.form=data))
     .catch(console.log(this.errors))

    },

    methods:{

        stockUpdate(){
          let id = this.$route.params.id
          axios.post('/api/stock/update/'+id, this.form)
          .then(() => {
            this.$router.push({name:'stock'})
            Notification.success()
          }).catch(error =>this.errors = error.response.data.errors)
        }
    }
}
</script>

<style>

</style>