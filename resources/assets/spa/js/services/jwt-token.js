import {Jwt} from './resources';
import LocalStorage from './localstorage';

export default {
    set token(value){
        LocalStorage.set('token', value);
    },
    get token(){
        return LocalStorage.get('token');
    },
    accessToken(username, password) {
        return Jwt.accessToken(username, password)
            .then((response) => {
                this.token = response.data.token;
            });
    },
    revokeToken(){

    }
}