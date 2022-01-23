<template>
  <div>
    <Create />
    <div v-if="menus && menus.length" class="menu-list">

      <h3>Manage your menus - {{ menus.length }}</h3>
      <table>
        <tr>
          <th>ID</th>
          <th>Menu Name</th>
          <th>Description</th>
          <th>Is Active</th>
          <th>Edit</th>
        </tr>
        <tr v-for="menu in menus" :key="menu.id">
          <td>{{ menu.id }}</td>
          <td>{{ menu.name }}</td>
          <td>{{ menu.description }}</td>
          <td>{{ menu.is_active ? 'Active' : 'Inactive' }}</td>
          <td @click="editMenu(menu.id)">Edit</td>
        </tr>
      </table>

    </div>
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import Create from './Create.vue';

export default defineComponent({
  name: 'List',
  components: {
    Create
  },

  data() {
    return {

    }
  },

  computed: {
    menus(){
      return this.$store.getters['menus/getAllById'];;
    }
  },

  methods: {
    async getMenus() {
      await this.$store.dispatch('menus/getAllById');
    },
    editMenu(id: number) {
      this.$router.push(`/restaurant/menu/update/${id}`);
    }
  },

  async mounted() {
    await this.getMenus();
  }

});
</script>

<style scoped>

</style>
