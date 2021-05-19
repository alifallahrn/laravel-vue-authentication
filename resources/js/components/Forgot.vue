<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <section-header :loading="loading" />
        <div class="card">
          <h5 class="card-header">Forgot</h5>
          <div class="card-body">
            <div v-if="this.errors.length">
              <ol class="alert alert-danger">
                <li class="ms-3" v-for="(value, key) in this.errors" :key="key">
                  {{ value }}
                </li>
              </ol>
            </div>
            <div v-if="this.message">
              <div class="alert alert-success">{{ this.message }}</div>
            </div>
            <form @submit.prevent="forgot">
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
              <div class="row">
                <div class="offset-sm-4 col-sm-8">
                  <button type="submit" class="btn btn-primary text-light">
                    Send Reset Link
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
      message: false,
      formData: {
        email: "",
      },
    };
  },
  methods: {
    forgot() {
      this.loading = true;
      this.errors = {};
      axios
        .post("/api/forgot", this.formData)
        .then((response) => {
          if (response.status == 200) {
            this.loading = false;
            this.message = response.data;
            this.formData.email = "";
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
