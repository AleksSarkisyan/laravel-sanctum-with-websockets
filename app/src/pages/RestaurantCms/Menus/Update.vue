<template>
  <div>
    <div class="menu">

      <h3>Update a menu</h3>

      <form class="ui-form">
          <label for="name">Name</label>
          <input
            type="text"
            placeholder="Name"
            autocomplete="off"
            v-model="updateMenuFormData.name"
            id="name"
          />

          <!-- <span v-if="axiosErrors.message && axiosErrors.errors.email[0]"> {{ axiosErrors.errors.email[0] }} </span> -->
          <label for="description">Description</label>
          <input
            type="text"
            placeholder="Description"
            autocomplete="off"
            v-model="updateMenuFormData.description"
            id="description"
          />
          <!-- <span v-if="axiosErrors.message && axiosErrors.errors.password[0]"> {{ axiosErrors.errors.password[0] }} </span> -->

          <q-btn
            color="primary"
            @click="updateMenu()"
            :label="btnLabel"
          />
      </form>

    </div>

     <div class="products">
        <h4>Choose Products for {{ updateMenuFormData.name }} </h4>

        <div v-for="(category, value, index) in products" :key="`category-${index}`" class="q-pa-md">
          <h5 class="category-name">{{ value }}</h5>
          <hr>
          <div v-for="product in category" :key="product.id">
            {{ product.name }} ( {{ product.weight }} gr - {{ product.price }} lv )
             <input
                left-label
                :label="product.name"
                type="checkbox"
                placeholder="Description"
                autocomplete="off"
                v-model="menu.products" :id="'product_' + product.id" :value="product.id"
              />
          </div>

        </div>

        <q-btn
          :disabled="menu.products.length == 0"
          color="primary"
          @click="saveMenu()"
          :label="btnLabelSaveMenu"
        />
      </div>
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import { api } from '../../../boot/axios';
import { API_PATHS } from '../../../components/models';

export default defineComponent({
  name: 'Update',
  components: {  },

  data() {
    return {
      updateMenuFormData: {
        name: '',
        description: '',
        isActive: 1
      },
      btnLabel: 'Update menu',
      btnLabelSaveMenu: 'Save Products To Menu',
      products: {},
      menu: {
        products: [

        ]
      }
    }
  },

  computed: {

  },

  methods: {
    async updateMenu() {
      let result = await api.post(`${API_PATHS.RESTAURANT_CMS_PATH}/menu/update`, { ...this.updateMenuFormData });
    },

    async saveMenu() {
      let menuId = this.$route.params.menuId;
      let productItems = { ...this.menu.products }
      await api.post(`${API_PATHS.RESTAURANT_CMS_PATH}/menu/save`, { params: { menuId, productItems } });
    }
  },

  async mounted() {
    if (!this.$route.params.menuId) {
      this.$router.push('/restaurant/dashboard')
    }

    let menuId = this.$route.params.menuId;
    let menu = await api.get(`${API_PATHS.RESTAURANT_CMS_PATH}/menu/get`, { params: { menuId } });

    this.products = menu.data.products
    this.updateMenuFormData = { ...menu.data.menu }
    this.menu.products = menu.data.productItems;
  },


});
</script>

<style scoped>
  h5 {
    margin: 0;
  }
  hr {
    margin-bottom: 10px;
  }
</style>
