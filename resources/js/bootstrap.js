import axios from 'axios';
window.axios = axios;

axios.defaults.baseURL = 'https://172.31.176.49/ect/public';

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';