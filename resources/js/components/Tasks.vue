<template>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-6">
        <section-header :loading="loading" />
        <task-add :tasks="tasks" v-on:updateTasksList="getTasksList()" />
        <task-list
          :tasks="tasks"
          :loading="loading"
          v-on:updateTasksList="getTasksList()"
        />
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
      tasks: [],
      loading: false,
    };
  },
  methods: {
    getTasksList() {
      let token = localStorage.getItem("token");
      if (!token) {
        this.$router.push("/login");
        return;
      }
      this.loading = true;
      axios
        .get("/api/tasks")
        .then((response) => {
          this.tasks = response.data;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getTasksList();
  },
};
</script>
