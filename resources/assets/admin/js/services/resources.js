import 'vue-resource';
import Vue from 'vue';
import ADMIN_CONFIG from './adminConfig';

Vue.http.headers.common['X-CSRF-token'] = $("meta[name=csrf-token]").attr('content');

let ClassStudentResource = Vue.resource(`${ADMIN_CONFIG.ADMIN_URL}/class_informations/{class_information}/students/{student}`);
let ClassTeachingResource = Vue.resource(`${ADMIN_CONFIG.ADMIN_URL}/class_informations/{class_information}/teachings/{teaching}`);

export {
    ClassStudentResource, ClassTeachingResource
}