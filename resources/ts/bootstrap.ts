import axios, {AxiosInstance} from 'axios';

declare global {
    interface Window {
        axios: AxiosInstance
    }
}

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
