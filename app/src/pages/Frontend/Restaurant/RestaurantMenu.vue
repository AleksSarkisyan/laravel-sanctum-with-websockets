<template>
   <div class="q-pa-md">
    <q-drawer
      v-if="getTotalCartPrice > 0"
      side="right"
      v-model="cartDrawerOpen"
      show-if-above
      bordered
    >
      <q-list>
        <q-item-label
          header
        >
          Products
        </q-item-label>

        <div v-for="product in cartProducts" :key="product.data.id" class="cart">
          <div class="product">
            <span> {{product.data.quantity }} -  {{ product.data.name }}</span>
            <span>{{ product.data.summedPrice ? product.data.summedPrice : 0 }} lv</span>
          </div>
        </div>

        <hr />
        <div class="total-price">
          <span>Total Price</span>
          <span>{{ getTotalCartPrice }} lv</span>
        </div>

        <q-btn @click="clearCart()" flat color="primary">
          clear
        </q-btn>

        <q-btn @click="submitOrder()" flat color="primary">
          Submit
        </q-btn>

      </q-list>
    </q-drawer>
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
                    <q-btn :disabled="!user.name" @click="addToCart(product)" flat color="primary">
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
      restaurant: { } as any,
      restaurantMenu: { },
      tab: '',
      cartDrawerOpen: true,
    }
  },

  computed: {
    user() {
      return this.$store.getters['user/getUser'];
    },

    cartProducts() {
      return this.$store.getters['cart/getCart'];
    },

    getProductItems() {
      return this.$store.getters['cart/getProductItems'];
    },
    getTotalCartPrice() {
      return this.$store.getters['cart/getTotalCartPrice'];
    },
    getTotalCartQuantity() {
      return this.$store.getters['cart/getTotalCartQuantity']
    }
  },

  methods: {
    async getRestaurantMenu() {
      let menu = await api.post('restaurants/get-menu', { params: { ...this.restaurant } });
      this.restaurantMenu = { ...menu.data.menu }
      this.tab = menu.data.firstCategory
    },

    addToCart(product: any) {
      this.$store.dispatch('cart/updateCart', { ...product })
      this.getCartDetails(product)
    },

    clearCart() {
      this.$store.dispatch('cart/clearCart');
    },

    getCartDetails(product: any) {
      this.getProductItems.find((item: any) => {
        if( item.id == product.id) {
          let updateData = {
            id: product.id,
            quantity: item.quantity,
            summedPrice:  item.summedPrice
          }
          this.$store.dispatch('cart/updateCartProduct', updateData)
        }
      });
    },
    async submitOrder() {
      let data = {
        restautant: this.restaurant,
        totalCartQuantity: this.getTotalCartQuantity,
        totalCartPrice: this.getTotalCartPrice,
        productItems: {...this.getProductItems}
      }

      let orderResult: any = await api.post('order/add', { params: data });

      if(orderResult.data.success) {
        this.clearCart();
        console.log('Thanks for your order.')
      }
    }
  },

  created() {
    this.restaurant = this.$route.params;

    /** If we have the id this means that the user has navigated away from a restaurant menu, so I clear the cart. Don't want to clear it if user just reloads the page */
    if (this.restaurant.id) {
      this.clearCart()
    }
  },

  async mounted() {
    await this.getRestaurantMenu();

  }
});
</script>

<style scoped>

</style>
