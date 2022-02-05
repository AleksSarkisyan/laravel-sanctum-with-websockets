<template>
  <div class="form-container">

    <h3>{{ labels.page }}</h3>
    <Form
      :formType="'Create'"
      :menuFields="menuFields"
      @createMenu="createMenu"
    />

  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import { api } from '../../../boot/axios'
import Form from '../../../components/Menu/Form.vue';
import { RestaurantMenuRoutes } from '../../../models/ApiPaths';
import { MenuFormComponentData } from '../../../models/Menu';

export default defineComponent({
  name: 'Create',
  components: {
    Form
  },

  data() {
    return {
      menuFields: {
        name: '',
        description: '',
        isActive: 1
      } as MenuFormComponentData,
    }
  },

  computed: {
    labels() {
      return {
        page: 'Create a menu'
      }
    }
  },

  methods: {
    async createMenu(menuFormData: MenuFormComponentData) {
      try {
        let result = await api.post(
          `${RestaurantMenuRoutes.CREATE}`,
          { ...menuFormData }
        );
        let menuId = result.data.result.id;

        this.$router.push({
          name: 'updateMenu',
          params: { menuId }
        });
      } catch (error) {
        console.log('got error', error)
      }
    }
  }

});
</script>

<style scoped>

</style>
