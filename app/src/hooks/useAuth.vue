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
  let modalTitle = ref('');

  const toggleAuthModal = (action: string) => {
    console.log('action', action)
    modalTitle.value = action;
    modalOpened.value = !modalOpened.value;
    store.dispatch('axios/clearErrors');
  }

  const authenticate = async (action: string) => {
    console.log('action is', action)
    const data = {
      email: formData?.email.value,
      password: formData?.password.value
    }

    if(action == API_PATHS.LOGIN) {
      await post(API_PATHS.LOGIN, data);
    } else {
      console.log('register new user...')
      await post(API_PATHS.REGISTER, data);
    }

    await store.dispatch('user/getUser');
  }

  let user: ComputedRef<UserType> = computed(() => {
    return store.getters['user/getUser'];
  });

  return {
    modalOpened,
    toggleAuthModal,
    authenticate,
    user,
    modalTitle
  };

}
</script>
