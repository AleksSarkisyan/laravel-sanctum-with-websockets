<template>
  <q-layout view="lHh Lpr lFf">
    <div class="restaurant-login">
      <RestaurantLoginForm @restaurantLogin="onRestaurantLogin" />
    </div>
  </q-layout>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import RestaurantLoginForm from '../../../components/Auth/RestaurantLoginForm.vue';
import { LoginFormData } from '../../../components/models';

export default defineComponent({
  name: 'RestaurantLogin',
  components: { RestaurantLoginForm },

  data(){
    return {
      restaurantAuthModalOpened: false
    }
  },

  methods: {
    async onRestaurantLogin(loginFormData: LoginFormData) {
      try {
        this.$store.dispatch('restaurantUser/getUser', { ...loginFormData })
        this.$router.push({ path: '/restaurant/dashboard' });
      } catch (error) {
        console.log('restaurant login error -', error)
      }
    }
  }

});

</script>

