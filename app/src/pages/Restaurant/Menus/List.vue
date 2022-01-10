<template>
  <div v-if="menus && menus.length" class="dashboard">

    Manage your menus

  </div>
</template>

<script lang="ts">

import { defineComponent } from 'vue'

export default defineComponent({
  name: 'List',
  components: {  },

  data() {
    return {

    }
  },

  computed: {
    menus(){
      return null;
    }
  },

  methods: {

  },

  created() {

  }

});
</script>

<style scoped>

</style>
