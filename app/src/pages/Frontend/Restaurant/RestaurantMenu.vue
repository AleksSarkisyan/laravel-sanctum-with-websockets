<template>
   <div class="q-pa-md">
    <div v-if="orderDetails.confirmed" class="modal-window">
      <div class="box">
        Your order from {{ orderDetails.restaurantName }} is confirmed.
        <div>
          <q-btn
            color="primary"
            @click="closeConfirmOrderModal()"
            label="OK"
          />
        </div>
      </div>
    </div>
    <div v-if="orderCreatedModalShown" class="modal-window">
      <div class="box">
        Thanks for your order. Stay on this page in order to receive a notification when a restaurant confirms your order.
        <div>
          <q-btn
            color="primary"
            @click="closeOrderCreatedModal()"
            label="OK"
          />
        </div>
      </div>
    </div>
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

        <div v-for="product in cartProducts" :key="product.id" class="cart">
          <div class="product">
            <span> {{product.quantity }} -  {{ product.name }}</span>
            <span>{{ product.summedPrice ? product.summedPrice : 0 }} lv</span>
          </div>
        </div>

        <hr />
        <div class="total-price">
          <span>Total Quantity</span>
          <span>{{ getTotalCartQuantity }}</span>
          |
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
import { echo, options } from '../../../boot/laravel-echo';
import Echo from 'laravel-echo';
import { SuccessResponse } from '../../../models/Shared';
import { OrderConfirmed } from '../../../models/Order';
import { RestaurantModel } from '../../../models/Restaurant';
import { ProductData } from '../../../models/Product';
import { OrderRoutes } from '../../../models/ApiPaths';

export default defineComponent({
  name: 'RestaurantMenu',
  components: {  },

  data() {
    return {
      restaurant: { } as RestaurantModel,
      restaurantMenu: { },
      tab: '',
      cartDrawerOpen: true,
      echoInstance: echo,
      orderDetails: { } as OrderConfirmed,
      orderCreatedModalShown: false
    }
  },

  computed: {
    user() {
      return this.$store.getters['user/getUser'];
    },

    cartProducts() {
      return this.$store.getters['cart/getCartProducts'];
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

    addToCart(product: ProductData) {
      this.$store.dispatch('cart/addToCart', { ...product })
    },

    clearCart() {
      this.$store.dispatch('cart/clearCart');
    },

    async submitOrder() {
      let orderResult: SuccessResponse = await api.post(OrderRoutes.ADD);

      if(orderResult.data.success) {
        this.clearCart();
        this.closeOrderCreatedModal();
      }
    },

    closeConfirmOrderModal() {
      this.orderDetails.confirmed = !this.orderDetails.confirmed;
    },

    closeOrderCreatedModal() {
      this.orderCreatedModalShown = !this.orderCreatedModalShown
    }
  },

  created() {
    this.echoInstance = new Echo(options);
    this.restaurant = this.$route.params as never;

    /** If we have the id this means that the user has navigated away from a restaurant menu, so I clear the cart. Don't want to clear it if user just reloads the page */
    if (this.restaurant.id) {
      this.clearCart()
    }
  },

  async mounted() {
    await this.getRestaurantMenu();
    this.echoInstance.channel(`private-orderConfirmed.${this.user.id}`).listen(`OrderConfirmed`, (result: OrderConfirmed) => {
      this.orderDetails = result;
    })
  },

  unmounted() {
    this.echoInstance.channel(`private-orderConfirmed.${this.user.id}`).stopListening('OrderConfirmed');
    this.echoInstance.leaveChannel(`private-orderConfirmed.${this.user.id}`);
  }
});
</script>

<style scoped>

</style>
