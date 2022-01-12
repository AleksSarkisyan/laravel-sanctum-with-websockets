<template>
  <div v-if="hasRestaurants">
    <div class="dashboard row">
      <div v-for="restaurant in user.restaurants" :key="restaurant.id" class="q-pa-md items-start q-gutter-md col-6">
        <q-card class="my-card">
          <img src="https://cdn.quasar.dev/img/mountains.jpg">

          <q-card-section>
            <div class="text-h6">Name: {{ restaurant.name }}</div>
            <div class="text-subtitle2">City: {{ restaurant.city }}</div>
            <q-btn
              color="primary" label="Manage"
              @click="manageRestaurant(restaurant.id)"
            />
          </q-card-section>

          <q-card-section class="q-pt-none">
            {{ lorem }}
          </q-card-section>
        </q-card>
      </div>
    </div>
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Dashboard',
  components: {  },

  data() {
    return {

    }
  },

  computed: {
    user() {
      return this.$store.getters['restaurantUser/getUser'];
    },

    hasRestaurants(): string {
      return this.user.name;
    }
  },

  methods: {
    manageRestaurant(id: number){
      this.$router.push(`/restaurant/edit/${id}`)
    }
  },

});
</script>

<style scoped>
.dashboard {
  display: flex;
}

.total-restaurants {
  padding-left: 15px;
}
</style>
