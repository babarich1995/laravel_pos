<template>
  <div>
<div>
        <router-link to="/store_expense">
        <button class="btn btn-primary" type="button">Add Expense</button> 
        </router-link>
    </div>
    <div class="mt-2 mb-3">
      <input type="text" class="form-control" style="width:300px" placeholder="search here" v-model="searchTerm">
    </div>

							<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Expense List</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<div class="table-responsive">
								
										<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
									
											<thead>
												<tr class="fw-bolder text-muted bg-light">
													
													<th>S/N</th>
													<th>Expense Details</th>
													<th>Amount</th>
													<th>Expense Date</th>
												
													<th class="text-center">Actions</th>
												</tr>
											</thead>
										
											<tbody>
											  <tr v-for="(expense, index) in filtersearch" :key="expense.id">
                        <td>{{index+1}}</td>
                        <td>{{expense.details}}</td>
                        <td>{{expense.amount}}</td>
                        <td>{{expense.expense_date}}</td>
                      
                        
                        <!-- <td class="text-end">
                          <router-link :to="{name:'edit_expense', params:{id:expense.id}}" class="btn btn-sm btn-flex btn-primary">Edit</router-link>
                          <a  @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger text-white">
                            Delete</a>
                          </td> -->
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
       expenses:[],
       searchTerm:''
      
      }
    },
computed:{
filtersearch(){
  return this.expenses.filter(expense =>{
    return expense.details.match(this.searchTerm)
  })
}
},
    methods:{
        getExpenses(){
        axios.get('/api/expense/')
        .then(({data}) => {
          this.expenses=data
        }).catch((err) => {
          
        });
        },

        deleteExpense(id){
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
                axios.delete('/api/expense/'+id)
               .then(() => {
                this.expenses = this.expenses.filter(expense => {
                  return expense.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'expense'})
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
      this.getExpenses();
    }
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>