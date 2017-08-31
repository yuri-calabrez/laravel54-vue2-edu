import {Teacher} from '../../services/resources';

function newChoice(){
    return {
        choice: ''
    };
}

function newQuestion(){
    return {
        question: '',
        point: 1,
        choices: [
        newChoice(),
        newChoice(),
        newChoice(),
        newChoice(),
        ]
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
    },
    deleteQuestion(state, index) {
        state.classTest.questions.splice(index, 1);
    },
    addChoice(state) {
        state.question.choices.push(newChoice());
    },
    deleteChoice(state, index) {
        state.question.choices.splice(index, 1);
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
    },
    create(context, classTeachingId) {
        return Teacher.classTest.save({class_teaching: classTeachingId}, context.state.classTest);
    },
    update(context, {classTeachingId, classTestId}) {
        return Teacher.classTest.update({
            class_teaching: classTeachingId, 
            class_test: classTestId}, context.state.classTest);
    },
};

export default {
    namespaced: true,
    state, mutations, actions
}