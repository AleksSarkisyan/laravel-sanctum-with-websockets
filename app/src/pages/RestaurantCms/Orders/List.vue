<template>
  <div>
    <div v-if="orders && orders.length">
      Your orders

      <table>
        <tr>
          <th>ID</th>
          <th>Total Price</th>
          <th>Total Quantity</th>
          <th>Username</th>
          <th>Created</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
        <tr v-for="order in orders" :key="order.id" :class="{ new: order.status == 'created' }">
          <td>{{ order.id }}</td>
          <td>{{ order.total_price }}</td>
          <td>{{ order.total_quantity }}</td>
          <td>{{ order.user.name }}</td>
          <td>{{ order.created_at }}</td>
          <td>{{ order.status }}</td>
          <td v-if="isNewOrder(order)" @click="confirmOrder(order)">Confirm order</td>
          <td v-else-if="isConfirmedOrder(order)">Confirmed</td>
        </tr>
      </table>
    </div>
    <div v-else>No orders yet</div>
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import { echo, options } from '../../../boot/laravel-echo';
import Echo from 'laravel-echo';
import { api } from '../../../boot/axios';
import { API_PATHS } from '../../../components/models';

export default defineComponent({
  name: 'List',
  components: {  },

  data() {
    return {
      orders: [] as any,
      restaurantId: null as any,
      echoInstance: echo
    }
  },

  computed: {
    user() {
      return this.$store.getters['restaurantUser/getUser'];
    }
  },

  methods: {
    async confirmOrder(order: any) {
      order.status = 'confirmed';
      await api.post(`${API_PATHS.CONFIRM_ORDER}`, { params: { orderId: order.id } });
    },

    isNewOrder(order: any) {
      return order.status == 'created' || !order.status;
    },

    isConfirmedOrder(order: any) {
      return order.status == 'confirmed';
    },
  },

  async mounted() {
    let orders = await api.get(`${API_PATHS.RESTAURANT_ORDERS}`, { params: { restaurantId: this.restaurantId } });
    this.orders = orders.data.orders.sort((a: any, b: any) => parseInt(b.id) - parseInt(a.id));

    this.echoInstance.channel(`private-orderCreated.${this.restaurantId}.${this.user.id}`).listen(`OrderCreated`, (result: any) => {
      this.orders.push(result.order.original.orderDetails)
      this.orders.sort((a: any, b: any) => parseInt(b.id) - parseInt(a.id));
    })
  },

  created() {
    /** Need to reinitialize Echo in case we navigate to a different restaurant, so that user doesn't get orders from other restaurants that he owns */
    this.echoInstance = new Echo(options);
    this.restaurantId = this.$route.params.restaurantId;
  },

  // unmounted() {
  //   this.echoInstance.channel(`private-testPrivateRestaurant.${this.restaurantId}.${this.user.id}`).stopListening('TestPrivateRestaurant');
  //   this.echoInstance.leaveChannel(`private-testPrivateRestaurant.${this.restaurantId}.${this.user.id}`);
  // }

});
</script>

<style scoped>
  .new {
    border: 2px solid green;
  }
</style>
