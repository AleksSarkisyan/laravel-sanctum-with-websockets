<template>
  <div>
    <Create @categoryCreated="onCategoryCreated" />
    <div v-if="categories && categories.length" class="category-list">

      <h3>Manage categories - {{ categories.length }}</h3>
      <table>
        <tr>
          <th>ID</th>
          <th>Category Name</th>
          <th>Description</th>
        </tr>
        <tr v-for="category in categories" :key="category.id">
          <td>{{ category.id }}</td>
          <td>{{ category.name }}</td>
          <td>{{ category.description }}</td>
        </tr>
      </table>

    </div>
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import { api } from '../../../boot/axios';
import { API_PATHS } from '../../../models/ApiPaths';
import Create from './Create.vue';

export default defineComponent({
  name: 'List',
  components: {
    Create
  },

  data() {
    return {
      categories: []
    }
  },

  computed: {

  },

  methods: {
    async getCategories() {
      let result = await api.get(API_PATHS.RESTAURANT_ALL_CATEGORIES);
      this.categories = result.data.categories
    },

    onCategoryCreated() {
      this.getCategories();
    }
  },

  async mounted() {
    await this.getCategories();
  }

});
</script>

<style scoped>

</style>
