<template>
 <div>
    
								<div class="row g-6 g-xl-9">
									<!--begin::Col-->
									<div class="col-lg-8">
									<!--begin::Toolbar-->
								<div class="d-flex flex-wrap flex-stack pb-7">
									<!--begin::Title-->
									<div class="d-flex flex-wrap align-items-center my-1 ">
										<!--begin::Search-->
										<div class="d-flex align-items-center position-relative  my-1">
											<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
											<span class="svg-icon svg-icon-3 position-absolute ms-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
												</svg>
											</span>
											<!--end::Svg Icon-->
                                                <input type="text" class="form-control ps-9" style="width:300px" placeholder="search product" v-model="searchTerm">
											
										</div>
										<!--end::Search-->
									</div>
									<!--end::Title-->
									
								</div>
								<!--end::Toolbar-->

										
										
													<ul class="nav pb-7">
														<li class="nav-item">
															<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-primary active fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">All Products</a>
														</li>
														<li class="nav-item" v-for="category in categories" :key="category.id">
															<a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4 me-1" data-bs-toggle="tab"
                                                             href="#kt_table_widget_5_tab_2" @click="subProduct(category.id)">
                                                                {{category.category_name}}
                                                            </a>
														</li>
														
													</ul>
											
											<!--end::Header-->
											
												<div class="tab-content">
													<!--begin::Tap pane-->
													<div class="tab-pane fade show active" id="kt_table_widget_5_tab_1">
														

                                    <!--begin::Row-->
										<div class="row g-6 g-xl-9">
											<!--begin::Col-->
											<div class="col-md-4 col-xxl-4" 
                                            v-for="product in filtersearch" :key="product.id">
												<!--begin::Card-->
                                              
												<div class="card">
                   
                                         <div class="card-content">
                                          <div class="card-body">
                                       <img :src="'backend/product/' +product.image" class="card-img img-fluid mb-1" >
                                      
                                        <h5 class="mt-1">{{product.product_name}}</h5>
                                     
                                        <hr class="my-1">
                                         <div class="fvrow mb-2">
                                                <p class="font-medium-2 mb-0">Price:Tsh {{product.selling_price}}/=</p>
                                               
                                            </div>
                                       <div class="fvrow mb-2">
                                         
                        <span class="badge badge-light-success" v-if="product.product_quantity >= 1">Available : {{product.product_quantity}}</span>
                       
                        <span class="badge badge-light-danger"  v-else>Stock Out</span>
                        
                                            </div>
											<div class="fvrow">
												<button  class="btn btn-sm btn-primary" @click.prevent="addToCart(product.id)"><i class="bi bi-cart-plus-fill"></i> Add To Cart</button>
                                              
											</div>
                                    </div>
                                </div>
                            </div>
                      
												<!--end::Card-->
											</div>
											<!--end::Col-->
										
										</div>
										<!-- <ul class="pagination">
    <li class="page-item previous disabled"><span class="page-link">Previous</span></li>
    <li class="page-item "><a href="#" class="page-link">1</a></li>
    <li class="page-item active"><a href="#" class="page-link">2</a></li>
    <li class="page-item "><a href="#" class="page-link">3</a></li>
    <li class="page-item "><a href="#" class="page-link">4</a></li>
    <li class="page-item "><a href="#" class="page-link">5</a></li>
    <li class="page-item "><a href="#" class="page-link">6</a></li>
    <li class="page-item next"><a class="page-link" href="#">Next</a></li>
