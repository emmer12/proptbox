import axios from 'axios';
const mode = 'production'
// 'http://127.0.0.1:8000/api'
// 'http://proptybox.com.ng/api' 
// 
const api = axios.create({
  baseURL:'https://proptybox.com.ng/api'
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
