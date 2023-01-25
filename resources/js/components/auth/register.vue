<template>
    <div>
      <!--begin::Authentication - Sign-up -->
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(backend/media/illustrations/sketchy-1/14.png">
				<!--begin::Content-->
				<div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
					<!--begin::Logo-->
					
						<img alt="Logo" src="backend/media/logos/logo.svg" class="h-40px mb-3" />
				
					<!--end::Logo-->
					<!--begin::Wrapper-->
					<div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
						<!--begin::Form-->
						<form class="form w-100"  id="kt_sign_up_form" @submit.prevent="signup">
							<!--begin::Heading-->
							<div class="mb-10 text-center">
								<!--begin::Title-->
								<h1 class="text-dark mb-3">Create an Account</h1>
								<!--end::Title-->
								<!--begin::Link-->
							
								<!--end::Link-->
							</div>
							<!--end::Heading-->
							
							
							<!--begin::Input group-->
							<div class="row fv-row mb-7">
								
									<label class="form-label fw-bolder text-dark fs-6">Full Name</label>
									<input class="form-control form-control-lg form-control-solid" type="text" placeholder="" autocomplete="off"
                  v-model="form.name" />
								
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="fv-row mb-7">
								<label class="form-label fw-bolder text-dark fs-6">Email</label>
								<input class="form-control form-control-lg form-control-solid" type="email" placeholder="" 
                v-model="form.email" autocomplete="off" />
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->
							<div class="mb-10 fv-row">
								<!--begin::Wrapper-->
								<div class="mb-1">
									<!--begin::Label-->
									<label class="form-label fw-bolder text-dark fs-6">Password</label>
									<!--end::Label-->
									<!--begin::Input wrapper-->
									<div class="position-relative mb-3">
										<input class="form-control form-control-lg form-control-solid" type="password" placeholder=""  autocomplete="off" 
                    v-model="form.password"/>
									
									</div>
									<!--end::Input wrapper-->
									
								</div>
								<!--end::Wrapper-->
							
							</div>
							<!--end::Input group=-->
							<!--begin::Input group-->
							<div class="fv-row mb-5">
								<label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
								<input class="form-control form-control-lg form-control-solid" type="password" placeholder=""  autocomplete="off"
                v-model="form.password_confirmation" />
							</div>
							<!--end::Input group-->
						
							<!--begin::Actions-->
							<div class="text-center">
								<button type="button" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
									<span class="indicator-label">Submit</span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
							</div>
							<!--end::Actions-->
              <div class="text-center mt-4">
              <router-link class="font-weight-bold small" to="/">Already have an account?</router-link>
              </div>
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
				
			</div>
			<!--end::Authentication - Sign-up-->
      
    </div>
</template>

<script>
export default {
    //This method will first load before all
  created(){
if (User.loggedIn()) {
  this.$router.push({name:'home'})
}
  },
    data(){
      return {
       form:{
        name:null,
        email:null,
        password:null,
        confirm_password:null
       },
       errors:{}
      }
    },
    methods:{
      signup(){
       axios.post('/api/auth/signup', this.form)
       .then(res => {
        User.responseAfterLogin(res)
        Toast.fire({
          icon:'success',
          title:'Signed in successfuly'
        })
        this.$router.push({name:'home'})})
       .catch((err) => {
        this.errors = err.response.data.errors
       })
      
      }
    }
}
</script>

