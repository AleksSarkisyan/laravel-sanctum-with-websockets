<template>
  <div v-if="user && user.email" class="dashboard">

    Logged in with email - {{ user.email }}
    <p>You have  {{ user.restaurants && user.restaurants.length }} restaurants </p>

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
    }
  },

  methods: {

  },

  created() {

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
