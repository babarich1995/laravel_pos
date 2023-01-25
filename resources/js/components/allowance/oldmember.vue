<form class="form" @submit.prevent="memberAdd" >
                 
                
							                   <div class="fv-row  my-3 p-4 me-6">
                  <label class="fs-6 fw-bold form-label mb-2">Employee</label>
                <select class="form-select" aria-label="Select example" v-model="form.employee_id">
                    <option   v-for="employee in employees"   :key="employee.id" :value="employee.id">{{employee.name}}</option>
                    
                </select>
                     
								</div>
							                  
							                   <div class="row mb-8">
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Charge Type</div>
												</div>
												
												<div class="col-xl-8 d-flex">
													<div class="form-check form-check-custom form-check-solid">
                                                    <label class="form-check-label me-5" for="percentage">
                                                        Percentage
                                                    </label>
                                                    
                                                    <input class="form-check-input me-6" type="radio" value="true" id="percentage"  v-model="form.is_percentage"/>
                                                    </div>
                                                    <div class="form-check form-check-custom form-check-solid">
                                                    <label class="form-check-label me-5" for="fixed_amount">
                                                        Fixed Amount
                                                    </label>
                                                    <input class="form-check-input" type="radio" value="false" id="fixed_amount" v-model="form.is_percentage"/>
                                                    
                                                </div> 
												</div>
											
											</div>
                                            <div class="row mb-8" v-if="form.is_percentage === true">
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Percent</div>
												</div>
												
												<div class="col-xl-8">
													<input class="form-control" type="text" placeholder="Enter percentage" 
                                                    v-model="form.allowance_percent" />
                                                    
												</div>
											
											</div>
                                            <div class="row mb-8" v-else>
												
												<div class="col-xl-4">
													<div class="fs-6 fw-bold mt-2 mb-3">Fixed Amount</div>
												</div>
												
												<div class="col-xl-4">
													<input class="form-control" type="text" placeholder="Enter fixed amount" 
                                                    v-model="form.allowance_amount" />
                                                
												</div>
											
											</div>
                                           
					
							
                   
                   
                    <div class="fv-row my-3 p-4 me-6 offset-xl-4">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    
                  </form>