</ul> -->
										<!--end::Row-->
													</div>
													<!--end::Tap pane-->
													<!--begin::Tap pane-->
													<div class="tab-pane fade" id="kt_table_widget_5_tab_2">
														
                                    <!--begin::Row-->
										<div class="row g-6 g-xl-9">
											<!--begin::Col-->
											<div class="col-md-4 col-xxl-4" 
                                            v-for="fetchProduct in getfiltersearch" :key="fetchProduct.id">
												<!--begin::Card-->
                                                <a href="#" class="text-gray-800 text-hover-primary mb-0">
												<div class="card">
                   
                                         <div class="card-content">
                                          <div class="card-body">
                                       <img :src="'backend/product/' +fetchProduct.image" class="card-img img-fluid mb-1" >
                                      
                                        <h5 class="mt-1">{{fetchProduct.product_name}}</h5>
                                     
                                        <hr class="my-1">
                                         <div class="fvrow mb-2">
                                                <p class="font-medium-2 mb-0">Price:Tsh {{fetchProduct.selling_price}}/=</p>
                                               
                                            </div>
                                       <div class="fvrow mb-2">
                                         
                        <span class="badge badge-light-success" v-if="fetchProduct.product_quantity >= 1">Available : {{fetchProduct.product_quantity}}</span>
                       
                        <span class="badge badge-light-danger"  v-else>Stock Out</span>
                        
                                            </div>
											<div class="fvrow">
												<button  class="btn btn-sm btn-primary" @click.prevent="addToCart(fetchProduct.id)"><i class="bi bi-cart-plus-fill"></i> Add To Cart</button>
                                              
											</div>
                                    </div>
                                </div>
                            </div>
                            </a>
												<!--end::Card-->
											</div>
											<!--end::Col-->
										
										</div>
										<!--end::Row-->
													</div>
													<!--end::Tap pane-->
												
												</div>
											
								

									</div>
								
									<div class="col-lg-4">
										
										<div class="card">
										
											<div class="card-header mt-6">
												
												<div class="card-title d-flex py-3 flex-row justify-content-between align-items-center">
													<h3 class="fw-bolder mb-1">Current Order</h3>
                                                    <a href="#" class="btn btn-sm  btn-primary"  data-bs-target="#kt_modal_invite_friends">
												
												<span class="svg-icon svg-icon-3">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
														<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
													</svg>
												</span>
												Add Customer</a>
													
												</div>
												
												
											</div>
										
											<div class="card-body pt-10 pb-0 px-5">
                        
                            
                              <div class="d-flex align-items-center mb-7 border-bottom" v-for="cart in carts" :key="cart.id">
												
													<div class="symbol symbol-50px me-5">
														<img :src="'backend/product/'+cart.product_image" class="" alt="">
													</div>
													
													<div class="flex-grow-1">
                            <div class="d-flex flex-row justify-content-between">
                             <div>
                            <span  class="text-dark fw-bolder text-hover-primary fs-6">{{cart.product_name}}</span>
                            </div>
                            <div class="ms-5">
                              <span style="cursor:pointer" class="badge badge-danger" @click="removeItem(cart.id)"><i class="bi bi-trash text-white"></i></span>
                            </div>
                            </div>
             
														
                            <div class="d-flex flex-row justify-content-between">
												
                            <div>
                            <span class="text-gray-800 fw-bolder">Tsh {{cart.sub_total}}</span>
                            
                            </div>
							<div class="ms-5 ">
                        	<div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="0" data-kt-dialer-max="500">
														
														<button type="button" @click.prevent="decrement(cart.id)"
														class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
														 data-kt-dialer-control="decrease" 
														  v-if="cart.product_quantity >= 2">
						
															<span class="svg-icon svg-icon-1">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
																	<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
																</svg>
															</span>
															
														</button>
														<button type="button" v-else disabled
														class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
						
															<span class="svg-icon svg-icon-1">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
																	<rect x="6.0104" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
																</svg>
															</span>
															
														</button>
														
														<input type="text" class="form-control  border-0 ps-12" data-kt-dialer-control="input" 
														 readonly="readonly" :value="cart.product_quantity">
														
														<button type="button" @click.prevent="increment(cart.id)"
														class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-25" data-kt-dialer-control="increase">
															
															<span class="svg-icon svg-icon-1">
																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																	<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black"></rect>
																	<rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
																	<rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
																</svg>
															</span>
														
														</button>
														
													</div>
                                                     </div>
													
														
													</div>
														
													</div>
												
												</div>

									
                                </div>
											<!--end::Card body-->

												<div class="card-footer">
													<ul class="list-group">
														<li class="list-group-item border-0  bg-light-primary d-flex justify-content-between align-items-center">
                                                         Total Quantity: <strong>{{getQuantity}}</strong>
														</li>
														<li class="list-group-item border-0   bg-light-primary d-flex justify-content-between align-items-center">
                                                         Sub Total: <strong>Tsh {{getSubTotal}}</strong>
														</li>
														<li class="list-group-item border-0  bg-light-primary d-flex justify-content-between align-items-center">
                                                         VAT:<strong>{{vats.vat}}%</strong>
														</li>
														<div class="separator separator-dashed border-gray-500"></div>
														<li class="list-group-item border-0  bg-light-primary d-flex justify-content-between align-items-center">
                                                          <strong>Total :</strong>  <strong>Tsh {{getSubTotal * vats.vat/100 + getSubTotal}}</strong>
														</li>
													</ul>
												</div>

												<form class="form" @submit.prevent="orderDone">
													<div class="fv-row  p-4 me-6">
													<label class="fs-6 fw-bold form-label mb-2">Customer Name</label>
													<select class="form-select" v-model="customer_id">
                                               <option v-for="customer in customers" :key="customer.id" :value="customer.id">{{customer.name}}</option>
													</select>
													</div>
													<div class="fv-row  p-4 me-6">
													<label>Pay</label>
													<input type="text" class="form-control"  v-model="pay"/>
													</div>
													<div class="fv-row  p-4 me-6">
													<label>Due Amount</label>
													<input type="text" class="form-control"  v-model="due"/>
													</div>
													<div class="fv-row  p-4 me-6">
											     	<label>Payment Method</label>
													<select class="form-select" v-model="payment_method">
                                                   <option value="cash">Cash</option>
												   <option value="bank">Bank</option>
												   <option value="mobile">Mobile</option>
												   <option value="cheque">Cheque</option>
													</select>
													</div>
													 <div class="fv-row p-4 me-6">
                                      <button type="submit" class="btn btn-success btn-block">Submit</button>
                                                </div>
													
												</form>
										</div>
										<!--end::Graph-->
									</div>
									<!--end::Col-->
									
									
									
									
								</div>
								<!--end::Row-->
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

  created(){
      this.getProducts();
      this.getCategories();
	  this.getCustomers();
	  this.cartProduct();
	  this.getVats();

	  Reload.$on('AfterAdd',()=>{
		this.cartProduct();
	  })
    },

    data(){
      return {
     customer_id:'',
	 pay:'',
	 due:'',
	 payment_method:'',
       products:[],
       categories:'',
       fetchProducts:[],
       searchTerm:'',
	   customers:'',
	   carts:[],
	   vats:''
      
      }
    },
