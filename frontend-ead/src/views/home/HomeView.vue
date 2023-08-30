<script>
import CardCoursePartials from "@/views/home/partials/CardCoursePartials.vue";
import {computed, onMounted} from "vue";
import store from "@/store";

export default {
  name: 'HomeView',
  setup () {

    const course_items = computed(() => store.state.courses.courses_items)

    onMounted(() => {
      store.dispatch('getCourses')
    })

    return {
      course_items
    }
  },
  components: {
    CardCoursePartials
  }
}
</script>

<template>
  <div>
    <div class="pageTitle">
      <span class="title">Meus Cursos</span>
      <span class="dots">
        <span></span>
        <span></span>
        <span></span>
    </span>
    </div>

    <div class="content">
      <ul class="listCourses">
        <card-course-partials
            v-for="course in course_items"
            :key="course.id"
            :course="course"
            :bg-name="'laravel'"
        />
      </ul>
    </div>
  </div>
</template>

