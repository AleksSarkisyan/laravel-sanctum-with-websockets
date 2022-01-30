<template>
  <div>
    <div class="form-container">
      <h3>{{ labels.page }}</h3>
      <Form
        v-if="menuFields.name"
        :formType="'Update'"
        :menuFields="menuFields"
        @updateMenu="updateMenu"
      />
    </div>

     <div class="products">
        <h4>{{ labels.products }} {{ menuFields.name }} </h4>

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
          @click="saveMenuProducts()"
          :label="labels.btnSaveMenu"
        />
      </div>
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import { api } from '../../../boot/axios';
import { RestaurantMenuRoutes, MenusType, MenuProducts, Product, MenuFormComponentData } from '../../../components/models';
import Form from '../../../components/Menu/Form.vue';

export default defineComponent({
  name: 'Update',
  components: {
    Form
  },

  data() {
    return {
      menuFields: {
        name: '',
        description: '',
        isActive: 1
      } as MenusType,
      products: { } as Product,
      menu: {
        products: [

        ]
      } as MenuProducts,
      menuId: ''
    }
  },

  computed: {
    labels() {
      return {
        products: 'Choose Products for',
        page: 'Update a menu',
        btnSaveMenu: 'Save Products To Menu',
      }
    }
  },

  methods: {
    async updateMenu(menuFormData: MenuFormComponentData) {
      this.menuFields.name = menuFormData.name
      await api.post(
        `${RestaurantMenuRoutes.UPDATE}`,
        { params: { ...menuFormData } }
      );
    },

    async saveMenuProducts() {
      let productItems = { ...this.menu.products }
      await api.post(
        `${RestaurantMenuRoutes.SAVE}`,
        { params: { menuId: this.menuId, productItems } }
      );
    }
  },

  async mounted() {
    this.menuId = <string>this.$route.params.menuId;

    if (!this.menuId) {
      this.$router.push({ name: 'dashboard'})
    }

    let menu = await api.get(
      `${RestaurantMenuRoutes.GET}`,
      { params: { menuId: this.menuId } }
    );

    this.products = menu.data.products
    this.menuFields = { ...menu.data.menu }

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
