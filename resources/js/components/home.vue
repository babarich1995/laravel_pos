<template>
  <div>
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card ">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="fs-6 fw-bold text-uppercase mb-1">Today Sale Amount</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{todaysale}}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                        <span>Since last years</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="fs-6 fw-bold text-uppercase mb-1">Todays Income</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{income}}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                        <span>Since last years</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Today Due</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{due}}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                        <span>Since last month</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Today Expense</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{expense}}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                        <span>Since yesterday</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           
          </div>
          <!--Row-->

          <div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Out of Stock Products</span>
										
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
													<th>Buying Price</th>
													<th>Status</th>
                          <th>Quantity</th>
												
												</tr>
											</thead>
										
											<tbody>
											  <tr v-for="(product, index) in products" :key="product.id">
                        <td>{{index+1}}</td>
                        <td>{{product.product_name}}</td>
                        <td>{{product.product_code}}</td>
                        <td>
                          <img :src="'backend/product/' +product.image" style="width:40px; height:40px;">
                        </td>
                        <td>{{product.buying_price}}</td>
                        <td v-if="product.product_quantity >= 1">
                        <span class="badge badge-light-success">Available</span>
                        </td>
                        <td v-else>
                        <span class="badge badge-light-danger">Stock Out</span>
                        </td>
                        <td>{{product.product_quantity}}</td>
                        
                       
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
     created(){
if (!User.loggedIn()) {
  this.$router.push({name:'/'})
}
  },

  data(){
   return {
    todaysale:'',
    income:'',
    due:'',
    expense:'',
    products:{}
   }
  },
  mounted(){
this.TodaySale();
this.TodayIncome();
this.TodayDue();
this.TodayExpense();
this.StockOut();
  },
  methods:{
    TodaySale(){
      axios.get('/api/today/sale')
          .then(({data}) => {
           this.todaysale = data
          }).catch(error =>this.errors = error.response.data.errors)
    },
    TodayIncome(){
      axios.get('/api/today/income')
          .then(({data}) => {
           this.income = data
          }).catch(error =>this.errors = error.response.data.errors)
    },
    TodayDue(){
      axios.get('/api/today/due')
          .then(({data}) => {
           this.due = data
          }).catch(error =>this.errors = error.response.data.errors)
    },
    TodayExpense(){
      axios.get('/api/today/expense')
          .then(({data}) => {
           this.expense = data
          }).catch(error =>this.errors = error.response.data.errors)
    },
    StockOut(){
      axios.get('/api/today/stockout')
          .then(({data}) => {
           this.products = data
          }).catch(error =>this.errors = error.response.data.errors)
    },
  }

}
</script>

<style>

</style>