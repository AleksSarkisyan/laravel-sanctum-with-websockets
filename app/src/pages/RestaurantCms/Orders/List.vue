<template>
  <div v-if="true">
    Hello from orders list...
  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue';
import Echo from 'laravel-echo';
import { echo } from '../../../boot/laravel-echo-js';


export default defineComponent({
  name: 'List',
  components: {  },

  data() {
    return {
      orders: [] as any
    }
  },

  computed: {

  },

  methods: {

  },

  mounted() {
    //const echo = new Echo;
   // echo
    console.log('got mounted...')
    echo.channel('orders').listen('OrderCreated', (result: any) => {
      this.orders = result;
      console.log('this.orders...', this.orders)
    })

  }

});
</script>

<style scoped>

</style>
