<template>
  <div v-if="true">
    Hello from orders list...

    <table>
      <tr>
        <th>ID</th>
        <th>Total Price</th>
        <th>Total Quantity</th>
        <th>View</th>
      </tr>
      <tr v-for="order in orders" :key="order.id">
        <td>{{ order.id }}</td>
        <td>{{ order.total_price }}</td>
        <td>{{ order.total_quantity }}</td>
        <td>Edit</td>
      </tr>
    </table>
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import { echo } from '../../../boot/laravel-echo';

export default defineComponent({
  name: 'List',
  components: {  },

  data() {
    return {
      orders: [] as any
    }
  },

  computed: {
    user() {
      return this.$store.getters['restaurantUser/getUser'];
    },
  },

  methods: {

  },

  created() {
    echo.channel('testPrivate.33').listen(`TestPrivate`, (result: any) => {
      console.log('order is1', result)
      // this.orders.push(result.orderProducts.original.orderDetails);
      // console.log('this.orders is', this.orders)
    })

     echo.channel(`private-testPrivate.33`).listen(`TestPrivate`, (result: any) => {
      console.log('order is2', result)
      // this.orders.push(result.orderProducts.original.orderDetails);
      // console.log('this.orders is', this.orders)
    })
  },

  mounted() {
    let restaurantId = this.$route.params.restaurantId;
    console.log('user is', this.user)
  }

});
</script>

<style scoped>

</style>
