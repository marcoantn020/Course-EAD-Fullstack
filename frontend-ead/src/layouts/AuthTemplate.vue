<script>

export default {
  name: 'AuthTemplate'
}

</script>

<template>
  <section id="loginPage" :style="{backgroundImage: 'url('+ require('@/assets/images/bgLogin.jpg') +')'}">
    <div class="loginContent">
      <div class="loginCard">
        <div class="decor" :style="{backgroundImage: 'url('+ require('@/assets/images/building.jpg') +')'}">
          <div class="content">
            <span class="logo">
                <img :src="require('@/assets/images/logo.svg')" alt="logo">
            </span>
            <span class="dots">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <span class="description">
                <p>
                    Os melhores e mais completos cursos de Laravel do Brasil, cursos com projetos reais. Do zero ao profissional.
                </p>
            </span>
            <span class="copyright fontSmall">
                Todos os Direitos reservados - <b>Especializati</b>
            </span>
          </div>
        </div>
        <div class="login">
          <div class="content">
            <span class="logo">
                <img :src="require('@/assets/images/logoDark.svg')" alt="logoDark">
            </span>
            <span>
                <p>Seja muito bem vindo!</p>
            </span>
            <span class="dots">
                <span></span>
                <span></span>
                <span></span>
            </span>
            <span class="description">
                Acesse nossa plataforma e desfrute de cursos completos para sua especialização.
            </span>

            <router-view></router-view>

          </div>
          <span class="copyright fontSmall">
              Todos os Direitos reservados - <b>Cursos Especializati</b>
          </span>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>

</style>