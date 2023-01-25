<template>
  <div>
    <div class="mb-3">
        <router-link to="/order">
        <button class="btn btn-primary" type="button">Today's Order</button> 
        </router-link>
    </div>

    		<div class="card mb-5 mb-xl-8 mw-450px align-center offset-xl-3">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-center flex-row">
										<span class="card-label fw-bolder fs-3 mb-1 ">Search Order</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-2">
								
									<form class="form" @submit.prevent="searchOrder">
                 
             
							
								<div class="fv-row  my-3 p-4 me-6">
									<label class="fs-6 fw-bold form-label mb-2">Order Date</label>
									<input class="form-control" type="date"  v-model="date"  required/>
                                    
								</div>
								
								
                   
                    <div class="fv-row my-3 p-4 me-6">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    
                  </form>
							
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
																<th>Customer Name</th>
																<th>Quantity</th>
                                                                <th>Sub Total</th>
                                                                 <th>Total</th>
                                                                <th>Payment Method</th>
                                                                <th>Paid Amount</th>
                                                                <th>Due Amount</th>
                                                               
															</tr>
														</thead>
														
														<tbody>
															<tr v-for="(order,index) in orders" :key="order.id">
																<td>{{index+1}}</td>
                                                                <td>{{order.name}}</td>
                                                                <td>{{order.getQuantity}}</td>
                                                                <td>{{order.getSubTotal}}</td>
                                                                 <td>{{order.total}}</td>
                                                                <td>{{order.payment_method}}</td>
                                                                <td>{{order.pay}}</td>
                                                                <td>{{order.due}}</td>
                                     <td>
                          <router-link :to="{name:'view_order', params:{id:order.id}}" class="btn btn-sm btn-primary">View</router-link>
                          
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
        date:'',
       orders:{},
      
      }
    },

    methods:{

        searchOrder(){
          var data = {date:this.date}
          axios.post('/api/search/order/', data)
          .then(({data}) => {
           this.orders = data
          }).catch(error =>this.errors = error.response.data.errors)
        }
    }
}
</script>

<style>

</style>