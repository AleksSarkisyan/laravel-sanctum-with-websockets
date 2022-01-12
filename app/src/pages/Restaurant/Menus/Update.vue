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
          <span v-for="product in category" :key="product.id">
            {{ product.name }}
             <input
                left-label
                :label="product.name"
                type="checkbox"
                placeholder="Description"
                autocomplete="off"
                v-model="menu.products" :id="'product_' + product.id" :value="product.id"
              /> |
          </span>

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
import { api } from '../../../boot/axios'

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
      let result = await api.post('admin/restaurant/menu/update', { ...this.updateMenuFormData });

      console.log('update result is', result)
    },

    async saveMenu() {
      console.log('this.menu.pro', { ...this.menu.products })
      let menuId = this.$route.params.menuId;
      let productIds = { ...this.menu.products }
      let saveMenu = await api.post('admin/restaurant/menu/save', { params: { menuId, productIds } });

      console.log('saveMenu result', { ...saveMenu })
    }
  },

  async mounted() {
    console.log('this.$route.params', this.$route.params.menuId)
    if (!this.$route.params.menuId) {
      this.$router.push('/restaurant/dashboard')
    }

    let menuId = this.$route.params.menuId;
    let menu = await api.get('admin/restaurant/menu/get', { params: { menuId } });

    console.log('menu is', menu)
    this.products = menu.data.products
    this.updateMenuFormData = { ...menu.data.menu }

    this.menu.products = menu.data.productIds;
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
