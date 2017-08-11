import Vue from 'vue';
import {ClassStudentResource} from "../services/resources";
import ADMIN_CONFIG from '../services/adminConfig';

const state = {
    students: []
};

const mutations = {
    set(state, students) {
        state.students = students;
    },
    add(state, student) {
       state.students.push(student);
    },
    destroy(state, studentId) {
        let index = state.students.findIndex((item) => {
           return item.id == studentId;
        });
        if(index != 1){
            state.students.splice(index, 1);
        }
    }
};

const actions = {
    query(context,classInformationId){
        return Vue.http.get(`${ADMIN_CONFIG.ADMIN_URL}/class_informations/${classInformationId}/students`)
            .then(response => {
                context.commit('set', response.data);
            })
    },
    store(context, {studentId, classInformationId}) {
        return ClassStudentResource.save({class_information: classInformationId}, {student_id: studentId})
            .then(response => {
                context.commit('add', response.data);
            });
    },
    destroy(context, {studentId, classInformationId}) {
        return ClassStudentResource.delete({class_information: classInformationId, student: studentId})
            .then(response => {
               context.commit('destroy', studentId);
               return response.data;
            });
    }
};

const module = {
    namespaced: true,
    state, mutations, actions
};

export default module;