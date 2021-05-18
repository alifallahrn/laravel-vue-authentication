<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <section-header />
        <auth-register-form />
      </div>
    </div>
  </div>
</template>

<script>
import sectionHeader from "./sections/header.vue";
import authRegisterForm from "./auth/registerForm.vue"

export default {
  components: { sectionHeader, authRegisterForm },
};
</script>
