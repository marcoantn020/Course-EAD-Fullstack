<script>
import { useStore } from "vuex";
import { ref, watch} from "vue";
import router from "@/router";
import {notify} from "@kyvg/vue3-notification";

export default {
  name: 'LoginComponent',
  setup() {
    const store = useStore()
    const email = ref("")
    const password = ref("")
    const loading = ref(false)

    const clickPassword = ref(true)
    const loadingStore = store.state.loading
    watch(
        () => store.state.users.loggedIn,
        (loggedIn) => {
          if(loggedIn) {
             router.push({name: 'campus.home'})
          }
        }
    )
    const viewPasswordUpdate = () => clickPassword.value = !clickPassword.value


    const auth = () => {
      loading.value = true
      store.dispatch('auth', {
        email: email.value,
        password: password.value,
        device_name: email.value
      })
          .then(() => router.push({name: 'campus.home'}))
          .catch(error => {
            notify({
              title: "Error",
              type: 'error',
              text: error.data.message,
            });
          })
          .finally(() => loading.value = false)
    }

    return {
      auth,
      email,
      password,
      loading,
      clickPassword,
      viewPasswordUpdate,
      loadingStore
    }
  }
}

</script>

<template>
    <form action="" method="">
      <div class="groupForm">
        <i class="far fa-envelope"></i>
        <input type="email" name="email" placeholder="Email" v-model="email" required>
      </div>
      <div class="groupForm">
        <i class="far fa-key"></i>
        <input :type="clickPassword ? 'password' : 'text'" name="password" placeholder="Senha" v-model="password" required>
        <i class="far fa-eye buttom" @click="viewPasswordUpdate"></i>
      </div>

      <button
          :disabled="loading"
          class="btn primary"
          type="submit"
          @click.prevent="auth" >
          <span v-if="loading">Carregando...</span>
          <span v-else-if="loadingStore">Validando acesso...</span>
          <span v-else>Login</span>
      </button>
    </form>
    <span>
      <p class="fontSmall">Esqueceu sua senha?
        <router-link :to="{name: 'forget.password'}" class="link primary">Clique aqui</router-link>
      </p>
    </span>
</template>

<style scoped>

</style>