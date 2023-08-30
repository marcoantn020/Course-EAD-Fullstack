<script>
import {ref} from "vue";
import store from "@/store";
import router from "@/router";
import {notify} from "@kyvg/vue3-notification";

export default {
  name: 'UpdatePasswordComponent',
  props: {
    token: {
      required: true
    }
  },
  setup (props) {
    const email = ref("");
    const password = ref("");
    const passwordConfirmation = ref("");
    const loading = ref(false);

    const clickPassword = ref(true)
    const viewPasswordUpdate = () => clickPassword.value = !clickPassword.value

    const updatePassword = () => {
      loading.value = true
      store.dispatch('updatePassword', {
        email: email.value,
        password: password.value,
        password_confirmation: passwordConfirmation.value,
        token: props.token,
      })
          .then(() => router.push({ name: 'auth'}))
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
      updatePassword,
      email,
      password,
      passwordConfirmation,
      loading,
      viewPasswordUpdate,
      clickPassword
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
        <input :type="clickPassword ? 'password' : 'text'" name="password" placeholder="senha" v-model="password" required>
        <i class="far fa-eye buttom" @click="viewPasswordUpdate"></i>
      </div>
      <div class="groupForm">
        <i class="far fa-key"></i>
        <input :type="clickPassword ? 'password' : 'text'" name="passwordConfirmation" placeholder="confirmar senha" v-model="passwordConfirmation" required>
      </div>
      <button
          :disabled="loading"
          class="btn primary"
          type="submit"
          @click.prevent="updatePassword"
      >
        <span v-if="loading"> Enviando... </span>
        <span v-else> Atualizar senha </span>
      </button>
    </form>
</template>

<style scoped>

</style>