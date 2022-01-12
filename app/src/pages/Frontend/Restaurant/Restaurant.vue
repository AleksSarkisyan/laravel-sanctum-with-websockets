<template>
  <div class="restaurants" v-if="Object.keys(restaurants).length !== 0">

    <div class="content"
      v-for="restaurant in restaurants"
      :key="restaurant.id"
    >
      <RestaurantList :restaurant="restaurant" :user="{ ...user }" />
    </div>

  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue'
import RestaurantList  from "../../../components/Restaurant/RestaurantList.vue";
import useAxios from '../../../hooks/useAxios.vue';

const { get } = { ...useAxios()};

export default defineComponent({
  name: 'Restaurant',
  components: { RestaurantList },

  data() {
    return {
      restaurants: { }
    }
  },

  computed: {
    user() {
      return this.$store.getters['user/getUser'];
    }
  },

  methods: {
    async getRestaurants() {
      let result = await get('restaurants')
      return result?.data.restaurants;
    }
  },

  async mounted() {
    this.restaurants = await this.getRestaurants();
  }
});
</script>

<style scoped>
.content {
  display: flex;
  justify-content: center;
  margin-bottom: 10px;
}
</style>
