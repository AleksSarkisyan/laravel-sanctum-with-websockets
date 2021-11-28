<script lang="ts">

import axios, { AxiosResponse } from 'axios';
import { useStore } from '../store/index';
import { AxiosCall, HTTP_METHODS } from '../components/models';

export default function useAxios() {

  const store = useStore();

  const call = async ( { method, path, data }: AxiosCall ): Promise<AxiosResponse|undefined> => {
    let url = 'http://127.0.0.1:8000/' + path;

    //process.env.MIX_API_URL
    //process.env.apiUrl ??

    try {
      const response = await axios({
        method,
        url,
        data
      });

      return response;
    } catch (error) {
      console.log('error --', error.response.data)

      if(error.response.data.message) {
        store.dispatch('axios/setErrors', error.response.data);
      }

      throw error;

    } finally {

    }

  };

  const get = async (path: string, data?: object | null) => {
    return await call({ method: HTTP_METHODS.Get, path, data });
  };

  const post = async (path: string, data?: object | null) => {
    return await call({ method: HTTP_METHODS.Post, path, data });
  };

  return {
    get,
    post
  };
}

</script>
