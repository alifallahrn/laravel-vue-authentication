<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <section-header :loading="loading" />
        <div class="card">
          <h5 class="card-header">Login</h5>
          <div class="card-body">
            <form @submit.prevent="login">
            <div v-if="this.errors.length">
              <ol class="alert alert-danger">
                <li class="ms-3" v-for="(value, key) in this.errors" :key="key">
                  {{ value }}
                </li>
              </ol>
            </div>
              <div class="row mb-3">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="email" v-model="formData.email" />
                </div>
              </div>
              <div class="row mb-3">
                <label for="password" class="col-sm-4 col-form-label"
                  >Password</label
                >
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="password" v-model="formData.password" />
                </div>
              </div>
              <div class="row">
                <div class="offset-sm-4 col-sm-8">
                  <button type="submit" class="btn btn-primary text-light">
                    Sign in
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import sectionHeader from "./sections/header.vue";

export default {
  components: { sectionHeader },
  data: function () {
    return {
      loading: false,
      errors: {},
      formData: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    login() {
      this.loading = true;
      axios
        .post("api/login", this.formData)
        .then((response) => {
          if (response.status == 200) {
            this.loading = false;
            localStorage.setItem('token', response.data);
            this.$router.push("/");
          }
        })
        .catch((errors) => {
          this.loading = false;
          let values = Object.values(errors.response.data.errors);
          this.errors = values.flat();
        });
    },
  },
};
</script>
