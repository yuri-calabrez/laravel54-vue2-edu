export default [
    /*{
        name: 'class_informations.list',
        path: '/classes',
        component: require('./components/teacher/TeacherClassInformationList.vue'),
        meta: {
            auth: true
        }
    },*/
    {
        path: '/teacher',
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                name: 'teacher.class_teachings.list',
                path: 'classes',
                component: require('./components/teacher/TeacherClassTeachingList.vue'),
                meta: {
                    auth: true
                }
            },
            {
                name: 'teacher.class_tests.list',
                path: 'classes/:class_teaching/tests',
                component: require('./components/teacher/class_test/TeacherClassTestList.vue'),
                meta: {
                    auth: true
                }
            },
            {
                name: 'teacher.class_tests.create_data',
                path: 'classes/:class_teaching/tests/create_data',
                component: require('./components/teacher/class_test/TeacherClassTestStepData.vue'),
                meta: {
                    auth: true
                }
            },
            {
                name: 'teacher.class_tests.update_data',
                path: 'classes/:class_teaching/tests/:class_test/update_data',
                component: require('./components/teacher/class_test/TeacherClassTestStepData.vue'),
                meta: {
                    auth: true
                }
            },
            {
                name: 'teacher.class_tests.questions',
                path: 'classes/:class_teaching/tests/:class_test?/questions',
                component: require('./components/teacher/class_test/TeacherClassTestStepQuestions.vue'),
                meta: {
                    auth: true
                }
            }
        ]
    },
    {
        path: '/student',
        component: {
            template: '<router-view></router-view>'
        },
        children: [
            {
                name: 'student.class_informations.list',
                path: 'classes',
                component: require('./components/student/StudentClassInformationList.vue'),
                meta: {
                    auth: true
                }
            },
            {
                name: 'student.class_teachings.list',
                path: 'classes/:class_information/teachings',
                component: require('./components/student/StudentClassTeachingList.vue'),
                meta: {
                    auth: true
                }
            },
        ]
    },
    {
        name: 'login',
        path: '/login',
        component: require('./components/Login.vue')
    },
    {path: '*', redirect: '/login'}
];