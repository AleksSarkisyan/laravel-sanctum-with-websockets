<template>

    <div v-if="modalOpened" class="modal-window">
      <div class="box">
        <form class="ui-form">
        <input
          type="email"
          placeholder="Email"
          autocomplete="off"
          v-model="email"
        />
        <span v-if="axiosErrors.message"> {{ axiosErrors.errors.email[0] }} </span>
        <input
          type="password"
          placeholder="Password"
          autocomplete="off"
          v-model="password"
        />
        <span v-if="axiosErrors.message"> {{ axiosErrors.errors.password[0] }} </span>
        <q-btn
          color="primary"
          @click="toggleAuthModal"
          label="Close"
        />

      <q-btn
        color="primary"
        @click="login"
        label="Login"
      />
      </form>
      </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, toRefs, ComputedRef, computed } from 'vue';
import { AxiosModel, LoginFormData } from '../../components/models';
import useAuth from '../../hooks/useAuth.vue';
import { useStore } from '../../store/index';

export default defineComponent({
  name: 'LoginForm',
  props: {
    modalOpened: {
      default: false,
      required: true,
      type: Boolean
    },
    toggleAuthModal: {
      default: false,
      type: Function
    }
  },
  setup(props) {
    const email = ref('');
    const password = ref('');
    const { modalOpened, toggleAuthModal } = toRefs(props);

    const formData: LoginFormData = {
      email,
      password
    }

    const { login } = useAuth(formData);
    const store = useStore();

    let axiosErrors: ComputedRef<AxiosModel> = computed(() => {
      return store.getters['axios/getAxiosErrors'];
    });

    return {
      email,
      password,
      modalOpened,
      toggleAuthModal,
      login,
      axiosErrors
    }
  }

});

</script>
