<script>
import {ref} from "vue";
import store from "@/store";
import {notify} from "@kyvg/vue3-notification";

export default {
  name: 'ForgetPasswordComponent',
  setup () {
    const email = ref("");
    const loading = ref(false);

    const forgetPassword = () => {
      loading.value = true
      store.dispatch('forgetPassword', {
        email: email.value
      })
          .then(response => {
            notify({
              title: "Success",
              text: response.data.status,
            });
          })
          .catch(error => {
            notify({
              title: "Error",
              type: 'error',
              text: error.data.email,
            });
          })
          .finally(() => loading.value = false)
    }

    return {
      forgetPassword,
      email,
      loading
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
      <button
          :disabled="loading"
          class="btn primary"
          type="submit"
          @click.prevent="forgetPassword"
      >
        <span v-if="loading"> Enviando... </span>
        <span v-else> Recuperar senha </span>
      </button>
    </form>
    <span>
      <p class="fontSmall">Esqueceu sua senha?
        <router-link :to="{name: 'auth'}" class="link primary">Clique aqui</router-link>
      </p>
    </span>
</template>

<style scoped>

</style>