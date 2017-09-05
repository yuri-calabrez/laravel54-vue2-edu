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
    get(context, {classTestId, studentClassTestId}) {
        return Student.studentClassTest.get({class_test: classTestId, student_class_test: studentClassTestId})
        .then(response => {
           context.commit('setStudentClassTest', response.data);
       });
    },
    create(context, classTestId) {
        return Student.studentClassTest.save({class_test: classTestId}, context.state.studentClassTest);
    }
};

export default {
    namespaced: true,
    state, mutations, actions
}