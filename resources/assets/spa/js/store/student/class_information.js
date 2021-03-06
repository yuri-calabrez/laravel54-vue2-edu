import {Student} from '../../services/resources';

const state = {
    classInformations: [],
    classInformation: null
};

const mutations = {
    setClassInformations(state, classInformations){
        state.classInformations = classInformations;
    },
     setClassInformation(state, classInformationId){
        state.classInformation = classInformationId;
     }
};

const actions = {
    query(context){
        return Student.classInformation.query()
            .then(response => {
               context.commit('setClassInformations', response.data);
            });
    },
    get(context, classInformationId){
        return Student.classInformation.get({class_information: classInformationId})
            .then(response => {
               context.commit('setClassInformation', response.data);
            });
    }
};

export default {
    namespaced: true,
    state, mutations, actions
}