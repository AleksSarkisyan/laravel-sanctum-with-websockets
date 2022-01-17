<template>
  <div v-if="true">
    Hello from orders list...
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

  },

  methods: {

  },

  mounted() {

  }

});
</script>

<style scoped>

</style>
