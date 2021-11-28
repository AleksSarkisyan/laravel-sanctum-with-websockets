<script lang="ts">

import { ref, ComputedRef, computed } from 'vue';
import useAxios from '../hooks/useAxios.vue';
import { UserType } from '../components/models';
import { useStore } from '../store/index';

import { LoginFormData, API_PATHS } from '../components/models';

export default function useAuth(formData: LoginFormData|null = null) {

  let modalOpened = ref(false);
  const store = useStore();
  const { post } = useAxios();

  const toggleAuthModal = () => {
    modalOpened.value = !modalOpened.value;
    store.dispatch('axios/clearErrors');
  }

  const login = async () => {
    const data = {
      email: formData?.email.value,
      password: formData?.password.value
    }

    await post(API_PATHS.LOGIN, data);
    store.dispatch('user/getUser');
  }

  let user: ComputedRef<UserType> = computed(() => {
    return store.getters['user/getUser'];
  });

  return {
    modalOpened,
    toggleAuthModal,
    login,
    user
  };

}
</script>
