import axios from 'axios';
import routes from './routes';
import { id, modal } from './utils';

const CHANGE_LANG_URL = '/change-language';

document.addEventListener('DOMContentLoaded', () => {
  Object.keys(routes).forEach((route) => {
    if (window.location.pathname.startsWith(route)) {
      routes[route].init();
    }
  });

  id('change-language-trigger').onclick = () => modal.open(id('lang-block'));

  document.querySelectorAll('.choose-language-block ul li').forEach((item) => {
    item.onclick = function () {
      const { lang } = this.dataset;
      axios.post(CHANGE_LANG_URL, { lang })
        .then(() => window.location.reload());
    }
  })
});