<template>
  <div class="restaurant-list">
    <div class="restaurant-img">
      <img src="~assets/restaurant.png" alt="">
    </div>
    <div class="restaurant-item">
        <div class="content">
            <h3 class="name">{{ restaurant?.name }}</h3>
            <p class="info"> {{ restaurant?.city }}</p>
            <div class="btn-and-rating-box">
                <div class="rating">

                </div>
                <button
                  @click="getMenu(restaurant)"
                  class="btn"
                  :disabled="false">
                    View menu
                  </button>
            </div>
        </div>
    </div>
</div>
</template>
<script lang="ts">
import { defineComponent, PropType } from 'vue'
import { Emits, RestaurantModel } from '../models';

export default defineComponent({
  name: 'RestaurantList',

  props: {
    restaurant: {
      type: Object as PropType<RestaurantModel>
    }
  },

  emits: [Emits.GET_MENU],

  methods: {
    getMenu(restaurant: RestaurantModel) {
      this.$emit(Emits.GET_MENU, restaurant)
    }
  }

});
</script>

<style scoped>

</style>
