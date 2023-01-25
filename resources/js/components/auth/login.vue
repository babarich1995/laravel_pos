<template>

    <div>

			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(backend/media/illustrations/sigma-1/14.png">
	
				<div class="d-flex flex-center flex-column flex-column-fluid p-5 pb-lg-20">
				
			<img alt="Logo" src="backend/media/logos/logo.svg" class="h-40px mb-3" />
				
					<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
				
						<form class="form w-100" @submit.prevent="login">
				
							<div class="text-center mb-10">
							
								<h1 class="text-dark mb-3">Sign In to Ceedo Inventory</h1>
								
							</div>
				
					
							<div class="fv-row mb-10">
								
								<label class="form-label fs-6 fw-bolder text-dark">Email</label>
							
								<input class="form-control form-control-lg form-control-solid" type="text" v-model="form.email" autocomplete="off" />
								
                        <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
            
							</div>
						
							<div class="fv-row mb-10">
							
								<div class="d-flex flex-stack mb-2">
								
									<label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
									
                  <router-link class="link-primary fs-6 fw-bolder" to="/forget">
                                        Forgot Password?
                                      </router-link>
								
								</div>
							
								<input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off" v-model="form.password" />
                 <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
						
							</div>
						
							<div class="text-center">
							
								<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
									<span class="indicator-label">Login</span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
							
								
							</div>
              <div class="text-center text-gray-400 fw-bold fs-4 mt-2">
                 
								<router-link class="link-primary fw-bolder" to="/register">Create an Account!</router-link>
                </div>
					
						</form>
					
					</div>
				
				</div>
			
				
			</div>
			



    </div>
</template>

<script>
export default {
//This method will first load before all
  created(){
if (User.loggedIn()) {
  this.$emit('loggedIn')
  this.$router.push({name:'home'})
}
  },
    data(){
      return {
       form:{
        email:null,
        password:null
       },
       errors:{}
      }
    },
    
    methods:{
      login(){
       axios.post('/api/auth/login', this.form)
       .then(res => {
        User.responseAfterLogin(res)
        Toast.fire({
          icon:'success',
          title:'Signed in successfuly'
        })
        this.$router.push({name:'home'})})
       .catch((err) => {
        this.errors = err.response.data.errors
        Toast.fire({
          icon:'warning',
          title:'Invalid Email or Password'
        })
       })
      
      }
    }
}
</script>

<style>

</style>