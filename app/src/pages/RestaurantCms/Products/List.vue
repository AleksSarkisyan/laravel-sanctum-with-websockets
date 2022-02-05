<template>
  <div>
    <Create @productCreated="onProductCreated" />
    <div v-if="products && products.length" class="menu-list">

      <h3>Manage your products - {{ products.length }}</h3>
      <table>
        <tr>
          <th>ID</th>
          <th>Product Name</th>
          <th>Category</th>
          <th>Description</th>
          <th>Price</th>
          <th>Promo Price</th>
          <th>Weight</th>
          <th>Is Active</th>
          <th>Edit</th>
        </tr>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.id }}</td>
          <td>{{ product.name }}</td>
          <td>{{ product.category.name }}</td>
          <td>{{ product.description }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.promo_price }}</td>
          <td>{{ product.weight }}</td>
          <td>{{ product.is_active ? 'Active' : 'Inactive' }}</td>
          <td @click="editProduct(product.id, product.name)">Edit</td>
        </tr>
      </table>

    </div>
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import Create from './Create.vue';
import { api } from '../../../boot/axios'
import { API_PATHS } from '../../../models/ApiPaths';

export default defineComponent({
  name: 'List',
  components: {
    Create
  },

  data() {
    return {
      products: []
    }
  },

  computed: {

  },

  methods: {
    async getProducts() {
      let allProducts = await api.get(API_PATHS.RESTAURANT_ALL_PRODUCTS);
      this.products = allProducts.data.products;
    },
    onProductCreated() {
      this.getProducts();
    },
    editProduct(productId: number, productName: string) {
      this.$router.push(`/restaurant/product/update/${productId}/${productName}`);
    }
  },

  async mounted() {
    await this.getProducts();
  }

});
</script>

<style scoped>

</style>
