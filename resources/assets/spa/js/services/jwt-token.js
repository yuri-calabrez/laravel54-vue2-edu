import {Jwt} from './resources';
import LocalStorage from './localstorage';

const payloadToObject = (token) => {
    let payload = token.split('.')[1];
    return JSON.parse(atob(payload));
};

export default {
    set token(value) {
        value ? LocalStorage.set('token', value) : LocalStorage.remove('token');
    },
    get token() {
        return LocalStorage.get('token');
    },
    get payload() {
        return this.token != null ? payloadToObject(this.token) : null;
    },
    accessToken(username, password) {
        return Jwt.accessToken(username, password)
            .then((response) => {
                this.token = response.data.token;
            });
    },
    revokeToken() {
        let afterRevokeToken = () => {
            this.token = null;
        };
        return Jwt.logout()
            .then(afterRevokeToken)
            .catch(afterRevokeToken);
    }
}