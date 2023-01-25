<template>
  <div>

    <div class="mt-2 mb-3">
      <input type="text" class="form-control" style="width:300px" placeholder="search here" v-model="searchTerm">
    </div>

							<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Today Order List</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<div class="table-responsive">
								
										<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
									
											<thead>
												<tr class="fw-bolder text-muted bg-light">
													
													<th>S/N</th>
													<th>Name</th>
													<th>Total Amount</th>
													<th>Payment</th>
                          <th>Due Amount</th>
                          <th>Payment Method</th>
												    <th>Action</th>
													
												</tr>
											</thead>
										
											<tbody>
											  <tr v-for="(order, index) in filtersearch" :key="order.id">
                        <td>{{index+1}}</td>
                        <td>{{order.name}}</td>
                        <td>{{order.total}}</td>
                        <td>{{order.pay}}</td>
                        <td>{{order.due}}</td>
                        <td>{{order.payment_method}}</td>
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
       orders:[],
       searchTerm:''
      
      }
    },
computed:{
filtersearch(){
  return this.orders.filter(order =>{
    return order.name.match(this.searchTerm)
  })
}
},
    methods:{
        getOrders(){
        axios.get('/api/orders/')
        .then(({data}) => {
          this.orders=data
        }).catch((err) => {
          
        });
        },

       
    },

    created(){
      this.getOrders();
    }
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>