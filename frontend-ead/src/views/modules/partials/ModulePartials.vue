<script>

import {computed, ref} from "vue";
  import store from "@/store";

  export default {
    name: 'ModulePartials',
    setup() {

      const showModule = ref('0')

      const modules = computed(() => store.state.courses.course_selected.modules)
      const playerSelected = computed(() => store.state.courses.playerLesson)

      const toggleModule = (moduleID) => {
          showModule.value = moduleID
      }

      const addLessonInPlayer = (lesson) => {
        store.commit('SET_PLAYER', lesson)
      }

      return {
        modules: modules.value,
        showModule,
        toggleModule,
        addLessonInPlayer,
        playerSelected,
      }
    }
  }

</script>

<template>
  <div class="left">
    <div class="card">
      <div class="title bg-laravel">
        <span class="text">Modulos</span>
        <span class="icon far fa-stream"></span>
      </div>
      <div
          :class="['modules', module.id === showModule ? 'active': '']"
          v-for="module in modules"
          :key="module.id"
          @click.prevent="toggleModule(module.id)"
      >
        <div class="name">
          <span class="text">{{ module.name }}</span>
          <span class="icon fas fa-sort-down"></span>
        </div>
        <ul class="classes" v-show="module.id === showModule">
          <li
              :class="{'active' : lesson.id === playerSelected.id}"
              v-for="lesson in module.lessons"
              :key="lesson.id"
              @click.prevent="addLessonInPlayer(lesson)"
          >
            <span class="check active fas fa-check" v-if="lesson.views.length > 0"></span>
            <span class="nameLesson">{{ lesson.name }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>