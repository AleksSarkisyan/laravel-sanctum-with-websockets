<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          v-if="essentialLinks.length"
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

       <div>
          <q-toolbar-title>
            Food App
          </q-toolbar-title>
       </div>

        <div class="top-nav auth">
          <!-- Restaurant user auth -->

          <div class="restaurant">
            <RestaurantRegistration />
          </div>

          <!-- Regular user auth -->
          <div class="regular" v-if="!user.name">
            <span class="hover" @click="toggleAuthModal('login')">Login </span>
            <span @click="toggleAuthModal">| </span>
            <span class="hover" @click="toggleAuthModal('register')">Register</span>
          </div>
          <div v-else> Hi, {{ user.name }}
            <span @click="logout">| Logout</span>
          </div>
        </div>

      </q-toolbar>
    </q-header>

    <q-drawer
      v-if="essentialLinks.length"
      v-model="leftDrawerOpen"
      show-if-above
      bordered
    >
      <q-list>
        <q-item-label
          header
        >
          Essential Links
        </q-item-label>

        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />

      </q-list>
    </q-drawer>
    <br>

    <login-form
      :modalOpened="modalOpened"
      :toggleAuthModal="toggleAuthModal"
      :modalTitle="modalTitle"
    >
    </login-form>

    <q-page-container>

      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import EssentialLink from '../components/EssentialLink.vue'
import useAuth from '../hooks/useAuth.vue';
import { defineComponent, ref, watch, onMounted } from 'vue'
import LoginForm from '../components/Auth/LoginForm.vue';
import RestaurantRegistration from '../pages/Frontend/Restaurant/RestaurantRegistration.vue';
import { API_PATHS } from '../models/ApiPaths';
import useAxios from '../hooks/useAxios.vue';

export default defineComponent({
  name: 'MainLayout',

  components: {
    EssentialLink,
    LoginForm,
    RestaurantRegistration
  },

  setup () {
    const { modalOpened, toggleAuthModal, user, modalTitle, logout } = useAuth(null);
     const { get } = useAxios();

    const getCsrf = async () => {
      return await get(API_PATHS.SANCTUM_COOKIE)
    }

    watch(user, (currentValue) => {
      /** User got authenticated, close auth modal */
      if (currentValue.name && currentValue.name != '' ) {
        toggleAuthModal('')
      }
    });

    onMounted(() => {
      getCsrf();
    })

    const leftDrawerOpen = ref(false)

    return {
      essentialLinks: [],
      leftDrawerOpen,
      toggleLeftDrawer () {
        leftDrawerOpen.value = !leftDrawerOpen.value
      },
      modalOpened,
      toggleAuthModal,
      user,
      modalTitle,
      logout
    }
  }
})
</script>


<style scoped>

</style>
