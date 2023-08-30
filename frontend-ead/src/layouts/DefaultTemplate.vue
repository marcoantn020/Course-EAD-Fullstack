<script>
  import HeaderComponent from "@/layouts/partials/HeaderComponent.vue";
  import FooterComponent from "@/layouts/partials/FooterComponent.vue";
  import {onBeforeMount} from "vue";

  export default {
    name: 'DefaultTemplate',
    setup() {
      onBeforeMount(() => {
        document.body.classList.add('page')
        document.body.classList.add('dark')

        document.title = "Curso EAD Vue3"
      })
    },
    components: {
      FooterComponent,
      HeaderComponent
    }
  }

</script>

<template>
  <div>
    <header-component />

    <section>
      <router-view></router-view>
    </section>

    <footer-component />
  </div>
</template>

<style scoped>

</style>