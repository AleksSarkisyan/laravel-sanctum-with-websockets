<template>
  <q-layout view="lHh Lpr lFf">
    <div class="restaurant-login">
      <RestaurantLoginForm @restaurantLogin="onRestaurantLogin" />
    </div>
  </q-layout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import RestaurantLoginForm from '../../components/Auth/RestaurantLoginForm.vue';
import { api } from '../../boot/axios'


export default defineComponent({
  name: 'RestaurantLogin',
  components: { RestaurantLoginForm },
  props: {

  },
  data(){
    return {
      restaurantAuthModalOpened: false
    }
  },

  methods: {
    async onRestaurantLogin(loginFormData: any) {
      try {
        console.log('got loginFormData', loginFormData)

        // let result = await api.post('admin/restaurant/login', { ...loginFormData });
        // console.log('got result ==', result)

        this.$store.dispatch('restaurantUser/getUser', { ...loginFormData })
        this.$router.push({ path: '/restaurant/dashboard' });
        // this.$router.push('/restaurant/dashboard');

      } catch (error) {
        console.log('restaurant login error -', error)
      }
    }
  },

  computed: {

  },

  created() {
    console.log('from RestaurantLogin...')
  }


});

</script>

