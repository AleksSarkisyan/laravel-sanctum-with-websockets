<template>
  <div class="menu">

    <h3>Create a menu</h3>

    <form class="ui-form">
        <input
          type="text"
          placeholder="Name"
          autocomplete="off"
          v-model="createMenuFormData.name"
        />
        <!-- <span v-if="axiosErrors.message && axiosErrors.errors.email[0]"> {{ axiosErrors.errors.email[0] }} </span> -->
        <input
          type="text"
          placeholder="Description"
          autocomplete="off"
          v-model="createMenuFormData.description"
        />
        <!-- <span v-if="axiosErrors.message && axiosErrors.errors.password[0]"> {{ axiosErrors.errors.password[0] }} </span> -->

        <q-btn
          color="primary"
          @click="createMenu()"
          :label="btnLabel"
        />
    </form>

  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import { api } from '../../../boot/axios'
import { API_PATHS } from '../../../components/models';

export default defineComponent({
  name: 'Create',
  components: {  },

  data() {
    return {
      createMenuFormData: {
        name: '',
        description: '',
        isActive: 1
      },
      btnLabel: 'Create menu'
    }
  },

  computed: {

  },

  methods: {
    async createMenu() {
      try {
        let result = await api.post(`${API_PATHS.RESTAURANT_CMS_PATH}/menu/create`, { ...this.createMenuFormData });
        let menuId = result.data.result.id;
        this.$router.push(`/restaurant/menu/update/${menuId}`);
      } catch (error) {
        console.log('got error', error)
      }
    }
  },

  created() {

  }

});
</script>

<style scoped>

</style>
