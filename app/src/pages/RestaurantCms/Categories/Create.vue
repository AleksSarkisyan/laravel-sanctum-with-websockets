<template>
  <div class="menu">

    <h3>Create a category</h3>

    <form class="ui-form">
        <input
          type="text"
          placeholder="Name"
          autocomplete="off"
          v-model="createCategoryFormData.name"
        />
        <!-- <span v-if="axiosErrors.message && axiosErrors.errors.email[0]"> {{ axiosErrors.errors.email[0] }} </span> -->
        <input
          type="text"
          placeholder="Description"
          autocomplete="off"
          v-model="createCategoryFormData.description"
        />
        <!-- <span v-if="axiosErrors.message && axiosErrors.errors.password[0]"> {{ axiosErrors.errors.password[0] }} </span> -->

        <q-btn
          color="primary"
          @click="createCategory()"
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
      createCategoryFormData: {
        name: '',
        description: ''
      },
      btnLabel: 'Create category'
    }
  },

  computed: {

  },

  emits: ['categoryCreated'],

  methods: {
    async createCategory() {
      try {
        await api.post(`${API_PATHS.RESTAURANT_CREATE_CATEGORY}`, { ...this.createCategoryFormData });

        this.$emit('categoryCreated')
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
