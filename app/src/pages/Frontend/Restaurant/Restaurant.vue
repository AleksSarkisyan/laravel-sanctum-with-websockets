<template>
  <div class="restaurants" v-if="Object.keys(restaurants).length !== 0">

    <div class="content"
      v-for="restaurant in restaurants"
      :key="restaurant.id"
    >
      <RestaurantList
        :restaurant="restaurant"
        :user="{ ...user }"
        @getMenu="onGetMenu"
      />
    </div>

  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue'
import RestaurantList  from "../../../components/Restaurant/RestaurantList.vue";
import useAxios from '../../../hooks/useAxios.vue';
import { UserType } from '../../../models/User';
import { RestaurantModel, RestaurantsModel } from '../../../models/Restaurant';

const { get } = { ...useAxios()};

export default defineComponent({
  name: 'Restaurant',
  components: { RestaurantList },

  data(): {
    restaurants: RestaurantsModel
  } {
    return {
      restaurants: { } as RestaurantsModel
     }
  },

  computed: {
    user(): UserType {
      return this.$store.getters['user/getUser'];
    }
  },

  methods: {
    async getRestaurants(): Promise<RestaurantsModel> {
      let result = await get('restaurants')
      return result?.data.restaurants;
    },
    async onGetMenu(restaurant: RestaurantModel) {
      this.$router.push({
        name: 'menu',
        path: `/menu/${restaurant.name}`,
        params:
        {  ...restaurant }
      })
    }
  },

  async mounted() {
    this.restaurants = await this.getRestaurants();
  }
});
</script>

<style scoped>

</style>
