<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <section-header />
        <auth-login-form />
      </div>
    </div>
  </div>
</template>

<script>
import sectionHeader from "./sections/header.vue";
import authLoginForm from "./auth/loginForm.vue";

export default {
  components: { sectionHeader, authLoginForm },
};
</script>
