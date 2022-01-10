<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          v-if="false"
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
      v-if="false"
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
    <q-page-container>

      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script lang="ts">
import EssentialLink from '../components/EssentialLink.vue'
import { defineComponent } from 'vue';
import { api } from '../boot/axios'

export default defineComponent({
  name: 'MainLayoutRestaurants',

  components: {
    EssentialLink
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
      await api.post('admin/restaurant/logout');
      this.$router.push('/');
    }
  },

  created() {
    if(  this.user) {
      console.log('got user', this.user.name)
    }

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
