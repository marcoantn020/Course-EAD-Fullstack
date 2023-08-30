<script>
  import store from "@/store";
  import router from "@/router";

  export default {
    name: 'CardCoursePartials',
    props: ['course', 'bgName'],
    setup (props) {

      const courseSelected = () => {
        store.commit('SET_COURSE_SELECTED', props.course)
        router.push({name: 'campus.modules'})
      }

      return {
        courseSelected
      }

    }
  }
</script>

<template>
      <li>
        <span :class="['card', 'bg-' + bgName]">
            <span class="icon">
                <img :src="[course.image !== '' ? course.image : require('@/assets/images/icons/default.png')]" :alt="course.name">
            </span>
            <span class="title">{{ course.name }}</span>
            <span class="action">
              <a href="#" @click.prevent="courseSelected" :class="['btn', bgName]">Acessar</a>
            </span>
        </span>
        <span class="dots">
            <span></span>
            <span></span>
            <span></span>
        </span>
      </li>
</template>

<style scoped>

</style>
