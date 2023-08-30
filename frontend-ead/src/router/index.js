import { createRouter, createWebHistory } from 'vue-router'
import HomeView from "@/views/home/HomeView.vue";
import MySupports from "@/views/supports/MySupports.vue";
import ModulesAndLesson from "@/views/modules/ModulesAndLesson.vue";
import LoginComponent from "@/views/auth/LoginComponent.vue";
import ForgetPasswordComponent from "@/views/auth/ForgetPasswordComponent.vue";
import UpdatePasswordComponent from "@/views/auth/UpdatePasswordComponent.vue";
import {TOKEN_NAME} from "@/config";
import store from "@/store";

const routes = [
  {
    path: '/',
    component: () => import('@/layouts/AuthTemplate.vue'),
    children: [
      {
        path: '/reset/:token',
        name: 'update.password',
        component: UpdatePasswordComponent,
        props: true
      },
      {
        path: '/recuperar-senha',
        name: 'forget.password',
        component: ForgetPasswordComponent
      },
      {
        path: '',
        name: 'auth',
        component: LoginComponent
      }
    ]
  },
  {
    path: '/campus',
    component: () => import('@/layouts/DefaultTemplate.vue'),
    children: [
      {
        path: 'modulos',
        name: 'campus.modules',
        component: ModulesAndLesson
      },
      {
        path: 'minhas-duvidas',
        name: 'campus.my.supports',
        component: MySupports
      },
      {
        path: '',
        name: 'campus.home',
        component: HomeView
      },
    ]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach(async (to, _, next) => {
  const loggedIn = store.state.users.loggedIn
  if (to.name !== 'update.password' && !loggedIn) {
    const token = localStorage.getItem(TOKEN_NAME)
    if (!token && to.name !== 'auth' && to.name !== 'forget.password') {
      return router.push({name: 'auth'})
    }

    await store.dispatch('getUserAuth')
        .catch(() => {
          if (to.name !== 'auth') return router.push({name: 'auth'})
        })
  }

  next()
})

export default router
