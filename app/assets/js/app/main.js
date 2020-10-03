import axios from 'axios';
import componentRoutes from './routes';
import BaseComponent from './lib/BaseComponent';

window.axios = axios;

document.addEventListener('DOMContentLoaded', () => {
  (new BaseComponent()).startComponentRouting(componentRoutes);
});
