<template>
  <q-page class="row items-center justify-evenly">
    <example-component
      title="Example component"
      active
      :todos="todos"
      :meta="meta"
    ></example-component>
    <q-btn aria-label="login" label="login" @click="login"></q-btn>

    <q-btn aria-label="fetch user" label="fetch user" @click="fetchUser"></q-btn>

    <p v-if="theUser && theUser.name">Hi,  {{ theUser.name }}</p>

    <p>{{ testNumber }}</p>
  </q-page>
</template>

<script lang="ts">
import { Todo, Meta, LoginFormData } from '../components/models';
import ExampleComponent from '../components/CompositionComponent.vue';
import axios, { AxiosResponse } from 'axios';
import { User, UserType } from '../components/models';
import { defineComponent, ref, Ref } from 'vue'

export default defineComponent({
  name: 'PageIndex',
  components: { ExampleComponent },
  setup() {
    const testNumber: Ref<number> = ref(1987);
    let theUser: Ref<UserType> = ref({} as UserType);

    axios.get('http://127.0.0.1:8000/sanctum/csrf-cookie').then(result => {
      console.log('csrf result', result)
    });

    const formData: LoginFormData = {
      email: 'aleks@test.com',
      password: 'Test123!'
    }

    const login = () => {
       axios.post('http://127.0.0.1:8000/login', formData).then(result => {
        console.log('login result', result)
      });
    }

    const fetchUser = () => {
       axios.get('http://127.0.0.1:8000/api/user').then((result: AxiosResponse<User>) => {
        console.log('fetchUser result', result)
        theUser.value = result.data;

        console.log('theUser -', theUser)

      }).catch(err => {
        console.log('err -', err)
      });
    }

    const todos = ref<Todo[]>([
      {
        id: 1,
        content: 'ct1'
      },
      {
        id: 2,
        content: 'ct2'
      },
      {
        id: 3,
        content: 'ct3'
      },
      {
        id: 4,
        content: 'ct4'
      },
      {
        id: 5,
        content: 'ct5'
      }
    ]);
    const meta = ref<Meta>({
      totalCount: 1200
    });
    return { todos, meta, login, fetchUser, testNumber, theUser };
  }
});
</script>
