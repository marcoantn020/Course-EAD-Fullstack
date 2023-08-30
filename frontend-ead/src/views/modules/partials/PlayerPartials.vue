<script>
import {computed, watch} from "vue";
import store from "@/store";

export default {
  name: 'PlayerPartials',
  setup () {
    const playerLesson = computed(() => store.state.courses.playerLesson)

    watch(() =>  store.state.courses.playerLesson,
        () => {
          if(playerLesson.value.id !== '')
            setTimeout(() => store.dispatch('lessonOfCourseCheckAsViewed'), 1000)
        })


    return {
      lesson: playerLesson
    }
  }
}

</script>

<template>
  <div class="training">
    <div class="card bg-laravel">
      <span class="icon">
          <img src="../../../assets/images/icons/laravel.svg" >
      </span>
      <span class="title">{{ lesson.name }}</span>
        <router-link :to="{name: 'campus.home'}" class="btn laravel">
          <i class="fas fa-chevron-left"></i>
          Voltar
        </router-link>
    </div>
    <iframe
        v-show="lesson.video !== ''"
        width="100%"
        height="auto"
        :src="lesson.video"
        title="YouTube video player"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>
  </div>
</template>

<style scoped>

</style>