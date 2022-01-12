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
import { api } from '../../boot/axios';

export default defineComponent({
  name: 'Edit',
  components: {  },

  data() {
    return {
      selectedMenu: null as any,
      availableMenus: [] as any,
      restaurant: {} as any
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
      console.log('restaurantId', restaurantId)
      console.log('selectedMenu', this.selectedMenu.value)
      let restaurantMenu = await api.post('admin/restaurant/update', { params: { restaurantId, menuId: this.selectedMenu.value } });

      console.log('restaurantMenu result', restaurantMenu)
    },
    async getRestaurant() {
      let restaurantId = this.$route.params.restaurantId;

      this.restaurant = await api.post('admin/restaurant/get', { params: { restaurantId: restaurantId } });
      console.log('this.restaurant...', {...this.restaurant.data.restaurant})
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
      this.menus.map((menu: any) => {
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
