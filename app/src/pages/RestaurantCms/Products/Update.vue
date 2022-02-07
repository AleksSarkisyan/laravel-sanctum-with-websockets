<template>
  <div>
    <div class="form-container">

      <h3>Update a product</h3>

      <form class="ui-form">
        <input
          type="text"
          placeholder="Name"
          autocomplete="off"
          v-model="updateProductFormData.name"
        />

        <q-select
          filled
          v-model="selectedCategory"
          :options="availableCategories"
          label="Select a category for this product"
          map-options
        />

        <input
          type="text"
          placeholder="Description"
          autocomplete="off"
          v-model="updateProductFormData.description"
        />

        <input
          type="number"
          placeholder="Price"
          autocomplete="off"
          v-model="updateProductFormData.price"
        />

        <input
          type="number"
          placeholder="Promo Price"
          autocomplete="off"
          v-model="updateProductFormData.promoPrice"
        />

        <input
          type="number"
          placeholder="Weight"
          autocomplete="off"
          v-model="updateProductFormData.weight"
        />

        <label style="text-align: left">Active
          <input
            type="checkbox"
            placeholder="Is Active ?"
            autocomplete="off"
            v-model="updateProductFormData.isActive"
          />
        </label>

        <q-btn
          color="primary"
          @click="updateProduct()"
          :label="btnLabel"
        />
      </form>

    </div>
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import { api } from '../../../boot/axios';
import { API_PATHS } from '../../../models/ApiPaths';
import { Category, Categories, AvailableCategories } from '../../../models/Category';
import { ProductData } from '../../../models/Product';

export default defineComponent({
  name: 'Update',
  components: {  },

  data() {
    return {
      updateProductFormData: {
        name: '',
        category: null as Category | null,
        description: '',
        price: 0,
        promoPrice: 0,
        weight: '',
        isActive: false
      } as ProductData,
      btnLabel: 'Update product',
      selectedCategory: { } as AvailableCategories,
      availableCategories: [] as AvailableCategories[]
    }
  },

  methods: {
    async updateProduct() {
      try {
        if (this.updateProductFormData.category) {
          this.updateProductFormData.category.id = this.selectedCategory.value
          this.updateProductFormData.category.name = this.selectedCategory.label
        }

        await api.post(API_PATHS.RESTAURANT_UPDATE_PRODUCT, {  ...this.updateProductFormData });
        this.$router.push('/restaurant/products')
      } catch (error) {
        console.log(error)
      }
    },

  },

  watch:  {
    selectedCategory(newVal, _) {
      this.selectedCategory = newVal;
    }
  },

  async mounted() {
    let { productId, productName } = this.$route.params;
    let product = await api.get(API_PATHS.RESTAURANT_PRODUCT, { params: { productId, productName } });

    this.selectedCategory.label = product.data.product.category.name;
    this.selectedCategory.value = product.data.product.category.id;

    const { id, name, description, price, promo_price, weight, is_active, category } = { ...product.data.product } as ProductData;

    const data = {
      id,
      name,
      description,
      price,
      promoPrice: promo_price,
      weight,
      isActive: is_active  == 1 ? true : false,
      category
    }

    this.updateProductFormData = data;

    let categories: Categories = await api.get(API_PATHS.RESTAURANT_ALL_CATEGORIES);

    if(categories.data && categories.data.categories.length) {
      categories.data.categories.map((category: Category) => {
        this.availableCategories.push({
          label: category.name,
          value: category.id
        })
      });
    }
  },

});
</script>

<style scoped>

</style>
