<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title>
          Quasar App
        </q-toolbar-title>

        <div v-if="!user.name">
          <span @click="toggleAuthModal">Login</span>
          <span @click="toggleAuthModal">Register</span>
        </div>
        <div v-else> Hi, {{ user.name }} </div>

      </q-toolbar>
    </q-header>

    <q-drawer
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
import { defineComponent, ref } from 'vue'
import LoginForm from '../components/Auth/LoginForm.vue';

export default defineComponent({
  name: 'MainLayout',

  components: {
    EssentialLink,
    LoginForm
  },

  setup () {
    const { modalOpened, toggleAuthModal, user } = useAuth(null);

    const leftDrawerOpen = ref(false)

    return {
      essentialLinks: [],
      leftDrawerOpen,
      toggleLeftDrawer () {
        leftDrawerOpen.value = !leftDrawerOpen.value
      },
      modalOpened,
      toggleAuthModal,
      user
    }
  }
})
</script>
