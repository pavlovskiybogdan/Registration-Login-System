import ChangePassword from './components/ChangePassword';
import PasswordReset from './components/PasswordReset';
import Register from './components/Register';
import Auth from './components/Auth';

export default {
  '/register': new Register(),
  '/login': new Auth(),
  '/reset-password': new PasswordReset(),
  '/change-password/': new ChangePassword(),
};
