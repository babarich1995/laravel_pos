<template>
  <div>
    <div>
        <router-link to="/order">
        <button class="btn btn-primary" type="button">Go Back</button> 
        </router-link>
    </div>
    <div class="row">
        <div class="col-xl-6">
      <div class="card card-xl-stretch mb-5 mb-xl-8 mt-4">
        <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bolder fs-3 mb-1">Order Details</span>
        </h3>
      
    </div>
			<ul class="list-group">
            <li class="list-group-item border-0  bg-light-primary p-4 m align-items-center">
                 <strong class="me-6">Name:</strong>{{orders.name}}
            </li>
            
            <li class="list-group-item border-0  bg-light-primary p-4 m align-items-center">
                 <strong class="me-6">Phone:</strong>{{orders.phone}}
            </li>
            <li class="list-group-item border-0  bg-light-primary p-4 m align-items-center">
                 <strong class="me-6">Address:</strong>{{orders.address}}
            </li>
            <li class="list-group-item border-0  bg-light-primary p-4 m align-items-center">
                 <strong class="me-6">Date:</strong>{{orders.order_date}}
            </li>
            <li class="list-group-item border-0  bg-light-primary p-4 m align-items-center">
                 <strong class="me-6">Payment Method:</strong>{{orders.payment_method}}
            </li>
           
        </ul>							
		</div> 
        </div>
                                <div class="col-xl-6">
                                        <div class="card card-xl-stretch mb-5 mb-xl-8 mt-4">
                                                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">Order Details</span>
                                </h3>
                            
                            </div>		
                                <ul class="list-group">
                                        <li class="list-group-item border-0  bg-light-success p-4 m align-items-center">
                                            <strong class="me-6">Subtotal:</strong>{{orders.getSubTotal}}
                                        </li>
                                        
                                        <li class="list-group-item border-0  bg-light-success p-4 m align-items-center">
                                            <strong class="me-6">Total:</strong>{{orders.total}}
                                        </li>
                                        <li class="list-group-item border-0  bg-light-success p-4 m align-items-center">
                                            <strong class="me-6">Vat:</strong>{{orders.vat}}%
                                        </li>
                                        <li class="list-group-item border-0  bg-light-success p-4 m align-items-center">
                                            <strong class="me-6">Due Amount:</strong>{{orders.due}}
                                        </li>
                                        <li class="list-group-item border-0  bg-light-success p-4 m align-items-center">
                                            <strong class="me-6">Paid Amount:</strong>{{orders.pay}}
                                        </li>
                                    
                                    </ul>		
										</div>
                    </div>
                <div class="card card-xl-stretch mb-5 mb-xl-8 mt-4">
			
											<div class="card-header border-0 pt-5">
												<h3 class="card-title align-items-start flex-column">
													<span class="card-label fw-bolder fs-3 mb-1">Order Details</span>
													
												</h3>
												
											</div>
											
											<div class="card-body py-3">
												
												<div class="table-responsive">
													
													<table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
														
														<thead>
															<tr class="fw-bolder text-muted">
																<th>S/N</th>
																<th>Product Name</th>
																<th>Product Code</th>
																<th>Image</th>
																<th>Quantity</th>
                                                                <th>Unit Price</th>
                                                                <th>Total</th>
															</tr>
														</thead>
														
														<tbody>
															<tr v-for="(detail,index) in details" :key="detail.id">
																<td>{{index+1}}</td>
                                                                <td>{{detail.product_name}}</td>
                                                                <td>{{detail.product_code}}</td>
                                                               <td>
                                                                <img :src="'/backend/product/'+detail.image" style="width:40px; height:40px;"/>
                                                                </td>
                                                                <td>{{detail.product_quantity}}</td>
                                                                <td>{{detail.product_price}}</td>
                                                                <td>{{detail.sub_total}}</td>
															</tr>
															
														</tbody>
														
													</table>
													
												</div>
												
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
      
       errors:{},
       orders:{},
       details:{}
      }
    },
    created(){
    let id = this.$route.params.id
     axios.get('/api/order/details/' +id)
     .then(({data})=>(this.orders=data))
     .catch(console.log(this.errors))
     axios.get('/api/order/orderdetails/' +id)
     .then(({data})=>(this.details=data))
     .catch(console.log(this.errors))
    },

    methods:{

      
      
    }
}
</script>

<style>

</style>