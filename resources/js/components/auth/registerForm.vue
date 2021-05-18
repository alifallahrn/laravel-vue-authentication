<template>
  <div>
    <div class="card">
      <h5 class="card-header">Register</h5>
      <div class="card-body">
        <form>
          <div class="row mb-3">
            <label for="first_name" class="col-sm-4 col-form-label"
              >First Name</label
            >
            <div class="col-sm-8">
              <input
                type="text"
                class="form-control"
                id="first_name"
                v-model="formData.first_name"
              />
            </div>
          </div>
          <div class="row mb-3">
            <label for="last_name" class="col-sm-4 col-form-label"
              >Last Name</label
            >
            <div class="col-sm-8">
              <input
                type="text"
                class="form-control"
                id="last_name"
                v-model="formData.last_name"
              />
            </div>
          </div>
          <div class="row mb-3">
            <label for="mobile" class="col-sm-4 col-form-label">Mobile</label>
            <div class="col-sm-8">
              <input
                type="text"
                class="form-control"
                id="mobile"
                v-model="formData.mobile"
              />
            </div>
          </div>
          <div class="row mb-3">
            <label for="email" class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
              <input
                type="email"
                class="form-control"
                id="email"
                v-model="formData.email"
              />
            </div>
          </div>
          <div class="row mb-3">
            <label for="password" class="col-sm-4 col-form-label"
              >Password</label
            >
            <div class="col-sm-8">
              <input
                type="password"
                class="form-control"
                id="password"
                v-model="formData.password"
              />
            </div>
          </div>
          <div class="row mb-3">
            <label for="password_confirmation" class="col-sm-4 col-form-label"
              >Password Confirmation</label
            >
            <div class="col-sm-8">
              <input
                type="password"
                class="form-control"
                id="password_confirmation"
                v-model="formData.password_confirmation"
              />
            </div>
          </div>
          <div class="row">
            <div class="offset-sm-4 col-sm-8">
              <button type="submit" class="btn btn-success text-light">
                Register
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  data: function () {
    return {
      formData: {
        first_name: "",
        last_name: "",
        mobile: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
    };
  },
};
</script>
