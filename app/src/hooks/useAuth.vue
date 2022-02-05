<script lang="ts">

import { ref, ComputedRef, computed } from 'vue';
import useAxios from '../hooks/useAxios.vue';
import { UserType, LoginFormData } from '../models/User';
import { useStore } from '../store/index';
import { useRouter } from 'vue-router';
import { API_PATHS } from '../models/ApiPaths';

export default function useAuth(formData: LoginFormData|null = null) {

  let modalOpened = ref(false);
  const store = useStore();
  const { post } = useAxios();
  let modalTitle = ref('');
  const router = useRouter();

  const toggleAuthModal = (action: string) => {
    modalTitle.value = action;
    modalOpened.value = !modalOpened.value;
    store.dispatch('axios/clearErrors');
  }

  const authenticate = async (action: string) => {
    const data = {
      email: formData?.email.value,
      password: formData?.password.value
    }

    if(action == API_PATHS.REGISTER) {
      await post(API_PATHS.REGISTER, data);
    }

    await post(API_PATHS.LOGIN, data);
    await store.dispatch('user/getUser');
  }

  let user: ComputedRef<UserType> = computed(() => {
    return store.getters['user/getUser'];
  });

  const logout = async () => {
    localStorage.removeItem('vuex');
    store.dispatch('user/resetUser');
    await post(API_PATHS.LOGOUT);
    router.push('/');
  }

  return {
    modalOpened,
    toggleAuthModal,
    authenticate,
    user,
    modalTitle,
    logout
  };

}
</script>
