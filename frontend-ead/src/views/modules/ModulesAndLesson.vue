<script>
  import ModulePartials from "@/views/modules/partials/ModulePartials.vue";
  import PlayerPartials from "@/views/modules/partials/PlayerPartials.vue";
  import SupportsPartials from "@/views/modules/partials/SupportsPartials.vue";
  import {computed} from "vue";
  import store from "@/store";
  import router from "@/router";

  export default {
    name: 'ModuleAndLesson',
    setup() {
      const course = computed(() => store.state.courses.course_selected)
      if(course.value.id === '') {
        router.push({name: 'campus.home'})
      }
      return {
        course: course
      }
    },
    components: {
      SupportsPartials,
      PlayerPartials,
      ModulePartials
    }
  }

</script>

<template>
  <div class="pageTitle">
    <span class="title">{{ course.name }}</span>
    <span class="dots">
                <span></span>
                <span></span>
                <span></span>
            </span>
  </div>

  <div class="content">
    <div class="container">

      <module-partials />

      <div class="right">
        <div class="content">

          <player-partials/>

          <supports-partials/>

        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>