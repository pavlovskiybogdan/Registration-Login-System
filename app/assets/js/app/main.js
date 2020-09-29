import axios from 'axios';
import routes from './routes';
import { id, modal } from './utils';

window.axios = axios;

document.addEventListener('DOMContentLoaded', () => {
  Object.keys(routes).forEach((route) => {
    if (window.location.pathname.startsWith(route)) {
      routes[route].init();
    }
  });

  id('change-language-trigger').onclick = () => modal.open(id('lang-block'));

  document.querySelectorAll('.choose-language-block ul li').forEach((item) => {
    // eslint-disable-next-line no-param-reassign
    item.onclick = function onClick() {
      const { lang } = this.dataset;
      axios.post('/change-language', { lang })
        .then(() => window.location.reload());
    };
  });
});
