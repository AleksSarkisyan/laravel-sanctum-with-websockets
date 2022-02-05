<template>
  <div class="form-container">

    <h3>Create a product</h3>

    <form class="ui-form">
      <input
        type="text"
        placeholder="Name"
        autocomplete="off"
        v-model="createProductFormData.name"
      />

      <q-select
        filled
        v-model="createProductFormData.category"
        :options="availableCategories"
        label="Select a category for this product"
        map-options
      />

      <input
        type="text"
        placeholder="Description"
        autocomplete="off"
        v-model="createProductFormData.description"
      />

      <input
        type="number"
        placeholder="Price"
        autocomplete="off"
        v-model="createProductFormData.price"
      />

      <input
        type="number"
        placeholder="Promo Price"
        autocomplete="off"
        v-model="createProductFormData.promoPrice"
      />

      <input
        type="number"
        placeholder="Weight"
        autocomplete="off"
        v-model="createProductFormData.weight"
      />

      <label style="text-align: left">Active
        <input
          type="checkbox"
          placeholder="Is Active ?"
          autocomplete="off"
          v-model="createProductFormData.isActive"
        />
      </label>


      <q-btn
        color="primary"
        @click="createProduct()"
        :label="btnLabel"
      />
    </form>

  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import { api } from '../../../boot/axios'
import { API_PATHS } from '../../../models/ApiPaths';

import { Category, AvailableCategories } from '../../../models/Category';

export default defineComponent({
  name: 'Create',
  components: {  },

  data() {
    return {
      createProductFormData: {
        name: '',
        category: null,
        description: '',
        price: null,
        promoPrice: null,
        weight: '',
        isActive: true
      },
      btnLabel: 'Create product',
      availableCategories: [] as AvailableCategories[]
    }
  },

  computed: {

  },

  emits: ['productCreated'],

  methods: {
    async createProduct() {
      try {
        await api.post(API_PATHS.RESTAURANT_CREATE_PRODUCT, { ...this.createProductFormData });
        this.$emit('productCreated')
      } catch (error) {
        console.log('got error', error)
      }
    }
  },

  created() {

  },

  async mounted() {
    let categories = await api.get(API_PATHS.RESTAURANT_ALL_CATEGORIES);

    if(categories.data.categories.length) {
      categories.data.categories.map((category: Category) => {
        this.availableCategories.push({
          label: category.name,
          value: category.id
        })
      });
    }
  }

});
</script>

<style scoped>

</style>
