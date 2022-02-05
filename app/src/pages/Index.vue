<template>
  <q-page class="row items-center justify-evenly">
    <example-component
      title="Example component"
      active
      :todos="todos"
      :meta="meta"
    ></example-component>
  </q-page>
</template>

<script lang="ts">
import { API_PATHS } from '../models/ApiPaths';
import ExampleComponent from '../components/CompositionComponent.vue';
import { defineComponent, onMounted } from 'vue'
import useAxios from '../hooks/useAxios.vue';
import useExample from '../hooks/useExample.vue';

export default defineComponent({
  name: 'PageIndex',
  components: { ExampleComponent },
  setup() {
    const { get } = useAxios();
    const { todos, meta } = useExample();

    const getCsrf = async () => {
      return await get(API_PATHS.SANCTUM_COOKIE)
    }

    onMounted(() => {
      getCsrf();
    })

    return {
      todos,
      meta
    };
  }
});
</script>
