<template>
  <div class="restaurant-auth">
    <span @click="toggleRestaurantAuthModal()" class="hover">Own a Restaurant - Register here! </span>
    <RestaurantRegistrationForm
      :restaurantAuthModalOpened="restaurantAuthModalOpened"
      @closeRestaurantRegistrationModal="toggleRestaurantAuthModal"
      @restaurantRegistration="onRestaurantRegistration"
    />
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import RestaurantRegistrationForm from '../../../components/Auth/RestaurantRegistrationForm.vue';
import { api } from '../../../boot/axios';
import { RestaurantRegistrationModel } from '../../../components/models';


export default defineComponent({
  name: 'RestaurantRegistration',
  components: { RestaurantRegistrationForm },

  data(){
    return {
      restaurantAuthModalOpened: false
    }
  },

  methods: {
    toggleRestaurantAuthModal() {
      this.restaurantAuthModalOpened = !this.restaurantAuthModalOpened;
      this.$store.dispatch('axios/setErrors', '');
    },

    async onRestaurantRegistration(formData: RestaurantRegistrationModel) {
      try {
        await api.post('api/register-restaurant', { ...formData });
        this.$store.dispatch('axios/setErrors', '');

      } catch (error: any) {
        console.log('error is', error)
        this.$store.dispatch('axios/setErrors', error);
      }
    }
  }

});

</script>
