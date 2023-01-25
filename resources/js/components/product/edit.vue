<template>
  <div>
    <div>
        <router-link to="/product">
        <button class="btn btn-primary" type="button">All Products</button> 
        </router-link>
    </div>
   <div class="card mb-5 mb-xl-8 mw-550px">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Update Product</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
								<form class="form" @submit.prevent="productUpdate" enctype="multipart/form-data">
                 
                <div class="d-flex">
							
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Product Name</label>
									<input class="form-control" type="text" placeholder="Enter product name" 
                   v-model="form.product_name" />
                  
                 
								</div>
								
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Product Code</label>
									<input class="form-control" type="text" placeholder="Enter product code"
                    v-model="form.product_code" />
                      
                     
								</div>
							
							</div>
                    <div class="d-flex">
							
								<div class="fv-row  my-3 p-4 me-6">
                  <label class="fs-6 fw-bold form-label mb-2">Product Category</label>
                <select class="form-select" aria-label="Select example" v-model="form.category_id">
                    <option   v-for="category in categories"   :key="category.id" :value="category.id">{{category.category_name}}</option>
                    
                </select>
                     
								</div>
								
								<div class="fv-row  my-3 p-4 me-6">
									 <label class="fs-6 fw-bold form-label mb-2">Product Supplier</label>
                <select class="form-select" aria-label="Select example" v-model="form.supplier_id">
                    <option v-for="supplier in suppliers" :key="supplier.id" :value="supplier.id">{{supplier.name}}</option>
                    
                </select>
                   
								</div>
								
							</div>
                   
                   <div class="d-flex">
							
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Product Root</label>
									<input class="form-control" type="text" placeholder="" 
                   v-model="form.root" />
                   
								</div>
								
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Buying Price</label>
									<input class="form-control" type="text" placeholder=""
                    v-model="form.buying_price" />
                      
                     
								</div>
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Selling Price</label>
									<input class="form-control" type="text" placeholder=""
                    v-model="form.selling_price" />
                      
                     
								</div>
							
							</div>
              <div class="d-flex">
             <div class="fv-row my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Buying Date</label>
									<input class="form-control" type="date" placeholder=""
                    autocomplete="off" v-model="form.buying_date" />
                    
                     
								</div>
                <div class="fv-row my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Product Quantity</label>
									<input class="form-control" type="text" placeholder="Enter your quantity"
                   autocomplete="off" v-model="form.product_quantity"/>
                   
								</div>
              </div>
              
				

                    <div class="d-flex">
                      <!-- <div class="input-group mb-5">
    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"/>
    <span class="input-group-text" id="basic-addon2">@example.com</span>
</div> -->
								<div class="fv-row my-3 p-4 me-6">
								 
                        <input type="file" class="custom-file-input" id="customFile" @change="onFileChange">
                   
								</div>
								<div class="my-3 p-4 me-6">
                                    <img :src="form.image" height="40px" width="40px"/>
                                </div>
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
        product_name:'',
        product_code:'',
        category_id:'',
        supplier_id:'',
        root:'',
        buying_price:'',
        selling_price:'',
        buying_date:'',
        product_quantity:'',
        image:'',
        newPhoto:'',
        
       },
       errors:{},
       categories:{},
       suppliers:{}
      }
    },
    created(){
    let id = this.$route.params.id
     axios.get('/api/product/' +id)
     .then(({data})=>(this.form=data))
     .catch(console.log(this.errors))

     
   // Category Collected 
    axios.get('/api/category/')
    .then(({data}) => (this.categories = data))

    // Supplier Collected 
    axios.get('/api/supplier/')
    .then(({data}) => (this.suppliers = data))
    },

    methods:{

        onFileChange(event){
         let file = event.target.files[0];
         if (file.size > 1048770) {
            Notification.image_validation()
         }else{
            let reader = new FileReader();
            reader.onload= event =>{
             this.form.newPhoto=  event.target.result
            };

            reader.readAsDataURL(file);
         }
        },
        productUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/product/'+id, this.form)
          .then(() => {
            this.$router.push({name:'product'})
            Notification.success()
          }).catch(error =>this.errors = error.response.data.errors)
        }
    }
}
</script>

<style>

</style>