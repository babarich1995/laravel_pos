<template>
  <div>
<div>
        <router-link to="/store_product">
        <button class="btn btn-primary" type="button">Add Product</button> 
        </router-link>
    </div>
    <div class="mt-2 mb-3">
      <input type="text" class="form-control" style="width:300px" placeholder="search here" v-model="searchTerm">
    </div>

							<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Product List</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<div class="table-responsive">
								
										<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
									
											<thead>
												<tr class="fw-bolder text-muted bg-light">
													
													<th>S/N</th>
													<th>Product Name</th>
													<th>Product Code</th>
													<th>Photo</th>
													<th>Category</th>
													<th>Buying Price</th>
													<th>Selling Price</th>
                          <th>Quantity</th>
													<th class="text-center">Actions</th>
												</tr>
											</thead>
										
											<tbody>
											  <tr v-for="(product, index) in filtersearch" :key="product.id">
                        <td>{{index+1}}</td>
                        <td>{{product.product_name}}</td>
                        <td>{{product.product_code}}</td>
                        <td>
                          <img :src="'backend/product/' +product.image" style="width:40px; height:40px;">
                        </td>
                        <td>{{product.category_name}}</td>
                        <td>{{product.buying_price}}</td>
                        <td>{{product.selling_price}}</td>
                        <td>{{product.product_quantity}}</td>
                        
                        <td class="text-end">
                          <router-link :to="{name:'edit_product', params:{id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a  @click="deleteProduct(product.id)" class="btn btn-sm btn-danger text-white">
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
       products:[],
       searchTerm:''
      
      }
    },
computed:{
filtersearch(){
  return this.products.filter(product =>{
    return product.product_name.match(this.searchTerm)
  })
}
},
    methods:{
        getProducts(){
        axios.get('/api/product/')
        .then(({data}) => {
          this.products=data
        }).catch((err) => {
          
        });
        },

        deleteProduct(id){
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
                axios.delete('/api/product/'+id)
               .then(() => {
                this.products = this.products.filter(product => {
                  return product.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'product'})
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
      this.getProducts();
    }
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>