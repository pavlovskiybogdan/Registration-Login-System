import { id } from './utils';

const register = {
  get rules() {
    return [
      { field: id('firstname'), min: '3', max: '50' },
      { field: id('lastname'), min: '3', max: '50' },
      { field: id('email'), min: '5', max: '50' },
      { field: id('country'), min: '3', max: '70' },
      { field: id('password'), min: '6', max: '50' },
      { field: id('password_confirm'), min: '6', max: '50' },
    ]
  }
}
export { register };