<template>
  <div class="form-container">

    <h3>{{ labels.page }}</h3>

    <form class="ui-form">
      <input
        type="text"
        placeholder="Name"
        autocomplete="off"
        v-model="createCategoryFormData.name"
      />
      <input
        type="text"
        placeholder="Description"
        autocomplete="off"
        v-model="createCategoryFormData.description"
      />
      <q-btn
        color="primary"
        @click="createCategory()"
        :label="labels.btnLabel"
      />
    </form>

  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import { api } from '../../../boot/axios'
import { RestaurantCategoryRoutes } from '../../../models/ApiPaths';
import { Emits } from '../../../models/Shared';
import { CreateCategoryComponentData } from '../../../models/Category';

export default defineComponent({
  name: 'Create',
  components: {  },

  data(): CreateCategoryComponentData {
    return {
      createCategoryFormData: {
        name: '',
        description: ''
      },
    }
  },

  computed: {
    labels() {
      return {
        page: 'Create a category',
        btnLabel: 'Create category'
      }
    }
  },

  emits: [Emits.CATEGORY_CREATED],

  methods: {
    async createCategory() {
      try {
        await api.post(
          `${RestaurantCategoryRoutes.CREATE}`,
          { ...this.createCategoryFormData }
        );

        this.$emit(Emits.CATEGORY_CREATED)
      } catch (error) {
        console.log('got error', error)
      }
    }
  },

});
</script>

<style scoped>

</style>
