import axios from 'axios';
import { App, Plugin } from 'vue';
import { useAppStore } from '@/stores/app';

const axiosPlugin = {
  install(app: App, options: any) {
    axios.defaults.baseURL = 'http://localhost/api/aibou';

    // request
    axios.interceptors.request.use((config: any) => {
      console.log('plugins');
      return config;
    });

    // response
    axios.interceptors.response.use(
      (response: any) => {
        if (response.data.message) {
          const store = useAppStore();
          store.addMessages({
            text: response.data.message,
            state: {
              color: 'success',
              timeout: 3000,
            },
          });
        }
        if (response.request.responseType == 'blob') {
          return response;
        }

        return response.data.data;
      },
      (error: any) => {
        const store = useAppStore();
        store.addMessages({
          text: 'エラー発生!',
          state: {
            color: 'error',
            timeout: 3000,
          },
        });
        if (error.response) {
          // サーバーからのエラーレスポンスを処理します
          const status = error.response.status;

          if (status === 401) {
            console.error('Unauthorized: ログインが必要です');
            // ログイン画面などにリダイレクトするなどの処理を追加することができます
          } else if (status === 404) {
            console.error('Not Found: ページが見つかりません');
          } else {
            console.error(`Error status: ${status}`);
            console.error('Error data:', error.response.data);
          }
        } else if (error.request) {
          // リクエストがサーバーに到達しなかった場合の処理をここに書きます
          console.error('No response received from the server');
        } else {
          // その他のエラー処理をここに書きます
          console.error('Error message:', error.message);
        }
        return Promise.reject(error);
      },
    );

    app.provide('axios', axios);
  },
};
export default axiosPlugin;
