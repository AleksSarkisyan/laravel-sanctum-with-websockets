<template>
  <div v-if="restaurantAuthModalOpened" class="modal-window">
    <div class="box">
      <form class="ui-form">
        <h4 v-if="modalTitle" class="title">{{ modalTitle }}</h4>
        <input
          type="email"
          placeholder="Email"
          autocomplete="off"
          v-model="formData.email"
        />
        <!-- <span v-if="axiosErrors.message && axiosErrors.errors.email[0]"> {{ axiosErrors.errors.email[0] }} </span> -->
        <input
          type="password"
          placeholder="Password"
          autocomplete="off"
          v-model="formData.password"
        />
        <!-- <span v-if="axiosErrors.message && axiosErrors.errors.password[0]"> {{ axiosErrors.errors.password[0] }} </span> -->

        <input
          type="text"
          placeholder="Restaurant Name"
          autocomplete="off"
          v-model="formData.restaurantName"
        />
        <!-- <span v-if="axiosErrors.message && axiosErrors.errors.name[0]"> {{ axiosErrors.errors.name[0] }} </span> -->

        <input
          type="text"
          placeholder="User Name"
          autocomplete="off"
          v-model="formData.name"
        />
        <!-- <span v-if="axiosErrors.message && axiosErrors.errors.name[0]"> {{ axiosErrors.errors.name[0] }} </span> -->

        <input
          type="text"
          placeholder="City"
          autocomplete="off"
          v-model="formData.city"
        />
        <!-- <span v-if="axiosErrors.message && axiosErrors.errors.city[0]"> {{ axiosErrors.errors.city[0] }} </span> -->

        <p class="danger" v-if="axiosErrors"> {{ axiosErrors }} </p>

        <q-btn
          color="primary"
          @click="closeRestaurantRegistrationModal"
          label="Close"
        />
        <q-btn
          color="primary"
          @click="restaurantRegistration()"
          :label="modalTitle"
        />
    </form>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'RestaurantRegistrationForm',
  props: {
    restaurantAuthModalOpened: {
      default: false,
      required: true,
      type: Boolean
    },

  },

  data() {
    return {
      formData: {
        email: '',
        password: '',
        restaurantName: '',
        name: '',
        city: '',
      },
      modalTitle: 'Restaurant Registration '
    }
  },

  emits: ['closeRestaurantRegistrationModal', 'restaurantRegistration'],

  methods: {
    closeRestaurantRegistrationModal() {
      this.$emit('closeRestaurantRegistrationModal');
    },
    restaurantRegistration() {
      this.$emit('restaurantRegistration', this.formData);
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
.title {
  color: #000;
}
</style>
