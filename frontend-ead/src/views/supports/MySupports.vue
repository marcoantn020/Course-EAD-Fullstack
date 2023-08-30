<script>

import SupportsComponent from "@/components/SupportsComponent.vue";
import {computed, onMounted, ref} from "vue";
import store from "@/store";
import PaginationComponent from "@/components/PaginationComponent.vue";

export default {
  name: 'MySupport',
  components: {PaginationComponent, SupportsComponent},
  setup () {

    const status = ref("")

    const supports = computed(() => store.state.supports.supports_items)

    onMounted(() => {
      store.dispatch('getMySupport', {status: status.value, page: 1})
    })

    const updateStatus = (value) => {
      status.value = value
      store.dispatch('getMySupport', {status: status.value})
    }

    const changePage = (page) => store.dispatch('getMySupport', {status: status.value, page: page})

    return {
      status,
      updateStatus,
      supports,
      changePage
    }
  }
}
</script>

<template>
  <div class="pageTitle">
    <span class="title">{{ 'Minhas Duvidas' }}</span>
    <span class="dots">
        <span></span>
        <span></span>
        <span></span>
    </span>
  </div>

  <div class="content">
    <div class="container">

      <div class="left">
        <div class="card">
          <div class="title bg-laravel">
            <span class="text">Filtros</span>
          </div>
          <div class="modules">
            <ul class="classes">
              <li :class="{active : status === ''}" @click="updateStatus('')">Todos</li>
              <li :class="{active : status === 'pending'}" @click="updateStatus('pending')">Aguardando Minha Resposta</li>
              <li :class="{active : status === 'waiting'}" @click="updateStatus('waiting')">Aguardando Professor</li>
              <li :class="{active : status === 'concluded'}" @click="updateStatus('concluded')">Finalizados</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="right">
        <div class="content">
          <div class="comments">
            <supports-component />
          </div>
        </div>

        <pagination-component
            :pagination="supports"
            @changePage="changePage"
        />

      </div>
    </div>
  </div>
</template>

<style scoped>

</style>