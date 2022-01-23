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

        <div class="restaurant-navbar">
          <q-toolbar-title>
            Restaurant Panel
          </q-toolbar-title>

          <div v-if="user && user.name"> Hello, {{ user.name }}
            <span @click="logout">| Logout</span>
          </div>
        </div>

      </q-toolbar>
    </q-header>

    <q-drawer
      v-if="leftDrawerOpened"
      v-model="leftDrawerOpened"
      show-if-above
      bordered
    >
      <q-list>
        <q-item-label
          header
        >
          Links
        </q-item-label>

        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
          @click="toggleLeftDrawer()"
        />

      </q-list>
    </q-drawer>
    <br>
    <q-page-container>

      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import EssentialLink from '../components/EssentialLink.vue'
import { defineComponent } from 'vue';
import { api } from '../boot/axios';
import { API_PATHS } from '../components/models';

export default defineComponent({
  name: 'MainLayoutRestaurants',

  components: {
    EssentialLink
  },

  data(){
    return {
      leftDrawerOpened: false,
      essentialLinks: [
        { title: 'Dashboard', caption: 'Manage your restaurants', link: 'restaurant/dashboard', icon: '' },
        { title: 'Menus', caption: 'Create and manage your menus', link: 'restaurant/menus', icon: '' },
        { title: 'Products', caption: 'Create and manage products', link: 'restaurant/products', icon: '' },
        { title: 'Categories', caption: 'Create and manage categories', link: 'restaurant/categories', icon: '' }
      ]
    }
  },

  computed: {
    user() {
      return this.$store.getters['restaurantUser/getUser'];
    }
  },

  methods: {
    async logout()  {
      localStorage.removeItem('vuex');
      this.$store.dispatch('restaurantUser/resetUser');
      await api.post(`${API_PATHS.RESTAURANT_CMS_PATH}/logout`);
      this.$router.push('/restaurant/login');
    },

    toggleLeftDrawer() {
      this.leftDrawerOpened = !this.leftDrawerOpened;
    },

    async getCsrf() {
      return await api.get(API_PATHS.SANCTUM_COOKIE)
    }
  },

  async mounted() {
    await this.getCsrf();
  }


})
</script>


<style scoped>
.restaurant-navbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}
</style>
