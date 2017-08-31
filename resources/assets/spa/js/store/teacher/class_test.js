import {Teacher} from '../../services/resources';

function newQuestion(){
    return {
        question: '',
        point: 1,
        choices: []
    }
}

const state = {
    classTests: [],
    classTest: {
        name: '',
        date_start: '',
        date_end: '',
        questions: []
    },
    question: newQuestion()
};

const mutations = {
    setClassTests(state, classTests){
        state.classTests = classTests;
    },
    setClassTest(state, classTest){
        state.classTest = classTest;
    },
    addQuestion(state) {
        state.classTest.questions.push(state.question);
        state.question = newQuestion();
    }
};

const actions = {
    query(context, classTeachingId) {
        return Teacher.classTest.query({class_teaching: classTeachingId})
            .then(response => {
               context.commit('setClassTests', response.data);
            });
    },
    get(context, {classTeachingId, classTestId}) {
        return Teacher.classTest.get({class_teaching: classTeachingId, class_test: classTestId})
            .then(response => {
               context.commit('setClassTest', response.data);
            });
    }
};

export default {
    namespaced: true,
    state, mutations, actions
}