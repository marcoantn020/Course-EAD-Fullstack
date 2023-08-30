<script>
  import router from "@/router";
  import {ref} from "vue";
  import MenuComponent from "@/layouts/partials/MenuComponent.vue";

  export default {
    name: 'HeaderComponent',
    components: {MenuComponent},
    setup () {
      const homeCampus = () => router.push({name: 'campus.home'})

      const showMenu = ref(false)
      const toggleMenu = () => showMenu.value = !showMenu.value

      return {
        homeCampus,
        toggleMenu,
        showMenu
      }
    }
  }
</script>

<template>
  <header id="header">
    <nav>
      <span class="toggleMenu far fa-bars" @click="toggleMenu"></span>
      <span class="logo">
        <router-link :to="{name: 'campus.home'}">
          <img :src="require('@/assets/images/logo.svg')" alt="Curso especializa ti">
        </router-link>
      </span>
    </nav>
  </header>
  <menu-component v-show="showMenu" />
</template>

<style scoped>

</style>