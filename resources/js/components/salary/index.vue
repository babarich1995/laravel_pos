<template>
  <div>
<div>
        <router-link to="/issue_salary">
        <button class="btn btn-primary" type="button">Pay Salary</button> 
        </router-link>
    </div>
    <div class="mt-2 mb-3">
      <input type="text" class="form-control" style="width:300px" placeholder="search here" v-model="searchTerm">
    </div>

							<div class="card mb-5 mb-xl-8">
						
								<div class="card-header border-0 pt-5">
									<h3 class="card-title align-items-start flex-column">
										<span class="card-label fw-bolder fs-3 mb-1">Salary Details</span>
										
									</h3>
								
								</div>
							
								<div class="card-body py-3">
								
									<div class="table-responsive">
								
										<table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
									
											<thead>
												<tr class="fw-bolder text-muted bg-light">
													
													<th>S/N</th>
													<th>Month Name</th>
													<th>Details</th>
												</tr>
											</thead>
										
											<tbody>
											  <tr v-for="(salary, index) in filtersearch" :key="salary.id">
                        <td>{{index+1}}</td>
                        <td>{{salary.salary_month}}</td>
                
                        <td>
                          <router-link :to="{name:'view_salary', params:{id:salary.salary_month}}" class="btn btn-sm btn-primary">View Salary</router-link>
                          
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
       salaries:[],
       searchTerm:''
      
      }
    },
computed:{
filtersearch(){
  return this.salaries.filter(salary =>{
    return salary.salary_month.match(this.searchTerm)
  })
}
},
    methods:{
        getSalaries(){
        axios.get('/api/salary/')
        .then(({data}) => {
          this.salaries=data
        }).catch((err) => {
          
        });
        },

       
    },

    created(){
      this.getSalaries();
    }
}
</script>
<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>