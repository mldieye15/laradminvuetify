import axios from 'axios';

window.axios = axios;

const defaultOptions = {
    baseURL: process.env.VUE_APP_BASE_API+'/app/',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      //'Accept-Language': lang,
      //'X-localization': lang
    }
};

let axiosInstance = axios.create(defaultOptions);

/*axiosInstance.interceptors.request.use(function (config) {
  const token = localStorage.getItem('token');
  console.log(token);
  config.headers.Authorization =  token ? `Bearer ${token}` : '';
  return config;
});*/

export default axiosInstance;