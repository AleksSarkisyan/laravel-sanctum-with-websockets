<template>
   <div class="q-pa-md">
    <div class="q-gutter-y-md" style="">
      <q-card>
        <q-tabs
          v-model="tab"
          dense
          class="text-grey"
          active-color="primary"
          indicator-color="primary"
          align="justify"
          narrow-indicator
        >
          <q-tab v-for="(value, name) in restaurantMenu" :key="name" :name="name" :label="name" />
        </q-tabs>

        <q-separator />

        <q-tab-panels v-model="tab" animated class="">
          <div v-for="(item, name) in restaurantMenu" :key="name" :name="name" :label="name" class="row menu">
            <q-tab-panel :name="name" class="row menu">
              <div class="q-pa items-start q-gutter menu-items">

                <q-card v-for="product in item" :key="product.id" class="menu-card">
                  <div class="menu-description">
                    <img src="https://cdn.quasar.dev/img/mountains.jpg">

                      <q-card-section>
                        <div class="text-h6 product-name">{{ product.name }}</div>
                        <div class="product-price">Price: {{ product.price }} lv</div>
                      </q-card-section>

                      <q-card-section class="q-pt-none">
                        {{ product.description }}
                      </q-card-section>
                  </div>
                  <q-card-actions>
                    <q-btn :disabled="!user.name" @click="addToCart()" flat color="primary">
                      Add to Cart
                    </q-btn>
                  </q-card-actions>

                </q-card>
              </div>
            </q-tab-panel>
          </div>
        </q-tab-panels>
      </q-card>
    </div>
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue'
import { api } from '../../../boot/axios';

export default defineComponent({
  name: 'RestaurantMenu',
  components: {  },

  data() {
    return {
      restaurant: { },
      restaurantMenu: { },
      testMenu: { } as any,
      tab: ''
    }
  },

  computed: {
    user() {
      return this.$store.getters['user/getUser'];
    }
  },

  methods: {
    async getRestaurantMenu() {
      let menu = await api.post('restaurants/get-menu', { params: { ...this.restaurant } });
      this.restaurantMenu = { ...menu.data.menu }
      this.tab = menu.data.firstCategory
    },
    async addToCart() {
      console.log('to do')
    }
  },
  created() {
    this.restaurant = this.$route.params;
  },

  async mounted() {
    await this.getRestaurantMenu();
  }
});
</script>

<style scoped>

</style>
