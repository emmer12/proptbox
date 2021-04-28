import axios from 'axios';
const mode = 'production'
let dev='http://127.0.0.1:8000/api/v1'
let production= 'https://proptybox.com/api/v1' 
// 
const api = axios.create({
  baseURL:production
});


api.interceptors.request.use(function(config){
  const tokens = localStorage.getItem('token')
  if (tokens) {
    config.headers.Authorization=`Bearer ${tokens}`
  } else{
    config.headers.Authorization=null
  }
   return config;
  
})
export default api;

