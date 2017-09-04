import {Student} from '../../services/resources';

const state = {
    classTests: [],
    classTest: null,
    question: null
};

const mutations = {
    setClassTests(state, classTests){
        state.classTests = classTests;
    },
    setClassTest(state, classTest){
        state.classTest = classTest;
    },
    setQuestion(state, question) {
        state.question = question;
    }
};

const actions = {
    query(context, classTeachingId) {
        return Student.classTest.query({class_teaching: classTeachingId})
        .then(response => {
           context.commit('setClassTests', response.data);
       });
    },
    get(context, {classTeachingId, classTestId}) {
        return Student.classTest.get({class_teaching: classTeachingId, class_test: classTestId})
        .then(response => {
           context.commit('setClassTest', response.data);
       });
    }
};

export default {
    namespaced: true,
    state, mutations, actions
}