import Vuex from 'vuex';
import ClassStudent from './class_student';
import ClassTeaching from './class_teaching';

export default new Vuex.Store({
    modules: {
        ClassStudent,
        ClassTeaching
    }
});