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
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Form',
  components: {  },
  data() {
    return {
      menuFormData: {
        name: '',
        description: '',
        isActive: 1
      },
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

  emits: ['updateMenu', 'createMenu'],

  methods: {
    submitMenu() {
      console.log('formType', this.formType)

      if (this.isUpdateForm) {
        this.$emit('updateMenu', this.menuFormData)
      } else {
        this.$emit('createMenu', this.menuFormData)
      }
    }
  },

  mounted() {
    console.log('this.menuFields..', this.menuFields)
    this.menuFormData = { ...this.menuFields }
  }

});
</script>

<style scoped>

</style>