computed:{
filtersearch(){
  return this.products.filter(product =>{
    return product.product_name.match(this.searchTerm)
  })
},
getfiltersearch(){
  return this.fetchProducts.filter(fetchProduct =>{
    return fetchProduct.product_name.match(this.searchTerm)
  })
},
getQuantity(){
	let sum = 0;
	console.log(this.carts)
	for (let i = 0; i < this.carts.length; i++) {
		
		sum += (parseFloat(this.carts[i].product_quantity))
	}
	return sum;
},
getSubTotal(){
	let subtotal = 0;
	for (let i = 0; i < this.carts.length; i++) {
		
		subtotal += (parseFloat(this.carts[i].product_quantity) * (this.carts[i].product_price))
	}
	return subtotal;
}
},
    methods:{
		//cart methods
       addToCart(id){
      axios.get('/api/addToCart/' +id)
        .then(() => {
		Reload.$emit('AfterAdd');
          Notification.cart_success();
        }).catch((err) => {
          
        });
	   },

	   orderDone(){
          let total = this.getSubTotal * this.vats.vat/100 + this.getSubTotal;
		  var data = {getQuantity:this.getQuantity,getSubTotal:this.getSubTotal,
		  customer_id:this.customer_id, pay:this.pay, due:this.due, 
		  payment_method:this.payment_method, vat:this.vats.vat, total:total}
		  axios.post('/api/orderdone', data)
          .then(() => {
            Notification.success()
		    this.$router.push({name:'home'})
          }).catch(error =>this.errors = error.response.data.errors)
	   },

	   cartProduct(){
        axios.get('/api/cart/product/')
        .then(({data}) => {
          this.carts=data
        }).catch((err) => {
          
        });
	   },

	   removeItem(id){
       axios.get('/api/remove/cart/' +id)
        .then(() => {
		Reload.$emit('AfterAdd');
          Notification.cart_delete();
        }).catch((err) => {
          
        });
	   },
      increment(id){
      axios.get('/api/increment/' +id)
        .then(() => {
		Reload.$emit('AfterAdd');
          Notification.success();
        }).catch((err) => {
          
        });
	  },
      decrement(id){
       axios.get('/api/decrement/' +id)
        .then(() => {
		Reload.$emit('AfterAdd');
          Notification.success();
        }).catch((err) => {
          
        });
	  },

	  getVats(){
       axios.get('/api/vats/')
        .then(({data}) => {
          this.vats=data
        }).catch((err) => {
          
        });
	  },
		//endcart methods
        getProducts(){
        axios.get('/api/product/')
        .then(({data}) => {
          this.products=data
        }).catch((err) => {
          
        });
        },
        getCategories(){
        axios.get('/api/category/')
        .then(({data}) => {
          this.categories=data
        }).catch((err) => {
          
        });
        },
        getCustomers(){
        axios.get('/api/customer/')
        .then(({data}) => {
          this.customers=data
        }).catch((err) => {
          
        });
        },
        subProduct(id){
        axios.get('/api/fetch/product/' +id)
        .then(({data}) => {
          this.fetchProducts=data
        }).catch((err) => {
          
        });
        }

    },

    
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>