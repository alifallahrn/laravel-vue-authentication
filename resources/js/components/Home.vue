<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <section-header :loading="loading" />
        <div class="card">
          <div class="card-body">
            <h1 class="text-center">Todolist</h1>
            <p class="text-center">The to do list to organize work & life :)</p>
            <div class="text-center mt-5">
              <router-link to="/tasks" class="btn btn-secondary text-light"
                >Get Started</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import sectionHeader from "./sections/header.vue";
import taskAdd from "./task/add.vue";
import taskList from "./task/list.vue";
export default {
  components: { taskAdd, taskList, sectionHeader },
  data: function () {
    return {
      loading: false,
    };
  },
};
</script>
