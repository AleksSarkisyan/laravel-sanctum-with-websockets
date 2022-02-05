<template>
  <div class="">
    <form class="ui-form">
      <label for="name">Name</label>
      <input
        type="text"
        placeholder="Name"
        autocomplete="off"
        v-model="menuFormData.name"
        id="name"
      />
      <label for="description">Description</label>
      <input
        type="text"
        placeholder="Description"
        autocomplete="off"
        v-model="menuFormData.description"
        id="description"
      />
      <q-btn
        color="primary"
        @click="submitMenu()"
        :label="btnLabel"
      />
    </form>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Emits } from '../../models/Shared';
import { MenuFormComponentData } from '../../models/Menu';

export default defineComponent({
  name: 'Form',
  components: {  },
  data(): {
    menuFormData: MenuFormComponentData
  } {
    return {
      menuFormData: {
        name: '',
        description: '',
        isActive: 1
      } as MenuFormComponentData,
    }
  },

  computed: {
    btnLabel() {
      return this.formType == 'Update' ? 'Update menu' : 'Create menu';
    },
    isUpdateForm() {
      return this.formType == 'Update';
    },
  },

  props: {
    formType: {
      type: String
    },
    menuFields: {
      type: Object
    }
  },

  emits: [Emits.CREATE_MENU, Emits.UPDATE_MENU],

  methods: {
    submitMenu() {
      if (this.isUpdateForm) {
        this.$emit(Emits.UPDATE_MENU, this.menuFormData)
      } else {
        this.$emit( Emits.CREATE_MENU, this.menuFormData)
      }
    }
  },

  mounted() {
    this.menuFormData = { ...this.menuFields } as MenuFormComponentData
  }

});
</script>

<style scoped>

</style>
