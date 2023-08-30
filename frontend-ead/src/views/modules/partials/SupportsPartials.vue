<script>
import SupportsComponent from "@/components/SupportsComponent.vue";
import {computed, ref, watch} from "vue";
import store from "@/store";
import ModalComponent from "@/components/ModalComponent.vue";

export default {
  name: 'SupportsPartials',
  setup () {
    const lesson = computed(() => store.state.courses.playerLesson)
    const supports = computed(() => store.state.supports.supports_items.data)
    const loading = ref(false)

    const modal = ref({
      showModal: false,
      supportReply: ''
    })

    const openModal = () => modal.value = {showModal: true, supportReply: ''}

    watch(
        () => store.state.courses.playerLesson,
        () => {
          loading.value = true
          store.dispatch('getSupportsByLesson', lesson.value.id)
              .finally(() => loading.value = false)
        }
    )


    return {
      lesson,
      loading,
      supports,
      openModal,
      modal
    }
  },
  components: {
    ModalComponent,
    SupportsComponent
  }
}
</script>

<template>
  <div class="comments" v-show="lesson.name">
    <div class="header">
      <span class="title">Dúvidas (total: {{ supports.length }}) <span v-if="loading">(carregando...)</span> </span>
      <button class="btn primary" @click.prevent="openModal">
        <i class="fas fa-plus"></i>
        Enviar nova dúvida
      </button>
    </div>

    <supports-component v-show="supports.length" />

    <modal-component
        :show-modal="modal.showModal"
        :support-reply="modal.supportReply"
        @closeModal="modal.showModal = false">
    </modal-component>

  </div>

</template>

<style scoped>

</style>