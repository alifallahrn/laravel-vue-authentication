<template>
  <div class="mt-2 mb-4">
    <div class="row">
      <div class="col-6 text-start">
        <router-link class="h2 header-logo-link" to="/">
          <div v-if="loading" class="spinner-border header-spinner"></div>
          <icons-logo v-else />
          <span>Todo List</span>
        </router-link>
      </div>
      <div v-if="display_auth_links" class="col-6 text-end">
        <div v-if="userInformation.id">
          <b class="me-2"
            >Welcome {{ userInformation.first_name }}
            {{ userInformation.last_name }}!</b
          >
          <button @click="logout" class="btn btn-danger text-light">
            Logout
          </button>
        </div>
        <div v-else-if="!userInformation.id">
          <router-link to="/login" class="btn btn-primary text-light"
            ><icons-login /> Login</router-link
          >
          <router-link to="/register" class="btn btn-success text-light"
            ><icons-register /> Register</router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import iconsLogo from "./icons/logo.vue";
import iconsLogin from "./icons/login.vue";
import iconsRegister from "./icons/register.vue";

export default {
  props: ["loading"],
  components: { iconsLogo, iconsLogin, iconsRegister },
  data: function () {
    return {
      display_auth_links: false,
      token: localStorage.getItem("token"),
      userInformation: {},
    };
  },
  methods: {
    getUserInformation() {
      if (!this.token) {
        this.display_auth_links = true;
        return;
      }
      axios
        .get("/api/user")
        .then((response) => {
          this.userInformation = response.data;
          this.display_auth_links = true;
          if (this.$route.path == "/login" || this.$route.path == "/register") {
            if (this.userInformation.id) {
              this.$router.push("/");
            }
          }
        })
        .catch((error) => {
          this.display_auth_links = true;
          console.log(error);
          if (error.response.status == "401") {
            localStorage.removeItem("token");
          }
        });
    },
    logout() {
      this.loading = true;
      axios
        .post("/api/logout")
        .then((response) => {
          localStorage.removeItem("token");
          this.userInformation = {};
          this.token = false;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
          this.loading = false;
        });
    },
  },
  mounted() {
    window.axios.defaults.headers.common["Authorization"] =
      "Bearer " + this.token;
    this.getUserInformation();
  },
};
</script>
