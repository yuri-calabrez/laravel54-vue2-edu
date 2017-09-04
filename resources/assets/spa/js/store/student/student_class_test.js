import {Student} from '../../services/resources';
import Vue from 'vue';

const state = {
    studentClassTest: {
        choices: {}
    }
};

const mutations = {
    setStudentClassTest(state, studentClassTest){
        state.studentClassTest = studentClassTest;
    },
    setChoiceTrue(state, {choiceId, question}){
        if(!state.studentClassTest.choices.hasOwnProperty(question.id)){
            Vue.set(state.studentClassTest.choices, question.id, choiceId);
        }
        state.studentClassTest.choices[question.id] = choiceId;
    }
};

const actions = {
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