import VisualComponent from './VisualComponent';
import routes from '../config/routes.config';

class BaseComponent extends VisualComponent {
  constructor() {
    super();
    this.registerLanguageActions();
  }

  startComponentRouting(componentRoutes) {
    if (Object.keys(componentRoutes).length) {
      Object.keys(componentRoutes).forEach((route) => {
        if (window.location.pathname.startsWith(route)) {
          componentRoutes[route].init();
        }
      });
    }
  }

  registerLanguageActions() {
    this.bootFunctions.forEach((func) => func.call(this));
  }

  languageBlockClickHandler() {
    this.findById('change-language-trigger').onclick = () => {
      this.openModal(this.findById('lang-block'));
    };
  }

  languageOptionClickHandler() {
    this.languageOptions.forEach((item) => {
      // eslint-disable-next-line no-param-reassign
      item.onclick = () => {
        const { lang } = item.dataset;
        axios.post(routes.language.change, { lang })
          .then(() => window.location.reload());
      };
    });
  }

  get bootFunctions() {
    return [
      this.languageOptionClickHandler,
      this.languageBlockClickHandler,
    ];
  }
}

export default BaseComponent;
