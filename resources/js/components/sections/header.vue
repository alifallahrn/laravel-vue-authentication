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
      <div class="col-6 text-end">
        <router-link to="/login" class="btn btn-primary text-light"
          ><icons-login /> Login</router-link
        >
        <router-link to="/register" class="btn btn-success text-light"
          ><icons-register /> Register</router-link
        >
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
};
</script>
