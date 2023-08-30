<script>
import { computed } from 'vue'

import router from "@/router"
import store from "@/store";

export default {
  name: 'MenuComponent',
  setup() {
    const logout = () => {
      store.dispatch('logout')
          .then(() => router.push({name: 'auth'}))
    }
    const loadingStore = computed(() => store.state.loading)

    return {
      logout,
      loadingStore,
    }
  }
}
</script>

<template>
  <div class="animate__animated animate__fadeIn">
    <transition name="fade">
      <ul id="mainMenu">
        <li class="animate__animated animate__headShake">
          <router-link :to="{name: 'campus.home'}">Início</router-link>
        </li>
        <li class="animate__animated animate__headShake">
          <router-link :to="{name: 'campus.my.supports'}">Minhas Dúvidas</router-link>
        </li>
        <li class="animate__animated animate__headShake">
          <a href="#" @click.prevent="logout">
            <span v-if="loadingStore">Saindo...</span>
            <span v-else>Sair</span>
          </a>
        </li>
      </ul>
    </transition>
  </div>
</template>

<style scoped>

</style>