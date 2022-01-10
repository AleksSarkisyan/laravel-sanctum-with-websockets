<template>
  <div>
    <div class="box">
      <form class="restaurant-login-form">
        <h4 v-if="modalTitle" class="title">{{ modalTitle }}</h4>
        <div>
          <input
          type="email"
          placeholder="Email"
          autocomplete="off"
          v-model="formData.email"
        />
        </div>

      <div>
        <input
          type="password"
          placeholder="Password"
          autocomplete="off"
          v-model="formData.password"
        />
      </div>

        <p class="danger" v-if="axiosErrors"> {{ axiosErrors }} </p>

        <div>
          <q-btn
            color="primary"
            @click="goHome"
            label="Go to Homepage"
          />
        </div>
         <div>
        <q-btn
            color="primary"
            @click="restaurantLogin()"
            :label="modalTitle"
          />
        </div>
    </form>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'RestaurantRegistrationForm',
  props: {

  },

  data() {
    return {
      formData: {
        email: '',
        password: 'Test123!',
      },
      modalTitle: 'Restaurant Login'
    }
  },

  emits: ['restaurantLogin'],

  methods: {
    restaurantLogin() {
      this.$emit('restaurantLogin', this.formData);
    },

    goHome() {
      this.$router.push('/')
    }
  },

  computed: {
    axiosErrors() {
      return this.$store.getters['axios/getAxiosErrors']
    }
  },

});

</script>

<style scoped>
form {
  display: flex;
  flex-direction: column;
  height: 100%;
  text-align: center;
}

form div {
  padding-bottom: 10px;
}
</style>
