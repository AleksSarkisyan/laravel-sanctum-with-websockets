<template>
  <div class="restaurant">

    <div v-if="availableMenus.length">
      <q-select
        filled
        v-model="selectedMenu"
        :options="availableMenus"
        label="Select a menu for this restaurant"
        map-options
      />

      <q-btn
        :disabled="!selectedMenu"
        color="primary"
        @click="updateRestaurant"
        label="Save Menu for this restaurant"
      />

    </div>
    <div v-else>You need to create a menu first.
      <p @click="redirect('/restaurant/menu/create')">Create one here</p>
    </div>

  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import { api } from '../../../boot/axios';
import { API_PATHS, MenusType, Restaurant, AvailableMenus } from '../../../components/models';

export default defineComponent({
  name: 'Edit',
  components: {  },

  data() {
    return {
      selectedMenu: { } as any,
      availableMenus: [] as AvailableMenus[],
      restaurant: { } as Restaurant
    }
  },

  computed: {
    menus() {
      return this.$store.getters['menus/getAllById'];
    }
  },

  methods: {
    async getMenus() {
      await this.$store.dispatch('menus/getAllById');
    },
    async updateRestaurant() {
      let restaurantId = this.$route.params.restaurantId;

      await api.post(`${API_PATHS.RESTAURANT_CMS_PATH}/update`, { params: { restaurantId, menuId: this.selectedMenu.value } });
    },
    async getRestaurant() {
      let restaurantId = this.$route.params.restaurantId;

      this.restaurant = await api.post(`${API_PATHS.RESTAURANT_CMS_PATH}/get`, { params: { restaurantId: restaurantId } });
      this.selectedMenu = this.restaurant.data.restaurant.menu_id
    },
    redirect(path: string) {
      this.$router.push(path);
    }
  },

  async mounted() {
    await this.getMenus();
    await this.getRestaurant()
    if(this.menus.length) {
      this.menus.map((menu: MenusType) => {
        this.availableMenus.push({
          label: menu.name,
          value: menu.id
        })
      });
    }
  }

});
</script>

<style scoped>

</style>
